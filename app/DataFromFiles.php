<?php 
namespace App;
use App\ReadFile;
use App\ReadJson;
use App\ReadCsv;
use App\ReadLDIF;
use Illuminate\Database\Eloquent\Model;

class DataFromFiles extends Model
{
	private $data=[];	

	public function __construct()
	{
		$csv=new ReadCsv('files/dataFeb-2-2017.csv');
		$json= new ReadJson('files/dataFeb-2-2017.json');
		$LDIF= new ReadLDIF('files/dataFeb-2-2017.ldif');
		//===============================================================
		$this->JoinData($csv);
		$this->JoinData($json);
		$this->JoinData($LDIF);
	}
	//===============================================================
	private function JoinData(ReadFile $ReadFile)
	{
		$combinedData =$ReadFile->returnData();
		$this->data = array_merge($combinedData, $this->data);
	}
	//===============================================================
	public function FindLargestOrdersForMedicines($limit){
		$orders=[];
		foreach ($this->data as $key => $single) {
			foreach ($single as $a) {
				array_push($orders,$a['Order']);
			}
		}
		$count_orders = array_count_values($orders);
		arsort($count_orders);
		$largestOrders=array_slice($count_orders, 0, $limit);
		return $largestOrders;
	}
	//===============================================================
	public function GetGroups(){
		$groups=[];
		foreach ($this->data as $namefile => $single) {
			foreach ($single as $a) {
				if(!in_array($a['Group'], $groups, true)){
					array_push($groups,$a['Group']);
			    }
			}
		}
		asort($groups);
		return $groups;
	}
	//===============================================================
	public function GetOrdersByGroupNumber(int $group_number){
		$sort_data=$this->data;
		$new_data=[];

		foreach ($sort_data as $namefile => $single) {
			foreach ($single as  $a) {
				if($a['Group']==$group_number){
					array_push($new_data,$a);
			    }
			}
		}
		return $new_data;
	}
	//===============================================================
	public function FindMostPopularCountryInGroup($data_group){

		$allCountriesInGroup=[];
		foreach ($data_group as $key => $a) {
			array_push($allCountriesInGroup,$a['Country']);
		}
		$mostPopularCountries = array_count_values($allCountriesInGroup);
		$max_count=max($mostPopularCountries);
		$mostPopularCountries=array_keys($mostPopularCountries, $max_count);
		$return_data=['max_count'=>$max_count,'countries'=>$mostPopularCountries];
		return (object) $return_data;
	}

	//===============================================================
	private function  CountStatutestInFiles()
	{
		foreach ($this->data as $namefile => $single) {
			foreach ($single as $a) {
				if (isset($statuses[$a['Status']][$namefile])) {
					array_push($statuses[$a['Status']][$namefile],$a['Status']);
				}else{
					$statuses[$a['Status']][$namefile]=[$a['Status']];
				}
				
				$countStatutes[$a['Status']][$namefile]=count($statuses[$a['Status']][$namefile]);
			}
		}
		return $countStatutes;
	}
	//===============================================================
	public function MainStatutesInFile(){

		$status=$this->CountStatutestInFiles();

		foreach ($status as $key => $value) {		
			$max_count=max($value);
			$value=array_keys($value, $max_count);
			$new[$key]=[
				'max_count'=>$max_count,
				'files'=>$value
			];
		}
		return $new;
	}
	//===============================================================
	public function ConvertedAllCustomersToString(){
		$customers_string='';
		foreach ($this->data as $namefile => $single) {
			foreach ($single as $a) {
				$customers_string.=$a['Customer'];
			}
		}
		return $customers_string;
	}
	//===============================================================
}