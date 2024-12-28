
window.onload = function(){
 const images = [
    "img/lucie_himlarova_uvod_prvni.webp",
    "img/uvod_druha.webp",
  ];

  let currentIndex = 0;
  const slider = document.getElementById('slider');

  function changeBackground() {
    currentIndex = (currentIndex + 1) % images.length; // Cyklické procházení obrázků
    slider.style.backgroundImage = `url(${images[currentIndex]})`;
  }

  if (window.innerWidth > 620) {
    // První nastavení pozadí
    slider.style.backgroundImage = `url(${images[currentIndex]})`;

    // Nastavení intervalu pro změnu každých 7 sekund
    setInterval(changeBackground, 7000);
  } else {
    // Nastavení jiného obrázku pro malé obrazovky
    slider.style.backgroundImage = `url('img/lucie_himlarova_uvod_m.webp')`;
  }
}
