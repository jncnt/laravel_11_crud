@extends('layouts.app')

@section('content')
<div class="row justify-content-center mt-3">
    <div class="col-md-8">
        @session('success')
            <div class="alert alert-success" role="alert">
                {{ $value }}
            </div>
        @endsession

        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span>Edit Product</span>
                <a href="{{ route('products.index') }}" class="btn btn-primary btn-sm">&larr; Back</a>
            </div>

            <div class="card-body">
                <div class="row">
                    <!-- Left side - Form -->
                    <div class="col-md-6">
                        <form action="{{ route('products.update', $product) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label for="code" class="form-label">Code:</label>
                                <input type="text" class="form-control @error('code') is-invalid @enderror" id="code" name="code" value="{{ $product->code }}">
                                @error('code')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="name" class="form-label">Name:</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ $product->name }}">
                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="quantity" class="form-label">Quantity:</label>
                                <input type="number" class="form-control @error('quantity') is-invalid @enderror" id="quantity" name="quantity" value="{{ $product->quantity }}">
                                @error('quantity')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="price" class="form-label">Price:</label>
                                <input type="number" step="0.01" class="form-control @error('price') is-invalid @enderror" id="price" name="price" value="{{ $product->price }}">
                                @error('price')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="description" class="form-label">Description:</label>
                                <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description">{{ $product->description }}</textarea>
                                @error('description')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="image" class="form-label">Product Image:</label>
                                <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image">
                                @error('image')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </form>
                    </div>

                    <!-- Right side - Image Preview -->
                    <div class="col-md-6 text-center">
                        <div id="imagePreview" class="border p-3" style="min-height: 300px; display: flex; align-items: center; justify-content: center;">
                            @if ($product->img_url)
                                <img
                                    id="previewImg"
                                    src="{{ asset('storage/' . $product->img_url) }}"
                                    alt="Product Image"
                                    class="img-fluid border"
                                    style="max-height: 300px; width: 100%; object-fit: contain;"
                                >
                            @else
                                <div class="text-muted">No image available</div>
                                <img id="previewImg" src="#" alt="Preview" class="img-fluid border" style="display: none; max-height: 300px; width: 100%; object-fit: contain;">
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const fileInput = document.getElementById('image');
        const previewImg = document.getElementById('previewImg');
        const imagePreview = document.getElementById('imagePreview');

        fileInput.addEventListener('change', function () {
            if (this.files && this.files[0]) {
                const reader = new FileReader();

                reader.onload = function (e) {
                    previewImg.src = e.target.result;
                    previewImg.style.display = 'block';

                    const textDiv = imagePreview.querySelector('.text-muted');
                    if (textDiv) {
                        textDiv.remove();
                    }
                };

                reader.readAsDataURL(this.files[0]);
            }
        });
    });
</script>
@endsection
