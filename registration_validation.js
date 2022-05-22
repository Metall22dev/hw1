const username = document.querySelector('#username');
const email = document.querySelector('#email');
const password = document.querySelector('#psw');
const cpassword = document.querySelector('#cpsw');
const form = document.querySelector('form');
const error = document.querySelector('#error');

function validation(event) {
    let messages = [];  //dichiaro l'array che conterra i messaggi d'errore

    console.log(username.value);
    if (username.value == '' || username.value == null) {   
        messages.push("Username richiesto!");
    }
    if (email.value == '' || email.value == null) {
        messages.push("Email richiesta!");
    }
    if (password.value == '' || password.value == null) {
        messages.push("Password richiesta!");
    }
    //questi 3 controlli sono futili poiche' c'e gia il required nell'html, ma li faccio ugualmente
    
    //---CONTROLLI ALLA PASSWORD---
    //conferma password
    if (password.value != cpassword.value) {
        messages.push('La conferma della password non corrisponde');
    }

    const caratteriminuscExpression = new RegExp("[a-z]");
    const caratterimaiuscExpression = new RegExp("[A-Z]");
    const numeriExpression = new RegExp("[0-9]");
    const specialcharsExpression = new RegExp("[!@#\$%\^&\*]");

    //lunghezza minima 8 caratteri
    if (password.value.length <= 7) {
        messages.push('La password deve essere lunga almeno 8 caratteri');
    }
    //lunghezza massima 20 caratteri
    if (password.value.length >= 21) {
        messages.push('La password può essere lunga al massimo 20 caratteri');
    }
    //almeno un carattere minuscolo
    if(!caratteriminuscExpression.test(password.value)) {
        messages.push('La password deve contenere almeno un carattere minuscolo');
    }
    //almeno un carattere maiuscolo
    if(!caratterimaiuscExpression.test(password.value)) {
        messages.push('La password deve contenere almeno un carattere maiuscolo');
    }
    //almeno un numero
    if(!numeriExpression.test(password.value)) {
        messages.push('La password deve contenere almeno un numero');
    }
    //almeno un carattere speciale
    if(!specialcharsExpression.test(password.value)) {
        messages.push('La password deve contenere almeno un carattere speciale');
    }

    //---CONTROLLI ALL'EMAIL---
    const emailExpression = new RegExp("[@.]");
    //controllo base: deve esserci almeno la '@' e il '.' 
    if(!emailExpression.test(email.value)) {
        messages.push('Email non valida');
    }
    
    if (messages.length > 0) { //significa che c'e qualche errore
        event.preventDefault();
        error.innerText = messages.join('\n');
    }
}

form.addEventListener('submit', validation);


