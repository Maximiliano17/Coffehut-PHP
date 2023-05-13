'use strict';

const check = document.querySelector('.checkbox');
const password = document.querySelector('.show-pass');


check.addEventListener('click', () => {
    let show = document.querySelector('input[type="checkbox"]:checked');
    if(show) {
        password.setAttribute('type', 'text');
    } else {
        password.setAttribute('type', 'password');
    }
})
