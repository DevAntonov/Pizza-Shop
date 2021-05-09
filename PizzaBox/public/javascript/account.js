//Display account forms update on click
let accForm = document.getElementById('acc_details');
let pwdForm = document.getElementById('acc_pass');
let adrForm = document.getElementById('acc_address');

let btnAcc = document.getElementById('btn_acc_info');
let btnPwd = document.getElementById('btn_pass');
let btnAdr = document.getElementById('btn_address');

function displayDetailsForm(){
    btnAcc.style.backgroundColor="#da9938";
    btnPwd.style.backgroundColor="transparent";
    btnAdr.style.backgroundColor="transparent";
    accForm.style.display="block";
    adrForm.style.display="none";
    pwdForm.style.display="none";
}

function displayPasswordForm(){
    btnPwd.style.backgroundColor="#da9938";
    btnAcc.style.backgroundColor="transparent";
    btnAdr.style.backgroundColor="transparent";
    accForm.style.display="none";
    adrForm.style.display="none";
    pwdForm.style.display="block";
    
}

function displayAddressForm(){
    btnAdr.style.backgroundColor="#da9938";
    btnAcc.style.backgroundColor="transparent";
    btnPwd.style.backgroundColor="transparent";
    accForm.style.display="none";
    pwdForm.style.display="none";
    adrForm.style.display="block";
}

