
const slides = document.querySelectorAll('.slide');
const thumbs = document.querySelectorAll('.thumbnails img');
let currentIndex = 0;
let interval;

function showSlide(index) {
    slides.forEach((slide, i) => {
        slide.classList.toggle('active', i === index);
    });
    thumbs.forEach((thumb, i) => {
        thumb.classList.toggle('selected', i === index);
    });
    currentIndex = index;
}

function startAutoSlide() {
    interval = setInterval(() => {
        const next = (currentIndex + 1) % slides.length;
        showSlide(next);
    }, 4000);
}

function resetAutoSlide() {
    clearInterval(interval);
    startAutoSlide();
}

startAutoSlide();

thumbs.forEach(thumb => {
    thumb.addEventListener('click', () => {
        const index = parseInt(thumb.getAttribute('data-index'));
        showSlide(index);
        resetAutoSlide();
    });
});
