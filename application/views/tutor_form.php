<div id="form-wrap">
	<?php
	$br = "<br>";

	echo form_open('form/submit'); ?>
	
	<table>
		<tr>
			<td>Student Name</td>
			<td><?php echo form_input('student','[pre-populated]'); ?></td>
		</tr>
		<tr>
			<td>Tutor</td>
			<td><?php echo form_input('tutor','[drop-down]'); ?></td>
		</tr>
		<tr>
			<td>Course</td>
			<td><?php echo form_input('course','[pre-populated]'); ?></td>
		</tr>
		<tr>
			<td colspan="2"><?php echo form_textarea('notes','notes'); ?></td>
		</tr>
	</table>
	<?php echo form_submit('submit','Submit'); ?>



</div>