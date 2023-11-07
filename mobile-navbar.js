const btnMobile = document.getElementById('btn-mobile');

function toggleMenu(event) {
  if (event.type === 'touchstart') event.preventDefault();
  const nav = document.getElementById('nav');
  nav.classList.toggle('active');
  const active = nav.classList.contains('active');
  event.currentTarget.setAttribute('aria-expanded', active);
  if (active) {
    event.currentTarget.setAttribute('aria-label', 'Fechar Menu');
  } else {
    event.currentTarget.setAttribute('aria-label', 'Abrir Menu');
  }
}

btnMobile.addEventListener('click', toggleMenu);
btnMobile.addEventListener('touchstart', toggleMenu);

var radio = document.querySelector('.manual-btn')
var cont = 1

document.getElementById('radio1').checked = true

setInterval(() => {
    proximaImg()
}, 7000)

function proximaImg(){
    cont++

    if(cont > 5){
        cont = 1 
    }

    document.getElementById('radio'+cont).checked = true
}

window.sr = ScrollReveal({ reset: true});

sr.reveal('.topico-01', {duration: 2000});

sr.reveal('.topico-02', {duration: 2000});

sr.reveal('.topico-03', {duration: 2000});

sr.reveal('.topico-04', {duration: 2000});

sr.reveal('.topico-05', {duration: 2000});

sr.reveal('.line-p', {duration: 3000});

sr.reveal('.prod-01', {duration: 1000});

sr.reveal('.prod-02', {duration: 1000});

sr.reveal('.prod-03', {duration: 1000});