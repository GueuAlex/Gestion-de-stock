const form = document.querySelector(".form"),
continueBtn = form.querySelector(".button"),
errorText = form.querySelector(".err_msg");

form.onsubmit =(e)=>{
    e.preventDefault(); //annul l'action par defaut de la soumission
}

continueBtn.onclick = ()=>{
    //Reccuperation en AJAX......................
    let xhr = new XMLHttpRequest(); // creation d'un objet XML
    xhr.open("POST", "../php/signup.php", true);
    xhr.onload = ()=>{
        if(xhr.readyState === XMLHttpRequest.DONE){
            if(xhr.status === 200){
                let data = xhr.response;
                if(data == "success"){
                   location.href = "../index.php";
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