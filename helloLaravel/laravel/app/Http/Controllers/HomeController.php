<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index() {
//        $webPrograms = [
//            'html',
//            'css',
//            'javascript',
//            'php',
//        ];
//        return view('test')->with([
//            'webPrograms' => $webPrograms
//        ]);

        return view('home');
    }

    public function show() {

        return view('home_show');
    }



}
