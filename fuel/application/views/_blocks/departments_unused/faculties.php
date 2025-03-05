<?php 

$slug = uri_segment(1);

if (!empty($slug))
{
	if($slug == strtolower("departments")){
		$faculties = fuel_model('faculties', array('where' => array('user_role.name' => uri_segment(2))));
	}
}
?>
<div class=""><h2 class="sub-heading">Faculty Members: </h2></div>
<div class="panel panel-info">
                        <div class="panel-heading">
                           <strong>Faculty Members:</strong> 
                        </div>
                        <!-- /.panel-heading -->
<div class="panel-body">
<div class="table-responsive">
	<table class="table table-striped">
	<thead>
		<tr>
			<th>Name</th>
			<th>Designation</th>
			<th>Specialization</th>
			<th>Contact</th>
			<th>eMail</th>
		</tr>
	</thead>
	<tbody>
<?php if(!empty($faculties)):?>
<?php foreach($faculties as $item) : ?>
		<tr>
			<td><?php echo $item->name;?></td>
			<td><?php echo $item->Designation;?></td>
			<td><?php echo $item->specialization;?></td>
			<td><?php echo $item->contact;?></td>
			<td><?php echo $item->email;?></td>
		</tr>
<?php endforeach; ?>
<?php else : ?>
		<tr>
			<td class="text-center" colspan="6">No recored to display</td>
		</tr>
<?php endif; ?>
	</tbody>
</table>
</div>
	
</div>
</div>
