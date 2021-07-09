<?php

session_start();

function isLoggedIn()
{
    if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true){
        return true;
    }else{
        return false;
    }
}

function isLoggedInAdmin()
{
    if(isset($_SESSION['loggedinAdmin']) && $_SESSION['loggedinAdmin'] === true){
        return true;
    }else{
        return false;
    }
}

function isCartSet()
{
    if(isset($_SESSION['cart'])&& $_SESSION['loggedin'] === true){
        return true;
    }else{
        return false;
    }
}