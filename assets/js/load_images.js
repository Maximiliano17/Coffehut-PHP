'use strict';

const imgs=Array.from(document.querySelectorAll('#image_perfil_load'));

imgs.forEach(i => i.addEventListener('error',event => {
  alert("no");
  })
);
