document.addEventListener("DOMContentLoaded", function () {
    const odstavce = document.querySelectorAll(".prevod .odstavec");

    function checkVisibility() {
      const triggerBottom = window.innerHeight / 5 * 4;

      odstavce.forEach((odstavec) => {
        const boxTop = odstavec.getBoundingClientRect().top;

        if (boxTop < triggerBottom) {
          odstavec.classList.add("show");
        }
      });
    }

    window.addEventListener("scroll", checkVisibility);
    checkVisibility(); // Spuštění při načtení stránky
  });

  document.addEventListener("DOMContentLoaded", function () {
    const odstavce = document.querySelectorAll(".section-portfolio");

    function checkVisibility() {
      const triggerBottom = window.innerHeight / 5 * 2;

      odstavce.forEach((odstavec) => {
        const boxTop = odstavec.getBoundingClientRect().top;

        if (boxTop < triggerBottom) {
          odstavec.classList.add("show");
        }
      });
    }

    window.addEventListener("scroll", checkVisibility);
    checkVisibility(); // Spuštění při načtení stránky
  });


// Funkce pro inicializaci lazy loading a střídání obrázků pro jednu sekci
function initializeImageSection(sectionId) {
    const section = document.querySelector(`#${sectionId}`);
    const lazyImages = section.querySelectorAll('.lazy');
    const observer = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          const img = entry.target;
          img.src = img.dataset.src;
          img.classList.remove('lazy');
          observer.unobserve(img);
        }
      });
    });

    lazyImages.forEach(img => observer.observe(img));

    // Střídání obrázků
    const images = section.querySelectorAll('.image-container img');
    let currentIndex = 0;

    function changeImage() {
      images[currentIndex].classList.remove('active');
      currentIndex = (currentIndex + 1) % images.length;
      images[currentIndex].classList.add('active');
    }

    // Spuštění střídání
    images[0].classList.add('active');
    setInterval(changeImage, 7000);
  }

  // Inicializace pro obě sekce
  initializeImageSection('section1');
  initializeImageSection('section2');