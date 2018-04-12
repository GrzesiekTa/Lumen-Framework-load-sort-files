<?php 
namespace App;

use App\ReadFile;
use App\LdifToArray;

class ReadLDIF extends ReadFile
{
	public function readData():array
	{
		$ld = new LdifToArray($this->file,true);
		$ldif=$ld->getArray();
		return $ldif;
	}
}