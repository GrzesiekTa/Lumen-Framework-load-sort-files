<?php 
namespace App;
use App\ReadFile;

class ReadCsv extends ReadFile
{

	public function readData():array
	{
		$csvFile = file($this->file);
		$keys = str_getcsv(array_shift($csvFile), '|');
		foreach ($csvFile as $key => $csvRecord) {
		    $csv[] = array_combine($keys, str_getcsv($csvRecord, '|')); 
		}
		return $csv;
	}
}

 ?>