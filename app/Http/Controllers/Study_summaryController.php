<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Study_summary;

class Study_summaryController extends Controller
{
    public function summary_show(){
    return view('study_summaries.index');
    }
}
