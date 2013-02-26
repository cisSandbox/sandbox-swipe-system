var input = "";
var reg   = new RegExp('^[0-9]+$');

function showStar() {
	$('.stars').append('<span class="star">*</span>');
}

function handleInput(e) {
	if(reg.test(String.fromCharCode(e.which))) {
		input += String.fromCharCode(e.which);
		console.log(input);
		console.log(e.which);
		if(input.length == 8) {
			console.log(input);
			$('.stars').empty();
			alert("Login Successful");
		} else {
			//input += String.fromCharCode(e.which);
			showStar();
		}

	}
}

$(document).ready(function(){
	$(window).keypress(function (e) {
		handleInput(e);
	});
});