<?php 

$slug = uri_segment(1);

if (!empty($slug))
{
	if($slug == strtolower("departments")){
		$alumni = fuel_model('alumni', array('where' => array('user_role.name' => uri_segment(2))));
	}
}
?>

<?php if(!empty($alumni)):?>
<div class=""><h2 class="sub-heading">Alumni: </h2></div>

<div class="panel panel-info">
                        <div class="panel-heading">
                           <strong>Alumnies of the Department :</strong> 
                        </div>
                        <!-- /.panel-heading -->
<div class="panel-body">
<div class="table-responsive">
	<table class="table table-striped">
	<thead>
		<tr>
			<th>Name </th>
			<th>Occupation</th>
			<th>Email</th>
			<th>City</th>
			<th>Degree</th>
			<th>Passing Year</th>

		</tr>
	</thead>
	<tbody>
<?php foreach($alumni as $item) : ?>
		<tr>
			<td><?php echo $item->name;?></td>
			<td><?php echo $item->occupation;?></td>
			<td><?php echo $item->email;?></td>
			<td><?php echo $item->city;?></td>
			<td><?php echo $item->degree;?></td>
			<td><?php echo $item->passing_year;?></td>

		</tr>
<?php endforeach; ?>
	</tbody>
</table>
</div>
	
</div>
</div>
<?php endif; ?>
