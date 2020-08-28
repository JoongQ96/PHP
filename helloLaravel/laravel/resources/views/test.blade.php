{{-- 상속받음 --}}
@extends('layout')

{{-- title 수정용 --}}
@section('title')
    test 페이지
@endsection

{{-- content 수정용 --}}
@section('content')
    MyLaravelTest
    <ul>
        @foreach($webPrograms as $webProgram)
            <li>{{ $webProgram }}</li>
        @endforeach
    </ul>
@endsection

