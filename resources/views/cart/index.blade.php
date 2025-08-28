@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
  <h1 class="h3 mb-0">Your Cart</h1>
  @if(session('cart') && count(session('cart')) > 0)
    <form action="{{ route('cart.clear') }}" method="POST">@csrf
      <button class="btn btn-outline-danger btn-sm">Clear Cart</button>
    </form>
  @endif
</div>

@php($cart = $cart ?? session('cart', []))

@if(empty($cart))
  <div class="alert alert-info">Your cart is empty. <a href="{{ route('products.index') }}">Browse products</a>.</div>
@else
  <div class="card p-3">
    <div class="table-responsive">
      <table class="table align-middle">
        <thead>
          <tr>
            <th style="width:80px;"></th>
            <th>Product</th>
            <th class="text-end">Price</th>
            <th style="width:150px;">Qty</th>
            <th class="text-end">Line Total</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          @foreach($cart as $row)
            @php($p = $row['product'])
            <tr>
              <td>
                <div class="ratio ratio-1x1 bg-light rounded overflow-hidden" style="width:70px;">
                  <img src="{{ $p->image_web_url }}" class="w-100 h-100 object-fit-contain" alt="{{ $p->name }}">
                </div>
              </td>
              <td>
                <div class="fw-semibold">{{ $p->name }}</div>
                <div class="text-muted small">{{ $p->category ?? 'Uncategorized' }}</div>
              </td>
              <td class="text-end">$ {{ number_format($p->price, 2) }}</td>
              <td>
                <form action="{{ route('cart.update', $p) }}" method="POST" class="d-flex align-items-center gap-2">
                  @csrf @method('PATCH')
                  <input type="number" name="qty" value="{{ $row['qty'] }}" min="0" max="999" class="form-control form-control-sm" style="width:90px;">
                  <button class="btn btn-sm btn-primary">Update</button>
                </form>
              </td>
              <td class="text-end">$ {{ number_format($p->price * $row['qty'], 2) }}</td>
              <td class="text-end">
                <form action="{{ route('cart.remove', $p) }}" method="POST" onsubmit="return confirm('Remove this item?')">
                  @csrf @method('DELETE')
                  <button class="btn btn-sm btn-outline-danger">Remove</button>
                </form>
              </td>
            </tr>
          @endforeach
        </tbody>
        <tfoot>
          <tr>
            <th colspan="4" class="text-end">Subtotal</th>
            <th class="text-end">$ {{ number_format($subtotal, 2) }}</th>
            <th></th>
          </tr>
        </tfoot>
      </table>
    </div>
  </div>
@endif
@endsection

cls