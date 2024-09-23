<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <x-app-layout>

    <body>
    <div>
        <img src="https://res.cloudinary.com/dttichlms/image/upload/v1727045763/gachagacha_pekalb.png" alt="画像が読み込めません。" style="max-width:200px;">
    </div>
    <div class="container">
    <div class="container">
        <h1>ガチャを引く</h1>
        現在のガチャｐｔ：{{ Auth::user()->gacha_pt }}
        @if(Auth::user()->gacha_pt >= 5 )
        <form action="{{ route('gacha_draw') }}" method="POST">
            @csrf
            <button type="submit">引く</button>
        </form>
        @else
        <p>ガチャｐｔが足りません</p>
        @endif
    </div>

    </body>
    </x-app-layout>
</html>