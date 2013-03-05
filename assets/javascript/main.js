// reg input:   01234567
// swipe input: ;00123456701;

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

$(document).ready(function(){

	function sendSubmission(id) {
		if (!window.location.origin) window.location.origin = window.location.protocol+"//"+window.location.host;
		$.ajax({
			url:  window.location.origin + "/index.php/main/check_student",
			type: 'POST',
			context: document.body,
			data:  {
				"id": id
			},
			success: function(name) {
				alert("Welcome " + name);
			}
		});
	}

	var input = "";
	var reg   = new RegExp('^[0-9|;]+$');

	$(document).keypress(function(e) {
		// not totally tested, works fine on chrome on my Linux box, not working on chrome on my mac
		if(e.which == 8 && input.length > 0) {
			input = input.substring(0, input.length - 1);
			$('.stars span:last-child').remove();
		}
		if(reg.test(String.fromCharCode(e.which))) {
			input += String.fromCharCode(e.which);
			if(input.length == 8 && input.indexOf(';') === -1) {
				$('.stars').empty();
				sendSubmission(input);
				input = "";
			} else if(input.length == 12) {
				input = input.substring(2, input.length - 2);
				$('.stars').empty();
				sendSubmission(input);
				input = "";
			} else {
				$('.stars').append('<span class="star">*</span>');
			}
		}
	});

});