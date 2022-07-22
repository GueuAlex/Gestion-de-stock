const closeBtn = document.querySelector('.closeBtn');
closeBtn.addEventListener('click', ()=>{
    document.location.href = '../index.php';
})


const form = document.querySelector('.form');
const submitBtn = form.querySelector('.submitBtn');
const alertUpdate = document.querySelector('.update');
const errorText = document.querySelector('.err_msg');

submitBtn.onclick = (e)=>{
    //Reccuperation en AJAX......................
    e.preventDefault();
    let xhr = new XMLHttpRequest(); // creation d'un objet XML
    xhr.open("POST", "../php/update.php", true);
    xhr.onload = ()=>{
        if(xhr.readyState === XMLHttpRequest.DONE){
            if(xhr.status === 200){
                let data = xhr.response;
                if(data == "success"){
                    form.style.display = 'none';
                    alertUpdate.style.display = 'block';
                    errorText.style.display = 'none';
                  
                 
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