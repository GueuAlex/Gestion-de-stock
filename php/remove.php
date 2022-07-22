<?php
$code = nl2br(htmlspecialchars(trim($_POST['code'])));

require_once 'article.class.php';
$rem = new Article($DB);
$retour = $rem->removeArt($code);
echo $retour;