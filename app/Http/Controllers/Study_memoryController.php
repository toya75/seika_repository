<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Study_memory;

use Carbon\Carbon;

use Illuminate\Support\Facades\Auth;

use App\Models\Study_summary;

class Study_memoryController extends Controller
{

        // カレンダー表示
    public function memory_show(){
  
        
       
       $titles = Study_memory::where('event_title', 'テスト２')->get();
       $sum =0;
       $carbon1 = 0;
       $carbon2 = 0;
       
        
        foreach($titles as $title){
            $carbon1 = new Carbon($title->start_date);
            $carbon2 = new Carbon($title->end_date);
            $sum += $carbon1->diffInHours($carbon2) ;
        
        }
    return view('study_memories.index')->with('sums',$sum);
    }
    
//（ここから）追記
    // 新規予定追加
    public function memory_create(Request $request, Study_memory $event){
        // バリデーション（eventsテーブルの中でNULLを許容していないものをrequired）
        $request->validate([
            'event_title' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'event_color' => 'required',
        ]);
        
        $startDate = new Carbon($request->start_date);
        $month = $startDate->format('m');
        $year = $startDate->format('Y');
        
        $record = Study_summary::where('event_title', $request->event_title)->where('month', $month)->where('year', $year)->first();
        
        
        $carbon1 = new Carbon($request->start_date);
        $carbon2 = new Carbon($request->end_date);
        $hour = $carbon1->diffInHours($carbon2) ;
        
        
        
        if ($record) {
        // 既存のレコードが見つかった場合、時間を追加
            
            $record->hour += $hour;
            $record->save();
        } else {
        // 既存のレコードが見つからない場合、新しいレコードを作成
            $newRecord = new Study_summary();
            $newRecord->user_id = Auth::id();
            $newRecord->event_title = $request->event_title;
            $newRecord->hour = $hour;
            $newRecord->month = $month;
            $newRecord->year = $year;
            $newRecord->save();
        }
        // 登録処理
        $event->event_title = $request->input('event_title');
        $event->event_body = $request->input('event_body');
        $event->start_date = $request->input('start_date');
        $event->end_date = $request->input('end_date'); 
        $event->event_color = $request->input('event_color');
        $event->event_border_color = $request->input('event_color');
        $event->save();

        // カレンダー表示画面にリダイレクトする
        return redirect(route("memory_show"));
    }
//（ここまで）

//（ここから）追記
    // DBから予定取得
    public function memory_get(Request $request, Study_memory $event){
        // バリデーション
        $request->validate([
            'start_date' => 'required|integer',
            'end_date' => 'required|integer'
        ]);

        // 現在カレンダーが表示している日付の期間
        $start_date = date('Y-m-d',$request->input('start_date') / 1000); // 日付変換（JSのタイムスタンプはミリ秒なので秒に変換）
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
//（ここから）追記
    // 予定の更新
    public function memory_update(Request $request, Study_memory $event){
        $input = new Study_memory();

        $input->event_title = $request->input('event_title');
        $input->event_body = $request->input('event_body');
        $input->start_date = $request->input('start_date');
        $input->end_date = $request->input('end_date'); 
        $input->event_color = $request->input('event_color');
        $input->event_border_color = $request->input('event_color');

        // 更新する予定をDBから探し（find）、内容が変更していたらupdated_timeを変更（fill）して、DBに保存する（save）
        $event->find($request->input('id'))->fill($input->attributesToArray())->save(); // fill()の中身はArray型が必要だが、$inputのままではコレクションが返ってきてしまうため、Array型に変換

        // カレンダー表示画面にリダイレクトする
        return redirect(route("memory_show"));
    }
//（ここまで）

//（ここから）追記
    // 予定の削除
    public function memory_delete(Request $request, Study_memory $event){
        // 削除する予定をDBから探し（find）、DBから物理削除する（delete）
        $event->find($request->input('id'))->delete();

        // カレンダー表示画面にリダイレクトする
        return redirect(route("memory_show"));
    }
//（ここまで）
   private function sum(string $title){
       $events = Study_memory::where('event_title', $title)->get();
       $sum = 0;
        foreach($events as $event){
            $sum += $event->end_date - $event->start_date;
        }
        return $sum;
   }

}
