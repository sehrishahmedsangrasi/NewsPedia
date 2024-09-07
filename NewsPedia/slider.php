<script>
let slideIndex = 0;
const slideInterval = 50; // Lower value for faster scrolling

function showSlides() {
    const slides = document.querySelector(".slider-container .slide-group");
    const totalSlides = document.querySelectorAll(".slide-item").length;

    // Calculate the width of a single slide item
    const slideWidth = document.querySelector(".slide-item").offsetWidth;
    
    // Increment the slide index to create the sliding effect
    slideIndex++;

    // Reset slideIndex to zero when it exceeds the total scrollable width
    if (slideIndex >= totalSlides * slideWidth) {
        slideIndex = 0;
    }

    // Apply the transform to create the sliding effect
    slides.style.transform = `translateX(-${slideIndex}px)`;
}

function startAutoSlide() {
    setInterval(showSlides, slideInterval);
}

// Start automatic sliding
startAutoSlide();
</script>