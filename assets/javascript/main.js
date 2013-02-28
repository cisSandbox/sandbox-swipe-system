// reg input:   01234567
// swipe input: ;001234567;

/**
 *
 *	Javascript input parsing
 *	
 *	TODO:
 *	Real documentation here
 *	Clean up code - it's not very pretty or efficient - Conner, maybe you can do better?
 * 
 * 
 */

var input = "";
var reg   = new RegExp('^[0-9|;]+$');

function showStar() {
	$('.stars').append('<span class="star">*</span>');
}

function handleInput(e) {
	if(reg.test(String.fromCharCode(e.which))) {
		input += String.fromCharCode(e.which);
		console.log(String.fromCharCode(e.which));
		if(input.length == 8 && input.indexOf(';') === -1) {
			console.log(input);
			$('.stars').empty();
			alert("Login Successful");
		} else if(input.length == 10) {
			input = input.substring(2, input.length);
			console.log(input);
			$('.stars').empty();
			alert("Login Successful");
		} else {
			showStar();
		}
	}
}

$(document).ready(function(){
	$(window).keypress(function(e) {
		handleInput(e);
	});
});