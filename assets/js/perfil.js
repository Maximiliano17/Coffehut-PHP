'use strict';

const perfil = document.querySelector('.perfil');
const name = document.querySelector('.name');
const image = document.querySelector('.profile_picture');
const submenu = document.querySelector('.submenu');
const arrow = document.querySelector('.arrow');
const cont = document.querySelector('#container');

perfil.addEventListener('click', () => {
    
    submenu.classList.toggle('active');
    arrow.classList.toggle('active');
    
        cont.addEventListener('click', (e) => {
            let pos = e.target;
                if(pos != perfil && pos != name && pos != image && pos != arrow) {
                    submenu.classList.remove('active');
                    arrow.classList.remove('active');
                    
                }
        });
});