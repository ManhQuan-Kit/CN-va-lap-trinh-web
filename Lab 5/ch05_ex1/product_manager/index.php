<?php
require('../model/database.php');
require('../model/product_db.php');
require('../model/category_db.php');

if (isset($_POST['action'])) {
    $action = $_POST['action'];
} else if (isset($_GET['action'])) {
    $action = $_GET['action'];
} else {
    $action = 'list_products';
}

// ================== PRODUCT ====================
if ($action == 'list_products') {
    // Get the current category ID
    if (isset($_GET['category_id'])) {
    $category_id = $_GET['category_id'];
} else {
    $category_id = 1;   // giá trị mặc định
}


    // Get product and category data
    $category_name = get_category_name($category_id);
    $categories = get_categories();
    $products = get_products_by_category($category_id);

    // Display the product list
    include('product_list.php');

} else if ($action == 'delete_product') {
    $product_id = $_POST['product_id'];
    $category_id = $_POST['category_id'];

    delete_product($product_id);
    header("Location: .?category_id=$category_id");

} else if ($action == 'show_add_form') {
    $categories = get_categories();
    include('product_add.php');

} else if ($action == 'add_product') {
    $category_id = $_POST['category_id'];
    $code = $_POST['code'];
    $name = $_POST['name'];
    $price = $_POST['price'];

    if (empty($code) || empty($name) || empty($price)) {
        $error = "Invalid product data. Check all fields and try again.";
        include('../errors/error.php');
    } else {
        add_product($category_id, $code, $name, $price);
        header("Location: .?category_id=$category_id");
    }

// ================== CATEGORY ====================
} else if ($action == 'list_categories') {
    $categories = get_categories();
    include('category_list.php');

} else if ($action == 'add_category') {
    $name = $_POST['name'];

    if (empty($name)) {
        $error = "Invalid category name. Try again.";
        include('../errors/error.php');
    } else {
        add_category($name);
        header("Location: .?action=list_categories");
    }

} else if ($action == 'delete_category') {
    $category_id = $_POST['category_id'];
    delete_category($category_id);
    header("Location: .?action=list_categories");
}
?>
