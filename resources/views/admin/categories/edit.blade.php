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

{{-- 編集 --}}
<div class="container">
  <form method="POST" action="{{ route('categories.update', $category->id) }}">
    @csrf
    @method('PATCH')
    <div class="mb-3">
      <label class="form-label">名前</label>
      <input type="text" name="name" value="{{$category->name}}" class="form-control" id="">
    </div>
    {{-- NodeTraitのparent_idのフォーム --}}
    <div class="mb-3">
      <label class="form-label">親カテゴリ</label>
      <select name="parent_id" class="form-select" aria-label="Default select example">
        <option value="0">親カテゴリ</option>
        @foreach ($categories as $cat)
        <option value="{{$cat->id}}" @if($category->parent_id == $cat->id) selected @endif>{{$cat->name}}</option>
        @endforeach
      </select>
      <button type="submit" class="btn btn-primary">Submit</button>
  </form>
</div>
@stop