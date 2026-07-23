window.addEventListener('load', function () {
    const loader = document.getElementById('loader');
    if (loader) loader.style.display = 'none';
});

// Date min = hari ini (biar tidak bisa mundur)
function setMinDate(dateInput) {
    if (!dateInput) return;


    const now = new Date();
    const yyyy = now.getFullYear();
    const mm = String(now.getMonth() + 1).padStart(2, '0');
    const dd = String(now.getDate()).padStart(2, '0');
    const today = `${yyyy}-${mm}-${dd}`;

    dateInput.min = today;

    if (dateInput.value && dateInput.value < today) {
        dateInput.value = today;
    }

    return today;
}



document.addEventListener('DOMContentLoaded', function () {
    const date1 = document.getElementById('booking-date');
    const date2 = document.getElementById('booking-date-2');

    const timeLanding = document.getElementById('booking-time-landing');
    const timePickup = document.getElementById('booking-time-pickup');

    const today = setMinDate(date1);

    function hhmmToMinutes(hhmm) {
        if (!hhmm) return null;
        const parts = hhmm.split(':');
        if (parts.length !== 2) return null;
        const hh = Number(parts[0]);
        const mm = Number(parts[1]);
        if (Number.isNaN(hh) || Number.isNaN(mm)) return null;
        return hh * 60 + mm;
    }

    function getNowHHMM() {
        const n = new Date();
        const pad = (x) => String(x).padStart(2, '0');
        return `${pad(n.getHours())}:${pad(n.getMinutes())}`;
    }

    function enforceTimeNotEarlier() {
        if (!date1 || !timeLanding || !timePickup) return;

        const nowHHMM = getNowHHMM();
        const nowMins = hhmmToMinutes(nowHHMM);
        if (nowMins === null) return;

        if (date1.value === today) {
            // kunci kalau jam user lebih kecil dari sekarang
            [timeLanding, timePickup].forEach((el) => {
                const valMins = hhmmToMinutes(el.value);
                if (valMins !== null && valMins < nowMins) {
                    el.value = nowHHMM;
                }
            });
        }
    }

    enforceTimeNotEarlier();
    setInterval(enforceTimeNotEarlier, 30000);

    // kalau masih ada elemen tanggal-2 di halaman lain
    setMinDate(date2);
});

window.addEventListener('scroll', function () {

    const nav = document.querySelector('.navbar');

    if (nav) {
        if (window.scrollY > 50) {
            nav.classList.add('scrolled');
        } else {
            nav.classList.remove('scrolled');
        }
    }

    const reveals = document.querySelectorAll('.reveal');

    reveals.forEach(item => {

        const top = item.getBoundingClientRect().top;
        const height = window.innerHeight;

        if (top < height - 100) {
            item.classList.add('active');
        }
    });
});

// PROMO Slider (auto)
(function () {
    const slider = document.querySelector('[data-promo-slider]');
    if (!slider) return;

    const slides = Array.from(slider.querySelectorAll('.promo-slide'));
    const dots = Array.from(slider.querySelectorAll('[data-promo-dot]'));
    if (!slides.length) return;

    let currentIndex = 0;
    let timer = null;
    const intervalMs = 1000;

    function setActive(index) {
        slides.forEach((img, i) => {
            img.classList.toggle('active', i === index);
        });
        dots.forEach((dotEl, i) => {
            dotEl.classList.toggle('active', i === index);
        });
        currentIndex = index;
    }

    function next() {
        const nextIndex = (currentIndex + 1) % slides.length;
        setActive(nextIndex);
    }

    function start() {
        if (timer) return;
        timer = setInterval(next, intervalMs);
    }

    function stop() {
        if (!timer) return;
        clearInterval(timer);
        timer = null;
    }

    // dot click
    dots.forEach((dotEl) => {
        dotEl.addEventListener('click', function () {
            const idx = Number(this.getAttribute('data-promo-dot'));
            if (Number.isNaN(idx)) return;
            stop();
            setActive(idx);
            start();
        });
    });

    // pause on hover
    slider.addEventListener('mouseenter', stop);
    slider.addEventListener('mouseleave', start);

    start();
})();

window.addEventListener('scroll', function () {

    const lefts =
        document.querySelectorAll('.reveal-left');

    lefts.forEach(item => {

        const top =
            item.getBoundingClientRect().top;

        const height =
            window.innerHeight;

        if (top < height - 100) {
            item.classList.add('active');
        }

    });

});

const formPesan =
    document.getElementById('formPesan');

if (formPesan) {

    formPesan.addEventListener('submit', function (e) {

        e.preventDefault();

        const nama =
            document.querySelector(
                '[name=nama_penumpang]'
            )?.value || '';

        const kode =
            document.querySelector(
                '[name=kode_pesawat]'
            )?.value || '';

        const hp =
            document.querySelector(
                '[name=telepon]'
            )?.value || '';

        const flight =
            document.querySelector(
                '[name=flight]'
            )?.value || '';

        const pembayaran =
            document.querySelector(
                'input[name=pembayaran]:checked'
            )?.value || '-';

        // Ambil data dari form fields langsung
        const jumlahPenumpang = document.querySelector('[name=jumlah_penumpang]')?.value || '-';
        const tanggalField = document.querySelector('[name=tanggal]')?.value || '-';
        const lokasiJemputField = document.querySelector('[name=lokasi_jemput]')?.value || '-';
        const lokasiTujuanField = document.querySelector('[name=lokasi_tujuan]')?.value || '-';
        const jamLandingField = document.querySelector('[name=jam_landing]')?.value || '-';
        const jamJemputField = document.querySelector('[name=jam_jemput]')?.value || '-';

        const pesan =
            `*PEMESANAN RY TRAVEL*

Kode Pesawat : ${kode}
Nama Penumpang : ${nama}
Jumlah Penumpang : ${jumlahPenumpang}
No HP : ${hp}
Tanggal : ${tanggalField}
Lokasi Jemput : ${lokasiJemputField}
Lokasi Tujuan : ${lokasiTujuanField}
Flight Pukul : ${flight}
Jam Landing : ${jamLandingField}
Jam Jemput : ${jamJemputField}
Pembayaran : ${pembayaran}`;

        window.open(
            `https://wa.me/6281234567890?text=${encodeURIComponent(pesan)}`
        );

    });

}



