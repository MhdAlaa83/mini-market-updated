@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
  <h1 class="h3">Add Product</h1>
</div>

<div class="card p-4">
  <form method="POST" action="{{ route('products.store') }}" enctype="multipart/form-data">
    @include('products._form')
  </form>
</div>
@endsection
