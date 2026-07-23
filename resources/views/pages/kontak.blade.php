@extends('layouts.app')

@section('content')

    <section class="kontak-hero">

        <h1>KONTAK KAMI</h1>

    </section>


    <section class="kontak-section reveal">

        <div class="kontak-info">

            <h1>RY TRAVEL</h1>

            <div class="info-card reveal-left">

                <h2>Kantor</h2>

                <p>
                    Jl. Jogja Ring Road Sel. No.1, Gonjen, Tamantirto,
                    Kec. Kasihan, Kabupaten Bantul,
                    Daerah Istimewa Yogyakarta 55184
                </p>

            </div>

            <div class="info-card reveal-left">

                <h2>Jam Operasional</h2>

                <ul class="operational-list">

                    <li>
                        <span>Senin</span>
                        <strong>24 Jam</strong>
                    </li>

                    <li>
                        <span>Selasa</span>
                        <strong>24 Jam</strong>
                    </li>

                    <li>
                        <span>Rabu</span>
                        <strong>24 Jam</strong>
                    </li>

                    <li>
                        <span>Kamis</span>
                        <strong>24 Jam</strong>
                    </li>

                    <li>
                        <span>Jumat</span>
                        <strong>24 Jam</strong>
                    </li>

                </ul>

                <div class="weekend-box">

                    <h3>
                        <i class="fa-solid fa-calendar-week"></i>
                        Pelayanan Weekend
                    </h3>

                    <div class="weekend-item">
                        <span>Sabtu</span>
                        <strong>24 Jam</strong>
                    </div>

                    <div class="weekend-item">
                        <span>Minggu</span>
                        <strong>24 Jam</strong>
                    </div>

                </div>

            </div>

            <div class="info-card reveal-left">

                <h2>Kontak</h2>

                <ul>

                    <li>
                        <i class="fa-brands fa-whatsapp"></i>
                        +62 882-0073-80782
                    </li>

                    <li>
                        <i class="fa-brands fa-instagram"></i>
                        @travel_bandara_jogja
                    </li>

                </ul>

            </div>

            <a href="https://maps.google.com" target="_blank" class="location-btn">

                <i class="fa-solid fa-location-dot"></i>
                LIHAT LOKASI

            </a>

        </div>

    </section>


    <section class="map-section reveal">

        <div id="map"></div>

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