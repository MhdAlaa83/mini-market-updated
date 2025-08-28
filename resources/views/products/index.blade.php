@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
  <h1 class="h3">Products</h1>
  @auth
    <a href="{{ route('products.create') }}" class="btn btn-soft">+ Add New</a>
  @endauth
</div>

<div class="card p-3 mb-4">
  <form method="GET" action="{{ route('products.index') }}" class="row g-2 align-items-end">
    <div class="col-md-3">
      <label class="form-label">Search</label>
      <input type="text" name="q" value="{{ request('q') }}" class="form-control" placeholder="name or description">
    </div>
    <div class="col-md-3">
      <label class="form-label">Category</label>
      <select name="category" class="form-select">
        <option value="">All</option>
        @foreach($categories as $cat)
          <option value="{{ $cat }}" @selected(request('category')===$cat)>{{ $cat }}</option>
        @endforeach
      </select>
    </div>
    <div class="col-md-2">
      <label class="form-label">Min Price</label>
      <input type="number" step="0.01" name="min_price" value="{{ request('min_price') }}" class="form-control">
    </div>
    <div class="col-md-2">
      <label class="form-label">Max Price</label>
      <input type="number" step="0.01" name="max_price" value="{{ request('max_price') }}" class="form-control">
    </div>
    <div class="col-md-2">
      <label class="form-label">Sort</label>
      <select name="sort" class="form-select">
        <option value="newest" @selected(request('sort')==='newest')>Newest</option>
        <option value="oldest" @selected(request('sort')==='oldest')>Oldest</option>
        <option value="name_asc" @selected(request('sort')==='name_asc')>Name A→Z</option>
        <option value="name_desc" @selected(request('sort')==='name_desc')>Name Z→A</option>
        <option value="price_asc" @selected(request('sort')==='price_asc')>Price Low→High</option>
        <option value="price_desc" @selected(request('sort')==='price_desc')>Price High→Low</option>
      </select>
    </div>
    <div class="col-12 text-end">
      <button class="btn btn-soft">Apply</button>
      <a href="{{ route('products.index') }}" class="btn btn-outline-secondary">Reset</a>
    </div>
  </form>
</div>

@if($products->count())
  <div class="row g-4">
    @foreach($products as $product)
      <div class="col-md-4 col-lg-3">
        <div class="card h-100">
          <div class="ratio ratio-4x3 bg-light d-flex align-items-center justify-content-center rounded-top overflow-hidden">
            <img src="{{ $product->image_web_url }}" class="w-100 h-100 object-fit-contain p-2" alt="{{ $product->name }}">
          </div>
          <div class="card-body d-flex flex-column">
            <h5 class="card-title">{{ $product->name }}</h5>
            <p class="mb-1">
              <span class="badge {{ $product->category_color_class }}">
                {{ $product->category ?? 'Uncategorized' }}
              </span>
            </p>
            <p class="fw-semibold">$ {{ number_format($product->price, 2) }}</p>

            <form action="{{ route('cart.add', $product) }}" method="POST" class="d-flex gap-2 align-items-center mb-2">
              @csrf
              <input type="number" name="qty" value="1" min="1" max="999" class="form-control form-control-sm" style="width: 90px;">
              <button class="btn btn-sm btn-primary">Add to Cart</button>
            </form>

            <div class="mt-auto d-flex gap-2">
              <a href="{{ route('products.show', $product) }}" class="btn btn-sm btn-outline-primary">Details</a>
              @auth
                <a href="{{ route('products.edit', $product) }}" class="btn btn-sm btn-outline-secondary">Edit</a>
              @endauth
            </div>
          </div>
        </div>
      </div>
    @endforeach
  </div>

  <div class="mt-4">
    {{ $products->links() }}
  </div>
@else
  <div class="alert alert-info">No products found. Try adjusting filters or add a new product.</div>
@endif
@endsection
