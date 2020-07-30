
/*var user_icon =document.querySelector('.user-nav__icon');

user_icon.addEventListener("click", function(e) {
	var user_menu= document.querySelector('.user-nav__menu');
	user_menu.classList.toggle('_active');
	console.log("click");
});
//по клику мимо закрой панельку
document.documentElement.addEventListener('click', function(e){
if(!e.target.closest('.user-nav')){
	var user_menu= document.querySelector('.user-nav__menu');
	user_menu.classList.remove('_active');
}
});*/

var icon__menu =document.querySelector('.icon__menu');
icon__menu.addEventListener("click", function(e) {
	var nav__menu= document.querySelector('.nav__menu');
	nav__menu.classList.toggle('_active');
	var menu__body= document.querySelector('.menu__body');
	menu__body.classList.toggle('_active');
});