const buttonContainer = document.querySelector('#button_container');
const errorContainer = document.querySelector('#error_container');

window.addEventListener('load', () => {
    if (location.search) {
        buttonContainer.style = 'margin-bottom: 30px';
        errorContainer.style.display = 'flex';
    } else{
        buttonContainer.style = 'margin-bottom: 0px';
        errorContainer.style.display = 'none';
    }
});