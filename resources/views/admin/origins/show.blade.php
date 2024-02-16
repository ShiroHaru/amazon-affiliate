@extends('adminlte::page')
@section('title', '')
@section('content_header')
<h1>{{ $controller['name_ja'] }} {{ $action['name_ja'] }}</h1>
@stop

@section('content')

{{-- パンくず --}}
{{ Breadcrumbs::render('admin.origins.show')}}

{{-- メッセージ --}}
@include('components.alert')

{{-- 一覧 --}}
<div class="">
  <div class="btn-row">
    {{-- 更新 --}}
    <a href="{{ route('origins.edit', $origin) }}" class="btn btn-primary btn-sm mb-2" role="button">編集</a>

    {{-- 削除 --}}
    <form action="{{ route('origins.destroy', $origin->id) }}" method="post">
      @csrf
      @method('DELETE')
      {{-- 簡易的に確認メッセージを表示 --}}
      <button class="btn btn-danger btn-sm" type="submit" onclick="return confirm('削除してもよろしいですか？')">
        削除
      </button>
    </form>
  </div>
  <div class="card">
    <div class="card-body">
      <div class="list-group list-group-flush">
        <div class="list-group-item">
          <div class="row">
            <div class="col-md-3">
              <div class="fw-bold">id</div>
            </div>
            <div class="col-md-4">
              <div>{{ $origin->id }}</div>
            </div>
          </div>
        </div>
        <div class="list-group-item">
          <div class="row">
            <div class="col-md-3">
              <div class="fw-bold">メモ</div>
            </div>
            <div class="col-md-4">
              <div>{{ $origin->note }}</div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
@stop