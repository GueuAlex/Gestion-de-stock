<?php

class Article{
    
    private $art_lib;
    private $art_code;
    private $art_price;
    private $art_quantity;
    private $art_category;
    private $art_pic;
    private $user_mat;
    private $DB;

    public function __construct($DB){
        $this->DB = $DB;
    }


    public function createArticle($art_code, $art_lib, $art_price, $art_quantity, $art_category, $user_mat, $art_pic){
        if(!empty($art_code) && !empty($art_lib) && !empty($art_price) && !empty($art_quantity) && !empty($user_mat)){
            if(is_int($art_price) && is_int($art_quantity) && $art_price > 0 && $art_quantity > 0){
                if(preg_match('#^[a-zA-Z]{2}[0-9]{3}#', $art_code)){
                    $req = $this->DB->query("SELECT * FROM article WHERE codeArt = '{$art_code}'") ;
                    if(count($req) <= 0){
                       $pic_info  = self::cheickImage($art_pic);
                       if($pic_info !== 1){
    
                            $this->art_code = $art_code;
                            $this->art_lib = $art_lib;
                            $this->art_price = $art_price;
                            $this->art_quantity = $art_quantity;
                            $this->art_category = $art_category;
                            $this->user_mat = $user_mat;
    
                            $req = $this->DB->query("INSERT INTO article(codeArt, libArt, prixArt, stock, matUtil, idCat, pic) VALUES('{$this->art_code}', '{$this->art_lib}', '{$this->art_price}', '{$this->art_quantity}', '{$this->user_mat}', '{$this->art_category}', '{$pic_info}')");
                            $info = "success";
                       }else{
                           $info = "Selectionner une image de type - jpeg, jpg, png";
                       }
                    }else{
                        $info = 'ce code est déjà attribuer a un autre article !';
                    }
                }else{
                    $info = 'le code doit commencer par 2 lettres et finir par 3 chiffres ';
                }
            }else{
                $info = 'Le prix et le stock doivent être des entiers positifs !';
            }
        }else{
            $info = 'Tous les champs sont obligatoire !';
        }

        return $info;
    }


    private function cheickImage($file){
        $img_name = $file['name'];//obtention du nom de fichier
        $img_type = $file['type'];// type de fichier
        $tmp_name = $file['tmp_name'];//nom temporare du fichier

        $img_explode = explode('.', $img_name);
        $img_ext = end($img_explode);// obtient l'extention de l'image

        $extention = ['png', 'jpeg', 'jpg'];// extention autoriser
        if(in_array($img_ext, $extention) === true){// if user upload img extention is correct
            $time = time(); // return current time
            $new_img_name = $time.$img_name;
            if(move_uploaded_file($tmp_name, "images/".$new_img_name)){//if user upload img to our folder sucessfully

                $this->art_pic = $new_img_name;
                return $this->art_pic;
            }
            
        }else {
            return 1;
        }
    }


    public function  getCurrenteUserArt($session_id, $catID): void{
        $req = $this->DB->query("SELECT * FROM  article WHERE matUtil = '{$session_id}' AND idCat = '{$catID}'");
        
        if(count($req) <= 0){

            echo '<div class="add_invitation">
                        <div class="a_content">
                        <a href="#" class="add_btn js_modalOpen">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-square-dotted" viewBox="0 0 16 16">
                            <path d="M2.5 0c-.166 0-.33.016-.487.048l.194.98A1.51 1.51 0 0 1 2.5 1h.458V0H2.5zm2.292 0h-.917v1h.917V0zm1.833 0h-.917v1h.917V0zm1.833 0h-.916v1h.916V0zm1.834 0h-.917v1h.917V0zm1.833 0h-.917v1h.917V0zM13.5 0h-.458v1h.458c.1 0 .199.01.293.029l.194-.981A2.51 2.51 0 0 0 13.5 0zm2.079 1.11a2.511 2.511 0 0 0-.69-.689l-.556.831c.164.11.305.251.415.415l.83-.556zM1.11.421a2.511 2.511 0 0 0-.689.69l.831.556c.11-.164.251-.305.415-.415L1.11.422zM16 2.5c0-.166-.016-.33-.048-.487l-.98.194c.018.094.028.192.028.293v.458h1V2.5zM.048 2.013A2.51 2.51 0 0 0 0 2.5v.458h1V2.5c0-.1.01-.199.029-.293l-.981-.194zM0 3.875v.917h1v-.917H0zm16 .917v-.917h-1v.917h1zM0 5.708v.917h1v-.917H0zm16 .917v-.917h-1v.917h1zM0 7.542v.916h1v-.916H0zm15 .916h1v-.916h-1v.916zM0 9.375v.917h1v-.917H0zm16 .917v-.917h-1v.917h1zm-16 .916v.917h1v-.917H0zm16 .917v-.917h-1v.917h1zm-16 .917v.458c0 .166.016.33.048.487l.98-.194A1.51 1.51 0 0 1 1 13.5v-.458H0zm16 .458v-.458h-1v.458c0 .1-.01.199-.029.293l.981.194c.032-.158.048-.32.048-.487zM.421 14.89c.183.272.417.506.69.689l.556-.831a1.51 1.51 0 0 1-.415-.415l-.83.556zm14.469.689c.272-.183.506-.417.689-.69l-.831-.556c-.11.164-.251.305-.415.415l.556.83zm-12.877.373c.158.032.32.048.487.048h.458v-1H2.5c-.1 0-.199-.01-.293-.029l-.194.981zM13.5 16c.166 0 .33-.016.487-.048l-.194-.98A1.51 1.51 0 0 1 13.5 15h-.458v1h.458zm-9.625 0h.917v-1h-.917v1zm1.833 0h.917v-1h-.917v1zm1.834-1v1h.916v-1h-.916zm1.833 1h.917v-1h-.917v1zm1.833 0h.917v-1h-.917v1zM8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3v-3z"/>
                            </svg>
                        </a>
                        <small>Ajouter un article !</small>
                        </div>
                    </div>';
        }else{
            echo "<div class='articles_container'>
                     <ul class='articles_list'>";
            foreach ($req as $article) {
                $valeur = ($article->prixArt)*($article->stock);
                echo "<li class='article_container'>
                <div class='article'>
                    <div class='article_img'>
                        <img src='./php/images/$article->pic' alt=''>
                    </div>
                    <div class='aricle_footer'>
                        <div class='article_info'>
                            <h4>$article->libArt | <span class='price'><img class='icon' src='icons/facture.png'> $article->prixArt f CFA</span></h4>
                            <p>
                                <img src='icons/stock.png' alt='' class='icon'> <small>En stock : $article->stock</small> <br>
                                <img src='icons/la-finance.png' class='icon' alt=''> <small>valeur total : $valeur f CFA</small>
                            </p>
                        </div>
                       
                    </div>
                    <ul>

                        <a href='#'>
                          <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-eye-fill' viewBox='0 0 16 16'>
                            <path d='M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z'/>
                            <path d='M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z'/>
                          </svg>
                        </a>

                        <a href='../vue/update.php?code=$article->codeArt'>
                            <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-pencil-square' viewBox='0 0 16 16'>
                                <path d='M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456l-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z'/>
                                <path fill-rule='evenodd' d='M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z'/>
                              </svg>
                        </a>

                        <a href='../vue/remove.php?code=$article->codeArt' >
                            <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-trash-fill' viewBox='0 0 16 16'>
                                <path d='M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z'/>
                            </svg>
                        </a>
                    </ul>
               </div>
            </li>";
            }

            echo "   </ul>
                 </div>";
        }
    }


    public function  getAllArt($catID): void{
        $req = $this->DB->query("SELECT * FROM  article WHERE idCat = '{$catID}'");
        if(count($req) <= 0){

            echo '<div class="add_invitation">
                        <div class="a_content">
                        <a href="#" class="add_btn js_modalOpen">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-square-dotted" viewBox="0 0 16 16">
                            <path d="M2.5 0c-.166 0-.33.016-.487.048l.194.98A1.51 1.51 0 0 1 2.5 1h.458V0H2.5zm2.292 0h-.917v1h.917V0zm1.833 0h-.917v1h.917V0zm1.833 0h-.916v1h.916V0zm1.834 0h-.917v1h.917V0zm1.833 0h-.917v1h.917V0zM13.5 0h-.458v1h.458c.1 0 .199.01.293.029l.194-.981A2.51 2.51 0 0 0 13.5 0zm2.079 1.11a2.511 2.511 0 0 0-.69-.689l-.556.831c.164.11.305.251.415.415l.83-.556zM1.11.421a2.511 2.511 0 0 0-.689.69l.831.556c.11-.164.251-.305.415-.415L1.11.422zM16 2.5c0-.166-.016-.33-.048-.487l-.98.194c.018.094.028.192.028.293v.458h1V2.5zM.048 2.013A2.51 2.51 0 0 0 0 2.5v.458h1V2.5c0-.1.01-.199.029-.293l-.981-.194zM0 3.875v.917h1v-.917H0zm16 .917v-.917h-1v.917h1zM0 5.708v.917h1v-.917H0zm16 .917v-.917h-1v.917h1zM0 7.542v.916h1v-.916H0zm15 .916h1v-.916h-1v.916zM0 9.375v.917h1v-.917H0zm16 .917v-.917h-1v.917h1zm-16 .916v.917h1v-.917H0zm16 .917v-.917h-1v.917h1zm-16 .917v.458c0 .166.016.33.048.487l.98-.194A1.51 1.51 0 0 1 1 13.5v-.458H0zm16 .458v-.458h-1v.458c0 .1-.01.199-.029.293l.981.194c.032-.158.048-.32.048-.487zM.421 14.89c.183.272.417.506.69.689l.556-.831a1.51 1.51 0 0 1-.415-.415l-.83.556zm14.469.689c.272-.183.506-.417.689-.69l-.831-.556c-.11.164-.251.305-.415.415l.556.83zm-12.877.373c.158.032.32.048.487.048h.458v-1H2.5c-.1 0-.199-.01-.293-.029l-.194.981zM13.5 16c.166 0 .33-.016.487-.048l-.194-.98A1.51 1.51 0 0 1 13.5 15h-.458v1h.458zm-9.625 0h.917v-1h-.917v1zm1.833 0h.917v-1h-.917v1zm1.834-1v1h.916v-1h-.916zm1.833 1h.917v-1h-.917v1zm1.833 0h.917v-1h-.917v1zM8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3v-3z"/>
                            </svg>
                        </a>
                        <small>Ajouter un article !</small>
                        </div>
                    </div>';
        }else{
            echo "<div class='articles_container'>
                     <ul class='articles_list'>";
            foreach ($req as $article) {
                $valeur = ($article->prixArt)*($article->stock);
                echo "<li class='article_container'>
                <div class='article'>
                    <div class='article_img'>
                        <img src='./php/images/$article->pic' alt=''>
                    </div>
                    <div class='aricle_footer'>
                        <div class='article_info'>
                            <h4>$article->libArt | <span class='price'><img class='icon' src='icons/facture.png'> $article->prixArt f CFA</span></h4>
                            <p>
                                <img src='icons/stock.png' alt='' class='icon'> <small>En stock : $article->stock</small> <br>
                                <img src='icons/la-finance.png' class='icon' alt=''> <small>valeur total : $valeur f CFA</small>
                            </p>
                        </div>
                       
                    </div>
                    <ul>

                        <a href='#'>
                          <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-eye-fill' viewBox='0 0 16 16'>
                            <path d='M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z'/>
                            <path d='M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z'/>
                          </svg>
                        </a>

                        <a href='../vue/update.php?code=$article->codeArt'>
                            <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-pencil-square' viewBox='0 0 16 16'>
                                <path d='M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456l-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z'/>
                                <path fill-rule='evenodd' d='M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z'/>
                              </svg>
                        </a>

                        <a href='../vue/remove.php?code=$article->codeArt'>
                            <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-trash-fill' viewBox='0 0 16 16'>
                                <path d='M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z'/>
                            </svg>
                        </a>
                    </ul>
               </div>
            </li>";
            }

            echo "   </ul>
                 </div>";
        }
    }

    public function getArtInfo($code){
        $req = $this->DB->query("SELECT * FROM  article WHERE codeArt = '{$code}'");
        if(count($req) <= 0){
            echo 'Donneés corrompues !';
            header('location:../index.php');
        }else{
            foreach ($req as $infos) {
                $code = $infos->codeArt;
                $pic = $infos->pic;
                $lib = $infos->libArt;
                $price = $infos->prixArt;
                $stock = $infos->stock;
                $cat = $infos->idCat;
                $userMat = $infos->matUtil;
                $val = ($infos->prixArt)*($infos->stock);
            }

           $tab = [$code, $lib, $price, $stock, $pic, $userMat, $cat, $val];
           return $tab;
        }
    }

    public function removeArt($code){
        $this->DB->query("DELETE FROM article WHERE codeArt = '{$code}'");
        
            $info = 'success';
       
        return $info;
    }

    public function getValStock(){
        $req = $this->DB->query("SELECT prixArt, stock  FROM  article");
        $retour = [];
        $valeurGlob = 0;
        $stock = 0;
        foreach ($req as $val) {
            $stock += $val->stock;
            $valeurGlob += ($val->prixArt)*($val->stock);
        }
        $retour =  [$stock, $valeurGlob];
        return $retour;
    }


    public function updateArt($art_code, $art_lib, $art_price, $art_quantity, $art_category, $art_pic, $codeGetting){

        if(!empty($art_code) && !empty($art_lib) && !empty($art_price) && !empty($art_quantity)){
            if(is_int($art_price) && is_int($art_quantity) && $art_price > 0 && $art_quantity > 0){
                if(preg_match('#^[a-zA-Z]{2}[0-9]{3}#', $art_code)){
                    //$req = $this->DB->query("SELECT * FROM article WHERE codeArt = '{$art_code}'") ;
                    //if(count($req) <= 0){
                       if(is_array($art_pic)){
                            $pic_info  = self::cheickImage($art_pic);
                            if($pic_info !== 1){
        
                                $this->art_code = $art_code;
                                $this->art_lib = $art_lib;
                                $this->art_price = $art_price;
                                $this->art_quantity = $art_quantity;
                                $this->art_category = $art_category;
                        
        
                                $req = $this->DB->query("UPDATE  article SET codeArt = '{$this->art_code}', libArt = '{$this->art_lib}', prixArt = '{$this->art_price}', stock = '{$this->art_quantity}', idCat = '{$this->art_category}', pic = '{$pic_info}' WHERE codeArt = '{$codeGetting}'");
                                $info = "success";
                            }else{
                                $info = "Selectionner une image de type - jpeg, jpg, png";
                            }
                       }else{
                            $this->art_code = $art_code;
                            $this->art_lib = $art_lib;
                            $this->art_price = $art_price;
                            $this->art_quantity = $art_quantity;
                            $this->art_category = $art_category;
                           

                            $req = $this->DB->query("UPDATE  article SET codeArt = '{$this->art_code}', libArt = '{$this->art_lib}', prixArt = '{$this->art_price}', stock = '{$this->art_quantity}', idCat = '{$this->art_category}', pic = '{$art_pic}' WHERE codeArt = '{$codeGetting}'");
                            $info = "success"; 
                       }
                    //}else{
                        //$info = 'ce code est déjà attribuer a un autre article !';
                    //}
                }else{
                    $info = 'le code doit commencer par 2 lettres et finir par 3 chiffres ';
                }
            }else{
                $info = 'Le prix et le stock doivent être des entiers positifs !';
            }
        }else{
            $info = 'Tous les champs sont obligatoire !';
        }

        return $info;

    }
    
}

require_once 'db.class.php';
$DB = new DB();