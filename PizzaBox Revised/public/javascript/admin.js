//Display admin CRUD forms on click
let menuForm = document.getElementById('display_menu');
let categoryForm = document.getElementById('display_category');
let productForm = document.getElementById('display_product');
let supplementForm = document.getElementById('display_supplement');

let btnMenu = document.getElementById('btn_menu');
let btnCategory = document.getElementById('btn_category');
let btnProduct = document.getElementById('btn_product');
let btnSupplement = document.getElementById('btn_supplement');

function displayMenuForm(){
    btnMenu.style.backgroundColor="#e0a853";
    btnCategory.style.backgroundColor="";
    btnProduct.style.backgroundColor="";
    btnSupplement.style.backgroundColor="";
    menuForm.style.display="block";
    productForm.style.display="none";
    categoryForm.style.display="none";
    supplementForm.style.display="none";

}

function displayCategoryForm(){
    btnCategory.style.backgroundColor="#e0a853";
    btnMenu.style.backgroundColor="";
    btnProduct.style.backgroundColor="";
    btnSupplement.style.backgroundColor="";
    menuForm.style.display="none";
    productForm.style.display="none";
    categoryForm.style.display="block";
    supplementForm.style.display="none";
    
}

function displayProductForm(){
    btnProduct.style.backgroundColor="#e0a853";
    btnMenu.style.backgroundColor="";
    btnCategory.style.backgroundColor="";
    btnSupplement.style.backgroundColor="";
    menuForm.style.display="none";
    categoryForm.style.display="none";
    productForm.style.display="block";
    supplementForm.style.display="none";
}

function displaySupplementForm(){
    btnProduct.style.backgroundColor="";
    btnMenu.style.backgroundColor="";
    btnCategory.style.backgroundColor="";
    btnSupplement.style.backgroundColor="#e0a853";
    menuForm.style.display="none";
    categoryForm.style.display="none";
    productForm.style.display="none";
    supplementForm.style.display="block";
    
}

function openSlideMenu(){
	document.getElementById('side_menu').style.width='250px';
	
}

function closeSlideMenu(){
	document.getElementById('side_menu').style.width='0px';
	
}