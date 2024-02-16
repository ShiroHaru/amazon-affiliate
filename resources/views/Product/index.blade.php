@extends('layouts.front')
@section('title', '🍔タイトル')

@section('content')
{{-- 完了メッセージ --}}
@if (session('message'))
<div class="alert alert-info alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
        ×
    </button>
    {{ session('message') }}
</div>
@endif

{{-- 新規登録画面へ --}}
<div class="container">
    <a href="{{ route('product.create') }}" class="btn btn-primary mb-2" role="button">新規登録</a>

    <div class="card">
        <div class="card-body">
            <table class="table">
                <thead>
                    <th>商品名</th>
                    <th>価格</th>
                    <th></th>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                    <tr>
                        <td>{{ $product->name }}</td>
                        <td>{{ number_format($product->price) }}</td>
                        <td>
                            <a href="{{ route('product.edit', $product->id) }}" class="btn btn-primary btn-sm mb-2"
                                role="button">編集</a>
                            <form action="{{ route('product.destroy', $product->id) }}" method="post">
                                @csrf
                                @method('DELETE')
                                {{-- 簡易的に確認メッセージを表示 --}}
                                <button class="btn btn-danger btn-sm" type="submit"
                                    onclick="return confirm('削除してもよろしいですか？')">
                                    削除
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@stop