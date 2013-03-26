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
		course: "",
		needHelp: 0,
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
						alert('student does not exist or student is currently signed in');
					}
				}
			});
		},
		getCourses: function getCouses() {
			$.ajax({
				url:  window.location.origin + "/index.php/main/get_courses",
				type: 'POST',
				dataType: 'json',
				context: document.body,
				success: function(courses) {
					//console.log(courses[1].courseID);
					for (var i = courses.length - 1; i >= 0; i--) {
						$('#course-list').append('<input class="button2" type="button" value="'+ courses[i].courseID +'"/>');
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
		if($(this).val() == 'true') {
			student.needHelp = 1;
			$('#help').hide();
			student.getCourses();
			$('#course-select').show();
		} else {
			student.addVisit();
		}
	});

	$('#course-list').on('click', '.button2', function() {
		student.course = $(this).val();
		student.addVisit();
	});

});