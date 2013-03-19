

<div class="form-container">
<h1>The Tutor Form</h1>
<h6>Student</h6>
<input name="student_name" type="text" value="<?php if ($student) echo $student ?>"> <br>
<?php if($student_name): ?>
<label class="info"><?php echo $student_name[0]->firstName . " " . $student_name[0]->lastName ?></label>
<?php endif; ?>
<h6>Course</h6>
<input type="text" name="course_tutored" value="<?php echo $class ?>">
<h6>Section</h6>
<select>
	
</select>
<h6>Tutor</h6>
<select name="" id="">
	<?php foreach ($tutors as $t): ?>
		<option name="tutor" value="<?php echo $t->tutorID ?>" /><?php echo $t->firstName . " " . $t->lastName ?></option>
	<?php endforeach; ?>
</select>
<h6>Notes</h6>
<textarea name="" id="" cols="30" rows="10"></textarea>
</div>

<!-- comment this line out to hide the strip at the bottom 
<link href="/assets/css/styles-mediaquery-reporter.css" type="text/css" rel="stylesheet" > 
-->
