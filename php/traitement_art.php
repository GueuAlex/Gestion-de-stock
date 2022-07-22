<?php
if(!isset($_SESSION)){
    session_start();
    $session_id = $_SESSION['id'];
}

//echo $session_id;

$lib = nl2br(htmlspecialchars(trim($_POST['lib'])));
$code = nl2br(htmlspecialchars(trim($_POST['code'])));
$cat = nl2br(htmlspecialchars(trim($_POST['cat'])));
$price = (int)nl2br(htmlspecialchars(trim($_POST['price'])));
$stock = (int)nl2br(htmlspecialchars(trim($_POST['stock'])));
$file = $_FILES['image'];

//var_dump($file['name']);

require_once 'article.class.php';

$article = new Article($DB);

$insert = $article->createArticle($code, $lib, $price, $stock, $cat, $session_id, $file);
echo $insert;