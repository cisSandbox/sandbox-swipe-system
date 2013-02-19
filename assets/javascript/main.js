var input = "";

function showStar() {
	$('.stars').append('<span class="star">*</span>');
}

function handleInput(e) {
	var reg   = new RegExp('^[0-9]+$');
	if(input.length < 8 && reg.test(String.fromCharCode(e.which))) {
		input += String.fromCharCode(e.which);
		showStar();
	}
}

$(document).ready(function(){
	$(window).keypress(function (e) {
		handleInput(e);
	});
});