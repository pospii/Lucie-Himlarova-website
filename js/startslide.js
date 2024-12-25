
window.onload = function(){
 const images = [
    "img/uvod_kopie_upravena.jpeg",
    "img/uvod_druha.jpeg",
  ];

  let currentIndex = 0;
  const slider = document.getElementById('slider');

  function changeBackground() {
    currentIndex = (currentIndex + 1) % images.length; // Cyklické procházení obrázků
    slider.style.backgroundImage = `url(${images[currentIndex]})`;
  }

  // První nastavení pozadí
  slider.style.backgroundImage = `url(${images[currentIndex]})`;

  // Nastavení intervalu pro změnu každých 7 sekund
  setInterval(changeBackground, 7000);
}
