<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <x-app-layout>

    <body>
    <div class="bodyimage">
    <div class="container">
        <h1>ガチャ結果</h1>
        <h2>おめでとう！あなたが引いたアイテムは: {{ $resultname }}</h2>
        <div>
            <img src="{{$resulturl}}" alt="画像が読み込めません。" style="max-width:300px;">
        </div>
        <a href="{{ route('gacha_show') }}" class="gray-button">戻る</a>
    </div>
    </div>
    </body>
    </x-app-layout>
</html>

    <style>
        .bodyimage {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 20px; /* 上部の余白 */
        }
    
            .gray-button {
            background-color: gray;
            color: white; /* ボタンの文字色 */
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            margin-bottom: 100px;
        }
        .gray-button:hover {
            background-color: darkgray; /* ホバー時の色 */
        }
   
    </style>