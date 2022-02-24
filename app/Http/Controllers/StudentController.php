<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class StudentController extends Controller
{
    public function index() {
        $result = DB::select(DB::raw("select count(*) as total_city, city from  students group by city"));
      
        $chartData = "";
        foreach($result as $list) {
            $chartData.="['".$list->city."', ".$list->total_city."],";        
        }
        // echo $chartData;
        $arr['chartData'] = rtrim($chartData, ",");
        return view('chart', $arr);
    }
}
