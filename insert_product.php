<?php
require_once "db.php";
require_once "product.php";
if(isset($_POST['submit'])){
    $seller_id = $_SESSION["seller_id"];
    $product_title=$_POST['product_title'];
    $product_cat=$_POST['category'];
    $product_price=$_POST['product_price'];
    $product_count=$_POST['product_count'];
    $product_keywords=$_POST['product_keywords'];
    $product_desc=$_POST['prod_desc'];
    $product_img=$_FILES['product_img']['name'];

    $temp_name=$_FILES['product_img']['tmp_name'];

    $dbObj = new db();
    $insert_product_query="INSERT INTO products (sellerID, p_cat, product_title,
    product_price, product_desc, product_keywords, product_count) VALUES('$seller_id', '$product_cat'
    , '$product_title', '$product_price','$product_desc','$product_keywords', '$product_count')";
    $stmt = $dbObj->connect()->prepare($insert_product_query);
    $data = $stmt->fetch();
    //to insert the image
    $img_sql = "INSERT INTO products (image) VALUES (LOAD_FILE('E:/Prog/XAMPP/htdocs/img//$temp_name'))" //place where image is saved on the web server
    move_uploaded_file($temp_name, "E:/Prog/XAMPP/htdocs/imgdump//$product_img");

    if($data == false)
        return false;
    else{
        echo "<script>alert('Product Inserted successfully')</script>";
        echo "<script>window.open('insert_product.php')</script>";
    }
}
