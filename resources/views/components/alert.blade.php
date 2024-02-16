@if( session('message') )
@foreach (session('message') as $key => $item)
<div class="alert alert-{{ $key }}">{{ $item }}</div>
@endforeach
@endif