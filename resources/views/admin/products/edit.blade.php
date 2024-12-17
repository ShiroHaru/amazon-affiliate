@extends('adminlte::page')
@section('title', '')
@section('content_header')
<h1>{{ $controller['name_ja'] }} {{ $action['name_ja'] }}</h1>
@stop

@section('content')

{{-- パンくず --}}
{{ Breadcrumbs::render('admin.products.edit')}}
{{-- メッセージ --}}
@include('components.alert')
{{-- エラーメッセージ --}}
@include('components.error')

{{-- 編集 --}}
<div class="container">
  <form method="POST" action="{{ route('products.update', $product->id) }}">
    @csrf
    @method('PATCH')
    <div class="mb-3">
      <label class="form-label">名前</label>
      <input type="text" name="name" class="form-control" value="{{ old('name', $product->name) }}">
    </div>
    <div class="mb-3">
      <label class="form-label">価格</label>
      <input type="text" name="price" class="form-control" value="{{ old('price', $product->price) }}">
    </div>
    <div class="mb-3">
      <label class="form-label">ASIN</label>
      <input type="text" name="asin" class="form-control" value="{{ old('asin', $product->asin) }}">
    </div>


    <div class="mb-3">
      <label class="form-label">カテゴリ</label>
      <div>
        @foreach ($categories as $index => $category)
        <div class="form-check">
          <label><input name="category_ids[{{ $index}}]" class="form-check-input" type="checkbox"
              value="{{ $category->id }}" {{ MyHelper::checked_array($errors, $index, $category->category_id)}}>{{
            str_repeat("-", $category->depth * 2) }}{{$category->name}}</label>
        </div>
        @endforeach

        {{-- <input type="hidden" name="category_ids[2]" value="9999"> --}}
      </div>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
  </form>
</div>
@stop