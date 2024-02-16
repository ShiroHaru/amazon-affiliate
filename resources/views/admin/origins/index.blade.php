@extends('adminlte::page')
@section('title', '')
@section('content_header')
<h1>{{ $controller['name_ja'] }} {{ $action['name_ja'] }}</h1>
@stop

@section('content')

{{-- パンくず --}}
{{ Breadcrumbs::render('admin.origins')}}

{{-- メッセージ --}}
@include('components.alert')

{{-- 一覧 --}}
<div class="">
  <div>
    <a href="{{ route('origins.create') }}" class="btn btn-primary btn-sm mb-2" role="button">新規登録</a>
  </div>
  <div class="card">
    <div class="card-body">
      <table class="table">
        <thead>
          <th>id</th>
          <th>メモ</th>
          <th>カテゴリ</th>
          <th></th>
        </thead>
        <tbody>
          @foreach ($origins as $origin)
          <tr>
            <td><a href="{{  route('origins.show', $origin) }}">{{ $origin->id }}</a></td>
            <td><a href=" {{ route('origins.show', $origin) }}">{{ $origin->note }}</a></td>
            <td>
              @if (isset($origin->categories))
              <div class="d-flex">
                @foreach ($origin->categories as $catgory)
                <div class="badge badge-secondary r-mr-xs">{{ $catgory->name }}</div>
                @endforeach
              </div> @endif
            </td>
            <td class="w-100px">
              <div class="btn-group" role="group" aria-label="Basic outlined origin">
                {{-- 詳細 --}}
                <div type="button" class="btn btn-outline-primary">
                  <a href="{{  route('origins.show', $origin) }}" class="" role="button"><i
                      class="fas fa-file-alt"></i></a>
                </div>
                {{-- 更新 --}}
                <div type="button" class="btn btn-outline-primary">
                  <a href="{{ route('origins.edit', $origin) }}" class="" role="button"><i class="fas fa-edit"></i></a>
                </div>
                {{-- 削除 --}}
                <div type="button" class="btn btn-outline-primary">
                  <form action="{{ route('origins.destroy', $origin->id) }}" method="post">
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