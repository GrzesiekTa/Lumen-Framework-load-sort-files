<?php
namespace App;
class LdifToArray {
    protected $file;
    protected $rawdata;
    protected $entries = array();

    public function __construct($file='',$process=false) {
      $this->file = $file;
      if($process) {
        $this->makeArray();
      }
    }

    function getArray() {
      return $this->entries;
    }

    function makeArray() {
       if($this->file=='') {
         if($this->rawdata=='') {
           throw new \Exception("No filename specified, aborting", 1);
         }
       } else {
         if(!file_exists($this->file)) {
          throw new \Exception("File $this->file does not exist, aborting", 1);
         } else {
           $this->rawdata  = file_get_contents($this->file);
         }
       }

       if($this->rawdata=='') {
         throw new \Exception("No data in file, aborting", 1);
       }


       $this->parse2array();
       return true;

       if(!$this->splitEntries()) {
        throw new \Exception("Could not extract data from this file, aborting", 1);
       }
       $this->splitBlocks();
       sort($this->entries);
       return true;
    }

    function parse2array()  {

        $arr1=explode("\n",str_replace("\r",'',$this->rawdata));
        $i=$j=0;
        $arr2=array();

        /* First pass, rawdata is splitted into raw blocks */
        foreach($arr1 as $v)  {
            if (trim($v)=='') {
                ++$i;
                $j=0;
            } else {
                $arr2[$i][$j++]=$v;
            }
        }
        $check_array = count($arr2[0]);
        foreach($arr2 as $k1=>$v1) {
            if (count($v1)!=$check_array) {
              throw new \Exception("Could not extract data from this file, aborting", 1);
            }

            $i=0;
            $decode=false;

            foreach($v1 as $v2) {
                if (preg_match('::',$v2)) { 
                    $decode=true;
                    $arr=explode(':',str_replace('::',':',$v2));
                    $i=$arr[0];
                    $this->entries[$k1][$i]=($arr[1]);
                } elseif (preg_match(':',$v2)) {
                    $decode=false;
                    $arr=explode(':',$v2);
                    $count=count($arr);
                    if ($count!=2)
                        for($i=$count-1;$i>1;--$i)
                            $arr[$i-1].=':'.$arr[$i];
                    $i=$arr[0];

                    // handling arrays in ldap entry
                    if (isset($this->entries[$k1][$i])) {
                      if (!is_array($this->entries[$k1][$i])) {
                        $this->entries[$k1][$i]=array($this->entries[$k1][$i]);
                      }
                      $this->entries[$k1][$i][]=$arr[1];
                    } else {
                      $this->entries[$k1][$i]=$arr[1];
                    }
                } else {

                    if ($decode) { 
                        $this->entries[$k1][$i].=($v2);
                    } else {
                        $this->entries[$k1][$i]=$v2;
                    }
                }
            }
        }
    }
}
