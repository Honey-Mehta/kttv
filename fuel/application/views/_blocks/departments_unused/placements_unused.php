<?php 

$slug = uri_segment(1);

if (!empty($slug))
{
	if($slug == strtolower("departments")){
		$placements = fuel_model('placements', array('where' => array('user_role.name' => uri_segment(2))));
	}
}
?>

<?php if(!empty($placements)):?>
<div class=""><h2 class="sub-heading">Placement: </h2></div>
<div class="panel panel-warning">
                        <div class="panel-heading">
                           <strong>Students Placement from the Department :</strong> 
                        </div>
                        <!-- /.panel-heading -->
<div class="panel-body">
<div class="table-responsive">
	<table class="table table-striped">
	<thead>
		<tr>
			<th>Name </th>
			<th>Post</th>
			<th>Firm</th>
			<th>Email</th>
			<th>City</th>
			<th>Degree</th>
			<th>Passing Year</th>

		</tr>
	</thead>
	<tbody>
<?php foreach($placements as $item) : ?>
		<tr>
			<td><?php echo $item->name;?></td>
			<td><?php echo $item->post;?></td>
			<td><?php echo $item->firm_name;?></td>
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
