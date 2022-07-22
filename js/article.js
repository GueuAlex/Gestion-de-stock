const form = document.querySelector(".form"),
continueBtn = form.querySelector(".button"),
errorText = document.querySelector(".err_msg");
const alert = document.querySelector('.succes');
const titre = document.querySelector('.titre');

titre.innerHTML = 'Ajouter un article';

form.onsubmit =(e)=>{
    e.preventDefault(); //annul l'action par defaut de la soumission
}

continueBtn.onclick = ()=>{
    //Reccuperation en AJAX......................
    let xhr = new XMLHttpRequest(); // creation d'un objet XML
    xhr.open("POST", "./php/traitement_art.php", true);
    xhr.onload = ()=>{
        if(xhr.readyState === XMLHttpRequest.DONE){
            if(xhr.status === 200){
                let data = xhr.response;
                if(data == "success"){
                    errorText.style.display = "none";
                    form.style.display = 'none';
                    titre.innerHTML = 'Article ajouter avec succes ';
                    titre.style.color = '#00c431';
                    alert.style.display = 'flex';
                  
                 
                }else{
                    errorText.textContent = data;
                    errorText.style.display = "flex";
                }
            }
        }
    }

    // envoi des donneés a PHP par ajax.......
    let formData = new FormData(form); // nouvel objet formDate
    xhr.send(formData);//envoi des données a php
}