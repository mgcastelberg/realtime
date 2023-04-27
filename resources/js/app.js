import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

// privado
Echo.private('notifications')
    .listen('UserSessionChanged', (e) => {
        const notificationElement = document.getElementById('notification');
        notificationElement.innerText = e.message;
        notificationElement.classList.remove('invisible');
        notificationElement.classList.remove('alert-success');
        notificationElement.classList.remove('alert-danger');
        notificationElement.classList.add('alert-' + e.type);
    });

// publico
// Echo.channel('notifications')
//     .listen('UserSessionChanged', (e) => {
//         const notificationElement = document.getElementById('notification');
//         notificationElement.innerText = e.message;
//         notificationElement.classList.remove('invisible');
//         notificationElement.classList.remove('alert-success');
//         notificationElement.classList.remove('alert-danger');
//         notificationElement.classList.add('alert-' + e.type);
//     });
