@extends('layouts.app')

@section('title', '글 작성(그림 작가)')

@section('content')
    <div>
        <ul class="float-left ml-5 text-blue-700    md:text-center">
            <li class="font-bold text-2xl">메     뉴</li>
            <li><a href="{{ route('home') }}">home</a></li>
            <li>공지사항</li>
            <li><a href="{{ route('writers.writer') }}">글  작가 페이지</a></li>
            <li><a href="{{ route('painters.painter') }}">그림 작가 페이지</a></li>
        </ul>
    </div>
    <div class="px-64">
        <h1 class="font-bold text-3xl">글 작성 (그림 작가)</h1><br>
        <form action="/painters" method="POST">
            @csrf
            {{-- label의 title이 input의 id와 같음 --}}
            <label class="block" for="title">제    목</label><br>
            <input class="border board-gray-800 w-full @error('title') border border-red-700 @enderror" type="text" name="title" id="title" required value="{{ old('title') ? old('title') : '' }}"><br>
            @error('title')
            <small class="text-red-700">{{ $message }}</small>
            @enderror

            <label class="block" for="body">내    용</label><br>
            <textarea class="border board-gray-800 w-full @error('body') border border-red-700 @enderror" name="body" id="body" cols="30" rows="10" required value="{{ old('title') ? old('title') : '' }}"></textarea><br>
            @error('body')
            <small class="text-red-700">{{ $message }}</small>
            @enderror

            <br><button class="bg-blue-600 text-white px-4 py-2 float-right">글 작성</button>
        </form>
    </div>
@endsection

