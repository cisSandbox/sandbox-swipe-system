<div class="list">
	<table>
		<!-- header -->
		<tr>
			<th>Tapout</th>
			<th>Student</th>
		</tr>

		<?php foreach ($records as $v): ?> 
		<!-- echo a row for each student -->
		<tr>
			<td><?php echo anchor('index.php/visit/tapout/' . $v->studentID, 'Tapout', 'class = "btn"'); ?></td>
			<td><?php echo $v->firstName . " " . $v->lastName; ?></td>
		</tr>
	
		<?php endforeach; ?>
	</table>
</div>