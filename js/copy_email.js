const copyEmailButton = document.querySelector('#copy_email_button');


copyEmailButton.addEventListener('click', () => {
   navigator.clipboard.writeText("sergeyvishtak127@gmail.com"); 
   const succesMessageContainer = document.querySelector('#alert_success');
   succesMessageContainer.innerHTML = 'Email copied';
   succesMessageContainer.style = 'top: 20px';
   setTimeout(() => {
       succesMessageContainer.style = 'top: -100px';
   }, 3000)
});
