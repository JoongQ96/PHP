<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use NunoMaduro\Collision\Writer;
use App\painterInfo;
use Illuminate\Support\Facades\DB;

class PainterController extends Controller
{
    public function painter()    // 메인  list
    {
        // 페이징 기능(한 페이지당 게시글 5개씩 출력), 내림차순(최신글 순으로 출력)
        $painterInfos = DB::table('painter_infos')->orderBy('id', 'desc')->paginate(5);

        return view('painters.painter', ['painterInfos' => $painterInfos]);
    }

    public function create() {  // 글 작성 write
        $user_id = auth()->user()->name;

        return view('painters.create', ['user_id' => $user_id]);
    }

    public function store(Request $request) // 글 작성 write_process
    {
        $values = request(['title', 'body']);
        $values['user_id'] = auth()->id();

        $request->validate([
            'title' => 'required',
            'body'  => 'required'
        ]);

        $painterInfo = new painterInfo();
        $painterInfo->user_id  = $request->user()->name; // DB의 게시글 user_id 부분,
        $painterInfo->title    = $request->title;        // DB의 게시글 title 부분, create.blade.php 의 name=title 값 추가
        $painterInfo->contents = $request->body;         // DB의 게시글 contents 부분, create.blade.php 의 name=body 값 추가
        $painterInfo->save();

        return redirect('painters/painter'); // redirect 할 페이지
    }

    public function show(painterInfo $painter)    // 글 보기 view
    {
        return view('painters.show', ['painter' => $painter]);
    }

    public function edit(painterInfo $painter)    // 글 수정 modify
    {
        return view('painters.edit', ['painter'=>$painter]);
    }

    public function update(Request $request, painterInfo $painter)    // 글 수정 modify_porcess
    {
        $request->validate([
            'title' => 'required',
            'body'  => 'required'
        ]);
        $painter->title    = $request->title;
        $painter->contents = $request->body;
        $painter->save();

        return redirect('painters/painter');
    }

    public function destroy(painterInfo $painter)     // 글 삭제 delete
    {
        $painter->delete();

        return redirect('painters/painter');
    }
}
