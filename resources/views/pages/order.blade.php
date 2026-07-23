@extends('layouts.app')

@section('content')

    <section class="order-hero">

        <h1>FORM PEMESANAN</h1>

    </section>

    <section class="order-section reveal">

        <div class="order-container">

            <!-- HEADER MERAH -->
            <div class="order-header">
                <img src="{{ asset('images/logo.png') }}" class="order-logo">

                <div class="order-progress" aria-label="Langkah Pemesanan">
                    <div class="order-step is-done">
                        <span class="order-step-dot">1</span>
                        <span class="order-step-label">Data Diri</span>
                    </div>
                    <div class="order-step">
                        <span class="order-step-dot">2</span>
                        <span class="order-step-label">Pembayaran</span>
                    </div>
                </div>

                <h2>Lengkapi Data Diri</h2>
                <p>Lengkapi data pemesanan untuk melanjutkan reservasi.</p>
            </div>

            <!-- FORM -->
            <div class="order-card">

                <form action="{{ route('order.store') }}" method="POST" id="orderForm">
                    @csrf

                    <div class="order-grid">

                        <div class="order-grid-left">

                            <div class="field-card">
                                <div class="form-group">
                                    <label>Kode Pesawat</label>
                                    <input type="text" name="kode_pesawat"
                                        value="{{ old('kode_pesawat', $order->kode_pesawat ?? '') }}"
                                        placeholder="Contoh: JT-625" pattern="^[A-Z]{2}-[0-9]{2,4}$"
                                        title="Format kode pesawat: JT-625" style="text-transform: uppercase;" required>
                                </div>
                            </div>

                            <div class="field-card">
                                <div class="form-group">
                                    <label>Nama Penumpang</label>
                                    <input type="text"
                                     name="nama_penumpang"
                                        value="{{ old('nama_penumpang', $order->nama_penumpang ?? '') }}"
                                        placeholder="Nama sesuai identitas"
                                         pattern="^[A-Za-z\s]{3,50}$"
                                        title="Nama hanya boleh huruf dan spasi"
                                     required>
                                </div>
                            </div>

                            <div class="field-card">
                                <div class="form-group">
                                    <label>Jumlah Penumpang</label>
                                    <input type="number" name="jumlah_penumpang"
                                        value="{{ old('jumlah_penumpang', $order->jumlah_penumpang ?? request('jumlah_penumpang')) }}"
                                        readonly>
                                </div>
                            </div>

                            <div class="field-card">
                                <div class="form-group">
                                    <label>Nomor WA / Telepon</label>
                                    <input type="tel" name="telepon" value="{{ old('telepon', $order->telepon ?? '') }}"
                                        placeholder="08xxxxxxxxxx" pattern="^08[0-9]{8,11}$" maxlength="13"
                                        title="Masukkan nomor WA yang valid" required>
                                </div>
                            </div>

                            <div class="field-card">
                                <div class="form-group">
                                    <label>Tanggal</label>
                                    <input type="text" name="tanggal"
                                        value="{{ old('tanggal', $order->tanggal ?? request('tanggal')) }}" readonly>
                                </div>
                            </div>

                            <div class="field-card">
                                <div class="form-group">
                                    <label>Flight Pukul</label>
                                    <input type="text" id="flight_pukul" name="flight_pukul"
                                        value="{{ old('flight_pukul', $order->flight_pukul ?? '') }}"
                                        placeholder="Contoh: 14:30" maxlength="5" pattern="^([01]\d|2[0-3]):([0-5]\d)$"
                                        required>
                                </div>
                            </div>

                            <!-- MAP CARD: Peta interaktif di dalam area data diri -->
                            <div class="field-card field-card-map">
                                <div class="map-card-label">
                                    <i class="fas fa-map-marked-alt"></i>
                                    <span>Pilih Lokasi Jemput & Tujuan</span>
                                </div>
                                <div id="orderMap" class="order-map"></div>
                                <div class="map-card-hint">
                                    <i class="fas fa-info-circle"></i>
                                    Ketik lokasi jemput/tujuan di kolom bawah, lalu pilih dari saran yang muncul.
                                </div>
                            </div>

                            <div class="field-card">
                                <div class="form-group">
                                    <label>Lokasi Jemput</label>
                                    <input type="text" name="lokasi_jemput" id="lokasi_jemput"
                                        value="{{ old('lokasi_jemput', $order->lokasi_jemput ?? request('lokasi_jemput')) }}"
                                        placeholder="Cari lokasi jemput" required>
                                    <input type="hidden" name="lokasi_jemput_lat" id="lokasi_jemput_lat"
                                        value="{{ old('lokasi_jemput_lat',$order->lokasi_jemput_lat ?? request('lokasi_jemput_lat')) }}">
                                    <input type="hidden" name="lokasi_jemput_lon" id="lokasi_jemput_lon"
                                        value="{{ old('lokasi_jemput_lon',$order->lokasi_jemput_lon ?? request('lokasi_jemput_lon')) }}">
                                </div>
                            </div>

                            <div class="field-card">
                                <div class="form-group">
                                    <label>Lokasi Tujuan</label>
                                    <input type="text" name="lokasi_tujuan" id="lokasi_tujuan"
                                        value="{{ old('lokasi_tujuan', $order->lokasi_tujuan ?? request('lokasi_tujuan')) }}"
                                        placeholder="Cari lokasi tujuan" required>
                                    <input type="hidden" name="lokasi_tujuan_lat" id="lokasi_tujuan_lat"
                                       value="{{ old('lokasi_tujuan_lat',$order->lokasi_tujuan_lat ?? request('lokasi_tujuan_lat')) }}">
                                    <input type="hidden" name="lokasi_tujuan_lon" id="lokasi_tujuan_lon"
                                        value="{{ old('lokasi_tujuan_lon',$order->lokasi_tujuan_lon ?? request('lokasi_tujuan_lon')) }}">
                                </div>
                            </div>

                            <div class="field-card">
                                <div class="form-group">
                                    <label>Jarak (km)</label>
                                    <input type="text" name="jarak" id="jarak"
                                        value="{{ old('jarak', $order->jarak ?? request('jarak')) }}" readonly>
                                </div>
                            </div>

                            <div class="field-card">
                                <div class="form-group">
                                    <label>Estimasi Harga</label>
                                    <input type="text" name="harga" id="harga"
                                        value="{{ old('harga', $order->harga ?? request('harga')) }}" readonly>
                                </div>
                            </div>

                            <div class="field-card">
                                <div class="form-group">
                                    <label>Jam Landing</label>
                                    <input type="text" name="jam_landing"
                                        value="{{ old('jam_landing', $order->jam_landing ?? request('jam_landing')) }}"
                                        readonly>
                                </div>
                            </div>

                            <div class="field-card">
                                <div class="form-group">
                                    <label>Jam Jemput</label>
                                    <input type="text" name="jam_jemput"
                                        value="{{ old('jam_jemput', $order->jam_jemput ?? request('jam_jemput')) }}"
                                        readonly>
                                </div>
                            </div>
                        </div>

                        <div class="order-grid-right">

                            <h3 class="payment-title">
                                Metode Pembayaran
                            </h3>

                            <div class="payment-grid">

                                <label class="payment-card">
                                    <input type="radio"
                                    name="pembayaran"
                                    value="bca"
                                    {{ old('pembayaran', $order->pembayaran ?? '') == 'bca' ? 'checked' : '' }}
                                    required>

                                    <img src="{{ asset('images/BCA.png') }}" alt="BCA">
                                    <span>Transfer BCA</span>
                                </label>

                                <label class="payment-card">
                                    <input type="radio"
                                    name="pembayaran"
                                    value="bri"
                                    {{ old('pembayaran', $order->pembayaran ?? '') == 'bri' ? 'checked' : '' }}>

                                    <img src="{{ asset('images/BRI.png') }}" alt="BRI">
                                    <span>Transfer BRI</span>
                                </label>

                                <label class="payment-card">
                                    <input type="radio"
                                    name="pembayaran"
                                    value="qris"
                                    {{ old('pembayaran', $order->pembayaran ?? '') == 'qris' ? 'checked' : '' }}>

                                    <img src="{{ asset('images/Qris.png') }}" alt="QRIS">
                                    <span>QRIS</span>
                                </label>

                                <label class="payment-card">
                                    <input type="radio"
                                    name="pembayaran"
                                    value="cash"
                                    {{ old('pembayaran', $order->pembayaran ?? '') == 'cash' ? 'checked' : '' }}>

                                    <img src="{{ asset('images/cash.jpg') }}" alt="Cash">
                                    <span>Cash</span>
                                </label>

                            </div>

                            <div class="order-submit">
                                <button class="btn-order" type="submit">
                                    <i class="fa-brands fa-whatsapp"></i>
                                    Pesan Sekarang
                                </button>

                                <p class="order-note">
                                    Setelah klik, data akan diproses untuk konfirmasi pemesanan.
                                </p>

                                <a href="{{ route('home') }}" class="btn-back">
                                    <i class="fas fa-arrow-left"></i>
                                    Kembali
                                </a>
                            </div>

                        </div>

                    </div>

                </form>

            </div>

        </div>

    </section>

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

    <style>
        /* Grid layout: data diri (kiri) + pembayaran (kanan) */
        .order-grid {
            display: flex;
            flex-direction: column;
            gap: 30px;
        }

        .order-grid-left {
            display: flex;
            flex-direction: column;
        }

        .order-grid-right {
            display: flex;
            flex-direction: column;
        }

        /* Mobile: stack vertikal */
        @media (max-width: 992px) {
            .order-grid {
                grid-template-columns: 1fr;
                gap: 30px;
            }
        }

        /* Map card embedded inside data diri section */
        .field-card-map {
            padding: 14px;
            background: #fafafa;
            border: 1px solid #e8e8e8;
            border-radius: 16px;
            margin-bottom: 18px;
            overflow: visible !important;
            /* override field-card overflow:hidden */
        }

        .map-card-label {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 12px;
            font-weight: 700;
            color: #333;
            font-size: 14px;
        }

        .map-card-label i {
            color: #e3000f;
            font-size: 18px;
        }

        .order-map {
            width: 100%;
            height: 280px;
            border-radius: 12px;
            border: 1px solid #ddd;
            z-index: 1;
        }

        .map-card-hint {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-top: 10px;
            font-size: 12px;
            color: #888;
        }

        .map-card-hint i {
            color: #e3000f;
            font-size: 14px;
        }

        /* Suggestions styled to appear like an inline search dropdown (Gojek-like) */
        .suggestions {
            position: absolute;
            background: #fff;
            border: 1px solid #eee;
            z-index: 99999;
            max-height: 240px;
            overflow-y: auto;
            width: 100%;
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.08);
            border-radius: 10px;
        }

        .suggestion-item {
            padding: 10px 12px;
            cursor: pointer;
            display: flex;
            gap: 10px;
            align-items: center;
        }

        .suggestion-item .dot {
            width: 10px;
            height: 10px;
            border-radius: 50%;
            background: #007bff;
            flex: 0 0 10px;
        }

        .suggestion-item .label {
            color: #222;
            font-size: 14px;
        }

        .suggestion-item.active,
        .suggestion-item:hover {
            background: #f3f6ff;
        }

        /* Ensure input parent can position suggestions correctly */
        .input-suggest-wrapper {
            position: relative;
        }
    </style>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const flight = document.getElementById("flight_pukul");
            const telepon = document.querySelector('input[name="telepon"]');
            const nama = document.querySelector('input[name="nama_penumpang"]');
            const kode = document.querySelector('input[name="kode_pesawat"]');
            const lokasiJemput = document.querySelector('input[name="lokasi_jemput"]');
            const lokasiTujuan = document.querySelector('input[name="lokasi_tujuan"]');
            const jarakInput = document.getElementById('jarak');
            const hargaInput = document.getElementById('harga');
            const orderMap = document.getElementById('orderMap');

            // Helpers
            function debounce(fn, delay = 300) {
                let t;
                return function (...args) {
                    clearTimeout(t);
                    t = setTimeout(() => fn.apply(this, args), delay);
                }
            }

            flight.addEventListener("input", function () {
                let value = this.value.replace(/\D/g, '');
                if (value.length > 2) {
                    value = value.substring(0, 2) + ":" + value.substring(2, 4);
                }
                this.value = value;
            });

            telepon.addEventListener("input", function () {
                this.value = this.value.replace(/[^0-9]/g, '');
            });

            nama.addEventListener("input", function () {
                this.value = this.value.replace(/[^a-zA-Z\s]/g, '');
            });

            kode.addEventListener("input", function () {
                this.value = this.value.toUpperCase();
                this.value = this.value.replace(/[^A-Z0-9-]/g, '');
            });

            // Initialize Leaflet map
            const map = L.map(orderMap).setView([-7.797068, 110.370529], 11);
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19,
                attribution: '&copy; OpenStreetMap contributors'
            }).addTo(map);

            let originMarker = null;
            let destMarker = null;
            let routeLayer = null;
            let originCoords = null;
            let destCoords = null;

            function setMarker(type, latlng) {
                if (type === 'origin') {
                    if (originMarker) originMarker.setLatLng(latlng);
                    else originMarker = L.marker(latlng).addTo(map);
                    originCoords = latlng;
                } else {
                    if (destMarker) destMarker.setLatLng(latlng);
                    else destMarker = L.marker(latlng).addTo(map);
                    destCoords = latlng;
                }
            }

            function clearRoute() {
                if (routeLayer) { map.removeLayer(routeLayer); routeLayer = null; }
            }

            function drawRoute(geojson) {
                clearRoute();
                routeLayer = L.geoJSON(geojson, { style: { color: '#007bff', weight: 4 } }).addTo(map);
                map.fitBounds(routeLayer.getBounds(), { padding: [50, 50] });
            }

            async function calculateRouteAndPrice() {
                if (!originCoords || !destCoords) return;
                const lon1 = originCoords.lng, lat1 = originCoords.lat;
                const lon2 = destCoords.lng, lat2 = destCoords.lat;
                // Use OSRM demo server
                const url = `https://router.project-osrm.org/route/v1/driving/${lon1},${lat1};${lon2},${lat2}?overview=full&geometries=geojson`;
                try {
                    const res = await fetch(url);
                    const data = await res.json();
                    if (data && data.routes && data.routes.length) {
                        const route = data.routes[0];
                        const meters = route.distance || 0;
                        const km = meters / 1000;
                        jarakInput.value = km.toFixed(2);
                        hargaInput.value = Math.round(km * 7500);
                        drawRoute(route.geometry);
                    }
                } catch (e) {
                    console.error('OSRM error', e);
                }
            }

            // Autocomplete with Nominatim
            const suggestionMap = new Map();

            function createSuggestionsContainer(input) {
                const container = document.createElement('div');
                container.className = 'suggestions';
                container.style.position = 'absolute';
                container.style.zIndex = 9999;
                // Ensure wrapper exists and is positioned
                let wrapper = input.parentElement;
                if (!wrapper.classList.contains('input-suggest-wrapper')) {
                    const wrap = document.createElement('div');
                    wrap.className = 'input-suggest-wrapper';
                    wrapper.replaceChild(wrap, input);
                    wrap.appendChild(input);
                    wrapper = wrap;
                }
                // append container inside wrapper so it won't be clipped
                wrapper.appendChild(container);
                // auto size to input width
                container.style.minWidth = input.offsetWidth + 'px';
                container.style.left = '0px';
                container.style.top = (input.offsetHeight + 6) + 'px';
                return { container, wrapper };
            }

            function attachAutocomplete(input, type) {
                let entry = null;
                input.addEventListener('input', debounce(async function (e) {
                    const q = this.value.trim();
                    if (!q) { if (entry) entry.container.innerHTML = ''; return; }
                    if (!entry) { entry = createSuggestionsContainer(input); suggestionMap.set(input, entry); }
                    try {
                        const url = `https://nominatim.openstreetmap.org/search?format=json&q=${encodeURIComponent(q)}&addressdetails=1&limit=5`;
                        const res = await fetch(url, { headers: { 'Accept-Language': 'id', 'User-Agent': 'RYTravel/1.0' } });
                        const list = await res.json();
                        entry.container.innerHTML = '';
                        let idx = -1;
                        const items = [];
                        list.forEach(item => {
                            const div = document.createElement('div');
                            div.className = 'suggestion-item';
                            div.innerHTML = `<span class="dot"></span><span class="label">${item.display_name}</span>`;
                            div.setAttribute('data-lat', item.lat);
                            div.setAttribute('data-lon', item.lon);
                            div.addEventListener('mousedown', function (ev) {
                                ev.preventDefault();
                                input.value = item.display_name;
                                const lat = parseFloat(item.lat);
                                const lon = parseFloat(item.lon);
                                setMarker(type, { lat: lat, lng: lon });
                                const hiddenLat = document.getElementById(type === 'origin' ? 'lokasi_jemput_lat' : 'lokasi_tujuan_lat');
                                const hiddenLon = document.getElementById(type === 'origin' ? 'lokasi_jemput_lon' : 'lokasi_tujuan_lon');
                                if (hiddenLat) hiddenLat.value = item.lat;
                                if (hiddenLon) hiddenLon.value = item.lon;
                                entry.container.innerHTML = '';
                                calculateRouteAndPrice();
                            });
                            entry.container.appendChild(div);
                            items.push(div);
                        });

                        // keyboard navigation
                        input.addEventListener('keydown', function (ev) {
                            if (!items.length) return;
                            if (ev.key === 'ArrowDown') {
                                ev.preventDefault(); idx = Math.min(idx + 1, items.length - 1);
                                items.forEach((it, i) => it.classList.toggle('active', i === idx));
                            } else if (ev.key === 'ArrowUp') {
                                ev.preventDefault(); idx = Math.max(idx - 1, 0);
                                items.forEach((it, i) => it.classList.toggle('active', i === idx));
                            } else if (ev.key === 'Enter') {
                                ev.preventDefault(); if (idx >= 0 && items[idx]) items[idx].dispatchEvent(new MouseEvent('mousedown'));
                            }
                        });
                    } catch (err) {
                        console.error('Nominatim error', err);
                    }
                }, 300));

                // close on outside click but don't close when clicking the suggestions container
                document.addEventListener('click', function (ev) {
                    if (!entry) return;
                    const container = entry.container;
                    if (container && !input.contains(ev.target) && !container.contains(ev.target)) container.innerHTML = '';
                });

                // hide suggestions shortly after input blur (allow click)
                input.addEventListener('blur', function () {
                    setTimeout(() => {
                        if (entry && entry.container) entry.container.innerHTML = '';
                    }, 200);
                });

                // If input already has a value (e.g., from server), try to geocode once
                if (input.value && input.value.trim().length > 0) {
                    (async function initialGeocode() {
                        try {
                            const url = `https://nominatim.openstreetmap.org/search?format=json&q=${encodeURIComponent(input.value)}&addressdetails=1&limit=1`;
                            const res = await fetch(url, { headers: { 'Accept-Language': 'id', 'User-Agent': 'RYTravel/1.0' } });
                            const list = await res.json();
                            if (list && list.length) {
                                const item = list[0];
                                const lat = parseFloat(item.lat);
                                const lon = parseFloat(item.lon);
                                setMarker(type, { lat: lat, lng: lon });
                                calculateRouteAndPrice();
                            }
                        } catch (err) {
                            console.error('Initial geocode error', err);
                        }
                    })();
                }
            }

            attachAutocomplete(lokasiJemput, 'origin');
            attachAutocomplete(lokasiTujuan, 'dest');

            // If the homepage provided coordinates via query params, use them directly
            const preOriginLat = {!! json_encode($order->lokasi_jemput_lat ?? request('lokasi_jemput_lat')) !!};
            const preOriginLon = {!! json_encode($order->lokasi_jemput_lon ?? request('lokasi_jemput_lon')) !!};
            const preDestLat = {!! json_encode($order->lokasi_tujuan_lat ?? request('lokasi_tujuan_lat')) !!};
            const preDestLon = {!! json_encode($order->lokasi_tujuan_lon ?? request('lokasi_tujuan_lon')) !!};

            let hasPreCoords = false;

            if (preOriginLat && preOriginLon) {
                try {
                    const lat = parseFloat(preOriginLat);
                    const lon = parseFloat(preOriginLon);
                    if (!isNaN(lat) && !isNaN(lon)) {
                        setMarker('origin', { lat, lng: lon });
                        document.getElementById('lokasi_jemput_lat').value = preOriginLat;
                        document.getElementById('lokasi_jemput_lon').value = preOriginLon;
                        hasPreCoords = true;
                    }
                } catch (e) { console.error('origin coords err', e); }
            }
            if (preDestLat && preDestLon) {
                try {
                    const lat = parseFloat(preDestLat);
                    const lon = parseFloat(preDestLon);
                    if (!isNaN(lat) && !isNaN(lon)) {
                        setMarker('dest', { lat, lng: lon });
                        document.getElementById('lokasi_tujuan_lat').value = preDestLat;
                        document.getElementById('lokasi_tujuan_lon').value = preDestLon;
                        hasPreCoords = true;
                    }
                } catch (e) { console.error('dest coords err', e); }
            }

            // If both markers already available from pre-coords, calculate route immediately
            if (originCoords && destCoords) {
                calculateRouteAndPrice();
            } else if (!hasPreCoords) {
                // Fallback: try after a short delay to let autocomplete geocoding finish
                setTimeout(() => {
                    if (originCoords && destCoords) calculateRouteAndPrice();
                }, 1500);
            }

        });
    </script>

@endsection