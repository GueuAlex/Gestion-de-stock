const closeBtn = document.querySelector('.closeBtn');
const hiddenAfterClick = document.querySelector('.hidden_after_click');
const form = hiddenAfterClick.querySelector('.form');
const removeBtn = form.querySelector('.remove_btn');
const removeAlert = document.querySelector('.alert_remove');
const errorText = document.querySelector('.err_msg');


closeBtn.addEventListener('click', ()=>{
    location.href = "../index.php";
})

removeBtn.onclick = (e)=>{
    //Reccuperation en AJAX......................
    e.preventDefault();
    let xhr = new XMLHttpRequest(); // creation d'un objet XML
    xhr.open("POST", "../php/remove.php", true);
    xhr.onload = ()=>{
        if(xhr.readyState === XMLHttpRequest.DONE){
            if(xhr.status === 200){
                let data = xhr.response;
                if(data == "success"){
                    hiddenAfterClick.style.display = 'none';
                    removeAlert.style.display = 'block';
                  
                 
                }else{
                    errorText.textContent = data;
                    errorText.style.display = "block";
                }
            }
        }
    }

    // envoi des donneés a PHP par ajax.......
    let formData = new FormData(form); // nouvel objet formDate
    xhr.send(formData);//envoi des données a php
}


