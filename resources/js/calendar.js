
import axios from "axios";
import { Calendar } from "@fullcalendar/core";
import dayGridPlugin from "@fullcalendar/daygrid";
import timeGridPlugin from '@fullcalendar/timegrid';
import interactionPlugin from '@fullcalendar/interaction'; // 追記1（interactionPluginの導入）

// （ここから）追記1
// 日付を-1してYYYY-MM-DDの書式で返すメソッド
function formatDate(date, pos) {
    const dt = new Date(date);
    if(pos==="end"){
        dt.setDate(dt.getDate());
    }
    return dt.getFullYear() + '-' +('0' + (dt.getMonth()+1)).slice(-2)+ '-' +  ('0' + dt.getDate()).slice(-2)+ 'T'+ ('0'+ dt.getHours()).slice(-2)+ ':'+ ('0' + dt.getMinutes()).slice(-2);
}
// （ここまで）

// カレンダーを表示させたいタグのidを取得
const calendarEl = document.getElementById("calendar");

// new Calender(カレンダーを表示させたいタグのid, {各種カレンダーの設定});
// "calendar"というidがないbladeファイルではエラーが出てしまうので、if文で除外。
if (calendarEl) {
    const calendar = new Calendar(calendarEl, {
        // プラグインの導入(import忘れずに)
        plugins: [interactionPlugin, dayGridPlugin, timeGridPlugin], // 追記2（interactionPluginの導入）
        
        
  slotDuration: '00:15:00',
  slotLabelInterval: '01:00',
  
  
  
        // カレンダー表示
        initialView: "timeGridWeek", // 最初に表示させるページの形式


// （ここから）追記1
    customButtons: { // カスタムボタン
        eventAddButton: { // 新規予定追加ボタン
            text: '予定を追加',
            click: function() {
                // 初期化（以前入力した値をクリアする）
                document.getElementById("new-id").value = "";
                document.getElementById("new-event_title").value = "";
                document.getElementById("new-start_date").value = "";
                document.getElementById("new-end_date").value = "";
                document.getElementById("new-event_body").value = "";
                document.getElementById("new-event_color").value = "blue";

                // 新規予定追加モーダルを開く
                document.getElementById('modal-add').style.display = 'flex';
            }
        }
    },
//（ここまで）

        headerToolbar: { // ヘッダーの設定
            // コンマのみで区切るとページ表示時に間が空かず、半角スペースで区切ると間が空く（半角があるかないかで表示が変わることに注意）
            start: "prev,next today", // ヘッダー左（前月、次月、今日の順番で左から配置）
            center: "title", // ヘッダー中央（今表示している月、年）
            end: "eventAddButton dayGridMonth,timeGridWeek", // 追記2（半角スペースは必要）
        },
        height: 'auto', // 高さをウィンドウサイズに揃える
        
// （ここから）追記3
    // カレンダーで日程を指定して新規予定追加
    selectable: true, // 日程の選択を可能にする
    select: function (info) { // 日程を選択した後に行う処理を記述
        // 選択した日程を反映（のこりは初期化）
        document.getElementById("new-id").value = "";
        document.getElementById("new-event_title").value = "";
        document.getElementById("new-start_date").value = formatDate(info.start); // 選択した開始日を反映
        document.getElementById("new-end_date").value = formatDate(info.end, "end"); // 選択した終了日を反映
        document.getElementById("new-event_body").value = "";
        document.getElementById("new-event_color").value = "blue";

        // 新規予定追加モーダルを開く
        document.getElementById('modal-add').style.display = 'flex';
    },
//（ここまで）
        
//（ここから）追記
    // DBに登録した予定を表示する
    events: function (info, successCallback, failureCallback) { // eventsはページが切り替わるたびに実行される
        // axiosでLaravelの予定取得処理を呼び出す
        axios
            .post("/calendar/get", {
                // 現在カレンダーが表示している日付の期間(1月ならば、start_date=1月1日、end_date=1月31日となる)
                start_date: info.start.valueOf(),
                end_date: info.end.valueOf(),
            })
            .then((response) => {
                // 既に表示されているイベントを削除（重複防止）
                calendar.removeAllEvents(); // ver.6でもどうやら使える（ドキュメントにはない？）
                // カレンダーに読み込み
                successCallback(response.data); // successCallbackに予定をオブジェクト型で入れるとカレンダーに表示できる
            })
            .catch((error) => {
                // バリデーションエラーなど
                alert("登録に失敗しました。");
            });
    },
// （ここまで）

// （ここから）追記2
    // 予定をクリックすると予定編集モーダルが表示される
    eventClick: function(info) {
        // console.log(info.event); // info.event内に予定の全情報が入っているので、必要に応じて参照すること
        document.getElementById("id").value = info.event.id;
        document.getElementById("delete-id").value = info.event.id; // ここを追記
        document.getElementById("event_title").value = info.event.title;
        document.getElementById("start_date").value = formatDate(info.event.start);
        document.getElementById("end_date").value = formatDate(info.event.end, "end");
        document.getElementById("event_body").value = info.event.extendedProps.description;
        document.getElementById("event_color").value = info.event.backgroundColor;

        // 予定編集モーダルを開く
        document.getElementById('modal-update').style.display = 'flex';
        
         
    },
// （ここまで）



    });
    
    // カレンダーのレンダリング
    calendar.render();
    
//（ここから）追記
// 新規予定追加モーダルを閉じる
window.closeAddModal = function(){
    document.getElementById('modal-add').style.display = 'none';
}
// （ここまで）

//（ここから）追記
// 予定編集モーダルを閉じる
window.closeUpdateModal = function(){
    document.getElementById('modal-update').style.display = 'none';
}
// （ここまで）

//（ここから）追記
window.deleteEvent = function(){
    'use strict'

    if (confirm('削除すると復元できません。\n本当に削除しますか？')) {
        document.getElementById('delete-form').submit();
    }
}
// （ここまで）

}