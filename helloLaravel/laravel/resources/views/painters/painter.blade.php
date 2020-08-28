@extends('layouts.app')

@section('title', '그림 작가 페이지')

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
        <h1 class="font-bold text-3xl">그림 작가 페이지</h1><br>
        <table class="border border-gray-800 w-full">
            <tr>
                <td>번호</td><td>제목</td><td>작성자</td><td>날짜</td>
            </tr>
            @foreach($painterInfos as $painterInfo)
                <tr>
                    <td>{{ $painterInfo->id }}</td>
                    <td><a href="/painters/{{ $painterInfo->id }}">{{ $painterInfo->title }}</a></td>
                    <td>{{ $painterInfo->user_id }}</td>
                    <td>{{ $painterInfo->updated_at }}</td>
                </tr>
            @endforeach
        </table><br>
        <div class="px-20">
            {{ $painterInfos->links() }}
        </div>
        <br>
        <a href="{{ route('home') }}" class="bg-blue-600 text-white px-4 py-2 float-right ml-2">h o m e</a>
        <a href="{{ route('painters.input') }}" class="bg-blue-600 text-white px-4 py-2 float-right">글 작성</a>
    </div>
@endsection




