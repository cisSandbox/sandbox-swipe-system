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
	$('#tutorbutton').hide();

	var student = {
		id: "",
		name: "",
		course: "",
		needHelp: 0,
		roomID: "SMI 234",
		tmp: "",
		tutorID: "",
		addVisit: function() {
			$.ajax({
				url:  window.location.origin + "/index.php/main/add_student_visit",
				type: 'POST',
				context: document.body,
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
		addWorkVisit: function() {
			$.ajax({
				url:  window.location.origin + "/index.php/main/add_work_visit",
				type: 'POST',
				context: document.body,
				data:  {
					"tutorID": this.tutorID
				},
				success: function(msg) {
					location.reload();
				}
			});
		},
		verifyStudent: function() {
			$.ajax({
				url:  window.location.origin + "/index.php/main/verify_student",
				type: 'POST',
				dataType: 'json',
				context: document.body,
				data:  {
					"id": this.id
				},
				success: function(person) {
					if(person) {
						student.name = person.query_result[0].firstName + ' ' + person.query_result[0].lastName;
						$('#wel-message').hide();
						$('#help').show();
						if(person.is_tutor) {
							student.tutorID = person.is_tutor[0].tutorID;
							/* ----------
								EDIT: CC 3/28/2013
								--> show three evenly spaced buttons if the student is a tutor
								EDIT: CC 5/8/2013
								--> bootstrap
								---------- */
							$('.row button').attr('class','span4 btn btn-large btn-primary');
							$('#tutorbutton').attr('class','span4 btn btn-large btn-danger');
							/* --- /edit --- */
							$('#help-wrapper h3').append('Do you want help today, ' + student.name + '? Or, are you here to tutor?');
							$('#tutorbutton').show();

						} else {
							$('#help-wrapper h3').append('Do you want help today, ' + student.name + '?');
						}
					} else {
						alert('student does not exist or student is currently signed in');
					}
				}
			});
		},
		getCourses: function() {
			$.ajax({
				url:  window.location.origin + "/index.php/main/get_courses",
				type: 'POST',
				dataType: 'json',
				context: document.body,
				success: function(courses) {
					//console.log(courses[1].courseID);
					var content = '';
					for (var i = 0; i < courses.length; i++) {
						/* ---------- 
						EDIT: CC5/8/2013
						--> added row-fluid for each row of six buttons

						EDIT: NH 5/9/2013
						--> fixed row display for buttons with twitter bootstrap
						---------- */

						if(i === 0) {
							content += '<div class="row row-mod"><button class="span2 btn-large btn-info" type="button" value="'+courses[i].courseID+'">'+ courses[i].courseID +'</button>';
						} else if(i % 6 === 0) {
							content += '</div><div class="row row-mod"><button class="span2 btn-large btn-info" type="button" value="'+courses[i].courseID+'">'+ courses[i].courseID +'</button>';
						} else if(i === courses.length-1) {
							content += '</div>';
						} else {
							content += '<button class="span2 btn-large btn-info" type="button" value="'+courses[i].courseID+'">'+ courses[i].courseID +'</button>';
						}

					}
					$('#course-list').append(content);
				}
			});
		}
	};

	$(document).keypress(function(e) {
		var reg   = new RegExp('^[0-9|;]+$');
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

	$('#swipe-in button').click(function() {
		if($(this).val() == 'true') {
			student.needHelp = 1;
			$('#help').hide();
			student.getCourses();
			$('#course-select').show();
		} else if ($(this).val() == 'false'){	// EDIT: CC 3/28/2013
			student.addVisit();					// --> made (else if) so tutors don't get added 
		}										// to tapout when they are here to work
	});

	$('#tutorbutton').click(function() {
		student.addWorkVisit();
	});

	$('#course-list').on('click', '.span2', function() {
		student.course = $(this).val();
		student.addVisit();
	});

});