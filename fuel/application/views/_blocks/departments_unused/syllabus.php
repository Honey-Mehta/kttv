<?php 

$slug = uri_segment(1);

if (!empty($slug))
{
	if($slug == strtolower("departments")){
		$syllabus = fuel_model('syllabus', array('where' => array('user_role.name' => uri_segment(2))));
	}
}
?>

<?php if(!empty($syllabus)):?>
<div class=""><h2 class="sub-heading">Syllabus: </h2></div>
<div class="panel panel-default">
                        <div class="panel-heading">
                           <strong>Syllabus :</strong> 
                        </div>
                        <!-- /.panel-heading -->
<div class="panel-body">
<div class="table-responsive">
	<table class="table table-striped">
	<thead>
		<tr>
			<th>Course </th>
			<th>Syllabus</th>

		</tr>
	</thead>
	<tbody>
<?php foreach($syllabus as $item) : ?>
		<tr>
			<td><?php echo $item->headline;?></td>
			<td> <a href="<?php echo $item->link;?>">Download Syllabus</a> </td>
		</tr>
<?php endforeach; ?>
	</tbody>
</table>
</div>
	
</div>
</div>
<?php endif; ?>
