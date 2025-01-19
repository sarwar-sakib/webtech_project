const track = document.querySelector('.slider-track');
const nextButton = document.querySelector('.next-btn');
const prevButton = document.querySelector('.prev-btn');

let position = 0;
const slideWidth = 220; // Image width + gap

nextButton.addEventListener('click', () => {
    const maxTranslate = -(track.scrollWidth - track.parentElement.clientWidth);
    position = Math.max(position - slideWidth, maxTranslate);
    track.style.transform = `translateX(${position}px)`;
});

prevButton.addEventListener('click', () => {
    position = Math.min(position + slideWidth, 0);
    track.style.transform = `translateX(${position}px)`;
});
