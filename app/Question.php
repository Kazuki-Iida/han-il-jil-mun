<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Question;

class Question extends Model
{
    /**
     * Post一覧を表示する
     * 
     * @param Post Postモデル
     * @return array Postモデルリスト
     */
    public function index(Question $question)
    {
        return $question->get();
    }
}
