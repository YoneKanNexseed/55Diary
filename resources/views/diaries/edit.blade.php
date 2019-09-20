<!-- layout.blade.phpをテンプレとして使う -->
@extends('layout')

<!-- layout.blade.phpのtitleの部分 -->
@section('title', '編集')

@section('content')
    <section class="container m-5">
        <div class="row justify-content-center">
            <div class="col-8">
                <form action="{{ route('diary.update', ['id' => $diary->id]) }}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="title">タイトル</label>
                        <input type="text" class="form-control" name="title" id="title" value="{{ $diary->title }}">
                    </div>
                    <div class="form-group">
                        <label for="title">本文</label>
                        <textarea class="form-control" name="body" id="body">{{ $diary->body }}</textarea>
                    </div>
                    <div class="text-right">
                        <button type="submit" class="btn btn-primary">更新</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection