<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <x-app-layout>

    <body>
    <div class="bodyimage">
    <div>
        <img src="https://res.cloudinary.com/dttichlms/image/upload/v1727045763/gachagacha_pekalb.png" alt="画像が読み込めません。" style="max-width:300px;">
    </div>
    </div>
    <div class="container">
        <div class="bodyimage">
        <h1>ガチャを引く</h1>
        現在のガチャｐｔ：{{ Auth::user()->gacha_pt }}
        </div>
        <div class="bodyimage">
        @if(Auth::user()->gacha_pt >= 5 )
        <form action="{{ route('gacha_draw') }}" method="POST">
            @csrf
            <button type="submit" class="gray-button">引く</button>
        </form>
        @else
        <p>ガチャｐｔが足りません</p>
        @endif
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
        }
        .gray-button:hover {
            background-color: darkgray; /* ホバー時の色 */
        }
    </style>