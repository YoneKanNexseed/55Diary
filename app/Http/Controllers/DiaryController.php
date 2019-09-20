<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Diary;
use App\Http\Requests\CreateDiary;

class DiaryController extends Controller
{
    // 一覧表示の画面を返す
    public function index()
    {
        // diariesテーブルのデータを全件取得
        // allメソッド：全件データを取得するメソッド
        $diaries = Diary::all();

        // dd($diaries);   // var_dump + 処理をここで中断
        // view('フォルダ名.ファイル名(blade.phpは除く)')
        return view('diaries.index', [
            'diaries' => $diaries
        ]);
    }

    // 新規追加の画面を表示するメソッド
    public function create()
    {
        return view('diaries.create');
    }

    // 新規追加の画面で投稿ボタンが押された時、
    // 投稿処理をするメソッド
    public function store(CreateDiary $request)
    {
        // ここからデータの登録処理

        // Diaryモデルのインスタンスを取得
        $diary = new Diary();

        // 画面で入力されたタイトルを代入
        $diary->title = $request->title;
        // 画面で入力された本文を代入
        $diary->body = $request->body;

        $diary->save(); // DBに保存

        // 一覧ページにリダイレクト
        // 戻った時のフォームを再送信しますか？の対策のため
        return redirect()->route('diary.index');
    }

    // 削除を実行するメソッド
    public function destroy(int $id)
    {
        // Diaryモデルを使って、削除したい要素の取得
        $diary = Diary::find($id);

        // 取得した要素を削除
        $diary->delete();

        // 一覧の画面に戻る
        return redirect()->route('diary.index');
    }

    // 編集画面を表示するメソッド
    public function edit(int $id)
    {
        // IDをもとに1件投稿を取得
        $diary = Diary::find($id);

        // 編集画面を表示する時、取得結果を渡す
        return view('diaries.edit', [
            'diary' => $diary
        ]);
    }

    // 編集処理をするメソッド
    public function update(CreateDiary $request, int $id)
    {
        // IDをもとに、投稿のタイトル、本文を更新
        $diary = Diary::find($id);
        $diary->title = $request->title;
        $diary->body = $request->body;
        $diary->save();

        // 一覧ページにリダイレクト
        return redirect()->route('diary.index');
    }
}
