<?php
namespace App;
abstract class ReadFile
{
	protected $data=[];
	public function __construct($file){
		$this->file=$file;
	}
	abstract protected function readData():array;
	
	public function returnData()
	{
		try {
			$new_data =$this->readData();
		}
		catch (\Exception $e) {
			echo "Plik <b>$this->file</b> nie istnieje lub nie spełnia załozonej struktury popraw plik i spróbuj ponownie";
		}
		$file_name=$this->getReadNameFile();
		return [
			$file_name=>$new_data
		];
	}
	private function getReadNameFile(){
		return basename($this->file);
	}
}