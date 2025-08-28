@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
  <h1 class="h3">Edit: {{ $product->name }}</h1>
</div>

<div class="card p-4">
  <form method="POST" action="{{ route('products.update', $product) }}" enctype="multipart/form-data">
    @method('PUT')
    @include('products._form', ['product' => $product])
  </form>
</div>
@endsection
