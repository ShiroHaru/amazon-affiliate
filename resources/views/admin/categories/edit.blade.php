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
    <button type="submit" class="btn btn-primary">Submit</button>
  </form>
</div>
@stop