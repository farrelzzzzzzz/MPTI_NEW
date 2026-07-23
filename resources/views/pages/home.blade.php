@extends('layouts.app')

@section('content')

<section class="hero">

    <h1 data-aos="zoom-in">
        ANTAR JEMPUT BANDARA JOGJA
    </h1>

    <form action="{{ route('order') }}" method="GET" class="booking-box" data-aos="fade-up" id="bookingForm">

        <div class="field">
            <label>Lokasi Jemput</label>

            <input type="text" name="lokasi_jemput" placeholder="Pilih Keberangkatan"
                pattern="^[A-Za-z0-9\s.,-]{3,100}$"
                title="Masukkan lokasi yang valid" required>
            <input type="hidden" name="lokasi_jemput_lat" id="lokasi_jemput_lat">
            <input type="hidden" name="lokasi_jemput_lon" id="lokasi_jemput_lon">
        </div>

        <div class="field">
            <label>Lokasi Tujuan</label>

            <input type="text" name="lokasi_tujuan" placeholder="Pilih Tujuan"
                pattern="^[A-Za-z0-9\s.,-]{3,100}$"
                title="Masukkan lokasi yang valid" required>
            <input type="hidden" name="lokasi_tujuan_lat" id="lokasi_tujuan_lat">
            <input type="hidden" name="lokasi_tujuan_lon" id="lokasi_tujuan_lon">
        </div>

        <div class="field">
            <label>Tanggal</label>

            <input type="date" id="booking-date" name="tanggal" required>
        </div>

        <div class="field">
            <label>Jam Landing</label>

            <input id="booking-time-landing"
                type="text"
                name="jam_landing"
                placeholder="Contoh: 13:00"
                maxlength="5"
                pattern="^([01]\d|2[0-3]):([0-5]\d)$"
                title="Format jam harus HH:MM"
                autocomplete="off"
                required>
        </div>

        <div class="field">
            <label>Jam Jemput</label>

            <input id="booking-time-pickup"
                type="text"
                name="jam_jemput"
                placeholder="Contoh: 13:00"
                maxlength="5"
                pattern="^([01]\d|2[0-3]):([0-5]\d)$"
                title="Format jam harus HH:MM"
                autocomplete="off"
                required>
        </div>

    <div class="field">
            <label>Jumlah Penumpang</label>

            <input type="number"
                name="jumlah_penumpang"
                min="1"
                max="10"
                placeholder="1 Orang"
                required>
        </div>

        <button type="submit" class="order-btn" id="orderBtn">
            <i class="fa-solid fa-paper-plane"></i>
            ORDER
        </button>

    </form>

</section>

<section class="promo reveal">

    <div class="promo-slider" data-promo-slider>

        <div class="promo-slides">
            <img class="promo-slide active" src="{{ asset('images/banner1.png') }}" alt="Promo 1">
            <img class="promo-slide" src="{{ asset('images/banner2.png') }}" alt="Promo 2">
            <img class="promo-slide" src="{{ asset('images/banner3.png') }}" alt="Promo 3">
        </div>

        <div class="promo-dots">

            <button class="promo-dot active" data-promo-dot="0"></button>
            <button class="promo-dot" data-promo-dot="1"></button>
            <button class="promo-dot" data-promo-dot="2"></button>

        </div>

    </div>

</section>

<section id="tentang" class="layanan">

    <h1 data-aos="fade-right">
        LAYANAN RY TRAVEL
    </h1>

    <p data-aos="fade-left">
        Ry Travel siap menemani perjalananmu dengan layanan antar jemput bandara
        yang nyaman, aman, dan tepat waktu. Pesan kendaraan dengan mudah,
        pilih jadwal keberangkatan, lalu nikmati perjalanan tanpa repot.
    </p>

    <div class="card reveal">

        <div class="icon">
            <i class="fa-solid fa-plane"></i>
        </div>

        <h2>Antar Jemput Bandara</h2>

        <p>
            Nikmati layanan antar jemput Bandara YIA dan Bandara Adisutjipto
            dengan armada nyaman, sopir berpengalaman,
            dan jadwal keberangkatan yang tepat waktu.
        </p>

    </div>

    <div class="card reveal">

        <div class="icon">
            <i class="fa-solid fa-ticket"></i>
        </div>

        <h2>Reservasi Mudah</h2>

        <p>
            Pesan layanan antar jemput bandara kini lebih praktis bersama
            Ry Travel. Cukup pilih jadwal keberangkatan,
            isi data perjalanan, dan konfirmasi pemesanan secara online.
        </p>

    </div>

    <!-- CARD BARU -->
    <div class="card reveal">

        <div class="icon">
            <i class="fa-solid fa-mountain-sun"></i>
        </div>

        <h2>Wisata Sekitar Jogja</h2>

        <p>
            Selain layanan antar jemput bandara, Ry Travel juga melayani
            perjalanan wisata ke berbagai destinasi populer di Yogyakarta,
            seperti Malioboro, HeHa Sky View, Pantai Parangtritis,
            Tebing Breksi, Candi Prambanan, Merapi, dan berbagai tempat
            wisata menarik lainnya dengan armada yang nyaman serta
            pengemudi yang berpengalaman.
        </p>

    </div>

</section>

<section class="gallery reveal">

    <h1>Seru Seruan Bersama Ry Travel</h1>

    <div class="gallery-grid">

        <video controls class="reels-video">
            <source src="{{ asset('videos/travel1.mp4') }}" type="video/mp4">
        </video>

        <video controls class="reels-video">
            <source src="{{ asset('videos/travel2.mp4') }}" type="video/mp4">
        </video>

        <video controls class="reels-video">
            <source src="{{ asset('videos/travel3.mp4') }}" type="video/mp4">
        </video>

    </div>

</section>

<a href="https://wa.me/62882007380782"
    class="wa-button"
    target="_blank">

    <i class="fa-brands fa-whatsapp"></i>
    Tanya Admin

</a>

<script>

document.addEventListener("DOMContentLoaded", function () {

    function formatJam(input){

        input.addEventListener("input", function(){

            let value=this.value.replace(/\D/g,'');

            if(value.length>2){

                value=value.substring(0,2)+":"+value.substring(2,4);

            }

            this.value=value;

        });

    }

    formatJam(document.getElementById("booking-time-landing"));
    formatJam(document.getElementById("booking-time-pickup"));

    document.querySelectorAll('input[name="lokasi_jemput"], input[name="lokasi_tujuan"]')
    .forEach(function(input){

        input.addEventListener("input",function(){

            this.value=this.value.replace(/[^a-zA-ZÀ-ÿ0-9\s.,-]/g,'');

        });

    });

    const jumlah=document.querySelector('input[name="jumlah_penumpang"]');

    jumlah.addEventListener("input",function(){

        if(this.value>10){

            this.value=10;
            alert("Maksimal 10 penumpang.");

        }

        if(this.value<1){

            this.value=1;

        }

    });

});

</script>

<style>
    /* Inline suggestions for homepage inputs */
    .input-suggest-wrapper { position: relative; }
    .suggestions { position: absolute; background: #fff; border: 1px solid #eee; z-index: 9999; max-height: 220px; overflow-y: auto; width: 100%; box-shadow: 0 6px 18px rgba(0,0,0,0.08); border-radius: 8px; }
    .suggestion-item { padding: 10px; cursor: pointer; }
    .suggestion-item:hover { background: #f3f6ff; }
</style>

<script>
document.addEventListener('DOMContentLoaded', function(){
    function debounce(fn, delay=300){ let t; return function(...a){ clearTimeout(t); t=setTimeout(()=>fn.apply(this,a), delay); }}

    function createContainer(input){
        let wrapper = input.parentElement;
        if (!wrapper.classList.contains('input-suggest-wrapper')){
            const wrap = document.createElement('div'); wrap.className='input-suggest-wrapper';
            wrapper.replaceChild(wrap, input); wrap.appendChild(input); wrapper = wrap;
        }
        const container = document.createElement('div'); container.className='suggestions'; container.style.top = (input.offsetHeight + 6)+'px'; container.style.left = '0px'; wrapper.appendChild(container);
        return container;
    }

    async function queryNominatim(q){
        const url = `https://nominatim.openstreetmap.org/search?format=json&q=${encodeURIComponent(q)}&addressdetails=1&limit=6`;
        const res = await fetch(url, { headers: { 'Accept-Language':'id', 'User-Agent':'RYTravel/1.0' }});
        return await res.json();
    }

    function attach(input){
        let container = null; let items = [];
        input.addEventListener('input', debounce(async function(){
            const q = this.value.trim();
            if (!q){ if (container) container.innerHTML=''; return; }
            if (!container) container = createContainer(input);
            try{
                const list = await queryNominatim(q);
                container.innerHTML=''; items=[];
                list.forEach(it=>{
                    const d=document.createElement('div'); d.className='suggestion-item'; d.textContent=it.display_name;
                    d.addEventListener('mousedown', (ev)=>{ 
                        ev.preventDefault(); 
                        input.value = it.display_name; 
                        // set hidden lat/lon if exists
                        const baseName = input.getAttribute('name');
                        const latField = document.querySelector(`input[name="${baseName}_lat"]`);
                        const lonField = document.querySelector(`input[name="${baseName}_lon"]`);
                        if(latField) latField.value = it.lat;
                        if(lonField) lonField.value = it.lon;
                        container.innerHTML=''; 
                    }); 
                    container.appendChild(d); items.push(d);
                });
            }catch(e){ console.error(e); }
        }, 250));
        input.addEventListener('blur', ()=>{ setTimeout(()=>{ if (container) container.innerHTML=''; }, 200); });
    }

    const a = document.querySelector('input[name="lokasi_jemput"]');
    const b = document.querySelector('input[name="lokasi_tujuan"]');
    if (a) attach(a); if (b) attach(b);

    // ============================================
    // GEOCODE HELPER (fill lat/lon if empty)
    // ============================================
    async function geocodeLocation(query) {
        if (!query || query.trim().length < 3) return null;
        try {
            const url = `https://nominatim.openstreetmap.org/search?format=json&q=${encodeURIComponent(query)}&limit=1`;
            const res = await fetch(url, { headers: { 'Accept-Language':'id', 'User-Agent':'RYTravel/1.0' }});
            const data = await res.json();
            if (data && data.length > 0) {
                return { lat: data[0].lat, lon: data[0].lon };
            }
        } catch(e) { console.error('Geocode error', e); }
        return null;
    }

    async function fillMissingCoordinates() {
        const jemputLat = document.getElementById('lokasi_jemput_lat');
        const jemputLon = document.getElementById('lokasi_jemput_lon');
        const tujuanLat = document.getElementById('lokasi_tujuan_lat');
        const tujuanLon = document.getElementById('lokasi_tujuan_lon');

        const tasks = [];

        if (jemputLat && (!jemputLat.value || !jemputLon.value)) {
            const jemputInput = document.querySelector('input[name="lokasi_jemput"]');
            if (jemputInput && jemputInput.value) {
                tasks.push(
                    geocodeLocation(jemputInput.value).then(coords => {
                        if (coords) { jemputLat.value = coords.lat; jemputLon.value = coords.lon; }
                    })
                );
            }
        }

        if (tujuanLat && (!tujuanLat.value || !tujuanLon.value)) {
            const tujuanInput = document.querySelector('input[name="lokasi_tujuan"]');
            if (tujuanInput && tujuanInput.value) {
                tasks.push(
                    geocodeLocation(tujuanInput.value).then(coords => {
                        if (coords) { tujuanLat.value = coords.lat; tujuanLon.value = coords.lon; }
                    })
                );
            }
        }

        if (tasks.length > 0) {
            await Promise.all(tasks);
        }
    }

    // ============================================
    // Store form data to URL params helper
    // ============================================
    const bookingForm = document.getElementById('bookingForm');

    function getFormQueryString() {
        if (!bookingForm) return '';
        const fd = new FormData(bookingForm);
        const params = new URLSearchParams();
        for (let [key, val] of fd.entries()) {
            params.set(key, val);
        }
        return params.toString();
    }

    // ============================================
    // Unified submit handler - handles geocode AND login modal
    // ============================================
    const orderBtn = document.getElementById('orderBtn');
    const isLoggedIn = {{ Auth::check() ? 'true' : 'false' }};

    if (bookingForm && orderBtn) {
        bookingForm.addEventListener('submit', async function(e) {
            e.preventDefault();

            // 1. Fill missing coordinates via geocode
            await fillMissingCoordinates();

            // 2. If guest, show login modal instead
            if (!isLoggedIn) {
                const modal = document.getElementById('loginModal');
                if (modal) {
                    modal.style.display = 'flex';
                    setTimeout(() => {
                        const emailInput = modal.querySelector('input[name="email"]');
                        if (emailInput) emailInput.focus();
                    }, 100);
                }
                return;
            }

            // 3. If logged in, submit normally
            HTMLFormElement.prototype.submit.call(this);
        });
    }

    // Close modal on X click
    const modalCloseBtn = document.querySelector('.login-modal-close');
    if (modalCloseBtn) {
        modalCloseBtn.addEventListener('click', function() {
            document.getElementById('loginModal').style.display = 'none';
        });
    }

    // Close modal on overlay click
    const modalOverlay = document.getElementById('loginModal');
    if (modalOverlay) {
        modalOverlay.addEventListener('click', function(e) {
            if (e.target === this) {
                this.style.display = 'none';
            }
        });
    }

    // Handle login form submission via AJAX
    const loginModalForm = document.getElementById('loginModalForm');
    if (loginModalForm) {
        loginModalForm.addEventListener('submit', async function(e) {
            e.preventDefault();

            const submitBtn = this.querySelector('button[type="submit"]');
            const originalText = submitBtn.innerHTML;
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Memproses...';
            submitBtn.disabled = true;

            const errorDiv = this.querySelector('.login-modal-error');
            if (errorDiv) errorDiv.style.display = 'none';

            const formData = new FormData(this);

            try {
                const response = await fetch(this.action, {
                    method: 'POST',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json',
                    },
                    body: formData
                });

                const data = await response.json();

                if (response.ok && data.redirect) {
                    // Success - redirect to order page with form data as query params
                    const queryString = getFormQueryString();
                    window.location.href = '{{ route("order") }}?' + queryString;
                } else {
                    // Show errors
                    const errorDiv = this.querySelector('.login-modal-error');
                    if (errorDiv) {
                        let errorMsg = 'Email atau password salah. Silakan coba lagi.';
                        if (data.errors) {
                            const firstError = Object.values(data.errors)[0];
                            if (firstError) errorMsg = firstError[0] || firstError;
                        } else if (data.message) {
                            errorMsg = data.message;
                        }
                        errorDiv.textContent = errorMsg;
                        errorDiv.style.display = 'block';
                    }
                }
            } catch (err) {
                const errorDiv = this.querySelector('.login-modal-error');
                if (errorDiv) {
                    errorDiv.textContent = 'Terjadi kesalahan. Silakan coba lagi.';
                    errorDiv.style.display = 'block';
                }
            } finally {
                submitBtn.innerHTML = originalText;
                submitBtn.disabled = false;
            }
        });
    }
});
</script>

@guest
<!-- LOGIN MODAL -->
<div id="loginModal" class="login-modal-overlay" style="display:none;">
    <div class="login-modal-card">
        <button class="login-modal-close">&times;</button>
        
        <div class="login-modal-header">
            <img src="{{ asset('images/logo.png') }}" alt="RY Travel Logo">
            <h2>Masuk untuk Memesan</h2>
            <p>Silakan login terlebih dahulu untuk melanjutkan pemesanan.</p>
        </div>

        <form id="loginModalForm" method="POST" action="{{ route('login') }}">
            @csrf
            <input type="hidden" name="modal_login" value="1">

            <div class="login-modal-error" style="display:none;"></div>

            <div class="login-modal-field">
                <label for="modal-email">Email</label>
                <div class="login-modal-input-wrapper">
                    <input id="modal-email" type="email" name="email" required autocomplete="email" placeholder="Masukkan email Anda">
                    <i class="fas fa-envelope"></i>
                </div>
            </div>

            <div class="login-modal-field">
                <label for="modal-password">Password</label>
                <div class="login-modal-input-wrapper">
                    <input id="modal-password" type="password" name="password" required autocomplete="current-password" placeholder="Masukkan password Anda">
                    <i class="fas fa-lock"></i>
                </div>
            </div>

            <div class="login-modal-options">
                <label class="login-modal-remember">
                    <input type="checkbox" name="remember" checked>
                    <span>Ingat saya</span>
                </label>
                <a href="{{ route('password.request') }}" class="login-modal-forgot">Lupa password?</a>
            </div>

            <button type="submit" class="login-modal-btn">
                <i class="fas fa-sign-in-alt"></i>
                Masuk & Lanjutkan
            </button>
        </form>

        <div class="login-modal-footer">
            <p>Belum punya akun? <a href="{{ route('register') }}">Daftar Sekarang</a></p>
        </div>
    </div>
</div>

<style>
/* LOGIN MODAL STYLES */
.login-modal-overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.6);
    backdrop-filter: blur(4px);
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 99999;
    animation: loginModalFadeIn 0.3s ease;
}

@keyframes loginModalFadeIn {
    from { opacity: 0; }
    to { opacity: 1; }
}

.login-modal-card {
    background: #fff;
    border-radius: 24px;
    width: 90%;
    max-width: 420px;
    padding: 40px 35px;
    position: relative;
    box-shadow: 0 25px 60px rgba(0, 0, 0, 0.3);
    animation: loginModalSlideUp 0.35s ease;
    max-height: 90vh;
    overflow-y: auto;
}

@keyframes loginModalSlideUp {
    from { transform: translateY(40px); opacity: 0; }
    to { transform: translateY(0); opacity: 1; }
}

.login-modal-close {
    position: absolute;
    top: 12px;
    right: 16px;
    background: none;
    border: none;
    font-size: 32px;
    color: #999;
    cursor: pointer;
    transition: color 0.3s;
    line-height: 1;
    padding: 4px 8px;
}

.login-modal-close:hover {
    color: #e3000f;
}

.login-modal-header {
    text-align: center;
    margin-bottom: 28px;
}

.login-modal-header img {
    width: 60px;
    margin-bottom: 16px;
}

.login-modal-header h2 {
    font-size: 22px;
    color: #222;
    margin-bottom: 6px;
}

.login-modal-header p {
    font-size: 14px;
    color: #888;
}

.login-modal-error {
    background: #fff5f5;
    color: #e3000f;
    padding: 12px 16px;
    border-radius: 10px;
    margin-bottom: 18px;
    font-size: 13px;
    border: 1px solid #fcc;
    text-align: center;
}

.login-modal-field {
    margin-bottom: 18px;
}

.login-modal-field label {
    display: block;
    font-weight: 600;
    color: #333;
    margin-bottom: 6px;
    font-size: 14px;
}

.login-modal-input-wrapper {
    position: relative;
}

.login-modal-input-wrapper i {
    position: absolute;
    left: 14px;
    top: 50%;
    transform: translateY(-50%);
    color: #aaa;
    font-size: 15px;
}

.login-modal-input-wrapper input {
    width: 100%;
    height: 48px;
    border: 2px solid #e8e8e8;
    border-radius: 12px;
    padding: 0 14px 0 42px;
    font-size: 15px;
    background: #fafafa;
    outline: none;
    transition: all 0.3s ease;
    box-sizing: border-box;
}

.login-modal-input-wrapper input:focus {
    border-color: #e3000f;
    background: #fff;
    box-shadow: 0 0 0 4px rgba(227, 0, 15, 0.08);
}

.login-modal-input-wrapper input:focus + i {
    color: #e3000f;
}

.login-modal-options {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 20px;
}

.login-modal-remember {
    display: flex;
    align-items: center;
    gap: 6px;
    font-size: 13px;
    color: #666;
    cursor: pointer;
}

.login-modal-remember input[type="checkbox"] {
    width: 16px;
    height: 16px;
    accent-color: #e3000f;
    cursor: pointer;
}

.login-modal-forgot {
    font-size: 13px;
    color: #e3000f;
    text-decoration: none;
    font-weight: 600;
}

.login-modal-forgot:hover {
    text-decoration: underline;
}

.login-modal-btn {
    width: 100%;
    height: 50px;
    background: linear-gradient(135deg, #e3000f, #c4000d);
    color: #fff;
    border: none;
    border-radius: 12px;
    font-size: 15px;
    font-weight: 700;
    cursor: pointer;
    transition: all 0.35s ease;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
}

.login-modal-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 25px rgba(227, 0, 15, 0.3);
}

.login-modal-btn:active {
    transform: scale(0.98);
}

.login-modal-btn:disabled {
    opacity: 0.7;
    cursor: not-allowed;
    transform: none;
}

.login-modal-footer {
    text-align: center;
    margin-top: 22px;
    padding-top: 18px;
    border-top: 1px solid #f0f0f0;
}

.login-modal-footer p {
    font-size: 14px;
    color: #888;
}

.login-modal-footer a {
    color: #e3000f;
    font-weight: 700;
    text-decoration: none;
}

.login-modal-footer a:hover {
    text-decoration: underline;
}

@media (max-width: 480px) {
    .login-modal-card {
        padding: 30px 20px;
    }
    .login-modal-header h2 {
        font-size: 19px;
    }
}
</style>
@endguest

@endsection
