<div class="list">
	<table class="table-striped">
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
		
		<tr>
			<!-- -- cdc edit 05/28/2013 -- -->
			<td><?php echo anchor('index.php/form/fill_out/' . $v->studentHash . '/' . $v->courseID,'<i class="icon-pencil icon-white"></i>', 'class = "btn btn-primary"'); ?></td>
			<!-- /cdc -->
			<td><?php echo $v->firstName . " " . $v->lastName; ?></td>
			<td><?php echo $v->courseID; ?></td>
			<td>
				<?php 
					$date = new \DateTime($v->timeIn);
					$interval = $date->diff(new \DateTime('now'));
					echo $interval->format('%i minutes ago') . '<br>';
				?>
			</td>
		</tr>
	
		<?php endforeach; ?>
	</tbody>
	</table>
</div> 
<script type="text/javascript">

</script>

