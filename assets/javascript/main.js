var input = "";
var reg   = new RegExp('^[0-9]+$');

function showStar() {
	$('.stars').append('<span class="star">*</span>');
}

function handleInput(e) {
	if(input.length < 8 && reg.test(String.fromCharCode(e.which))) {
		if(input.length == 7) {
			$('.stars').empty();
			alert("Login Successful");
		} else {
			input += String.fromCharCode(e.which);
			showStar();
		}
	}
}

$(document).ready(function(){
	$(window).keypress(function (e) {
		handleInput(e);
	});
});