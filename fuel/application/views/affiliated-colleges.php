
<?php 
$path = uri_path();
$slug = uri_segment(2);

$offset = $this->input->get('offset') ? $this->input->get('offset'): 0;
$limit = 10;

if(uri_segment(3))
{
	$Req_collegeType = fuel_model('affiliated_college',array('where' => array('college_type' => str_replace('-', ' ', uri_segment(3)))));
	
	if (empty($Req_collegeType)) show_404();
}

$dept = fuel_model('affiliated_college',array('select'=>'DISTINCT(college_type)'));


if (!empty($slug))
{

	if($slug == strtolower("type")){

		$college_list = fuel_model('affiliated_college', array('where' => array('college_type' =>str_replace('-', ' ', uri_segment(3))), 'limit' => $limit, 'offset' => $offset));

//		if (empty($college_list)) show_404(); 
	} else {
		show_404();
	}
}
else
{	

	$college_list = fuel_model('affiliated_college', array('limit' => $limit, 'offset' => $offset));

}

?>

<?php fuel_set_var('page_title', ucwords('affiliated colleges')); ?>
<div class="">

<div class="row">
	<div class="col-xs-9">
		<small>Type: <?php echo (uri_segment(3) ? ucwords(str_replace('-',' ', uri_segment(3))):'All' ); ?></small> 
	</div>
	<div class="col-xs-3 pull-right">
		<select id="filterDept" onchange="filter_college(this.value);" class="form-control input-sm col-xs-2">
			<option value="">Filter by College Type</option>
			<?php if(!empty($dept)):?>
				<?php foreach($dept as $item) : ?>
					<option value="<?php echo url_title($item->college_type,'-',true);?>"><?php echo $item->college_type;?></option>
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
			<th>College Name</th>
			<th>College type</th>
			<th>Estd year</th>
			<th>Address, District</th>
			<th>Website</th>
		</tr>
	</thead>
	<tbody>
<?php if(!empty($college_list)):?>
<?php foreach($college_list as $item) : ?>
	<?php $offset++; ?>
		<tr>
			<td><?php echo $offset;?></td>
			<td><?php echo $item->college_name;?></td>
			<td><?php echo $item->college_type;?></td>
			<td><?php echo $item->estd_year;?></td>
			<td><?php echo $item->address.', '.$item->district;?></td>
			<td><?php echo $item->website;?></td>
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
    $total_rows = $CI->db->get('affiliated_college')->num_rows();
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
  		function filter_college(value) {
		  window.location.href = "/affiliated-colleges/type/" + value;
		}

</script>