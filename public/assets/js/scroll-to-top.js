/**
 * Scroll to Top Button Functionality
 * Shows a button when user scrolls down and scrolls to top when clicked
 */

// Get the button element
const scrollToTopBtn = document.getElementById('scrollToTop');

// Show button when user scrolls down
window.addEventListener('scroll', () => {
  const scrollPosition = window.pageYOffset || document.documentElement.scrollTop;

  // Show button after scrolling 300px down
  if (scrollPosition > 300) {
    scrollToTopBtn.classList.add('show');
  } else {
    scrollToTopBtn.classList.remove('show');
  }
});

// Scroll to top when button is clicked
scrollToTopBtn.addEventListener('click', () => {
  window.scrollTo({
    top: 0,
    behavior: 'smooth'
  });
});
