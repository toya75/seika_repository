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
    
    public function show(){
    return view('study_memories.calendar');
    }
    
    public function create(Request $request, Study_memory $event){
        // バリデーション（eventsテーブルの中でNULLを許容していないものをrequired）
        $request->validate([
            'event_title' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'event_color' => 'required',
        ]);

        // 登録処理
        $event->user_id = $request->user()->id;
        $event->event_title = $request->input('event_title');
        $event->event_body = $request->input('event_body');
        $event->start_date = $request->input('start_date');
        $event->end_date = date("Y-m-d", strtotime("{$request->input('end_date')} +1 day")); // FullCalendarが登録する終了日は仕様で1日ずれるので、その修正を行っている
        $event->event_color = $request->input('event_color');
        $event->event_border_color = $request->input('event_color');
        $event->save();

        // カレンダー表示画面にリダイレクトする
        return redirect(route("show"));
    }
    
    // DBから予定取得
    public function get(Request $request, Event $event){
        // バリデーション
        $request->validate([
            'start_date' => 'required|integer',
            'end_date' => 'required|integer'
        ]);

        // 現在カレンダーが表示している日付の期間
        $start_date = date('Y-m-d', $request->input('start_date') / 1000); // 日付変換（JSのタイムスタンプはミリ秒なので秒に変換）
        $end_date = date('Y-m-d', $request->input('end_date') / 1000);

        // 予定取得処理（これがaxiosのresponse.dataに入る）
        return $event->query()
            // DBから取得する際にFullCalendarの形式にカラム名を変更する
            ->select(
                'id',
                'event_title as title',
                'event_body as description',
                'start_date as start',
                'end_date as end',
                'event_color as backgroundColor',
                'event_border_color as borderColor'
            )
            // 表示されているカレンダーのeventのみをDBから検索して表示
            ->where('end_date', '>', $start_date)
            ->where('start_date', '<', $end_date) // AND条件
            ->get();
    }
//（ここまで）
    
}
