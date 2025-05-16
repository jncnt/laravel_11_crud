@extends('layouts.app')
@section('content')
    <div class="row justify-content-center mt-3">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="float-start">
                        Product Information
                    </div>
                    <div class="float-end">
                        <a href="{{ route('products.index') }}" class="btn btn-primary btn-sm">&larr; Back</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="fw-bold">Code:</label>
                                <span>{{ $product->code }}</span>
                            </div>
                            <div class="mb-3">
                                <label class="fw-bold">Name:</label>
                                <span>{{ $product->name }}</span>
                            </div>
                            <div class="mb-3">
                                <label class="fw-bold">Quantity:</label>
                                <span>{{ $product->quantity }}</span>
                            </div>
                            <div class="mb-3">
                                <label class="fw-bold">Price:</label>
                                <span>{{ $product->price }}</span>
                            </div>
                            <div class="mb-3">
                                <label class="fw-bold">Description:</label>
                                <span>{{ $product->description }}</span>
                            </div>
                        </div>
                        <div class="col-md-6 text-center">
                            @if($product->img_url)
                                <img src="{{ asset('storage/' . $product->img_url) }}" alt="{{ $product->name }}" class="img-fluid" style="max-height: 300px">
                            @else
                                <p>No image available</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection



