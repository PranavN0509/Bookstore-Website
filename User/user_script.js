let toggleBtn = document.getElementById('toggle-btn');
let body = document.body;
let darkMode = localStorage.getItem('dark-mode');

const enableDarkMode = () =>{
   toggleBtn.classList.replace('fa-sun', 'fa-moon');
   body.classList.add('dark');
   localStorage.setItem('dark-mode', 'enabled');
}

const disableDarkMode = () =>{
   toggleBtn.classList.replace('fa-moon', 'fa-sun');
   body.classList.remove('dark');
   localStorage.setItem('dark-mode', 'disabled');
}

if(darkMode === 'enabled'){
   enableDarkMode();
}

toggleBtn.onclick = (e) =>{
   darkMode = localStorage.getItem('dark-mode');
   if(darkMode === 'disabled'){
      enableDarkMode();
   }else{
      disableDarkMode();
   }
}

let profile = document.querySelector('.header .profile');

document.querySelector('#user-btn').onclick = () =>{
   profile.classList.toggle('active');
   search.classList.remove('active');
}

let search = document.querySelector('.header .search-show');
document.querySelector('.header #live_search').onclick = () =>{
   search.classList.toggle('active');
   sideBar.classList.remove('active');
   profile.classList.remove('active');
}


let sideBar = document.querySelector('.side-bar');

document.querySelector('#menu-btn').onclick = () =>{
   let menubutton = document.getElementById('menu-btn');
   sideBar.classList.toggle('active');
   // body.classList.toggle('active');
   menubutton.classList.replace('fas fa-bars','fa-solid fa-x');
}

window.onscroll = () =>{
   profile.classList.remove('active');
   search.classList.remove('active');

   if(window.innerWidth < 10000){
      sideBar.classList.remove('active');
      body.classList.remove('active');
   }
}

var Indexvalue = 1;
function showImg(e){
   var i;
   const img = document.querySelectorAll('.Home .bookslider .images img');
   const sliders = document.querySelectorAll('.butn-sliders span');
   if(e>img.length){Indexvalue = 1}
   if(e<1){Indexvalue = img.length}
   for(i=0; i < img.length; i++){
      img[i].style.display = "none";
   }
   for(i=0; i < sliders.length; i++){
      sliders[i].style.background = "rgba(255,255,255,0.1)";
   }
   img[Indexvalue-1].style.display = "block";
   sliders[Indexvalue-1].style.background = "white";
   console.log(Indexvalue);

}

showImg(Indexvalue);
function butn_slide(e){showImg(Indexvalue = e);}
function side_slide(e){showImg(Indexvalue += e);}




// function Homedisplay(){
//    let home = document.querySelector('.Home');
//    let shop = document.querySelector('.shop');
//    home.classList.remove('active');
//    shop.classList.remove('active');
//    orders.classList.remove('active');
//    cart.classList.remove('active') 
// }

// function Shopdisplay(){
//    let home = document.querySelector('.Home');
//    let shop = document.querySelector('.shop');
//    shop.classList.add('active'); 
//    home.classList.add('active');
//    cart.classList.remove('active') 
//    orders.classList.remove('active');
// }

// function Ordersdisplay(){
//    let home = document.querySelector('.Home');
//    let shop = document.querySelector('.shop');
//    let orders = document.querySelector('.orders')
//    home.classList.add('active');
//    shop.classList.remove('active');
//    orders.classList.add('active');
//    cart.classList.remove('active') 
// }

// function Cartdisplay(){
//    let home = document.querySelector('.Home');
//    let shop = document.querySelector('.shop');
//    let orders = document.querySelector('.orders');
//    let cart = document.querySelector('.cart');
//    home.classList.add('active');
//    shop.classList.remove('active');
//    orders.classList.remove('active'); 
//    cart.classList.add('active');

// }
