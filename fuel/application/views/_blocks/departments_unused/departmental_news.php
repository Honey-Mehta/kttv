<?php 

$slug = uri_segment(1);

if (!empty($slug))
{
	if($slug == strtolower("departments")){
		$departmental_news = fuel_model('departmental_news', array('where' => array('user_role.name' => uri_segment(2))));
	}
}
?>
<?php if(!empty($departmental_news)):?>
	<br><br>
<div class=""><h2 class="sub-heading">News & Notification from Department:: </h2></div>

<?php foreach($departmental_news as $item) : ?>
	

<div class="text-left table-responsive">
	<table  class="table table-striped table-bordered courses">
	<thead>
		<tr>
			<th colspan="2">Headline : <?php echo $item->headline;?></th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td style="width: 200px">Release Date</td>
			<td ><?php echo date('d-M-Y', strtotime($item->release_date));?></td>

		<?php if(!empty($item->link)):?>
			<tr>
				<td>Link</td>
			
				<td>
					<a href="<?php echo $item->link;?>" target="<?=($item->isexternal == 'yes'? '_blank':'_self')?>">Download departmental_news</a>
				</td>
				</tr>	
		<?php endif; ?>
		<?php if(!empty($item->content)) :?>
			<tr>
				<td>Description</td>
				<td><?php echo $item->content; ?> </td>
			</tr>
		<?php endif; ?>
	</tbody>
</table>


<br>
</div>
<?php endforeach; ?>
<?php endif; ?>
