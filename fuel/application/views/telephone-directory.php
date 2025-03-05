
<?php 
$path = uri_path();
$slug = uri_segment(2);

$offset = $this->input->get('offset') ? $this->input->get('offset'): 0;
$limit = 10;

if(uri_segment(3))
{
	$Req_dept = fuel_model('user_role',array('where' => array('base_location' => 'departments/'.uri_segment(3))));
	
	if (empty($Req_dept)) show_404();
}

$dept = fuel_model('user_role');


if (!empty($slug))
{

	if($slug == strtolower("departments")){

		$directory = fuel_model('telephone_directory', array('where' => array('base_location' => 'departments/'.uri_segment(3)), 'limit' => $limit, 'offset' => $offset));

//		if (empty($directory)) show_404(); 
	} else {
		show_404();
	}
}
else
{	

	$directory = fuel_model('telephone_directory', array('limit' => $limit, 'offset' => $offset));

}

?>

<?php fuel_set_var('page_title', ucwords('Telephone directory')); ?>
<div class="">

<div class="row">
	<div class="col-xs-9">
		<small>Department: <?php echo (uri_segment(3) ? ucwords(str_replace('-',' ', uri_segment(3))):'All' ); ?></small> 
	</div>
	<div class="col-xs-3 pull-right">
		<select id="filterDept" onchange="filter_department(this.value);" class="form-control input-sm col-xs-2">
			<option value="">Filter by Department</option>
			<?php if(!empty($dept)):?>
				<?php foreach($dept as $item) : ?>
					<option value="<?php echo $item->base_location;?>"><?php echo $item->name;?></option>
				<?php endforeach; ?>
			<?php endif; ?>
		</select>
	</div>	
</div>
<hr>
<div class="table-responsive">
	<table class="table table-striped">
	<thead>
		<tr>
			<th>S.No.</th>
			<th>Name</th>
			<th>Designation</th>
			<th>Department</th>
			<th>Contact</th>
			<th>eMail</th>
		</tr>
	</thead>
	<tbody>
<?php if(!empty($directory)):?>
<?php foreach($directory as $item) : ?>
	<?php $offset++; ?>
		<tr>
			<td><?php echo $offset;?></td>
			<td><?php echo $item->name;?></td>
			<td><?php echo $item->Designation;?></td>
			<td><?php echo $item->Department;?></td>
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

<?php 
    $CI->load->library('pagination');
    $total_rows = $CI->db->get('telephone_directory')->num_rows();
    $config['base_url'] = base_url($path.'?');
    $config['total_rows'] = $total_rows;
    $config['per_page'] = $limit;
    $config['num_links'] = 4;
    $config['first_link'] = 'First';
    $config['last_link'] = 'Last';


    $CI->pagination->initialize($config);

    echo $CI->pagination->create_links();

?>


<script>
  		function filter_department(value) {
		  window.location.href = "/telephone-directory/" + value;
		}

</script>