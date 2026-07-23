document.addEventListener("DOMContentLoaded", function () {

    const body = document.getElementById("ry-chat-body");
    const input = document.getElementById("chat-input");
    const sendBtn = document.getElementById("send-message");
    const minimizeBtn = document.getElementById("chat-minimize");
    const closeBtn = document.getElementById("chat-close");
    const windowChat = document.getElementById("ry-chat-window");

    if (!body || !input || !sendBtn) {
        console.error("Chatbot element tidak ditemukan.");
        return;
    }

    function scrollBottom() {
        body.scrollTop = body.scrollHeight;
    }

    function addUserMessage(message) {
        const div = document.createElement("div");
        div.className = "user-message";
        div.innerHTML = `<div class="bubble">${message}</div>`;
        body.appendChild(div);
        scrollBottom();
    }

    function addAIMessage(message) {
        const div = document.createElement("div");
        div.className = "ai-message";
        div.innerHTML = `<div class="bubble">${message.replace(/\n/g, "<br>")}</div>`;
        body.appendChild(div);
        scrollBottom();
    }

    function showTyping() {
        const div = document.createElement("div");
        div.className = "ai-message";
        div.id = "typing-box";
        div.innerHTML = `
            <div class="typing">
                <span></span>
                <span></span>
                <span></span>
            </div>`;
        body.appendChild(div);
        scrollBottom();
    }

    function removeTyping() {
        const typing = document.getElementById("typing-box");
        if (typing) typing.remove();
    }

    async function sendMessage(text) {

        if (!text.trim()) return;

        addUserMessage(text);
        input.value = "";
        showTyping();

        try {

            const response = await fetch("/chatbot", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "Accept": "application/json",
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({
                    message: text
                })
            });

            // Ambil response sebagai text terlebih dahulu
            const raw = await response.text();

            console.log("STATUS :", response.status);
            console.log("RESPONSE :", raw);

            removeTyping();

            let data;

            try {
                data = JSON.parse(raw);
            } catch (err) {
                addAIMessage("Server tidak mengembalikan JSON.<br><br>Lihat Console (F12).");
                return;
            }

            if (data.success) {
                addAIMessage(data.answer);
            } else {
                addAIMessage(data.answer ?? "AI tidak tersedia.");
            }

        } catch (e) {

            console.error(e);

            removeTyping();

            addAIMessage("ERROR : " + e.message);

        }

    }

    sendBtn.addEventListener("click", () => {
        sendMessage(input.value);
    });

    input.addEventListener("keypress", function (e) {
        if (e.key === "Enter") {
            e.preventDefault();
            sendMessage(input.value);
        }
    });

    document.querySelectorAll(".quick-btn").forEach(btn => {
        btn.addEventListener("click", function () {
            sendMessage(this.innerText);
        });
    });

    if (minimizeBtn) {
        minimizeBtn.addEventListener("click", () => {
            windowChat.classList.toggle("chat-minimized");
        });
    }

    if (closeBtn) {
        closeBtn.addEventListener("click", () => {
            document.getElementById("ry-chat").style.display = "none";
        });
    }

});