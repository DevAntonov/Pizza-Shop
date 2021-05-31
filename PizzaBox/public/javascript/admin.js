//Display admin CRUD forms on click
let menuForm = document.getElementById('display_menu');
let categoryForm = document.getElementById('display_category');
let productForm = document.getElementById('display_product');

let btnMenu = document.getElementById('btn_menu');
let btnCategory = document.getElementById('btn_category');
let btnProduct = document.getElementById('btn_product');

function displayMenuForm(){
    btnMenu.style.backgroundColor="#e0a853";
    btnCategory.style.backgroundColor="";
    btnProduct.style.backgroundColor="";
    menuForm.style.display="block";
    productForm.style.display="none";
    categoryForm.style.display="none";
}

function displayCategoryForm(){
    btnCategory.style.backgroundColor="#e0a853";
    btnMenu.style.backgroundColor="";
    btnProduct.style.backgroundColor="";
    menuForm.style.display="none";
    productForm.style.display="none";
    categoryForm.style.display="block";
    
}

function displayProductForm(){
    btnProduct.style.backgroundColor="#e0a853";
    btnMenu.style.backgroundColor="";
    btnCategory.style.backgroundColor="";
    menuForm.style.display="none";
    categoryForm.style.display="none";
    productForm.style.display="block";
}

