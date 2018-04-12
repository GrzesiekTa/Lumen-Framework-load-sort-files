<?php 
namespace App;

class CountConsonants
{
	public static function count($string)
    {
        return preg_match_all('@[qbcćdfghjklłmnprstwxzżźv]@i',$string);
    }
}