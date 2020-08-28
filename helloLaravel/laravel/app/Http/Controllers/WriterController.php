<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use NunoMaduro\Collision\Writer;
use App\writerInfo;
use Illuminate\Support\Facades\DB;

class WriterController extends Controller {

    public function writer()    // 메인  list
    {
        $writerInfos = DB::table('writer_infos')->orderBy('id', 'desc')->paginate(5);
        // 페이징 기능(한 페이지당 게시글 5개씩 출력), 내림차순(최신글 순으로 출력)
        return view('writers.writer', ['writerInfos' => $writerInfos]);
    }

    public function create() {  // 글 작성 write
        $user_id = auth()->user()->name;
//        $user_id = Auth::user();
//        dd($user_id);
        return view('writers.create', ['user_id' => $user_id]);
    }

    public function store(Request $request) // 글 작성 write_process
    {
        $values = request(['title', 'body']);
        $values['user_id'] = auth()->id();

        $request->validate([
            'title' => 'required',
            'body'  => 'required'
        ]);

        $writerInfo = new writerInfo;
        $writerInfo->user_id  = $request->user()->name; // DB의 게시글 user_id 부분,
        $writerInfo->title    = $request->title;        // DB의 게시글 title 부분, create.blade.php 의 name=title 값 추가
        $writerInfo->contents = $request->body;         // DB의 게시글 contents 부분, create.blade.php 의 name=body 값 추가
        $writerInfo->save();

        return redirect('writers/writer'); // redirect 할 페이지
    }

    public function show(writerInfo $writer)    // 글 보기 view
    {
//        $writer = Writer::latest()->where('user_id', auth()->id())->get();
//        dd($writer);
//        dd(auth()->id());
//        dd($writer->user_id);
//        $writer = auth()->user()->name;
//        dd( auth()->user()->name);
        return view('writers.show', ['writer' => $writer]);
    }

    public function edit(writerInfo $writer)    // 글 수정 modify
    {
        return view('writers.edit', ['writer'=>$writer]);
    }

    public function update(Request $request, writerInfo $writer)    // 글 수정 modify_porcess
    {
        $request->validate([
            'title' => 'required',
            'body'  => 'required'
        ]);
        $writer->title = $request->title;
        $writer->contents  = $request->body;
        $writer->save();
        return redirect('writers/writer');
    }

    public function destroy(writerInfo $writer)     // 글 삭제 delete
    {
        $writer->delete();
        return redirect('writers/writer');
    }
}
