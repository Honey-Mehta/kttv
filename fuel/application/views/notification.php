
<?php 
$path = uri_path();
$slug = uri_segment(2);
$offset = $this->input->get('offset') ? $this->input->get('offset'): '0';
$limit = 20;

if (!empty($slug))
{	
	if($slug == strtolower("category")){

		$notification = fuel_model('notification', array('where' => array('name' => uri_segment(3)), 'limit' => $limit, 'offset' => $offset));

		$CI->db->join('fuel_notification_groups', 'notification.group_id = fuel_notification_groups.id', 'left');
		$CI->db->where(array('name' => uri_segment(3) ));

		if (empty($notification)) show_404();

	} else {
		$notification_item = fuel_model('notification', array('find' => 'one', 'where' => array('slug' => $slug)));
		if (empty($notification_item)) show_404();
	}
}
else
{	

	$notification = fuel_model('notification', array('limit' => $limit, 'offset' => $offset));

}

?>
<?php if(!empty($notification)):?>
<?php fuel_set_var('page_title', ucwords(str_replace('-', ' ', uri_segment(3)?uri_segment(3):uri_segment(1)))); ?>
<?php foreach($notification as $item) : ?>


<div class="row">
	<div class="col-md-1 date_box">
		<div class="datehome">
			<div class="date_mm"><?php echo date('d M',strtotime($item->release_date));?></div>
			<div class="date_dd"><?php echo date('Y',strtotime($item->release_date));?></div>
		</div>
	</div>
		<div class="col-md-10">
		<p><a href="<?=$item->url?>" target="<?=($item->isexternal == 'yes'? '_blank':'_self')?>" ><?php echo $item->headline?></a><span class="pull-right label label-primary"><?php echo $item->name?></span></p>
		</div>
	
</div>

<?php endforeach; ?>

<?php 
    $CI->load->library('pagination');
    $total_rows = $CI->db->get('notification')->num_rows();
    $config['base_url'] = base_url($path.'?');
    $config['total_rows'] = $total_rows;
    $config['per_page'] = $limit;
    $config['num_links'] = 4;
    $config['first_link'] = 'First';
    $config['last_link'] = 'Last';


    $CI->pagination->initialize($config);

    echo $CI->pagination->create_links();
    echo "<br>	<span> Total list of ". fuel_var('page_title')." : ". $total_rows ."</span>";
?>

<?php else: ?>

	<?php fuel_set_var('page_title', $notification_item->headline); ?>
	<div class="notification_item">
		<div><span class=" label label-primary"><?=$notification_item->name?></span><span class="pull-right">Release Date:<?=$notification_item->release_date_formatted?></span></div><hr style="margin:10px 0;">
		<?=$notification_item->content_formatted?>
	</div>
<?php endif; ?>

