let slideIndex = 0;

  function showSlides() {
    let slides = document.getElementsByClassName("mySlides");
    // Skryje všechny slidy
    for (let i = 0; i < slides.length; i++) {
      slides[i].style.display = "none";
    }
    // Zvýší index o 1 (cykluje přes slidy)
    slideIndex++;
    if (slideIndex > slides.length) {
      slideIndex = 1; // Zpět na první slide
    }
    // Zobrazí aktuální slide
    slides[slideIndex - 1].style.display = "block";
    // Další slide po 15 sekundách
    setTimeout(showSlides, 7000);
  }

  // Spustí slideshow
  showSlides();
