<?php
    if(isset( $_GET['code']) && !empty(trim( $_GET['code']))){
        $code = nl2br(htmlspecialchars($_GET['code']));
        require_once '../php/article.class.php';
        $remInfo = new Article($DB);
    }else{
        header('location:../index.php');
    }
    
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete |</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    
    <aside id="modal1"  class="modal"  aria-hidden="true" role="dialog" aria-labelledby="title_modal">
        <div class="modal_container">
            <div  class="modal_wrapper js-modal-stop">
                <div class="hidden_after_click">
                    <button class="js-modal-close closeBtn">X</button>
                    <h2 id="title_modal">ATTENTION !</h2>
                    <h5>Souhaitez vous vraiment supprimer cet article ?</h5>
                    <div class="err_msg" style="display: none;"></div>
                    <hr>
                    <?php
                        $Info = $remInfo->getArtInfo($code);
                    ?>
                    <div class='remove_container'>
                    <div class='remove_content'>
                        <div class='remove_img'>
                            <img src='../php/images/<?= $Info[4];?>' alt=''>
                        </div>
                        <div class='remove_info'>
                            <h4><?= $Info[1];?></h4>
                            <p><small>prix : <?= $Info[2];?> f CFA</small></p>
                            <p><small>En stock : <?= $Info[3];?></small></p>
                            <p><small>Valeur globale : <?= $Info[7];?> f CFA</small></p>
                        </div>
                    </div>
                  </div>
                    <div class="remove_btn_content">
                        <form action="#" method="post" class="form">
                            <input type="text" name="code" value="<?= $code;?>" hidden>
                           <button type="submit" class="remove_btn">Supprimer</button>
                        </form>
                    </div>
                </div>
                <div class="alert_remove">
                    <p class="alert">
                        <small>supprimer avec succes !</small> <br>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-circle-fill" viewBox="0 0 16 16">
                        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293 5.354 4.646z"/>
                        </svg>
                    </p>
                    <p>
                        <a href="../index.php">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z"/>
                            </svg> Retour
                        </a>
                    </p>
                </div>
           </div>
        </div>
    </aside>
    <script src="../js/remove.js"></script>
</body>
</html>