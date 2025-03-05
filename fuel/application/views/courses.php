
<?php 
$path = uri_path();
$slug = uri_segment(2);
 
$offset = $this->input->get('offset') ? $this->input->get('offset'): 0;
$limit = 10;
$total_count = null;
if(uri_segment(3))
{
	$Req_dept = fuel_model('user_role',array('where' => array('base_location' => 'departments/'.uri_segment(3))));
	
	if($Req_dept)
	{
		$dept_id = $Req_dept[0]->id;
	}

	if (empty($Req_dept)) {
		$Req_dept = fuel_model('courses',array('where' => array('mode' => str_replace('-', ' ', uri_segment(3)))));
	}
	if (empty($Req_dept)) show_404();
}

$dept = fuel_model('user_role');

$CI->load->model('courses_model');
if (!empty($slug))
{
	

	if($slug == strtolower("departments")){

		$where = array('group_id' => $dept_id);		
		$courses_list = fuel_model('courses', array('where' => $where, 'limit' => $limit, 'offset' => $offset));
		$total_count = $this->courses_model->record_count($where);

		fuel_set_var('page_title', 'पाठ्यक्रम');

//		if (empty($courses_list)) show_404(); 
	} else if ($slug == strtolower("study-mode")){

		$where = array('mode' => str_replace('-', ' ', uri_segment(3)));		
		$courses_list = fuel_model('courses', array('where' => $where, 'limit' => $limit, 'offset' => $offset));
		$total_count = $this->courses_model->record_count($where);
		$title_array = explode(':', $page_title);
		fuel_set_var('page_title', $title_array[0]);


	} else {
		show_404();
	}

}
else
{	
	fuel_set_var('page_title', 'पाठ्यक्रम');
	$courses_list = fuel_model('courses', array('limit' => $limit, 'offset' => $offset));
	$total_count = $this->courses_model->record_count();
}



?>

<div class="">

<div class="row">
	<div class="col-xs-9">
		<small> 
		
		<?php if($slug == strtolower("departments")){

			echo lang(strtolower(uri_segment(2))).' : ';
			$nav_parent_group = fuel_model('navigation', array('limit'=>'1','where'=> array('location'=>'departments/'.uri_segment(3))));
			echo $nav_parent_group[0]->label;

		//		if (empty($courses_list)) show_404(); 
		} else if ($slug == strtolower("study-mode")){

			echo lang(strtolower(uri_segment(2))).' : ';
			echo lang(ucwords(str_replace('-',' ', uri_segment(3))));

		} else {
			
			echo lang( 'All Courses' );

		}?>

		</small> 
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
<style type="text/css">
	table tr td {
		text-align: left;
		padding-left: 8px;
	}
</style>
<div class="table-responsive">
	<table class="table table-striped table-bordered">
	<thead>
		<tr>
			<th>S.No.</th>
			<th>Course Name</th>
			<th>Available Seat</th>	
					
			<th>Duration</th>
			<th>Eligibility</th>
			<th>Subject</th>
			<th>Sem Annual Syatem</th>
			<th>Admission Mode</th>
			<th>Course Type</th>
			<th>Study Mode</th>
			

		</tr>
	</thead>
	<tbody>
<?php if(!empty($courses_list)):?>
<?php foreach($courses_list as $item) : ?>
	<?php $offset++; ?>
		<tr>
			<td><?php echo $offset;?></td>
			<td><?php echo $item->course_name;?></td>
			<td><?php echo $item->available_seat;?></td>
			
			<td><?php echo $item->duration;?></td>
			<td><?php echo $item->eligibility;?></td>
			<td><?php echo $item->subject;?></td>
			<td><?php echo $item->sem_annual_syatem;?></td>
			<td><?php echo $item->admission_mode;?></td>
			<td><?php echo $item->course_type;?></td>
			<td><?php echo $item->mode;?></td>
			
		</tr>
<?php endforeach; ?>
<?php else : ?>
		<tr>
			<td class="text-center" colspan="10">No recored to display</td>
		</tr>
<?php endif; ?>
	</tbody>
</table>
</div>
	
</div>

<?php 
    $CI->load->library('pagination');

	$config['total_rows'] = $total_count;
    $config['base_url'] = base_url($path.'?');
    $config['per_page'] = $limit;
    $config['num_links'] = 4;
    $config['first_link'] = 'First';
    $config['last_link'] = 'Last';


    $CI->pagination->initialize($config);

    echo $CI->pagination->create_links();

?>


<script>
  		function filter_department(value) {
		  window.location.href = "/courses/" + value;
		}

</script>