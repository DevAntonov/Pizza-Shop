<?php

class Admins extends Controller
{
    public function __construct()
    {
        $this->adminModel = $this->model('Admin');
    }

    
    public function login()
    {   
        $data = [
            'admin_name' => '',
            'pwd' => '',
            'admin_name_err' => '',
            'pwd_err' => ''
        ];
        

        if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
        
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'admin_name' => trim($_POST['admin_name']),
                'pwd' => trim($_POST['pwd']),
                'admin_name_err' => '',
                'pwd_err' => ''
            ];

            if(empty($data['admin_name'])){
                $data['admin_name_err'] = 'Please enter your admin name!';
            }
            
            if(empty($data['pwd'])){
                $data['pwd_err'] = 'Please enter your password!';
            }

            if(empty($data['admin_name_err']) && empty($data['pwd_err'])){
                $loggedInAdmin = $this->adminModel->loginAdmin($data['admin_name'],$data['pwd']);
                if($loggedInAdmin){
                    $this->createAdminSession($loggedInAdmin);
                    header('location: '. URLROOT . '/admins/dashboard');
                }else{
                    $data['pwd_err'] = "Incorrect admin name and/or password! ";
                    $this->view('admins/login', $data);
                }
            }

        }else{
            $data = [
                'admin_name' => '',
                'pwd' => '',
                'admin_name_err' => '',
                'pwd_err' => ''
            ];
        }

        $this->view('admins/login', $data);
    }

    public function createAdminSession($admin)
    {
        session_start();
        $_SESSION['loggedinAdmin'] = true;
        $_SESSION['admin_id'] = $admin->id;
        $_SESSION['admin_name'] = $admin->admin_name;
    }

    public function logoutAdmin()
    {
        unset($_SESSION['loggedinAdmin']);
        unset($_SESSION['admin_id']);
        unset($_SESSION['admin_name']);
        header('location: '. URLROOT . '/admins/login');
    }

    public function dashboard()
    {
        $data = [];
        $this->view('admins/dashboard', $data);
    }

    // CRUD Validation for Category, Product, Menu

    //Menu

    public function createMenuItem()
    {
        $data = [
            'success_msg_menu' => '',
            'category_name_menu_err' => '',
            'menu_item_name_err' => '',
            'price_err' => '',
            'no_products_selected' => '',
            'img_err' => ''
        ];

        $nameValidation = "/^[a-zA-Z ]*$/";
        $priceValidation = "/^\d{1,10}(?:\.\d{1,2})?$/";

        if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            if(empty($_POST['category_name_menu'])){
                $data['category_name_menu_err'] = 'Please select a valid category!';
            }elseif(!$this->adminModel->isCategoryExisting($_POST['category_name_menu'])){
                $data['category_name_menu_err'] = 'Invalid category!';
            }
            if(empty($_POST['products'])){
                $data['no_products_selected']= "Please select at least one product!";
            }
            if(empty($_POST['menu_item_name'])){
                $data['menu_item_name_err'] = "Menu item has empty name!";
            }elseif(!preg_match($nameValidation, $_POST['menu_item_name'])){
                $data['menu_item_name_err'] = "Menu item name can only contain letters!";
            }
            if(empty($_POST['price']) || $_POST['price'] == 0){
                $data['price_err'] = "Menu item has no price!";
            }elseif(!preg_match($priceValidation, $_POST['price'])){
                $data['price_err'] = "Invalid price format!";
            }elseif(preg_match($nameValidation, $_POST['price'])){
                $data['price_err'] = "Price cannot contain letters!";
            }
            if(!isset($_FILES['img'])){
                $data['img_err'] = 'No image file has been chosen!';
            }

            if(empty($data['category_name_menu_err']) && empty($data['no_products_selected']) && empty($data['menu_item_name_err']) && empty($data['price_err']) && empty($data['img_err'])){
                
                $image = preparedFileUpload();
                    
                if($image != '-1'){
                    if($this->adminModel->createMenuItem($_POST['category_name_menu'],$_POST['products'],$_POST['menu_item_name'],$_POST['price'], $image))
                    {
                        $data['success_msg_menu'] = "Menu item successfully created!";
                        $this->view('admins/dashboard',$data);
                        echo '<script type="text/javascript"> displayMenuForm(); </script>';
                    }else{
                        $data['menu_item_name_err'] = "Menu item name is taken!";
                        $this->view('admins/dashboard',$data);
                        echo '<script type="text/javascript"> displayMenuForm(); </script>';
                    }
                }
                elseif($image == '-1')
                {
                    $data['img_err'] = 'File already exists!';
                    $this->view('admins/dashboard',$data);
                    echo '<script type="text/javascript"> displayMenuForm(); </script>';
                }
                else{
                    $data['img_err'] = 'Unsupported file type! Supported file types are ".jpg", ".jpeg" and ".png"';
                    $this->view('admins/dashboard',$data);
                    echo '<script type="text/javascript"> displayMenuForm(); </script>';
                }
            }else{
                $this->view('admins/dashboard',$data);
                echo '<script type="text/javascript"> displayMenuForm(); </script>';
            }
        }
        $this->view('admins/dashboard',$data);

    }

    //Category

    public function createCategory()
    {
        $data = [
            'category_name' => '',
            'category_name_err' => '',
            'success_msg' => ''
        ];

        $nameValidation = "/^[a-zA-Z]*$/";

        if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'category_name' => trim($_POST['category_name'])
            ];
            
            if(empty($data['category_name'])){
                $data['category_name_err'] = 'Please enter a category name!';
            }elseif(!preg_match($nameValidation, $data['category_name'])){
                $data['category_name_err'] = "Category name can only contain letters!";
            }

            if(empty($data['category_name_err'])){
                if($this->adminModel->createCategory($data['category_name'])){
                    $data['success_msg'] = "Category successfully created!";
                }else{
                    $data['category_name_err'] = 'Category name exists!';
                }
            }else{
                $this->view('admins/dashboard',$data);
            }

        }
        
        $this->view('admins/dashboard',$data);
    }

    public function updateCategory()
    {
        $data = [
            'category_new_name' => '',
            'category_new_name_err' => '',
            'success_msg' => ''
        ];

        $nameValidation = "/^[a-zA-Z]*$/";

        if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'category_new_name' => trim($_POST['category_new_name'])
            ];
            
            if(empty($data['category_new_name'])){
                $data['category_new_name_err'] = 'Please enter your new category name!';
            }elseif(!preg_match($nameValidation, $data['category_new_name'])){
                $data['category_new_name_err'] = "Category name can only contain letters!";
            }

            if(empty($_POST['selected_category_name'])){
                $data['category_new_name_err'] = 'Please select a category!';
            }

            if(empty($data['category_new_name_err'])){
                if($this->adminModel->updateCategory($_POST['selected_category_name'],$data['category_new_name'])){
                    $data['success_msg'] = "Category successfully updated!";
                }else{
                    $data['category_new_name_err'] = 'Category does not exists!';
                }
            }else{
                $this->view('admins/dashboard',$data);
            }

        }
        
        $this->view('admins/dashboard',$data);
    }

    public function deleteCategory()
    {
        $data = ['category_name_err' => ''];
        if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            if(empty($_POST['selected_category_name'])){
                $data['category_name_err'] = 'Please select a category you wish to delete!';
            }

            if(empty($data['category_name_err'])){
                if($this->adminModel->deleteCategory($_POST['selected_category_name'])){
                    $data['success_msg'] = "Category deleted!";
                }else{
                    $data['category_name_err'] = 'Invalid category or category name is still relevant to a menu item!';
                }
            }else{
                $this->view('admins/dashboard',$data);
            }

        }

        $this->view('admins/dashboard',$data);
    }

    // Product

    public function createType()
    {
        $data = [
            'product_type_name' => '',
            'product_type_name_err' => '',
            'success_msg_product' => ''
        ];

        $nameValidation = "/^[a-zA-Z]*$/";

        
        if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'product_type_name' => trim($_POST['product_type_name'])
        
            ];

            if(empty($data['product_type_name'])){
                $data['product_type_name_err'] = 'Please enter product type name!';
            }elseif(!preg_match($nameValidation, $data['product_type_name'])){
                $data['product_type_name_err'] = "Product type name can only contain letters!";
            }

            if(empty($data['product_type_name_err'])){
                if($this->adminModel->createType($data['product_type_name'])){
                    $data['success_msg_product'] = "Product type successfully created!";
                    $this->view('admins/dashboard',$data);
                    echo '<script type="text/javascript"> displayProductForm(); </script>';
                }else{
                    $data['product_type_name_err'] = 'Product type name exists!';
                    $this->view('admins/dashboard',$data);
                    echo '<script type="text/javascript"> displayProductForm(); </script>';
                }
            }else{
                $this->view('admins/dashboard',$data);
                echo '<script type="text/javascript"> displayProductForm(); </script>';
            }

        }

        $this->view('admins/dashboard',$data);
    }

    public function createProduct()
    {
        $data = [
            'product_item_name' => '',
            'product_item_name_err' => '',
            'product_type_name' => '',
            'product_type_name_err' => '',
            'success_msg_product' => ''
        ];

        $nameValidation = "/^[a-zA-Z]*$/";

        if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'product_item_name' => trim($_POST['product_item_name']),
                'product_type_name' => trim($_POST['product_type'])
        
            ];

            if(empty($data['product_type_name'])){
                $data['product_type_name_err'] = 'Please select a product type!';
            }
            if(empty($data['product_item_name'])){
                $data['product_item_name_err']= 'Please enter product item name!';
            }elseif(!preg_match($nameValidation, $data['product_item_name'])){
                $data['product_item_name_err'] = "Product item name can only contain letters!";
            }

            if(empty($data['product_type_name_err']) && empty($data['product_item_name_err']))
            {
                if($this->adminModel->isTypeExisting($data['product_type_name']))
                {
                    if($this->adminModel->createProductItem($data['product_type_name'],$data['product_item_name'])){
                        $data['success_msg_product'] = "Product item successfully created!";
                        $this->view('admins/dashboard',$data);
                        echo '<script type="text/javascript"> displayProductForm(); </script>';
                    }else{
                        $data['product_item_name_err'] = 'Product item name exists!';
                        $this->view('admins/dashboard',$data);
                        echo '<script type="text/javascript"> displayProductForm(); </script>';
                    }
                }else{
                    $data['product_type_name_err'] = 'Product type name does not exists!';
                    $this->view('admins/dashboard',$data);
                    echo '<script type="text/javascript"> displayProductForm(); </script>';
                }
                
            }else{
                $this->view('admins/dashboard',$data);
                echo '<script type="text/javascript"> displayProductForm(); </script>';
            }

        }

        $this->view('admins/dashboard',$data);

    }

    public function updateProduct()
    {
        $data = [
            'product_new_name' => '',
            'product_new_name_err' => '',
            'selected_item' => '',
            'selected_item_err' => '',
            'success_msg_product' => ''
        ];

        $nameValidation = "/^[a-zA-Z]*$/";

        if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'selected_item' => trim($_POST['product_name']),
                'product_new_name' => trim($_POST['product_new_name'])
        
            ];

            if(empty($data['selected_item'])){
                $data['selected_item_err'] = 'Please select a product you wish to rename!';
            }

            if(empty($data['product_new_name'])){
                $data['product_new_name_err'] = 'Please enter product item name!';

            }elseif(!preg_match($nameValidation, $data['product_new_name'])){
                $data['product_new_name_err'] = 'Product item name can only contain letters!';
            }

            if(empty($data['selected_item_err']) && empty($data['product_new_name_err']))
            {
                if($this->adminModel->updateProduct($data['product_new_name'], $data['selected_item'])){
                    $data['success_msg_product'] = 'Product name successfully changed!';
                    $this->view('admins/dashboard',$data);
                    echo '<script type="text/javascript"> displayProductForm(); </script>';
                }else{
                    $data['product_new_name_err'] = 'Product item name does not exist!';
                    $this->view('admins/dashboard',$data);
                    echo '<script type="text/javascript"> displayProductForm(); </script>';
                }
            }else{
                $this->view('admins/dashboard',$data);
                echo '<script type="text/javascript"> displayProductForm(); </script>';
            }

        }

        $this->view('admins/dashboard',$data);
    }

    public function deleteProductItem()
    {
        $data = [
            'product_item_name_err' => ''
        ];
        
        if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            
            if(empty($_POST['product_item_name'])){
                $data['product_item_name_err'] = 'Please select an item you wish to delete!';
            }

            if(empty($data['product_item_name_err'])){
                if($this->adminModel->deleteProductItem($_POST['product_item_name'])){
                    $data['success_msg_product'] = "Item deleted!";
                    $this->view('admins/dashboard',$data);
                    echo '<script type="text/javascript"> displayProductForm(); </script>';
                }else{
                    $data['product_item_name_err'] = 'Invalid Item!';
                    $this->view('admins/dashboard',$data);
                    echo '<script type="text/javascript"> displayProductForm(); </script>';
                }
            }else{
                $this->view('admins/dashboard',$data);
                echo '<script type="text/javascript"> displayProductForm(); </script>';
            }
        }

        $this->view('admins/dashboard',$data);
    }

    
    public function deleteProductType()
    {
        $data = [
            'product_type_name_err' => ''
        ];
        
        if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            
            if(empty($_POST['product_type'])){
                $data['product_type_name_err'] = 'Please select a type you wish to delete!';
            }

            if(empty($data['product_type_name_err'])){
                if($this->adminModel->deleteProductType($_POST['product_type'])){
                    $data['success_msg_product'] = "Type deleted!";
                    $this->view('admins/dashboard',$data);
                    echo '<script type="text/javascript"> displayProductForm(); </script>';
                }else{
                    $data['product_type_name_err'] = 'Invalid type or type is still relevant to an item/s!';
                    $this->view('admins/dashboard',$data);
                    echo '<script type="text/javascript"> displayProductForm(); </script>';
                }
            }else{
                $this->view('admins/dashboard',$data);
                echo '<script type="text/javascript"> displayProductForm(); </script>';
            }
        }

        $this->view('admins/dashboard',$data);
    }

}