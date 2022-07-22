
/**********************************************
            onglets   
**********************************************/

(function(){
    var afficherOnglet = function(a){
        var li = a.parentNode;
            var div = a.parentNode.parentNode.parentNode.parentNode;

            if(li.classList.contains('active')){
                return false;
            }
            //on retire la active de l,onglet actif
            div.querySelector('.tabs .active').classList.remove('active');
            //on ajoute la class active a l,onglet actuel 
            li.classList.add('active');

            //on retire la classs active sur le contenu actif
            div.querySelector('.tab-content.active').classList.remove('active');

            //on ajoute class active sur le contenu correpondant a mon clic

            div.querySelector(a.getAttribute('href')).classList.add('active');

    }

    var tabs = document.querySelectorAll('.tabs a');
    for(var i=0; i < tabs.length; i++){
        tabs[i].addEventListener('click', function(e){

           afficherOnglet(this);

        })
    }

    var hash = window.location.hash;
    var a = document.querySelector('a[href="'+ hash +'"]');
    if(a !== null && !a.parentNode.classList.contains('active')){
            afficherOnglet(a)
    } var afficherOnglet = function(a){
        var li = a.parentNode;
            var div = a.parentNode.parentNode.parentNode.parentNode;

            if(li.classList.contains('active')){
                return false;
            }
            //on retire la active de l,onglet actif
            div.querySelector('.tabs .active').classList.remove('active');
            //on ajoute la class active a l,onglet actuel 
            li.classList.add('active');

            //on retire la classs active sur le contenu actif
            div.querySelector('.tab-content.active').classList.remove('active');

            //on ajoute class active sur le contenu correpondant a mon clic

            div.querySelector(a.getAttribute('href')).classList.add('active');

    }

    var tabs = document.querySelectorAll('.tabs a');
    for(var i=0; i < tabs.length; i++){
        tabs[i].addEventListener('click', function(e){

           afficherOnglet(this);

        })
    }

    var hash = window.location.hash;
    var a = document.querySelector('a[href="'+ hash +'"]');
    if(a !== null && !a.parentNode.classList.contains('active')){
            afficherOnglet(a)
    }
   })();


/**********************************************
            permission   
**********************************************/

/* const lien = document.querySelectorAll('a.rien');

lien.addEventListener('click', (e)=>{
    e.preventDefault();
    alert("Vous n'avez pas cette permission !");
}) */

/**********************************************
            modal    
**********************************************/
const modal = document.querySelector('.modal');
const closeBtn = document.querySelector('.closeBtn');
const OpenModal = document.querySelectorAll('a.js_modalOpen');
const modalWrapper = document.querySelector('.modal_wrapper');


modal.style.display = 'none';
closeBtn.addEventListener('click', ()=>{
    modal.style.display = 'none'
    location.href = "index.php";
})

OpenModal.forEach(element => {
    element.addEventListener('click', (e)=>{
        e.preventDefault();
        modal.style.display = 'block';
    
    })
});




/**********************************************
            Typewriter js    
**********************************************/
const textAnim = document.querySelector('.typeWriting');
new Typewriter(textAnim, {
    deleteSpeed: 40
})
  .changeDelay(40)
  .typeString('gerer les stocks de : ')
  .pauseFor(600)
  .typeString('<span style="color:#ffbb00; text-decoration:underline;">vetements</span> !')
  .pauseFor(1000)
  .deleteChars(11)
  .typeString('<span style="color:#0044ff; text-decoration:underline;">Téléphones</span> !')
  .pauseFor(1000)
  .deleteChars(12)
  .typeString('<span style="color:#eb1010; text-decoration:underline;">Chaussures</span> !')
  .pauseFor(1000)
  .deleteChars(12)
  .typeString('<span style="color:#b8b2b0; text-decoration:underline;">Ordi</span> !')
  .pauseFor(1000)
  .deleteChars(6)
  .typeString('<span style="color:#ff7300; text-decoration:underline;">Voitures</span> !')
  .pauseFor(1000)
  .deleteChars(10)
  .deleteChars(24)
  .start()








  
  