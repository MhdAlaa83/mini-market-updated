@extends('layouts.app')

@section('content')
<div class="row g-4">
  <div class="col-md-5">
    <div class="card p-3 h-100">
      <div class="ratio ratio-16x9 bg-light d-flex align-items-center justify-content-center rounded overflow-hidden">
        <img src="{{ $product->image_web_url }}" class="w-100 h-100 object-fit-contain p-3" alt="{{ $product->name }}">
      </div>
    </div>
  </div>
  <div class="col-md-7">
    <div class="card p-4 h-100">
      <h1 class="h3 mb-1">{{ $product->name }}</h1>
      <p class="mb-2">
        <span class="badge {{ $product->category_color_class }}">{{ $product->category ?? 'Uncategorized' }}</span>
      </p>
      <p class="lead fw-semibold">$ {{ number_format($product->price,2) }}</p>
      <p class="text-muted">{{ $product->description }}</p>

      <div class="mt-3">
        <span class="me-3">Stock: <strong>{{ $product->stock }}</strong></span>
        <span>Status: <strong>{{ $product->is_active ? 'Active' : 'Inactive' }}</strong></span>
      </div>

      <form action="{{ route('cart.add', $product) }}" method="POST" class="d-flex gap-2 align-items-center mt-3">
        @csrf
        <input type="number" name="qty" value="1" min="1" max="999" class="form-control" style="width: 120px;">
        <button class="btn btn-primary">Add to Cart</button>
        <a href="{{ route('cart.index') }}" class="btn btn-outline-secondary">View Cart</a>
      </form>

      <div class="mt-4 d-flex gap-2">
        @auth
          <a href="{{ route('products.edit', $product) }}" class="btn btn-outline-secondary">Edit</a>
        @endauth
        <a href="{{ route('products.index') }}" class="btn btn-soft">Back</a>
      </div>
    </div>
  </div>
</div>
@endsection
