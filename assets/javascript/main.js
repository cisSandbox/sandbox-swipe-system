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

	if (!window.location.origin) window.location.origin = window.location.protocol+"//"+window.location.host;

	$('#help').hide();
	$('#course-select').hide();

	var student = {
		id: "",
		name: "",
		timeIn: new Date(),
		course: "",
		needHelp: false,
		roomID: "SMI 234",
		tmp: "",
		addVisit: function() {
			$.ajax({
				url:  window.location.origin + "/index.php/main/add_student_visit",
				type: 'POST',
				data:  {
					"roomID":    this.roomID,
					"studentID": this.id,
					"courseID":  this.course,
					"timeIn":    this.timeIn,
					"needHelp":  this.needHelp
				},
				success: function(msg) {
					location.reload();
				}
			});
		},
		verifyStudent: function verifyStudent() {
			$.ajax({
				url:  window.location.origin + "/index.php/main/verify_student",
				type: 'POST',
				context: document.body,
				data:  {
					"id": this.id
				},
				success: function(name) {
					if(name != "error") {
						$('#wel-message').hide();
						$('#help').show();
						$('#help-wrapper h3').append('Do you want help today, ' + name + '?');
						this.name = name;
					} else {
						alert('student does not exist');
					}
				}
			});
		}
	};

	$(document).keypress(function(e) {
		var reg   = new RegExp('^[0-9|;]+$');
		// not totally tested, works fine on chrome on my Linux box, not working on chrome on my mac
		if(e.which == 8 && student.tmp.length > 0) {
			student.tmp = student.tmp.substring(0, student.tmp.length - 1);
			$('.stars span:last-child').remove();
		}
		if(reg.test(String.fromCharCode(e.which))) {
			student.tmp += String.fromCharCode(e.which);
			if(student.tmp.length == 8 && student.tmp.indexOf(';') === -1) {
				$('.stars').empty();
				student.id = student.tmp;
				student.verifyStudent();
				student.tmp = "";
			} else if(student.tmp.length == 12) {
				student.tmp = student.tmp.substring(2, student.tmp.length - 2);
				$('.stars').empty();
				student.id = student.tmp;
				student.verifyStudent();
				student.tmp = "";
			} else {
				$('.stars').append('<span class="star">*</span>');
			}
		}
	});

	$('.button').click(function() {
		student.needHelp = $(this).val();
		console.log(student.needHelp);
		if(student.needHelp == 'true') {
			$('#help').hide();
			$('#course-select').show();
		} else {
			student.addVisit();
		}
	});

	$('.button2').click(function() {
		student.course = $(this).val();
		console.log(student.course);
		student.addVisit();
	});

});