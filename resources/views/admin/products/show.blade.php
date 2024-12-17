@extends('adminlte::page')
@section('title', '')
@section('content_header')
<h1>{{ $controller['name_ja'] }} {{ $action['name_ja'] }}</h1>
@stop

@section('content')

{{-- パンくず --}}
{{ Breadcrumbs::render('admin.products.show')}}

{{-- メッセージ --}}
@include('components.alert')

{{-- 一覧 --}}
<div class="">
  <div class="btn-row">
    {{-- 更新 --}}
    <a href="{{ route('products.edit', $product) }}" class="btn btn-primary btn-sm mb-2" role="button">編集</a>

    {{-- 削除 --}}
    <form action="{{ route('products.destroy', $product->id) }}" method="post">
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
              <div>{{ $product->id }}</div>
            </div>
          </div>
        </div>
        <div class="list-group-item">
          <div class="row">
            <div class="col-md-3">
              <div class="fw-bold">価格</div>
            </div>
            <div class="col-md-4">
              <div>{{ $product->price }}</div>
            </div>
          </div>
        </div>
        <div class="list-group-item">
          <div class="row">
            <div class="col-md-3">
              <div class="fw-bold">ASIN</div>
            </div>
            <div class="col-md-4">
              <div>{{ $product->asin }}</div>
            </div>
          </div>
        </div>
        <div class="list-group-item">
          <div class="row">
            <div class="col-md-3">
              <div class="fw-bold">カテゴリ</div>
            </div>
            <div class="col-md-4">
              @if (isset($product->categories))
              <div class="d-flex">
                @foreach ($product->categories as $catgory)
                <div class="badge badge-secondary r-mr-xs">{{ $catgory->name }}</div>
                @endforeach
              </div> @endif
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
@stop