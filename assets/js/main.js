$(document).ready(function () {

  // Navbar scroll shadow
  $(window).on('scroll', function () {
    if ($(this).scrollTop() > 50) {
      $('#mainNav').css('box-shadow', '0 2px 20px rgba(224,0,0,0.2)');
    } else {
      $('#mainNav').css('box-shadow', 'none');
    }
  });

  // Auto hide alert
  setTimeout(() => { $('.alert').fadeOut(600); }, 3000);

  // Fade in on scroll
  const observer = new IntersectionObserver((entries) => {
    entries.forEach(e => {
      if (e.isIntersecting) {
        e.target.style.opacity = '1';
        e.target.style.transform = 'translateY(0)';
      }
    });
  }, { threshold: 0.1 });

  document.querySelectorAll('.card-dark, .tech-card, .timeline-item').forEach(el => {
    el.style.opacity = '0';
    el.style.transform = 'translateY(20px)';
    el.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
    observer.observe(el);
  });

});