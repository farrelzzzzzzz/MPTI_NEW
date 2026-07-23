@extends('layouts.app')

@section('content')

<section class="order-hero">

    <h1>FORM PEMESANAN</h1>

</section>

<section class="order-section reveal">

    <div class="order-container">

        {{-- HEADER --}}
        <div class="order-header">

            <img src="{{ asset('images/logo.png') }}" class="order-logo">

            <div class="order-progress">

                <div class="order-step is-done">

                    <span class="order-step-dot">
                        <i class="fa-solid fa-check"></i>
                    </span>

                    <span class="order-step-label">
                        Data Diri
                    </span>

                </div>

                <div class="order-step active">

                    <span class="order-step-dot">
                        2
                    </span>

                    <span class="order-step-label">
                        Konfirmasi
                    </span>

                </div>

            </div>

            <h2>Konfirmasi Pemesanan</h2>

            <p>
                Periksa kembali seluruh data sebelum melanjutkan ke WhatsApp.
            </p>

        </div>

        {{-- CARD --}}
        <div class="order-card">

            <div class="order-grid">

                {{-- ========================= --}}
                {{-- DATA DIRI --}}
                {{-- ========================= --}}

                <div class="order-grid-left">

                    <div class="field-card">
                        <div class="form-group">
                            <label>Kode Pesawat</label>
                            <input type="text" value="{{ $order->kode_pesawat }}" readonly>
                        </div>
                    </div>

                    <div class="field-card">
                        <div class="form-group">
                            <label>Nama Penumpang</label>
                            <input type="text" value="{{ $order->nama_penumpang }}" readonly>
                        </div>
                    </div>

                    <div class="field-card">
                        <div class="form-group">
                            <label>Jumlah Penumpang</label>
                            <input type="text" value="{{ $order->jumlah_penumpang }}" readonly>
                        </div>
                    </div>

                    <div class="field-card">
                        <div class="form-group">
                            <label>Nomor WA / Telepon</label>
                            <input type="text" value="{{ $order->telepon }}" readonly>
                        </div>
                    </div>

                    <div class="field-card">
                        <div class="form-group">
                            <label>Tanggal</label>
                            <input type="text" value="{{ $order->tanggal }}" readonly>
                        </div>
                    </div>

                    <div class="field-card">
                        <div class="form-group">
                            <label>Flight Pukul</label>
                            <input type="text" value="{{ $order->flight_pukul }}" readonly>
                        </div>
                    </div>

                    <div class="field-card">
                        <div class="form-group">
                            <label>Lokasi Jemput</label>
                            <input type="text" value="{{ $order->lokasi_jemput }}" readonly>
                        </div>
                    </div>

                    <div class="field-card">
                        <div class="form-group">
                            <label>Lokasi Tujuan</label>
                            <input type="text" value="{{ $order->lokasi_tujuan }}" readonly>
                        </div>
                    </div>

                    <div class="field-card">
                        <div class="form-group">
                            <label>Jam Landing</label>
                            <input type="text" value="{{ $order->jam_landing }}" readonly>
                        </div>
                    </div>

                    <div class="field-card">
                        <div class="form-group">
                            <label>Jam Jemput</label>
                            <input type="text" value="{{ $order->jam_jemput }}" readonly>
                        </div>
                    </div>

                    <div class="field-card">
                        <div class="form-group">
                            <label>Jarak (km)</label>
                            <input type="text" value="{{ number_format($order->jarak, 2, ',', '.') }} km" readonly>
                        </div>
                    </div>

                    <div class="field-card">
                        <div class="form-group">
                            <label>Estimasi Harga</label>
                            <input type="text" value="Rp {{ number_format($order->harga, 0, ',', '.') }}" readonly>
                        </div>
                    </div>

                </div>

                {{-- ========================= --}}
                {{-- PEMBAYARAN --}}
                {{-- ========================= --}}

                <div class="order-grid-right">

                    <h3 class="payment-title">
                        Metode Pembayaran
                    </h3>

                    <div class="payment-confirm">

                        @php

                            $gambar = match($order->pembayaran){

                                'bca' => 'BCA.png',

                                'bri' => 'BRI.png',

                                'qris' => 'Qris.png',

                                'cash' => 'cash.jpg',

                                default => 'logo.png'

                            };

                        @endphp

                        <img src="{{ asset('images/'.$gambar) }}" alt="Metode Pembayaran" class="payment-confirm-img">


                        <h4>{{ strtoupper($order->pembayaran) }}</h4>

                    </div>

                    <div class="order-submit">

                        <div class="confirm-action">

                            <a href="{{ route('order.cancel',$order->id) }}"
                               class="btn-cancel">

                                <i class="fa-solid fa-xmark"></i>

                                Batal

                            </a>

                            <a href="{{ route('order.send',$order->id) }}"
                               class="btn-confirm">

                                <i class="fa-brands fa-whatsapp"></i>

                                Lanjut ke WhatsApp

                            </a>

                        </div>

                        <p class="confirm-note">

                            Pastikan seluruh data telah benar.
                            Jika sudah yakin silakan lanjut ke WhatsApp untuk
                            menghubungi admin Ry Travel.

                        </p>

                    </div>

                </div>

            </div>

        </div>

    </div>

</section>

@endsection