'use strict';

const container = document.querySelector('#container');
const container_perfil = document.querySelector('#container-edit-perfil');
const btn = document.querySelector('#edit-perfil');
const btn_q = document.querySelector('.btn-form');


btn.addEventListener('click', () => {
    container.classList.add('actived');
    container_perfil.classList.add('actived');
        
})

btn_q.addEventListener('click', () => {
    container.classList.remove('actived');
    container_perfil.classList.remove('actived');
})