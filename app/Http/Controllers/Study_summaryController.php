<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Study_summary;

use Carbon\Carbon;

class Study_summaryController extends Controller
{
    public function summary_show(){
        $event= Study_summary::where('month', '9')->where('year', '2024')->get();
        
        return view('study_summaries.index')->with('events',$event);
    }
    
    public function summary_get(Request $request){
         
         $event_hours = Study_summary::select('select event_title from study_summaries')->where('month', '9')->where('year', '2024')->get();
    
        return view('study_summaries.index')->with('event_hour',$event_hours);
    }
    
    public function summary_time(Request $request){
    $year = data('Y');
    $month = data('m');
    
    if($request->filled('year','month')){
        $year = $request->year;
        $month = $request->month;
    }
    }
    
        public function getMonthlyEvents($year, $month)
    {
        $events= Study_summary::where('month', $month)->where('year', $year)->get();

        return response()->json($events);
    }
}
