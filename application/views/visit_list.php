<div id="list">
	<table>
		<!-- header -->
		<tr>
			<th>Tutor Form</th>
			<th>Student</th>
			<th>Class</th>
			<th>Arrival</th>
		</tr>

		<?php foreach ($records as $v): ?> 
		<!-- echo a row for each student -->
		<tr>
			<td>Tutor Form<!-- eventually, this will be a button for tutors to get to the tutor form. --></td>
			<td><?php echo $v->firstName . " " . $v->lastName; ?></td>
			<td><?php echo $v->courseID; ?></td>
			<td><?php echo $v->timeIn; ?></td>
		</tr>
	
		<?php endforeach; ?>
	</table>
</div>