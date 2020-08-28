@extends('layouts.app')

@section('title', '글 보기')

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
        <h1 class="font-bold text-3xl">글 보기</h1>
        <label class="block" for="title">제    목</label><small class="float-right">작성일 {{ $writer->created_at }}</small>
        <br>
        <input class="border board-gray-800 w-full" readonly type="text" name="title" id="title" value="{{ $writer->title }}"><br>

        <label class="block" for="body">내    용</label><br>
        <textarea class="border board-gray-800 w-full" readonly name="body" id="body" cols="30" rows="10">{{ $writer->contents }}</textarea><br>

        <br>
        <button class="bg-blue-600 text-white px-4 py-2 float-left" onclick="location.href='/writers/writer'">M A I N</button>
        @if(auth()->user()->name == $writer->user_id)
            <form action="/writers/{{$writer->id}}" method="POST">
                @method('DELETE')
                @csrf
                <button class="bg-blue-600 text-white px-4 py-2 float-right ml-2">글 삭제</button>
            </form>
            <button class="bg-blue-600 text-white px-4 py-2 float-right" onclick="location.href='/writers/{{ $writer->id }}/edit'">글 수정</button>
        @endif
    </div>
@endsection
