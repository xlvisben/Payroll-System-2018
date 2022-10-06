<?php
//ADD CATEGORY
include('header.php');
if ($_GET['action'] == "addcategory") {
    $name = sanitizeString($_POST['name']);
    mysqli_query($GLOBALS['connect'],"INSERT INTO category(name)VALUES('$name')");
    echo "<script>location.replace('productcategory.php')</script>";
}


//Update Category
if ($_GET['action'] == "editcategory") {
    if ($_POST) {

        # code...
        $id = sanitizeString($_POST['id']);
        $v = sanitizeString($_POST['catname']);

        $sql = "UPDATE category SET name='$v' WHERE id='$id';";

        if (mysqli_query($GLOBALS['connect'],$sql)) {
            echo "Record updated successfully";
            echo "<script>location.replace('categories.php')</script>";
        } else {
            echo mysql_error();
        }

    }

}
//DELETE Category
if ($_GET['action'] == "deletecategory") {
    $id = $_REQUEST['id'];
    mysqli_query($GLOBALS['connect'],"DELETE FROM category WHERE id='$id'");
    echo "<script>location.replace('categories.php')</script>";

}
//EDIT PRODUCT
if ($_GET['action'] == "editproduct") {
    $name = $_POST['name'];
    $category = $_POST['cat'];
    $id = $_REQUEST['id'];
    $cost = $_REQUEST['cost'];
    mysqli_query($GLOBALS['connect'],"UPDATE products SET name='$name',cost='$cost',category='$category' WHERE id='$id'");
    echo "<script>location.replace('products.php')</script>";

}
//DELETE PRODUCT
if ($_GET['action'] == "deleteproduct") {
    $id = $_REQUEST['id'];
    mysqli_query($GLOBALS['connect'],"DELETE FROM products WHERE id='$id'");
    echo "<script>location.replace('products.php')</script>";
}
//STOCK OPERATIONS
//Add product stock levels
if ($_GET['action'] == "addlevel") {
    //get current level

    //add to new value

    //record entry to db


    //send SMS

}
//Update product stock level
if ($_GET['action'] == "editlevel") {
    //get current level

    //add to new value

    //record entry to db


    //send SMS

}
//Delete Product Stock level Entry
if ($_GET['action'] == "deletelevel") {
    //get current level

    //add to new value

    //record entry to db


    //send SMS

}
//RECEIVE STOCK (WAREHOUSE IN)
if ($_GET['action'] == "warehousein") {
    $productid = $_REQUEST['id'];
    $product = sanitizeString($_POST['product']);
    $stockin = sanitizeString($_POST['ppl']);
    $costprice = sanitizeString($_POST['lit']);
    $stockvalue = sanitizeString($_POST['tot']);
    $warehouse = sanitizeString($_POST['loc']);
    $recordedby = sanitizeString($_POST['pur']);
    $dateadded = sanitizeString($_POST['pdate']);
    $logs = sanitizeString($_POST['token']);
    //get current level
    $currentstock = sanitizeString($_POST['smile']);
    //add to new value
    $newstock = sanitizeString($_POST['stock']);
    //record entry to db.stockmoves


    //check main stock table using loop
    //if 0 insert if exists update
    $result=mysqli_fetch_assoc(mysqli_query($GLOBALS['connect'],"SELECT COUNT(id) as tot from stock WHERE productid='$productid' && location='$warehouse'"));
    $no=$result['tot'];
    //INSERT INTO STOCK
    if ($no==0) {
        mysqli_query($GLOBALS['connect'],"INSERT INTO stock (product,productid,quantity,costprice,stockvalue,location)VALUES('$product','$productid','$stockin','$costprice','$stockvalue','$warehouse')");
    } elseif ($no>0) {
        mysqli_query($GLOBALS['connect'],"UPDATE stock SET quantity='$newstock' WHERE productid='$productid')");

    }
    //INSERT 
    mysqli_query($GLOBALS['connect'],"INSERT INTO stockmoves(product,productid,currentstock,stockin,costprice,stockvalue,warehouse,recordedby,dateadded,logs,updatedstock)VALUES('$product','$productid','$currentstock','$stockin','$costprice','$stockvalue','$warehouse','$recordedby','$dateadded','$logs','$newstock') ");
    //SEND SMS
echo"<script>location.replace('checkinstock.php')</script>";

    


}


//WAREHOUSE OUT
if ($_GET['action'] == "warehouseout") {
    $productid = $_REQUEST['id'];
    $product = sanitizeString($_POST['product']);
    $stockout = sanitizeString($_POST['ppl']);
    $warehouse = sanitizeString($_POST['loc']);
    $recordedby = sanitizeString($_POST['pur']);
    $dateadded = sanitizeString($_POST['pdate']);
    $logs = sanitizeString($_POST['token']);
    //get current level
    $currentstock = sanitizeString($_POST['smile']);
    //add to new value
    $newstock = sanitizeString($_POST['stock']);
    //record entry to db.stockmoves


    //check main stock table using loop
    //if 0 insert if exists update
    /*
    $result=mysqli_fetch_assoc(mysqli_query($GLOBALS['connect'],"SELECT COUNT(id) as tot from stock WHERE productid='$productid' && location='$warehouse'"));
    $no=$result['tot'];
    //INSERT INTO STOCK
    if ($no==0) {
        mysqli_query($GLOBALS['connect'],"INSERT INTO stock (product,productid,quantity,costprice,stockvalue,location)VALUES('$product','$productid','$stockin','$costprice','$stockvalue','$warehouse')");
    } elseif ($no>0) {
        mysqli_query($GLOBALS['connect'],"UPDATE stock SET quantity='$newstock' WHERE productid='$productid')");

    }*/
    //INSERT RECORD
    mysqli_query($GLOBALS['connect'],"INSERT INTO stockmoves(product,productid,currentstock,stockout,warehouse,recordedby,dateadded,logs,updatedstock)VALUES('$product','$productid','$currentstock','$stockout','$warehouse','$recordedby','$dateadded','$logs','$newstock') ");
    //SEND SMS
echo"<script>location.replace('checkoutstock.php')</script>";
  

}
?>