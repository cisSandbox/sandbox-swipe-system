

<div class="form-container">
<form action="/index.php/form/submit" method="post">
<h1>The Tutor Form</h1>
<h6>Student</h6>
	<!-- cdc edit 05/28/2013 -->
	<input class="span2" name="studentHash" type="text" value="<?php if ($student) echo $student ?>"> 
	<!-- /cdc -->
	<span class="help-inline">
		<?php if($student_name): ?>
			<label class="label label-info">
				<?php echo $student_name[0]->firstName . " " . $student_name[0]->lastName ?>
			</label>
		<?php endif; ?>
	</span>

<h6>Course</h6>
<input class="span2" type="text" name="course" value="<?php echo $class ?>">
<h6>Section</h6>
<select name="block" class="span2">
	<?php foreach ($blocks as $b): ?>
		<option name="block" value="<?php echo $b->meetingID ?>" /><?php echo $b->block ?></option>
	<?php endforeach; ?>
</select>
<h6>Tutor</h6>
<select name="tutorID" id="" class="span3">
	<?php foreach ($tutors as $t): ?>
		<option name="tutor" value="<?php echo $t->tutorID ?>" /><?php echo $t->firstName . " " . $t->lastName ?></option>
	<?php endforeach; ?>
</select>
<h6>Notes</h6>
<textarea name="notes" id="" cols="30" rows="10"></textarea>
<hr>
<input type="submit" class="btn btn-primary" value="Submit" />
</form>
</div>

<!-- comment this line out to hide the strip at the bottom 
<link href="/assets/css/styles-mediaquery-reporter.css" type="text/css" rel="stylesheet" > 
-->
