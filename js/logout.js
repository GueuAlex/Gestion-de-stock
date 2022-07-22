const  logoutBnt = document.querySelector('.logout');

logoutBnt.addEventListener('click', ()=>{
    document.location.href = './php/logout.php';
})