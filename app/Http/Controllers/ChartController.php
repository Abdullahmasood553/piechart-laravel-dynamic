<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\DataAnalytics;

class ChartController extends Controller
{
    public function index() {  
        return view('chart');
    }


    public function fetchData() {
        $data = DataAnalytics::select(DB::raw('COUNT(*) as total_sales, name'))
        ->groupBy('name')
        ->get();
        foreach($data->toArray() as $row)
        {
         $output[] = array(
           'name' => $row['name'],
           'total_sales' => $row['total_sales']
         );
        }
        echo json_encode($output);
    }
}
