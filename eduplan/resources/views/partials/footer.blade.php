<footer class="footer bg-light text-center py-3 mt-auto">
    <p class="mb-0">&copy; {{ date('Y') }} Eduplan. All rights reserved.</p>
</footer>

<style>
/* Make sure footer stays at bottom */
html, body {
    height: 100%;
    margin: 0;
    display: flex;
    flex-direction: column;
}

body > .container,
body > .container-fluid {
    flex: 1 0 auto; /* push footer to bottom when content is short */
}

.footer {
    flex-shrink: 0; /* prevent footer from shrinking */
    font-size: 0.95rem;
    border-top: 1px solid #ddd;
}

/* On small devices, reduce padding slightly */
@media (max-width: 576px) {
    .footer {
        padding: 0.75rem;
        font-size: 0.85rem;
    }
}
</style>
