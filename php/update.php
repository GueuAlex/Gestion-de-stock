<?php
if(!isset($_SESSION)){
    session_start();
    $session_id = $_SESSION['id'];
}

if(isset( $_POST['codeGetting']) && !empty(trim( $_POST['codeGetting']))){
    $codeGetting = $_POST['codeGetting'];
    require_once 'article.class.php';
    $remInfo = new Article($DB);
    $info = $remInfo->getArtInfo($codeGetting);
}else{
    header('location:../index.php');
}


if(isset($_POST['lib']) && !empty(trim($_POST['lib']))){
    $lib = nl2br(htmlspecialchars($_POST['lib']));
}else{
    $lib = $info[1];
}


if(isset($_FILES['image']['name']) && !empty($_FILES['image']['name'])){
    $file = $_FILES['image'];
}else{
    $file = $info[4];
}



if(isset($_POST['stock']) && !empty(trim($_POST['stock']))){
    $stock = (int)nl2br(htmlspecialchars($_POST['stock']));           
}else{
    $stock = $info[3];
}


if(isset($_POST['price']) && !empty(trim($_POST['price']))){
    $price = (int)nl2br(htmlspecialchars($_POST['price']));          
}else{
    $price = $info[2];
}


if(isset($_POST['cat']) && !empty(trim($_POST['cat']))){
    $cat = nl2br(htmlspecialchars($_POST['cat']));     
}else{
    $cat = $info[6];
}


if(isset($_POST['code']) && !empty(trim($_POST['code']))){
    $code = nl2br(htmlspecialchars($_POST['code']));  
}else{
    $code = $info[0];
}


$update = $remInfo->updateArt($code, $lib, $price, $stock, $cat, $file, $codeGetting);

echo $update;

