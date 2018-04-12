<?php
namespace App\Http\Controllers;
use App\DataFromFiles;
use Illuminate\Http\Request;
use App\CountConsonants;
class DataController extends Controller
{
    public function __construct(DataFromFiles $dataFromFiles){
    	$this->dataFromFiles=$dataFromFiles;
    }
    //==========================================================
    public function LargestOrders()
    {
    	$limit=30;
    	$best_orders=$this->dataFromFiles->FindLargestOrdersForMedicines($limit);
    	return view('Data.LargestOrders', compact('best_orders','limit'));
    }
    //==========================================================
    public function GetOrderByGroup($id)
    {
    	$getGroups=$this->dataFromFiles->GetGroups();
    	$ordersByGroupNumber=$this->dataFromFiles->GetOrdersByGroupNumber($id);
        if ($ordersByGroupNumber==null) {
            abort(404);
        }
    	$mostPopularCountriesInGroup=$this->dataFromFiles->FindMostPopularCountryInGroup($ordersByGroupNumber);
    	return view('Data.GetOrderByGroup', compact('getGroups','ordersByGroupNumber','mostPopularCountriesInGroup'));
    }
    //============================================================================================
    public function StatutesInFiles(){
        $status=$this->dataFromFiles->MainStatutesInFile();
        return view('Data.StatutesInFiles',compact('status'));
    }
    //============================================================================================
    public function ShowCustomerConsonants(){
        $customersString=$this->dataFromFiles->ConvertedAllCustomersToString();
        $cutSpaceFromCustomersString=str_replace(' ',"",$customersString);
        $customersConsonants=CountConsonants::count( $cutSpaceFromCustomersString);
        return view('Data.ShowCustomerConsonants', compact('customersConsonants'));
    }
}