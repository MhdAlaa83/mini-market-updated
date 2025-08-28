@csrf
<div class="row g-3">
  <div class="col-md-6">
    <label class="form-label">Name</label>
    <input type="text" name="name" value="{{ old('name', $product->name ?? '') }}" class="form-control" required>
  </div>
  <div class="col-md-6">
    <label class="form-label">Category</label>
    <input type="text" name="category" value="{{ old('category', $product->category ?? '') }}" class="form-control">
  </div>
  <div class="col-md-12">
    <label class="form-label">Description</label>
    <textarea name="description" class="form-control" rows="4">{{ old('description', $product->description ?? '') }}</textarea>
  </div>
  <div class="col-md-4">
    <label class="form-label">Price ($)</label>
    <input type="number" step="0.01" name="price" value="{{ old('price', $product->price ?? '') }}" class="form-control" required>
  </div>
  <div class="col-md-4">
    <label class="form-label">Stock</label>
    <input type="number" name="stock" value="{{ old('stock', $product->stock ?? '') }}" class="form-control" required>
  </div>
  <div class="col-md-4 form-check mt-4">
    <input type="checkbox" class="form-check-input" id="is_active" name="is_active" value="1" @checked(old('is_active', ($product->is_active ?? true)))>
    <label class="form-check-label" for="is_active">Active</label>
  </div>

  <div class="col-md-12">
    <label class="form-label">Image (JPG/PNG/WEBP)</label>
    <input type="file" name="image" class="form-control" accept="image/*">
    @if(!empty($product?->image_url))
      <div class="mt-2">
        <small class="text-muted d-block">Current:</small>
        <div class="ratio ratio-4x3 bg-light rounded overflow-hidden" style="max-width: 240px;">
          <img src="{{ $product->image_web_url }}" class="w-100 h-100 object-fit-contain p-2" alt="Current image">
        </div>
      </div>
    @endif
  </div>

  <div class="col-12 text-end">
    <button class="btn btn-soft">Save</button>
    <a href="{{ route('products.index') }}" class="btn btn-outline-secondary">Cancel</a>
  </div>
</div>
