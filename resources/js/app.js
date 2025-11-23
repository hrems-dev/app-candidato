// El código JavaScript es funcionalmente el mismo:

// ===== Menú móvil =====
const navToggle = document.getElementById("navToggle");
const navMenu = document.getElementById("navMenu");

navToggle?.addEventListener("click", () => {
    // Usa la clase 'is-open' que se definió en el <style> en el <head>
    const open = navMenu.classList.toggle("is-open");
    navToggle.setAttribute("aria-expanded", String(open));
});

// Cierra el menú al navegar
navMenu?.addEventListener("click", (e) => {
    if (e.target.tagName === "A" && navMenu.classList.contains("is-open")) {
        navMenu.classList.remove("is-open");
        navToggle.setAttribute("aria-expanded", "false");
    }
});

// ===== Modo oscuro =====
const themeToggle = document.getElementById("themeToggle");
themeToggle?.addEventListener("click", () => {
    const root = document.documentElement;
    // Tailwind maneja los estilos del modo oscuro con la clase 'dark'
    root.classList.toggle("dark");
    localStorage.setItem(
        "theme",
        root.classList.contains("dark") ? "dark" : "light"
    );
});

// ===== Contadores KPIs =====
function animateCount(el) {
    const target = Number(el.getAttribute("data-count") || 0);
    const duration = 1200;
    const start = performance.now();
    const startVal = 0;

    function tick(t) {
        const p = Math.min((t - start) / duration, 1);
        const val = Math.floor(startVal + (target - startVal) * p);
        el.textContent = val.toString();
        if (p < 1) requestAnimationFrame(tick);
    }
    requestAnimationFrame(tick);
}

// ===== Reveal al hacer scroll (la clase 'is-visible' está definida en el <style>) =====
const observer = new IntersectionObserver(
    (entries) => {
        entries.forEach((entry) => {
            if (entry.isIntersecting) {
                entry.target.classList.add("is-visible");
                // Si es KPI, anímalo una sola vez
                if (
                    entry.target.classList.contains("kpi__num") &&
                    !entry.target.dataset.done
                ) {
                    animateCount(entry.target);
                    entry.target.dataset.done = "1";
                }
                observer.unobserve(entry.target);
            }
        });
    },
    { threshold: 0.15 }
);

document
    .querySelectorAll(".reveal, .kpi__num")
    .forEach((el) => observer.observe(el));

// ===== Validación de formulario =====
const form = document.getElementById("contactForm");
const statusEl = document.getElementById("formStatus");

function setError(id, message) {
    const err = document.querySelector(`.error[data-for="${id}"]`);
    if (err) err.textContent = message || "";
}

form?.addEventListener("submit", (e) => {
    e.preventDefault();
    setError("nombre");
    setError("email");
    setError("mensaje");
    const fd = new FormData(form);
    const nombre = (fd.get("nombre") || "").toString().trim();
    const email = (fd.get("email") || "").toString().trim();
    const mensaje = (fd.get("mensaje") || "").toString().trim();
    let ok = true;

    if (!nombre) {
        setError("nombre", "Escribe tu nombre");
        ok = false;
    }
    if (!email || !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
        setError("email", "Correo inválido");
        ok = false;
    }
    if (!mensaje || mensaje.length < 10) {
        setError("mensaje", "Cuéntanos un poco más (mín. 10 caracteres)");
        ok = false;
    }

    if (!ok) return;

    // Demo: simula envío
    statusEl.textContent = "Enviando…";
    statusEl.style.opacity = "0.8";

    setTimeout(() => {
        statusEl.textContent = "¡Gracias! Te responderemos pronto.";
        statusEl.style.opacity = "1";
        form.reset();
    }, 800);
});
