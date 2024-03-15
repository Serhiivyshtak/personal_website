const elemsToAnimateOnLoad = [
    document.querySelector('#header_logo'),
    document.querySelector('#back_button'),
];

let allContentItems = [];
let breakpoints = [];

function setBreakpoints () {
    let breakpointTotal = -(window.innerHeight - window.innerHeight / 4);
    let breakpoints = [];
    breakpoints[0] = breakpointTotal;
    for (let i = 0; i < allContentItems.length; i++) {
        breakpointTotal += allContentItems[i].offsetHeight
        breakpoints.push(breakpointTotal);
    }
    return breakpoints
}

window.addEventListener('load', () => {

    // animate elements on load
    for (everyElem of elemsToAnimateOnLoad) {
        everyElem.classList.add('animation');
    }

    allContentItems = document.querySelectorAll('.content_item');
    allContentItems[0].classList.add('animation');

    breakpoints = setBreakpoints();
});

window.addEventListener('resize', () => {
    breakpoints = setBreakpoints();
});


const header = document.querySelector('#header');
const headerLogo = elemsToAnimateOnLoad[0];
const backButton = elemsToAnimateOnLoad[1];

window.addEventListener('scroll', () => {
    let scrollTop = window.scrollY;
    if (scrollTop > 0) {
        header.classList.add('header_changed');
        headerLogo.style.color = 'white';
        backButton.style.fill = 'white';
    } else {
        header.classList.remove('header_changed');
        backButton.style.fill = 'black';
        headerLogo.style.color = 'black';
    }

    for (let i = 0; i < allContentItems.length; i++) {
        if (scrollTop >= breakpoints[i]) {
            allContentItems[i].classList.add('animation');
        } else {
            allContentItems[i].classList.remove('animation');
        }
    }
});

