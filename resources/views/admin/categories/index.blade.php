@extends('adminlte::page')
@section('title', '')
@section('content_header')
<h1>{{ $controller['name_ja'] }} {{ $action['name_ja'] }}</h1>
@stop

@section('content')

{{-- パンくず --}}
{{ Breadcrumbs::render('admin.categories')}}
{{-- メッセージ --}}
@include('components.alert')

<div class="">
  <div>
    <a href="{{ route('categories.create') }}" class="btn btn-primary btn-sm mb-2" role="button">新規登録</a>
  </div>
  <div class="card">
    <div class="card-body">
      <table class="table">
        <thead>
          <th>id</th>
          <th>名前</th>
          <th></th>
        </thead>
        <tbody>
          @foreach ($categories as $category)
          <tr>
            <td>{{ $category->id }}</td>
            {{-- $category->depthの数だけスペースを入れる --}}
            <td>{{ str_repeat("-", $category->depth * 2) . $category->name }}</td>

            <td class="w-100px">
              <div class="btn-group" role="group" aria-label="Basic outlined example">
                {{-- 詳細 --}}
                <div type="button" class="btn btn-outline-primary">
                  <a href="{{  route('categories.show', $category) }}" class="" role="button"><i
                      class="fas fa-file-alt"></i></a>
                </div>
                {{-- 更新 --}}
                <div type="button" class="btn btn-outline-primary">
                  <a href="{{ route('categories.edit', $category) }}" class="" role="button"><i
                      class="fas fa-edit"></i></a>
                </div>
                {{-- 削除 --}}
                <div type="button" class="btn btn-outline-primary">
                  <form action="{{ route('categories.destroy', $category->id) }}" method="post">
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





{{-- <h1>カテゴリ一覧</h1>

<form action="{{ route('categories.updateOrder') }}" method="POST">
  @csrf
  <ul id="category-list">
    @foreach ($categories as $category)
    <li data-id="{{ $category->id }}">
      {{ str_repeat('--', $category->depth) }} {{ $category->name }}
    </li>
    @endforeach
  </ul>
  <button type="submit" class="btn btn-primary">並び順を保存</button>
</form>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-ui/1.12.1/jquery-ui.min.js"></script>
<script>
  $(function() {
            $('#category-list').sortable({
                update: function(event, ui) {
                    var order = $(this).sortable('toArray', { attribute: 'data-id' });
                    $('input[name="order"]').val(JSON.stringify(order));
                }
            });
        });
</script> --}}




@stop