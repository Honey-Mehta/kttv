<?php 

$slug = uri_segment(1);

if (!empty($slug))
{
	if($slug == strtolower("departments")){
		$courses = fuel_model('courses', array('where' => array('user_role.name' => uri_segment(2))));
	}
}
?>

<?php if(!empty($courses)):?>
<div class=""><h2 class="sub-heading">Course Details: </h2></div>

<?php foreach($courses as $item) : ?>

<div class="row">
<div class="col-md-2"></div>

<div class="text-left table-responsive">
	<table  class="table-striped table-bordered courses">
	<thead>
		<tr>
			<th colspan="2">Course Name : <?php echo $item->course_name;?></th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td style="width: 200px">Type</td>
			<td style="width: 400px"><?php echo $item->course_type;?></td>
		<tr>
			<td>Duration</td>
			<td><?php echo $item->duration;?></td>
		</tr>
		<tr>
			<td>Eligibility</td>
			<td><?php echo $item->eligibility;?></td>
		</tr>	
			
		<tr>
			<td>Subject</td>
			<td><?php echo $item->subject;?></td>
			
		</tr>
		<tr>
			<td>Available Seat</td>
			<td><?php echo $item->available_seat;?></td>
			
		</tr>
		<tr>
			<td>Admission Mode</td>
			<td><?php echo $item->admission_mode;?></td>
			
		</tr>
		<tr>
			<td>Study Mode</td>
			<td><?php echo $item->mode;?></td>
			
		</tr>
	</tbody>
</table>
</div>
</div>
<br>
<?php if(!empty($item->course_OUTLINE)) echo '<h4 class="sub-heading">COURSE OUTLINE ('.$item->course_name.'): </h4>'. $item->course_OUTLINE ;?>
<br>
<br>
<?php endforeach; ?>
<?php endif; ?>
