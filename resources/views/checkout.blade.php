@extends('layouts.app')

@section('title', 'Checkout')

@section('content')
    <div class="container">
        <h1>Checkout</h1>
        <form action="{{ route('checkout.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Nama Lengkap</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="mb-3">
                <label for="address" class="form-label">Alamat Pengiriman</label>
                <textarea class="form-control" id="address" name="address" required></textarea>
            </div>
            <div class="mb-3">
                <label for="payment_method" class="form-label">Metode Pembayaran</label>
                <select class="form-select" id="payment_method" name="payment_method" required>
                    <option value="transfer_bank">Transfer Bank</option>
                    <option value="cod">COD (Bayar di Tempat)</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Proses Checkout</button>
        </form>
    </div>
@endsection