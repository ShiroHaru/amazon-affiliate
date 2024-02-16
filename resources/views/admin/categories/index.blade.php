@extends('adminlte::page')
@section('title', '')
@section('content_header')
<h1>{{ $controller['name_ja'] }} {{ $action['name_ja'] }}</h1>
@stop

@section('content')

{{-- パンくず --}}
{{ Breadcrumbs::render('admin.categories')}}
{{-- メッセージ --}}
@include('components.alert')

{{-- 一覧 --}}
<div class="">
  <div>
    <a href="{{ route('categories.create') }}" class="btn btn-primary btn-sm mb-2" role="button">新規登録</a>
  </div>
  <div class="card">
    <div class="card-body">
      <table class="table">
        <thead>
          <th>id</th>
          <th>名前</th>
          <th></th>
        </thead>
        <tbody>
          @foreach ($categories as $category)
          <tr>
            <td>{{ $category->id }}</td>
            <td>{{ $category->name }}</td>
            <td class="w-100px">
              <div class="btn-group" role="group" aria-label="Basic outlined example">
                {{-- 詳細 --}}
                <div type="button" class="btn btn-outline-primary">
                  <a href="{{  route('categories.show', $category) }}" class="" role="button"><i
                      class="fas fa-file-alt"></i></a>
                </div>
                {{-- 更新 --}}
                <div type="button" class="btn btn-outline-primary">
                  <a href="{{ route('categories.edit', $category) }}" class="" role="button"><i
                      class="fas fa-edit"></i></a>
                </div>
                {{-- 削除 --}}
                <div type="button" class="btn btn-outline-primary">
                  <form action="{{ route('categories.destroy', $category->id) }}" method="post">
                    @csrf
                    @method('DELETE')
                    {{-- 簡易的に確認メッセージを表示 --}}
                    <a class="" type="submit" onclick="return confirm('削除してもよろしいですか？')">
                      <i class="fas fa-trash"></i>
                    </a>
                  </form>
                </div>
              </div>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>
@stop