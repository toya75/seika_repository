<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <x-app-layout>

    <body>
    <div class="container">
        <h1>ガチャ結果</h1>
        <h2>おめでとう！あなたが引いたアイテムは: {{ $resultname }}</h2>
        <div>
            <img src="{{$resulturl}}" alt="画像が読み込めません。" style="max-width:200px;">
        </div>
        <a href="{{ route('gacha_show') }}">戻る</a>
    </div>
    </body>
    </x-app-layout>
</html>