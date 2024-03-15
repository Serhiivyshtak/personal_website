const menuBtn = document.querySelector('#menu_button');
const menu = document.querySelector('#menu');
const headerLogo = document.querySelector('#header_logo');

const elemsToAnimateOnLoad = document.querySelectorAll('.animate_on_load');


const breakPoints = [
    document.querySelector('.home').offsetHeight - window.innerHeight / 4,
    document.querySelector('.home').offsetHeight + document.querySelector('.about_section').offsetHeight - window.innerHeight / 4,
    document.querySelector('.home').offsetHeight + document.querySelector('.about_section').offsetHeight + document.querySelector('.skills_section').offsetHeight - window.innerHeight / 4,
    document.querySelector('.home').offsetHeight + document.querySelector('.about_section').offsetHeight + document.querySelector('.skills_section').offsetHeight + document.querySelector('.social_media_section').offsetHeight - window.innerHeight / 2,
];

const elemsToAnimateOnScrolling = [
    document.querySelectorAll('.first_breakpoint_animation'),
    document.querySelectorAll('.second_breakpoint_animation'),
    document.querySelectorAll('.third_breakpoint_animation'),
    document.querySelectorAll('.fourth_breakpoint_animation'),
];

const menuNavigationLinks = document.querySelectorAll('.nav_link');
const menuNavigationLinksDestinations = [
    document.querySelector('.home').offsetHeight,
    document.querySelector('.home').offsetHeight + document.querySelector('.about_section').offsetHeight,
    document.querySelector('.home').offsetHeight + document.querySelector('.about_section').offsetHeight + document.querySelector('.skills_section').offsetHeight,
    document.querySelector('.home').offsetHeight + document.querySelector('.about_section').offsetHeight + document.querySelector('.skills_section').offsetHeight + document.querySelector('.social_media_section').offsetHeight,
    document.querySelector('.home').offsetHeight,
];


menuBtn.addEventListener('click', () => {

    // showing menu on clicking at the menu button
    menuBtn.firstElementChild.classList.toggle('menu_button_active');
    menu.classList.toggle('menu_active');
});

window.addEventListener('load', () => {

    // animating elemsnts on reload
    for (everyElem of elemsToAnimateOnLoad) {
        everyElem.classList.add('animation');
    }

    // setting default styles for all elements, which gonna be animated
    for (let i = 0; i < elemsToAnimateOnScrolling.length; i++) {
        for (let f = 0; f < elemsToAnimateOnScrolling[i].length; f++) {
            elemsToAnimateOnScrolling[i][f].style = `
                opacity: 0;
                transform: translateY(150px);
                transition: 1s;
                `;
        }
    }

    // outputing responses from backend after sending the form
    if (location.search) {
        let message = location.search.split('=')[1].replaceAll('%20', ' ');

        if (message !== 'Nachricht erfolgreich gesendet') {
            const ContactFormErrorContainer = document.querySelector('#contact_form_error');
            ContactFormErrorContainer.innerHTML = message;
    
            window.scrollTo({
                top: document.querySelector('.home').offsetHeight + document.querySelector('.about_section').offsetHeight + document.querySelector('.skills_section').offsetHeight + document.querySelector('.social_media_section').offsetHeight,
                left: 0,
                behavior: 'smooth',
            });
        } else {
            const succesMessageContainer = document.querySelector('#alert_success');
            succesMessageContainer.innerHTML = message;
            succesMessageContainer.style = 'top: 20px';
            setTimeout(() => {
                succesMessageContainer.style = 'top: -100px';
            }, 3000)
        }
        
    }
});


window.addEventListener('scroll', (e) => {
    let scrollTop = window.scrollY;

    // animating elements on scrolling
    for (let i = 0; i < breakPoints.length; i++) {
        if (scrollTop >= breakPoints[i]) {
            for (let f = 0; f < elemsToAnimateOnScrolling[i].length; f++) {
                elemsToAnimateOnScrolling[i][f].classList.add('animation');
            }
        } else {
            for (let f = 0; f < elemsToAnimateOnScrolling[i].length; f++) {
                elemsToAnimateOnScrolling[i][f].classList.remove('animation');
            }
        }
    }

    //changing color of header on scrolling
    if (scrollTop >= menuNavigationLinksDestinations[0] && scrollTop < menuNavigationLinksDestinations[2]) {
        headerLogo.style.color = 'white';
        menuBtn.firstElementChild.style.fill = 'white';
    } else {
        headerLogo.style.color = 'black';
        menuBtn.firstElementChild.style = 'fill: black';
    }
});

document.addEventListener('click', (e) => {

    // scroll to a certain block of a website by clicking at the navigation links
    for (let i = 0; i < menuNavigationLinks.length; i++) {
        if (e.target === menuNavigationLinks[i]) {
            window.scrollTo({
                top: menuNavigationLinksDestinations[i],
                left: 0,
                behavior: 'smooth',
            });
        }
    }
});
