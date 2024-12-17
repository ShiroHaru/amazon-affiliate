@extends('adminlte::page')
@section('title', '')
@section('content_header')
<h1>{{ $controller['name_ja'] }} {{ $action['name_ja'] }}</h1>
@stop

@section('content')

{{-- パンくず --}}
{{ Breadcrumbs::render('admin.products')}}

{{-- メッセージ --}}
@include('components.alert')

{{-- 一覧 --}}
<div class="">
  <div>
    <a href="{{ route('products.create') }}" class="btn btn-primary btn-sm mb-2" role="button">新規登録</a>
  </div>
  <div class="card">
    <div class="card-body">
      <table class="table">
        <thead>
          <th>id</th>
          <th>名前</th>
          <th>価格</th>
          <th>ASIN</th>
          <th>カテゴリ</th>
          <th></th>
        </thead>
        <tbody>
          @foreach ($products as $product)
          <tr>
            <td><a href="{{  route('products.show', $product) }}">{{ $product->id }}</a></td>
            <td><a href=" {{ route('products.show', $product) }}">{{ $product->name }}</a></td>
            <td><a href=" {{ route('products.show', $product) }}">{{ $product->price }}</a></td>
            <td><a href="{{  route('products.show', $product) }}">{{ $product->asin }}</a></td>
            <td>
              @if (isset($product->categories))
              <div class="d-flex">
                @foreach ($product->categories as $catgory)
                <div class="badge badge-secondary r-mr-xs">{{ $catgory->name }}</div>
                @endforeach
              </div> @endif
            </td>
            <td class="w-100px">
              <div class="btn-group" role="group" aria-label="Basic outlined product">
                {{-- 詳細 --}}
                <div type="button" class="btn btn-outline-primary">
                  <a href="{{  route('products.show', $product) }}" class="" role="button"><i
                      class="fas fa-file-alt"></i></a>
                </div>
                {{-- 更新 --}}
                <div type="button" class="btn btn-outline-primary">
                  <a href="{{ route('products.edit', $product) }}" class="" role="button"><i
                      class="fas fa-edit"></i></a>
                </div>
                {{-- 削除 --}}
                <div type="button" class="btn btn-outline-primary">
                  <form action="{{ route('products.destroy', $product->id) }}" method="post">
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