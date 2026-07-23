@extends('layouts.app')

@section('content')

    <section class="testimoni-hero">

        <h1>TESTIMONI</h1>

    </section>

    <section class="why-ry reveal">

        <div class="why-image">
            <img src="{{ asset('images/logo.png') }}">
        </div>

        <div class="why-content">

            <h1>Kenapa RY TRAVEL ?</h1>

            <h3>Berpengalaman dan Terpercaya</h3>

            <p>
                RY Travel berpengalaman dalam melayani jasa antar jemput bandara dengan mengutamakan ketepatan waktu,
                kenyamanan, dan keamanan pelanggan. Kepercayaan pelanggan menjadi motivasi kami untuk terus memberikan
                pelayanan terbaik dalam setiap perjalanan.
            </p>

            <h3>Mudah dan Fleksibel</h3>

            <p>
                Kami siap melayani kebutuhan antar jemput dari dan menuju bandara dengan proses pemesanan yang mudah dan
                layanan yang fleksibel. Jadwal penjemputan dapat disesuaikan dengan waktu keberangkatan maupun kedatangan
                Anda agar perjalanan menjadi lebih praktis dan nyaman.
            </p>

            <h3>Profesional dan Ramah</h3>

            <p>
                Perjalanan Anda akan terasa lebih nyaman bersama tim RY Travel yang profesional, ramah, dan berpengalaman.
                Kami selalu berkomitmen memberikan pelayanan terbaik serta memastikan setiap pelanggan mendapatkan
                pengalaman perjalanan yang aman dan menyenangkan.
            </p>

        </div>

    </section>

    <section class="testimoni-card reveal">

        <h1>Pendapat Mereka Tentang Kami</h1>
        <p class="testi-subtitle">
            Kepuasan pelanggan adalah prioritas kami. Berikut beberapa ulasan asli dari pelanggan
            RY Travel melalui WhatsApp.
        </p>

        <div class="testimoni-grid">

            <!-- Testimoni 1 -->
            <div class="testi-card">

                <div class="rating">
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <span>5.0</span>
                </div>

                <img src="{{ asset('images/testimoni1.jpg') }}" alt="Testimoni">

                <div class="testi-detail">

                    <p><i class="fa-solid fa-calendar-days"></i> 18 Juli 2026</p>

                    <p><i class="fa-solid fa-van-shuttle"></i> Antar Jemput Bandara</p>

                    <p><i class="fa-solid fa-location-dot"></i> Yogyakarta → YIA</p>

                    <p class="quote">
                        "Driver ramah, armada bersih, perjalanan nyaman.
                        Pasti order lagi di RY Travel."
                    </p>

                </div>

            </div>

            <!-- Testimoni 2 -->
            <div class="testi-card">

                <div class="rating">
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <span>5.0</span>
                </div>

                <img src="{{ asset('images/testimoni2.jpg') }}" alt="Testimoni">

                <div class="testi-detail">

                    <p><i class="fa-solid fa-calendar-days"></i> 12 Juli 2026</p>

                    <p><i class="fa-solid fa-plane"></i> Antar Jemput Bandara</p>

                    <p><i class="fa-solid fa-location-dot"></i> Bantul → YIA</p>

                    <p class="quote">
                        "Terima kasih kak, sudah diantar dengan selamat sampai tujuan, sat set sat set tau" sampai"
                    </p>

                </div>

            </div>

            <!-- Testimoni 3 -->
            <div class="testi-card">

                <div class="rating">
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <span>5.0</span>
                </div>

                <img src="{{ asset('images/testimoni3.jpg') }}" alt="Testimoni">

                <div class="testi-detail">

                    <p><i class="fa-solid fa-calendar-days"></i> 8 Juli 2026</p>

                    <p><i class="fa-solid fa-route"></i> Travel Bandara</p>

                    <p><i class="fa-solid fa-location-dot"></i> YIA → Semarang</p>

                    <p class="quote">
                        "haloo kak, sudah di anter dgn aman dan nyaman, terima kasih banyak yaa kak, driver nya jga okee
                        bgtt"
                    </p>

                </div>

            </div>

        </div>

    </section>

    <section class="info-area reveal">

        <div class="info-left">

            <div class="info-box">

                <h1>Daerah Operasional</h1>

                <p>
                    Jl. Jogja Ring Road Sel. No.1, Gonjen, Tamantirto, Kec. Kasihan, Kabupaten Bantul, Daerah Istimewa
                    Yogyakarta 55184
                </p>

            </div>

            <div class="info-box">

                <h1>Info Kontak</h1>

                <p>0882-0073-80782</p>
                <p>info@rytravel.com</p>
                <p>Yogyakarta, Indonesia</p>

            </div>

            <div class="info-box payment-box">

                <h1>Info Pembayaran</h1>

                <div class="payment-grid">

                    <div class="payment-card">
                        <img src="{{ asset('images/BCA.png') }}" alt="BCA">
                        <h3>Transfer BCA</h3>
                        <span>a.n. RY Travel</span>
                    </div>

                    <div class="payment-card">
                        <img src="{{ asset('images/BRI.png') }}" alt="BRI">
                        <h3>Transfer BRI</h3>
                        <span>a.n. RY Travel</span>
                    </div>

                    <div class="payment-card">
                        <img src="{{ asset('images/Qris.png') }}" alt="QRIS">
                        <h3>QRIS</h3>
                        <span>Scan QR saat pembayaran</span>
                    </div>

                    <div class="payment-card">
                        <img src="{{ asset('images/cash.jpg') }}" alt="Cash">
                        <h3>Cash</h3>
                        <span>Bayar langsung kepada driver</span>
                    </div>

                </div>

            </div>

        </div>

        <div class="info-map">

            <div id="map"></div>

        </div>

    </section>

    <a href="https://wa.me/62882007380782" class="wa-button" target="_blank">
        <i class="fa-brands fa-whatsapp"></i>
        Tanya Admin
    </a>

    @push('scripts')
        <script>
            document.addEventListener("DOMContentLoaded", function () {

                const latitude = -7.820694;
                const longitude = 110.333472;

                const map = L.map('map').setView([latitude, longitude], 17);

                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    attribution: '&copy; OpenStreetMap'
                }).addTo(map);

                L.marker([latitude, longitude])
                    .addTo(map)
                    .bindPopup("<b>RY Travel</b><br>Jl. Jogja Ring Road Selatan No.1")
                    .openPopup();

            });
        </script>
    @endpush

@endsection