<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <x-app-layout>
    <x-slot name="header">
        　study_memory
    </x-slot>
    <body>
        <h1>Blog Name</h1>
        <div class='study_memories'>
            @foreach ($study_memories as $study_memory)
                <div class='study_memory'>
                    <h2 class='title'>{{ $study_memory->title }}</h2>
                    <p class='body'>{{ $study_memory->body }}</p>
                </div>
            @endforeach
        </div>
        
        ログインユーザー：{{ Auth::user()->name }}
        
    </body>
    </x-app-layout>
</html>