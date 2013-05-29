<!-- new
<div class="list">
	
	header
	<div class="row-fluid page-header">
		<div class="span3 text-center">Tutor Form</div>
		<div class="span3 text-center">Student</div>
		<div class="span3 text-center">Class</div>
		<div class="span3 text-center">Arrival</div>
	</div>
	/head
	content
	<?php foreach ($records as $v): ?> 
	echo a row for each student
	<div class="row-fluid">
		<div class="span3 text-center"><?php echo anchor('index.php/form/fill_out/' . $v->studentID . '/' . $v->courseID,'Tutor Form', 'class = "btn btn-primary"'); ?></div>
		<div class="span3 text-center"><?php echo $v->firstName . " " . $v->lastName; ?></div>
		<div class="span3 text-center"><?php echo $v->courseID; ?></div>
		<div class="span3 text-center">
			<?php 
				$date = new \DateTime($v->timeIn);
				$interval = $date->diff(new \DateTime('now'));
				echo $interval->format('%i minutes ago') . '<br>';
			?>
		</div>
	</div>
	<?php endforeach; ?>
	/content
</div> 
/new -->




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

