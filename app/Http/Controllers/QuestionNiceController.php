<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuestionNiceController extends Controller
{
    public function store($questionId)
    {
        Auth::user()->like($questionId);
        return 'ok!'; //レスポンス内容
    }

    public function destroy($questionId)
    {
        Auth::user()->unlilikeke($questionId);
        return 'ok!'; //レスポンス内容
    }
}
