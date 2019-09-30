$(window).ready(function(){
	/*navFixedControl();*/
});
/*function navFixedControl() {
	var altura = $('#navbar').offset().top;
	$(window).on('scroll',function(){
	  if ($(window).scrollTop() > altura) {
	    $('#navbar').addClass('fixed-top');
	  }else{
	    $('#navbar').removeClass('fixed-top');
	  }
	});
}*/
$("#search-button").click(function(e){
	$("#search-form").show();
	$("#search-form")[0].children[0][0].focus();
	e.stopPropagation();
	e.preventDefault();
	$("#user-dropdown").hide();
});
$("#search-form").click(function(e){
	e.stopPropagation();
});
$(document).click(function(){
	$("#search-form").hide();
	$("#user-dropdown").hide();
});
$("#navbarDropdownMenuLink").click(function(){
	$("#search-form").hide();
	$("#user-dropdown").show();
});
// Variable booleana para mostrar u ocultar menu
let showMenu = false;

function switchMenu(e) {
	if (showMenu) {
		$('#header-master').animate({
			'right' : '100%'
		});
		e.classList.remove('fa-times');
		e.classList.add('fa-bars');
		showMenu = false;

	}else{
		$('#header-master').animate({
			'right' : 0
		});
		e.classList.remove('fa-bars');
		e.classList.add('fa-times');
		showMenu = true;
	}
}