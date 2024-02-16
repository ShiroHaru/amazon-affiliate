@if ($errors->any())
<div class="alert alert-danger">
  <ul class="r-mb-0">
    @foreach ($errors->all() as $error)
    <li class="">{{ $error }}</li>
    @endforeach
  </ul>
</div>
@endif