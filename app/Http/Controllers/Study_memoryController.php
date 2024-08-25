<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Study_memory;

class Study_memoryController extends Controller
{
    public function index(Study_memory $study_memory)//インポートしたstudy_memoryをインスタンス化して$study_memoryとして使用。
    {
    return view('study_memories.index')->with(['study_memories' => $study_memory->get()]);  
    }
}
