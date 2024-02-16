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
  <form action="{{ route('origins.store') }}" method="POST">
    @csrf
    <div class="mb-3">
      <label class="form-label">メモ</label>
      <textarea name="note" class="form-control"></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
  </form>
</div>
@stop