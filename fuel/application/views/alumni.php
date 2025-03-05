
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

		$alumni_list = fuel_model('alumni', array('where' => array('base_location' => 'departments/'.uri_segment(3)), 'limit' => $limit, 'offset' => $offset));

//		if (empty($alumni_list)) show_404(); 
	} else {
		show_404();
	}
}
else
{	

	$alumni_list = fuel_model('alumni', array('limit' => $limit, 'offset' => $offset));

}

?>

<?php fuel_set_var('page_title', ucwords('Alumni : APS University')); ?>
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
			<th>Occupation</th>			
			<th>City</th>
			<th>eMail</th>
			<th>Passing Year</th>
			<th>Department</th>
		</tr>
	</thead>
	<tbody>
<?php if(!empty($alumni_list)):?>
<?php foreach($alumni_list as $item) : ?>
	<?php $offset++; ?>
		<tr>
			<td><?php echo $offset;?></td>
			<td><?php echo $item->name;?></td>
			<td><?php echo $item->occupation;?></td>
			<td><?php echo $item->city;?></td>
			<td><?php echo $item->email ? str_replace(['@', '.'], ['[at]', '[dot]'], $item->email) : '--';?></td>
			<td><?php echo $item->passing_year;?></td>
			<td><?php echo $item->Department;?></td>
		</tr>
<?php endforeach; ?>
<?php else : ?>
		<tr>
			<td class="text-center" colspan="7">No recored to display</td>
		</tr>
<?php endif; ?>
	</tbody>
</table>
</div>
	
</div>

<?php 
    $CI->load->library('pagination');
    $total_rows = $CI->db->get('tbl_alumni')->num_rows();
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
		  window.location.href = "/alumni/" + value;
		}

</script>