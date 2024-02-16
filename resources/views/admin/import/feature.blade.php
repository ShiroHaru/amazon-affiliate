@extends('adminlte::page')
@section('title', '')
@section('content_header')
<h1>{{ $controller['name_ja'] }} {{ $action['name_ja'] }}</h1>
@stop

@section('content')

{{-- パンくず --}}
{{ Breadcrumbs::render('admin.categories.edit')}}
{{-- メッセージ --}}
@include('components.alert')
{{-- エラーメッセージ --}}
@include('components.error')


{{-- 新規登録 --}}
<div class="container">
  <form action="{{ action('Admin\ImportController@store') }}" method="POST" enctype="multipart/form-data">
    @csrf


    <div class="mb-3">
      <label class="form-label">Orignを選択</label>
      <select class="form-select" aria-label="Default select example">
        <option value="">-</option>
        @foreach ($origins_with_categories as $origins)
        @php
        $categories_arr = []; //optionテキスト用にカテゴリー名を連結
        @endphp
        @foreach ($origins->categories as $category)
        @php
        $categories_arr[] = $category->name;
        @endphp
        @endforeach
        <option value="{{ $origins->id }}">{{ implode(', ', $categories_arr) }}</option>
        @endforeach
      </select>
    </div>

    <div class="mb-3">
      <label class="form-label">jsonファイルを選択</label>
      <input type="file" class="form-control" id="json" name="json">
    </div>

    <button type="submit" class="btn btn-primary">Submit</button>
  </form>
</div>
@stop