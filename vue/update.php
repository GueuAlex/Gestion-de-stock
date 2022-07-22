<?php
     if(isset( $_GET['code']) && !empty(trim( $_GET['code']))){
        $code = nl2br(htmlspecialchars($_GET['code']));
        require_once '../php/article.class.php';
        $remInfo = new Article($DB);
        $info = $remInfo->getArtInfo($code);
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
    <link rel="stylesheet" href="../css/style.css">
    <title>Update |</title>
</head>
<body>
    <aside id="modal1"  class="modal"  aria-hidden="true" role="dialog" aria-labelledby="title_modal">
        <div class="modal_container">
            <div  class="modal_wrapper js-modal-stop">
                <button class="js-modal-close closeBtn">X</button>
                <div class="bday-card">
                    <h4>Mettre a jour un article</h4>
                    <div class="err_msg" style="display: none;"></div>
                    <form action=""  method="post" class="form">
                        <input type="text" name="codeGetting" hidden value="<?= $code;?>">
                        <div class="name_container">
                            <div class="marge">
                                <label for="nom">Libellé</label><br>
                                <div class="nom">
                                  <input type="text" name="lib" placeholder="<?= $info[1];?>" id="nom">
                                </div>
                            </div>
                            <div>
                                <label for="prenom">Code article</label><br>
                                <div class="prenom">
                                  <input type="text" name="code" placeholder="<?= $info[0];?>" id="prenom">
                                </div>
                            </div>
                        </div>
                        
                        <br>
            
                        <div class="contact_rol">
                           <div class="marge">
                                <label for="rol">Catégorie</label><br>
                                <div class="rol">
                                    <select name="cat" id="rol">
                                        <?php
                                             require_once '../php/db.class.php';
                                             $DB = new DB();
                                             $req = $DB->query('SELECT * FROM categorie');
                                             foreach ($req as $value):
                                        ?>
                                        <?php if($value->idCat === $info[6] ):?>
                                            <option selected value="<?=$value->idCat?>"><?=$value->libCat?></option>
                                        <?php else:?>
                                            <option value="<?=$value->idCat?>"><?=$value->libCat?></option>
                                        <?php endif?>
                                        <?php endforeach?>
                                    </select>
                                </div>
                           </div>
                            <div class="marge1">
                                <label for="contact">Prix unitaire</label><br>
                                <div class="contact">
                                    <input type="text" name="price" placeholder="<?=$info[2]?>" id="contact">
                                </div>
                            </div>
                        </div>
                        
                        <br>
            
                        <div class="pass_log">
                            <div class="marge">
                                <label for="login">Quantité</label><br>
                                <div class="login">
                                    <input type="text" name="stock" placeholder="<?=$info[3]?>" id="login">
                                </div>
                            </div>
                            <div class="file">
                                <label for="password">Photo</label><br>
                                <div class="password">
                                    <input type="file" name="image" id="password">
                                </div>
                            </div>
                        </div>
                        
                        <br>
                        
                        <div class="btn">
                            <input class="submitBtn" type="submit" value="Modifier">
                        </div>
                    </form>

                    <div class="alert_remove update">
                        <p class="alert update_p">
                            <small>Mise a jour reussite !</small> <br>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456l-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
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
        </div>
    </aside>

    <script src="../js/update.js"></script>
</body>
</html>