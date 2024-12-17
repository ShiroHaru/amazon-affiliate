@extends('adminlte::page')
@section('title', '')
@section('content_header')
<h1>{{ $controller['name_ja'] }} {{ $action['name_ja'] }}</h1>
@stop

@section('content')

{{-- メッセージ --}}
@include('components.alert')

{{-- 新規登録 --}}
<div class="container">
  <form action="{{ route('products.store') }}" method="POST">
    @csrf
    <div class="mb-3">
      <label class="form-label">名前</label>
      <input type="text" name="name" class="form-control">
    </div>
    <div class="mb-3">
      <label class="form-label">価格</label>
      <input type="text" name="price" class="form-control">
    </div>
    <div class="mb-3">
      <label class="form-label">ASIN</label>
      <input type="text" name="asin" class="form-control">
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
  </form>
</div>
@stop