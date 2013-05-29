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
			<!-- cdc edit 05/28/2013 -->
			<td><?php echo anchor('index.php/visit/tapout/' . $v->studentHash, "I'm gone", 'class = "btn btn-danger grow"'); ?></td>
			<!-- /edit -->
			<td><?php echo $v->firstName . " " . $v->lastName; ?></td>
		</tr>
	
		<?php endforeach; ?>
	</table>
</div>