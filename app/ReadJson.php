<?php 
namespace App;
use App\ReadFile;

class ReadJson extends ReadFile
{
	public function readData():array
	{
		$str = file_get_contents($this->file); 
		$json=json_decode($str,true);
	
		foreach ($json['data'] as $key => $value) {
			foreach ($json['cols'] as $key_cols => $value_cols) {
				$all_entity[$key][$value_cols]=$value[$key_cols];
			}
		}
		return $all_entity;
	}
}