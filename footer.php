</div> <!-- Penutup container content-wrapper -->

<!-- FOOTER -->
<footer class="bg-dark text-white text-center py-5 mt-auto shadow">
    <div class="container">
        <!-- LOGO FOOTER -->
        <div class="mb-3">
            <h4 class="fw-bold d-flex align-items-center justify-content-center gap-2">
                <img src="uploads/kucing.png" alt="Logo" style="height: 50px; width: auto;" class="rounded"> Meow PetShop
            </h4>
        <p class="mb-2 text-secondary small">Penuhi Kebutuhan Anabul Anda Bersama Kami</p>
        </div>

        <!-- TEKS TENTANG KAMI PINDAH KE FOOTER -->
        <div class="mb-4 mx-auto" style="max-width: 650px;">
            <p class="text-light small px-3" style="line-height: 1.6; opacity: 0.85;">
                Meow PetShop adalah surga bagi para pecinta kucing. Kami menyediakan berbagai macam kebutuhan kucing berkualitas tinggi, mulai dari makanan bergizi, pasir penyerap bau terbaik, hingga mainan interaktif yang membuat anabul selalu bahagia.
            </p>
        </div>

        <!-- SOSIAL MEDIA -->
        <div class="mb-3">
            <a href="https://www.instagram.com/rvaldooow?vrfl=eXBrY2s3czg1eThz" target="_blank" class="text-white text-decoration-none mx-2 fs-5"><i class="bi bi-instagram"></i></a>
            <a href="https://www.facebook.com/share/18j7KZPzEd/" target="_blank" class="text-white text-decoration-none mx-2 fs-5"><i class="bi bi-facebook"></i></a>
            <a href="https://wa.me/<?= $nomor_whatsapp ?>" target="_blank" class="text-white text-decoration-none mx-2 fs-5"><i class="bi bi-whatsapp"></i></a>
        </div>
    </div>
</footer>

<!-- Bootstrap JS Bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<!-- AOS Animation JS -->
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init({ duration: 800, once: true, offset: 50 });
</script>
<!-- Bootstrap JS Bundle -->
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const btnSwitch = document.getElementById('btn-switch-theme');
        const themeIcon = document.getElementById('theme-icon');
        const htmlElement = document.documentElement;

        // Cek apakah pengguna sebelumnya sudah menyimpan preferensi tema
        const savedTheme = localStorage.getItem('theme') || 'light';
        htmlElement.setAttribute('data-bs-theme', savedTheme);
        updateIcon(savedTheme);

        btnSwitch.addEventListener('click', () => {
            let currentTheme = htmlElement.getAttribute('data-bs-theme');
            let newTheme = currentTheme === 'dark' ? 'light' : 'dark';

            htmlElement.setAttribute('data-bs-theme', newTheme);
            localStorage.setItem('theme', newTheme);
            updateIcon(newTheme);
        });

        function updateIcon(theme) {
            if (theme === 'dark') {
                themeIcon.classList.replace('bi-sun-fill', 'bi-moon-fill');
                btnSwitch.classList.replace('btn-outline-dark', 'btn-outline-light');
            } else {
                themeIcon.classList.replace('bi-moon-fill', 'bi-sun-fill');
                btnSwitch.classList.replace('btn-outline-light', 'btn-outline-dark');
            }
        }
    });
</script>
</body>
</html>