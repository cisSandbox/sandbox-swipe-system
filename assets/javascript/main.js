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
		if(input.length == 8 && input.indexOf(';') === -1) {
			$('.stars').empty();
			sendSubmission(input);
			input = "";
		} else if(input.length == 10) {
			input = input.substring(2, input.length);
			$('.stars').empty();
			sendSubmission(input);
			input = "";
		} else {
			showStar();
		}
	}
}

function sendSubmission(id) {
	if (!window.location.origin) window.location.origin = window.location.protocol+"//"+window.location.host;
	$.ajax({
		url:  window.location.origin + "/index.php/main/check_student",
		type: 'POST',
		data:  {
			"id": id
		},
		success: function(msg) {
			alert(msg);
		}
	});
}

$(document).ready(function(){
	$(window).keypress(function(e) {
		handleInput(e);
	});
});