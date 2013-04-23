<div class="list">
	<table>
		<!-- header -->
	<thead>
		<tr>
			<th>Tutor Form</th>
			<th>Student</th>
			<th>Class</th>
			<th>Arrival</th>
		</tr>
	</thead>
	<tbody id="students">
		<?php foreach ($records as $v): ?> 
		<!-- echo a row for each student -->
		<tr>
			<td><?php echo anchor('index.php/form/fill_out/' . $v->studentID . '/' . $v->courseID,'Tutor Form', 'class = "btn"'); ?></td>
			<td><?php echo $v->firstName . " " . $v->lastName; ?></td>
			<td><?php echo $v->courseID; ?></td>
			<td><?php echo $v->timeIn; ?></td>
		</tr>
	
		<?php endforeach; ?>
	</tbody>
	</table>
</div>
<script type="text/javascript">

</script>