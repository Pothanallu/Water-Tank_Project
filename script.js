// Slideshow functionality
let slideIndex = 0;

function showSlides() {
    let i;
    let slides = document.getElementsByClassName("mySlides");
    let dots = document.getElementsByClassName("dot");
    for (i = 0; i < slides.length; i++) {
        slides[i].style.display = "none";  
    }
    slideIndex++;
    if (slideIndex > slides.length) {slideIndex = 1}    
    for (i = 0; i < dots.length; i++) {
        dots[i].className = dots[i].className.replace(" active", "");
    }
    slides[slideIndex-1].style.display = "block";  
    dots[slideIndex-1].className += " active";
    setTimeout(showSlides, 3000); // Change image every 3 seconds
}

// Call the showSlides function when the page loads
window.onload = showSlides; 

// Check if the user has already been redirected in this session
if (!sessionStorage.getItem('hasRedirected')) {
    setTimeout(() => {
        sessionStorage.setItem('hasRedirected', 'true'); // Set the flag for this session
        window.location.href = 'signup.html'; // Change to your desired URL
    }, 5000); // Redirects after 5 seconds
}

// Card Slider Functionality
const cardWrapper = document.getElementById('cardWrapper');
const leftArrow = document.getElementById('leftArrow');
const rightArrow = document.getElementById('rightArrow');

let isDragging = false;
let startPos = 0;
let currentTranslate = 0;
let prevTranslate = 0;
let animationID;
let currentIndex = 0;

const cards = Array.from(document.querySelectorAll('.card'));
const cardWidth = cards[0].clientWidth + 20; // Adjust for margin

// Handle mouse dragging
cardWrapper.addEventListener('mousedown', startDrag);
cardWrapper.addEventListener('mousemove', moveDrag);
cardWrapper.addEventListener('mouseup', endDrag);
cardWrapper.addEventListener('mouseleave', endDrag);

function startDrag(e) {
    isDragging = true;
    startPos = e.clientX;
    animationID = requestAnimationFrame(animation);
    cardWrapper.style.transition = 'none';
}

function moveDrag(e) {
    if (!isDragging) return;
    const currentPosition = e.clientX;
    currentTranslate = prevTranslate + currentPosition - startPos;
}

function endDrag() {
    isDragging = false;
    cancelAnimationFrame(animationID);

    const movedBy = currentTranslate - prevTranslate;
    if (movedBy < -100 && currentIndex < cards.length - 1) currentIndex += 1;
    if (movedBy > 100 && currentIndex > 0) currentIndex -= 1;

    setPositionByIndex();
}

function animation() {
    setSliderPosition();
    if (isDragging) requestAnimationFrame(animation);
}

function setSliderPosition() {
    cardWrapper.style.transform = `translateX(${currentTranslate}px)`;
}

function setPositionByIndex() {
    currentTranslate = currentIndex * -cardWidth;
    prevTranslate = currentTranslate;
    setSliderPosition();
    cardWrapper.style.transition = 'transform 0.3s ease-out';
}


// Button functionality
rightArrow.addEventListener('click', () => {
    if (currentIndex < cards.length - 1) {
        currentIndex += 1;
        setPositionByIndex();
    }
});

leftArrow.addEventListener('click', () => {
    if (currentIndex > 0) {
        currentIndex -= 1;
        setPositionByIndex();
    }
});

// Toggle FAQ answers
document.querySelectorAll('.faq').forEach(faq => {
    faq.addEventListener('click', () => {
        faq.classList.toggle('active');
    });
});

// Get the button
const scrollToTopBtn = document.getElementById("scrollToTopBtn");

// Show the button when the user scrolls down 100px from the top
window.onscroll = function() {
    if (document.body.scrollTop > 100 || document.documentElement.scrollTop > 100) {
        scrollToTopBtn.style.display = "block";
    } else {
        scrollToTopBtn.style.display = "none";
    }
};

// Scroll to the top when the button is clicked
scrollToTopBtn.addEventListener("click", function(event) {
    event.preventDefault(); // Prevent default action of anchor tag
    window.scrollTo({ top: 0, behavior: "smooth" }); // Smooth scrolling to the top
});
