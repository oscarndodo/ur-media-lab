document.querySelectorAll("form").forEach(el => {
    el.addEventListener("submit", () => {
        const button = el.querySelector("button[type=submit]")
        button.disabled = true;
        button.textContent = 'Processando...';
        button.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';
    })
})