<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Todo;

class TodoController extends Controller
{
    public function index()
    {
        $todo = new Todo();
        return view('todo.create');
        // $todos = $todo->all();

        //dd('新規作成画面のルート実行！');
    }

    public function create()
    {

        return view('todo.create');
        dd('新規作成画面のルート実行！');

    }

    public function store(Request $request)
    {
        $content = $request->input('content');

        // 1. todosテーブルの1レコードを表すTodoクラスをインスタンス化
        $todo = new Todo();
        // 2. Todoインスタンスのカラム名のプロパティに保存したい値を代入
        $todo->content = $content;
        // 3. Todoインスタンスの`->save()`を実行してオブジェクトの状態をDBに保存するINSERT文を実行
        $todo->save();

        return redirect()->route('todo.index');

    }
}
