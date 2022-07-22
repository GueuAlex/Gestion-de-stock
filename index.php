<?php
    if(!isset($_SESSION)){
        session_start(); 

    }
    
    if(!isset($_SESSION['id']) || empty(trim($_SESSION['id']))){
        header('location:./vue/login.php');
    }else{
        require_once 'php/user.class.php';
        $current_user = new user($DB);
        $session_id = $_SESSION['id'];

        $getUser = $current_user->getUser($session_id);

        require_once 'php/article.class.php';
        $article = new Article($DB);
        
    }
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Dashboard |</title>
</head>
<body>
    <div class="container">
       
        <!--user area----------------->
        <div class="user_container">
            <div class="user_info">
                <div class="user_info_head">
                    <div class="profil_and_detailles">
                        <div class="profile">

                        </div>
                        <?php foreach($getUser as $value): ?>
                        <div class="detailles">
                            <h3><?= $value->loginUtil?></h3>
                            <small><?=$value->nomUtil.' '.$value->prenomUtim?></small>
                        </div>
                    </div>
                </div>
                <div class="user_info_body">
                    <div class="body_container">
                       <div class="info">
                            <div class="desc"><small>user info</small></div>
                            <p>
                                <img src="icons/employee.png" class="icon" alt="">
                                 <span><?php
                                    if($value->idRole == 1){
                                        $role = 'Administrateur';
                                    }elseif($value->idRole == 2){
                                        $role = 'Sous-admin';
                                    }else{
                                        $role =' utilisateur';
                                    }
                                    echo $role;
                                 ?></span>
                            </p>
                            <p>
                                <img src="icons/id.png" class="icon" alt="">
                                 <span><?= $session_id?></span>
                            </p>

                            <p>
                                <img src="icons/phone-call.png" class="icon" alt="">
                                 <span><?= $value->contUtil?></span>
                            </p>
                       </div>
                       <?php endforeach?>
                        
                       <div class="personnel">
                            <div class="desc"><small>Gestionnaire du personnel</small></div>
                            <div class="personnel-info">
                                <div>
                                    <div class="personnel-pic">
                                      <img src="images/img2.jpg" class="pic5" alt=""> | Dosso Golou  <br> &nbsp; &nbsp; <small>utilisateur</small>
                                    </div>
                                </div>
                                <div>
                                   <button class="seeMore">
                                        <a href="vue/userInfo.php"> voir +</a>
                                   </button>
                                </div>
                            </div>
                       </div>


                       <div class="him_production_info">
                           <div class="desc"><small>mes produits</small></div>
                           <p>
                            <img src="icons/stock.png" class="icon" alt="">
                             <span>En stock : 5145</span>
                                <div class="products_pic">
                                    <div class="pic1"></div>
                                    <div class="pic2"></div>
                                    <div class="pic3"></div>
                                    <div class="pic4"></div>
                                </div>
                           </p>
                           <p>
                            <img src="icons/la-finance.png" class="icon" alt="">
                             <span>Valeur globale : 54 957250,00 f CFA</span>
                           </p>
                       </div>

                       <div class="him_last_product him_production_info">
                            <div class="desc"><small>dernier produit ajouter</small></div>
                            <p>
                                <img src="icons/stock.png" class="icon" alt="">
                                <span>Quantité : 45</span>
                                <div class="products_pic">
                                    <div class="pic5"></div> | Nivea
                                </div>
                            </p>
                            <p>
                                <img src="icons/facture.png" class="icon" alt="">
                                <span>Prix unitaire : 1 221,26 f CFA</span>
                            </p>
                            <p>
                                <img src="icons/la-finance.png" class="icon" alt="">
                                <span>Valeur globale : 54 957,00 f CFA</span>
                        </p>
                       </div>

                    </div>
                </div>
                <div class="user_info_footer">
                    <h3>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cloud-upload-fill" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M8 0a5.53 5.53 0 0 0-3.594 1.342c-.766.66-1.321 1.52-1.464 2.383C1.266 4.095 0 5.555 0 7.318 0 9.366 1.708 11 3.781 11H7.5V5.707L5.354 7.854a.5.5 0 1 1-.708-.708l3-3a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 5.707V11h4.188C14.502 11 16 9.57 16 7.773c0-1.636-1.242-2.969-2.834-3.194C12.923 1.999 10.69 0 8 0zm-.5 14.5V11h1v3.5a.5.5 0 0 1-1 0z"/>
                          </svg>
                        <span>Ajouter un produit</span>
                    </h3>
                    <a href="#modal1" class="button js_modalOpen">
                        +
                    </a>
                    <div class="logout">Deconnection</div>
                </div>
            </div>
        </div>
        
        <!--product area----------------->
        <div class="side_container">
            <div class="page_tilte">
                <h1>GESTION DE <span class="oseilles">STOCK</span>  <span class="typeWriting"></span></h1>
            </div>
            <div class="card_container">
                <div class="stock">
                    <div class="fi">
                        <img src="icons/stock.png" alt="">  &nbsp; &nbsp; 
                        <h3> | STOCK</h3>
                    </div>
                    <small>
                           <?php
                               $valeurGlob = $article->getValStock();
                               echo $valeurGlob[0];
                             ?>
                    </small>
                </div>
                <div class="categorie">
                    <div class="fi">
                        <img src="icons/categories.png" alt="">  &nbsp; &nbsp; 
                        <h3> | CATEGORIES</h3>
                    </div>
                    <small>5</small>
                    <!--<select>
                        <option >chaussure: 487</option>
                        <option >Télephone: 369</option>
                        <option >Habit: 4789</option>
                        <option >Ordinateur: 789</option>
                        <option >Voiture: 742</option>
                    </select>-->
                </div>
                <div class="valeurs">
                    <div class="fi">
                        <img src="icons/la-finance.png" alt="">  &nbsp; &nbsp; 
                        <h3> | VALEUR</h3>
                    </div>
                    <small class="oseilles">
                           <?php
                               $valeurGlob = $article->getValStock();
                               echo $valeurGlob[1];
                             ?>
                    f CFA</small>
                </div>
            </div>
          <!--------------------------roducts list---------------------------------------------->
            <div class="product_container">
                <div>
                    <div class="li_content">
                        <ul class="tabs">
                            <li class="active"><a href="#home" class="relod">MES ARTICLES</a></li>
                            <li><a href="#mention">TOUS LES ARTICLES</a></li>
                        </ul>
                    </div>
            
                   <div class="tabs-content">
                        <div class="tab-content active" id="home">
                            <div>
                                <div class="menu2">
                                    <ul class="tabs">
                                        <li class="active"><a href="#home1">Vetements</a></li>
                                        <li><a href="#mention1">Télephones</a></li>
                                        <li><a href="#about1">Ordi</a></li>
                                        <li><a href="#Chaussures1">Chaussures</a></li>
                                        <li><a href="#Voitures1">Voitures</a></li>
                                    </ul>
                                </div>
                        
                               <div class="tabs-content">

                                    <div class="tab-content active" id="home1">
                                        <!---------------------------------------------->
                                        <!----------------MEs vetements----------------->
                                        <!---------------------------------------------->
                                       
                                          
                                            <?php
                                                $article->getCurrenteUserArt($session_id, 1);
                                            ?>
                                               
                                         
                                      
                                    </div>

                                    <div class="tab-content" id="mention1">
                                       <!---------------------------------------------->
                                        <!----------------Mes telephones--------------->
                                        <!---------------------------------------------->
                                        <?php
                                            $article->getCurrenteUserArt($session_id, 5);
                                        ?>

                                    </div>

                                    
                                    <div class="tab-content" id="about1">
                                        <!---------------------------------------------->
                                        <!----------------Mes Ordi----------------------->
                                        <!---------------------------------------------->
                                        <?php
                                            $article->getCurrenteUserArt($session_id, 3);
                                        ?>
                                    </div>

                                     
                                    <div class="tab-content" id="Chaussures1">
                                        <!---------------------------------------------->
                                        <!----------------Mes chaussures---------------->
                                        <!---------------------------------------------->
                                        <?php
                                            $article->getCurrenteUserArt($session_id, 2);
                                        ?>
    
                                    </div>

                                    
                                    <div class="tab-content" id="Voitures1">
                                        <!---------------------------------------------->
                                        <!----------------Mes Voitures------------------>
                                        <!---------------------------------------------->
                                        <?php
                                            $article->getCurrenteUserArt($session_id, 4);
                                        ?>
                                       
                                    </div>
                                </div>
                            </div>
                        </div>




                        <div class="tab-content" id="mention">
                            <div>
                                <div class="menu2">
                                    <ul class="tabs">
                                        <li class="active"><a href="#home2">Vetements</a></li>
                                        <li><a href="#mention2">Télephones</a></li>
                                        <li><a href="#about2">Ordi</a></li>
                                        <li><a href="#Chaussures2">Chaussures</a></li>
                                        <li><a href="#Voitures2">Voitures</a></li>
                                    </ul>
                                </div>
    
                               <div class="tabs-content">

                                    <div class="tab-content active" id="home2">
                                        <!---------------------------------------------->
                                        <!----------------Tous les vetements------------>
                                        <!---------------------------------------------->
                                        <?php
                                            $article->getAllArt(1);
                                        ?>
                                        
                                    </div>

                                    <div class="tab-content" id="mention2">
                                        <!---------------------------------------------->
                                        <!----------------Tous les telephones----------->
                                        <!---------------------------------------------->
                                        <?php
                                            $article->getAllArt(5);
                                        ?>
                                    </div>

                                    <div class="tab-content" id="about2">
                                        <!---------------------------------------------->
                                        <!----------------Tous les ordi----------------->
                                        <!---------------------------------------------->
                                        <?php
                                            $article->getAllArt(3);
                                        ?>
                                    </div>

                                    <div class="tab-content" id="Chaussures2">
                                        <!---------------------------------------------->
                                        <!----------------Toutes les chaussures--------->
                                        <!---------------------------------------------->
                                        <?php
                                            $article->getAllArt(2);
                                        ?>
                                    </div>
                                    
                                    <div class="tab-content" id="Voitures2">
                                        <!---------------------------------------------->
                                        <!----------------Tous les voitures------------->
                                        <!---------------------------------------------->

                                        <?php
                                            $article->getAllArt(4);
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-------------------------------------------------------->
    <!---------------------------modal------------------------>
    <!-------------------------------------------------------->
    <aside id="modal1"  class="modal"  aria-hidden="true" role="dialog" aria-labelledby="title_modal">
        <div class="modal_container">
            <div  class="modal_wrapper js-modal-stop">
                <button class="js-modal-close closeBtn">X</button>
                <div class="bday-card">
                    <h4 class="titre"></h4>
                    <div class="err_msg">Tous les champs sont obligatoire !</div>
                    <form action="php/article.php"  method="POST" class="form" enctype="multipart/form-data">
                        <div class="name_container">
                            <div class="marge">
                                <label for="nom">Libellé</label><br>
                                <div class="nom">
                                  <input type="text" name="lib" id="nom">
                                </div>
                            </div>
                            <div>
                                <label for="prenom">Code article</label><br>
                                <div class="prenom">
                                  <input type="text" name="code" id="prenom">
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
                                             require_once 'php/db.class.php';
                                             $DB = new DB();
                                             $req = $DB->query('SELECT * FROM categorie');
                                             foreach ($req as $value):
                                        ?>
                                        <option value="<?=$value->idCat?>"><?=$value->libCat?></option>
                                        <?php endforeach?>
                                    </select>
                                </div>
                           </div>
                            <div class="marge1">
                                <label for="contact">Prix unitaire</label><br>
                                <div class="contact">
                                    <input type="text" name="price" id="contact">
                                </div>
                            </div>
                        </div>
                        
                        <br>
            
                        <div class="pass_log">
                            <div class="marge">
                                <label for="login">Stock</label><br>
                                <div class="login">
                                    <input type="text" name="stock" id="login">
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
                            <input class="button" type="submit" value="Ajouter">
                        </div>
                    </form>
                    <div class="succes" style="display: none;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check2-square" viewBox="0 0 16 16">
                            <path d="M3 14.5A1.5 1.5 0 0 1 1.5 13V3A1.5 1.5 0 0 1 3 1.5h8a.5.5 0 0 1 0 1H3a.5.5 0 0 0-.5.5v10a.5.5 0 0 0 .5.5h10a.5.5 0 0 0 .5-.5V8a.5.5 0 0 1 1 0v5a1.5 1.5 0 0 1-1.5 1.5H3z"/>
                            <path d="M8.354 10.354l7-7a.5.5 0 0 0-.708-.708L8 9.293 5.354 6.646a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0z"/>
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </aside>
    <script src="https://unpkg.com/typewriter-effect@latest/dist/core.js"></script>
    <script src="js/script.js"></script>
    <script src="js/logout.js"></script>
    <script src="js/article.js"></script>
</body>
</html>
