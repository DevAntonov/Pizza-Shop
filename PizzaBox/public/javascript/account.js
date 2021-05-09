//Display account forms update on click
let accForm = document.getElementById('acc_details');
let pwdForm = document.getElementById('acc_pass');
let adrForm = document.getElementById('acc_address');

function displayDetailsForm(){
    accForm.style.display="block";
    adrForm.style.display="none";
    pwdForm.style.display="none";
}

function displayPasswordForm(){
    accForm.style.display="none";
    adrForm.style.display="none";
    pwdForm.style.display="block";
    
}

function displayAddressForm(){
    accForm.style.display="none";
    pwdForm.style.display="none";
    adrForm.style.display="block";
}

