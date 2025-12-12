document.querySelectorAll("form").forEach(el => {
    el.addEventListener("submit", () => {
        const button = el.querySelector("button[type=submit]")
        button.disabled = true;
        button.innerHTML = 'Processando...';
        button.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';
    })
})

document.querySelectorAll(".menu-item").forEach(el => {
    const currentURL = window.location.href.replace(/\/$/, "");
    const itemURL = el.href.replace(/\/$/, "");

    if (currentURL === itemURL) {
        el.classList.add("bg-blue-600", "text-white");
    }
});

