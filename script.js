//-------SLIDE SHOW DELLE AUTO-------
$(document).ready(function(){
    
});

$(".my-car").slick({
  autoplay: true,
  speed: 1000,
  dots: true,
  customPaging : function(slider, i) {
  var thumb = $(slider.$slides[i]).data();
  return '<a>'+(i+1)+'</a>';
},

});
//----------------------------------


//-------LOGIN POPUP FORM-------
function scrollOFF() {
  document.body.classList.add("no-scroll");
}

function scrollON() {
  document.body.classList.remove("no-scroll");
}

function opacityModeON() {
  document.querySelector(".overlay").classList.remove('hidden');
}

function opacityModeOFF() {
  document.querySelector(".overlay").classList.add('hidden');
}

function openLogForm() {
  opacityModeON();
  scrollOFF();
  document.getElementById("Login").style.display = "block";
}
  
function closeLogForm() {
  document.getElementById("Login").style.display = "none";
  opacityModeOFF();
  scrollON();
}

const loga = document.querySelector("#accedi");
loga.addEventListener('click', openLogForm);

const logb = document.querySelector(".accedi-btn");
logb.addEventListener('click', openLogForm);

const cancelbtn = document.querySelector(".cancel");
console.log(cancelbtn);
cancelbtn.addEventListener('click', closeLogForm);
//----------------------------------


//-------LOGIN POPUP-------

//----------------------------------

//-------LOGIN POPUP FORM-------
//----------------------------------
