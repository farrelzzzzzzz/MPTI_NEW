<div id="ry-chat">

    <!-- Chat Window -->
    <div id="ry-chat-window">

        <!-- HEADER -->
        <div class="ry-chat-header">

            <div class="ry-chat-brand">

                <img src="{{ asset('images/logo.png') }}" alt="Logo">

                <div>

                    <h4>RY Travel Assistant</h4>

                    <span>Online</span>

                </div>

            </div>

            <div class="ry-chat-action">

                <button id="chat-minimize">

                    ─

                </button>

                <button id="chat-close">

                    ✕

                </button>

            </div>

        </div>

        <!-- BODY -->
        <div id="ry-chat-body">

            <div class="ai-message">

                <div class="bubble">

                    👋 Halo!

                    <br><br>

                    Selamat datang di <b>RY Travel</b>.

                    <br><br>

                    Saya siap membantu Anda mengenai:

                    <br><br>

                    🚐 Antar Jemput Bandara

                    <br>

                    🏝 Paket Wisata

                    <br>

                    📅 Jadwal

                    <br>

                    💳 Booking

                </div>

            </div>

            <div class="quick-question">

                <button class="quick-btn">

                    Paket Wisata

                </button>

                <button class="quick-btn">

                    Harga

                </button>

                <button class="quick-btn">

                    Booking

                </button>

                <button class="quick-btn">

                    Jadwal

                </button>

            </div>

        </div>

        <!-- FOOTER -->

        <div class="ry-chat-footer">

            <input

                type="text"

                id="chat-input"

                placeholder="Tulis pertanyaan..."

                autocomplete="off"

            >

            <button id="send-message">

                <svg xmlns="http://www.w3.org/2000/svg"
                     width="22"
                     height="22"
                     fill="currentColor"
                     viewBox="0 0 16 16">

                    <path d="M15.854.146a.5.5 0 0 0-.53-.11L.64 5.856a.5.5 0 0 0 .034.94l5.09 1.697 1.697 5.09a.5.5 0 0 0 .94.034L15.964.676a.5.5 0 0 0-.11-.53z"/>

                </svg>

            </button>

        </div>

    </div>

</div>