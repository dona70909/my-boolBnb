console.log('ci sono');

const deleteForms = document.querySelectorAll('.delete-form');


deleteForms.forEach(singleForm => {
    singleForm.addEventListener('submit', function (event) {
        event.preventDefault(); // § blocchiamo l'invio del form
        userConfirmation = window.confirm(`Sei sicuro di voler eliminare ${this.getAttribute('apartment-title')}?`);
        if (userConfirmation) {
            this.submit();
        }
    })
});

let messagesList = document.querySelectorAll('.message-item');
let boxMessages = document.querySelectorAll('.box-message');
console.log(boxMessages);

let activeClick = null;





messagesList.forEach( (message, index) => {
    
    message.addEventListener('click', function() {

    
        this.activeClick = index
        boxMessages[this.activeClick].classList.toggle("d-none");
    

    })
});


