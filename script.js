let currentSlide = 0;

function showSlide(index) {
    const slides = document.querySelectorAll('.testimonial-slide');
    const dots = document.querySelectorAll('.dot');
    
    slides.forEach((slide, i) => {
        slide.style.transform = `translateX(-${index * 100}%)`;
        dots[i].classList.remove('active');
    });
    
    dots[index].classList.add('active');
    currentSlide = index;
}

setInterval(() => {
    currentSlide = (currentSlide + 1) % 3;
    showSlide(currentSlide);
}, 5000);

document.addEventListener('DOMContentLoaded', () => {
    showSlide(currentSlide);

    const features = document.querySelectorAll('.feature');

    function checkVisibility() {
        features.forEach(feature => {
            const rect = feature.getBoundingClientRect();
            if (rect.top < window.innerHeight && rect.bottom >= 0) {
                feature.classList.add('visible');
                feature.classList.remove('hidden');
            }
        });
    }

    window.addEventListener('scroll', checkVisibility);
    checkVisibility(); 
});

