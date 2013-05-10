<div class="list">
	<table class="table-striped">
		<!-- header -->
		<tr>
			<th>Tapout</th>
			<th>Student</th>
		</tr>

		<?php foreach ($records as $v): ?> 
		<!-- echo a row for each student -->
		<tr>
			<td><?php echo anchor('index.php/visit/tapout/' . $v->studentID, "I'm gone", 'class = "btn btn-danger grow"'); ?></td>
			<td><?php echo $v->firstName . " " . $v->lastName; ?></td>
		</tr>
	
		<?php endforeach; ?>
	</table>
</div>