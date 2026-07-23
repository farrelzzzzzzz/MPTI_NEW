@extends('layouts.app')

@section('content')

    <section class="about-hero">

        <h1>TENTANG RY TRAVEL</h1>

    </section>

    <section class="about-company reveal">

        <h1>TENTANG RY TRAVEL</h1>

        <p>
            Ry Travel merupakan usaha yang bergerak di bidang jasa transportasi antar jemput bandara yang hadir untuk
            memenuhi kebutuhan masyarakat akan layanan perjalanan yang praktis, aman, dan nyaman.
            Dengan meningkatnya kebutuhan transportasi menuju dan dari bandara, RY Travel berkomitmen menjadi solusi
            transportasi yang dapat diandalkan oleh seluruh pelanggan.
        </p>

        <p>
            Dalam setiap pelayanan, RY Travel mengutamakan kenyamanan, keamanan, dan ketepatan waktu. Didukung oleh armada
            yang terawat, pengemudi yang profesional, serta sistem pemesanan yang mudah, kami selalu berusaha memberikan
            pengalaman perjalanan yang menyenangkan bagi setiap pelanggan.
        </p>

        <p>
            Melalui layanan antar jemput bandara, RY Travel siap melayani berbagai kebutuhan perjalanan, baik untuk
            keperluan pribadi, keluarga, maupun perjalanan bisnis. Kami berkomitmen untuk memberikan layanan transportasi
            yang terpercaya sehingga pelanggan dapat melakukan perjalanan dengan lebih tenang dan nyaman.
        </p>

        <p>
            Dengan semangat pelayanan yang ramah, profesional, dan terpercaya, RY Travel berharap dapat menjadi pilihan
            utama masyarakat dalam layanan antar jemput bandara. Bagi kami, kepuasan dan kenyamanan pelanggan merupakan
            prioritas utama dalam setiap perjalanan yang kami layani.
        </p>

    </section>

    <section class="about-banner reveal">

        <img src="{{ asset('images/promo.png') }}">

    </section>

    <section class="why-us reveal">

        <h1>Kenapa Harus Ry Travel</h1>

        <div class="why-grid">

            <div class="why-item">
                <i class="fa-regular fa-calendar"></i>
                <h3>Mudah untuk menentukan jadwal</h3>
            </div>

            <div class="why-item">
                <i class="fa-regular fa-money-bill-1"></i>
                <h3>Harga terjangkau</h3>
            </div>

            <div class="why-item">
                <i class="fa-solid fa-headset"></i>
                <h3>Fasilitas yang nyaman</h3>
            </div>

        </div>

    </section>

    <section class="facility reveal">

        <h1>Fasilitas Tersedia</h1>

        <div class="facility-box">

            <div class="facility-card">
                <div class="circle">
                    <img src="{{ asset('images/usb slotjpg.jpg') }}" alt="USB Slot">
                </div>
                <div>
                    <h3>USB Slot</h3>
                    <p>Dilengkapi dengan USB Slot untuk gadget.</p>
                </div>
            </div>

            <div class="facility-card">
                <div class="circle">
                    <img src="{{ asset('images/seat belt.jpg') }}" alt="Seat Belt">
                </div>
                <div>
                    <h3>Seat Belt</h3>
                    <p>Dilengkapi seat belt agar perjalanan aman.</p>
                </div>
            </div>

            <div class="facility-card">
                <div class="circle">
                    <img src="{{ asset('images/adjustment seat.jpg') }}" alt="Adjustment Seat">
                </div>
                <div>
                    <h3>Adjustment Seat</h3>
                    <p>Posisi duduk lebih nyaman.</p>
                </div>
            </div>

            <div class="facility-card">
                <div class="circle">
                    <img src="{{ asset('images/bagasi luas.jpg') }}" alt="Bagasi Luas">
                </div>
                <div>
                    <h3>Bagasi Luas</h3>
                    <p>Bagasi luas untuk kebutuhan perjalanan.</p>
                </div>
            </div>

            <div class="facility-card">
                <div class="circle">
                    <img src="{{ asset('images/head room.jpg') }}" alt="Head Room">
                </div>
                <div>
                    <h3>Head Room</h3>
                    <p>Ruang kepala yang lega.</p>
                </div>
            </div>

            <div class="facility-card">
                <div class="circle">
                    <img src="{{ asset('images/ac.jpg') }}" alt="AC">
                </div>
                <div>
                    <h3>AC</h3>
                    <p>AC sejuk dan nyaman.</p>
                </div>
            </div>


        </div>

    </section>

    <section class="armada reveal">

        <h1>Armada Ry Travel</h1>

        <div class="armada-wrapper">

            <!-- Mobil 1 -->
            <div class="armada-item">

                <img src="{{ asset('images/hiace.png') }}">

                <div class="armada-feature">

                    <div class="fitur-item">
                        <i class="fa-solid fa-chair"></i>
                        <span>16 & 19 Seat</span>
                    </div>


                    <div class="fitur-item">
                        <i class="fa-solid fa-couch"></i>
                        <span>Reclining Seat</span>
                    </div>


                    <div class="fitur-item">
                        <i class="fa-solid fa-bus"></i>
                        <span>Isuzu NLR Series</span>
                    </div>

                    <div class="fitur-item">
                        <i class="fa-solid fa-tv"></i>
                        <span>Audio-Video Entertainment</span>
                    </div>

                    <div class="fitur-item">
                        <i class="fa-solid fa-fan"></i>
                        <span>Full AC</span>
                    </div>

                    <div class="fitur-item">
                        <i class="fa-solid fa-kit-medical"></i>
                        <span>Medical Kit</span>
                    </div>

                    <div class="fitur-item">
                        <i class="fa-solid fa-location-crosshairs"></i>
                        <span>GPS Tracker</span>
                    </div>

                    <div class="fitur-item">
                        <i class="fa-solid fa-suitcase-rolling"></i>
                        <span>Bagasi Luas</span>
                    </div>

                </div>

            </div>

            <!-- Mobil 2 -->
            <div class="armada-item">

                <img src="{{ asset('images/hiace.png') }}">

                <div class="armada-feature">

                    <div class="fitur-item">
                        <i class="fa-solid fa-chair"></i>
                        <span>14 Seat</span>
                    </div>

                    <div class="fitur-item">
                        <i class="fa-solid fa-couch"></i>
                        <span>Reclining Seat</span>
                    </div>

                    <div class="fitur-item">
                        <i class="fa-solid fa-tv"></i>
                        <span>Audio-Video Entertainment</span>
                    </div>

                    <div class="fitur-item">
                        <i class="fa-solid fa-fan"></i>
                        <span>Full AC</span>
                    </div>

                    <div class="fitur-item">
                        <i class="fa-solid fa-kit-medical"></i>
                        <span>Medical Kit</span>
                    </div>

                    <div class="fitur-item">
                        <i class="fa-solid fa-location-crosshairs"></i>
                        <span>GPS Tracker</span>
                    </div>

                    <div class="fitur-item">
                        <i class="fa-solid fa-suitcase-rolling"></i>
                        <span>Bagasi Luas</span>
                    </div>

                </div>

            </div>

        </div>

    </section>

    <a href="https://wa.me/62882007380782" class="wa-button" target="_blank">
        <i class="fa-brands fa-whatsapp"></i>
        Tanya Admin
    </a>

@endsection