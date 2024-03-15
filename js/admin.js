
const emailBox = document.querySelector('#email_box_container');
const emailBoxHeading = document.querySelector('#email_box_heading');
const emailBoxEmailContainer = document.querySelector('#email_input');
const emailForm = document.querySelector('#email_send_form');

const openBtns = document.querySelectorAll('.reply_button');

const closeBtns = document.querySelectorAll('.box_close_button');
const boxes = document.querySelectorAll('.modal_window');

const createPostButton = document.querySelector('#create_bi_button');

const deleteBtns = document.querySelectorAll('.delete_btn');
const deleteBox = document.querySelector('#delete_box_container');
const deleteMessageContainer = document.querySelector('#delete_box_message');
const deleteBoxButton = document.querySelector('#completely_delete_btn');
const cancelDeleteBtn = document.querySelector('#cancel_delete_button');


const rewriteBtns = document.querySelectorAll('.rewrite_btn');
const rewriteWindowHeading = document.querySelector('#nci_box_heading');
const rewriteWindowSubmitButton = document.querySelector('#nci_box_submit_button');
const rewriteWindowPickImageButton = document.querySelector('#nci_box_image_picker_label');
const rewriteWindowInputs = document.querySelectorAll('.nci_box_text_area');
const rewriteWindowForm = document.querySelector('#nci_box_form');

const blogItems = [
    document.querySelectorAll('.bi_admin_heading'), //headings
    document.querySelectorAll('.bi_description_text'), // descriptions
    document.querySelectorAll('.bi_main_text_text'), // main texts
]


const copyBtns = document.querySelectorAll('.copy_btn');
const adminPasswords = document.querySelectorAll('.passwords2copy')



document.addEventListener('click', (e) => {

    if (e.target === cancelDeleteBtn) {
        deleteBox.style = 'display: none';
    }

    for (let i = 0; i < deleteBtns.length; i++) {
        if (e.target === deleteBtns[i] || e.target === deleteBtns[i].children[0] || e.target === deleteBtns[i].children[0].children[0]) {
            let object = deleteBtns[i].getAttribute('data-object');
            deleteMessageContainer.innerHTML = `Möchten Sie ${object} löschen?`;
            let goToLink = deleteBtns[i].getAttribute('data-href');
            deleteBoxButton.setAttribute('href', goToLink);
            deleteBox.style = 'display: flex';
        }
    }

    for (let i = 0; i < closeBtns.length; i++) {
        if (e.target === closeBtns[i] || e.target === closeBtns[i].children[0] || e.target === closeBtns[i].children[0].children[0]) {
            for (let f = 0; f < rewriteWindowInputs.length; f++) {
                rewriteWindowInputs[f].value = "";
            }
            boxes[i].style = 'display: none';
        }
    }

    if (e.target === createPostButton) {
        boxes[0].style = 'display: flex';
    }

    for (let i = 0; i < openBtns.length; i++) {
        if (e.target === openBtns[i] || e.target === openBtns[i].children[0] || e.target === openBtns[i].children[0].children[0]) {
            emailBoxHeading.innerHTML = 'Antwort an ' + openBtns[i].getAttribute('data-id-name') + ' senden';
            emailBoxEmailContainer.value = openBtns[i].getAttribute('data-email');
            emailForm.setAttribute('action', 'app/send_mail.php?msg=' + openBtns[i].getAttribute('data-message-id'));
            emailBox.style = 'display: flex';
        }
    }

    for (let i = 0; i < rewriteBtns.length; i++) {
        if (e.target === rewriteBtns[i] || e.target === rewriteBtns[i].children[0] || e.target === rewriteBtns[i].children[0].children[0]) {

            let post_id = rewriteBtns[i].getAttribute('data-id')

            rewriteWindowHeading.innerHTML = "Die Veröffentlichung korrigieren";
            rewriteWindowSubmitButton.innerHTML = "Korrigieren";
            rewriteWindowPickImageButton.innerHTML = "Ein neues Bild hochladen";
            rewriteWindowForm.setAttribute('action', `app/rewrite_post.php?post=${post_id}`);

            for (let f = 0; f < rewriteWindowInputs.length; f++) {
                rewriteWindowInputs[f].value = blogItems[f][i].innerText;
            }

            console.log("heey");
            boxes[0].style = 'display: flex';
        }
    }

    for (let i = 0; i < copyBtns.length; i++) {
        if (e.target === copyBtns[i] || e.target === copyBtns[i].children[0] || e.target === copyBtns[i].children[0].children[0]) {
            navigator.clipboard.writeText(adminPasswords[i].innerText);
            copyBtns[i].innerHTML = "Copied";
            setTimeout(() => {
                copyBtns[i].innerHTML = 
                    `
                    <svg class="control_button_image" xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960">
                        <path d="M360-240q-33 0-56.5-23.5T280-320v-480q0-33 23.5-56.5T360-880h360q33 0 56.5 23.5T800-800v480q0 33-23.5 56.5T720-240H360Zm0-80h360v-480H360v480ZM200-80q-33 0-56.5-23.5T120-160v-560h80v560h440v80H200Zm160-240v-480 480Z"/>
                    </svg>
                    `;
            }, 3000)
        }
    }
});