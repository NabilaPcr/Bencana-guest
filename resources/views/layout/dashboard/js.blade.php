    {{-- START JS  --}}
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
        {{-- END JS  --}}

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                let slideIndex = 0;
                const slides = document.querySelectorAll(".mySlides");
                const dots = document.querySelectorAll(".dot");
                let interval;

                function showSlide(index) {
                    slides.forEach((slide, i) => {
                        slide.classList.remove("active");
                        dots[i].classList.remove("active");
                    });

                    slideIndex = index;
                    if (slideIndex >= slides.length) slideIndex = 0;
                    if (slideIndex < 0) slideIndex = slides.length - 1;

                    slides[slideIndex].classList.add("active");
                    dots[slideIndex].classList.add("active");
                }

                function nextSlide() {
                    showSlide(slideIndex + 1);
                }

                function startAutoSlide() {
                    interval = setInterval(nextSlide, 5000);
                }

                function resetAutoSlide() {
                    clearInterval(interval);
                    startAutoSlide();
                }

                // Init
                showSlide(0);
                startAutoSlide();

                // Dot navigation
                window.currentSlide = function(n) {
                    showSlide(n - 1);
                    resetAutoSlide();
                };
            });
        </script>
