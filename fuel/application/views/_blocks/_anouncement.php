
<div class="container-fluid">
<div class="container">

<div class="">
<!--notification section -->
<section id="note">
		
<div class="row">
<div class="notice-grid" style="padding-top: 15px;">
	
		<div class="col-md-6" style=" margin-bottom: 20px; ">
		<div class="col-lg-12 back tile-card">
			<div class="heading_blue pad_zero classic-title">अधिसूचना एवं समाचार
			</div>
	 		<div class=" list-group bg_note">
				<div class="player" style="height: 100%;overflow-y: auto;text-align: justify;">

				<?php $notification = fuel_model('notification', array('limit'=>'15','where'=> array('name'=>'News-and-Notifications'))); ?>
				<?php foreach($notification as $item) : ?>		
											
					<div class="sh">
						<div class="date_box">
							<div class="datehome">
								<div class="date_mm"><?php echo date('d', strtotime($item->release_date)) .' '.lang(date('M', strtotime($item->release_date)));?></div>
								<div class="date_dd"><?php echo date('Y', strtotime($item->release_date));?></div>
							</div>
						</div>
						<div class="data_block">
							<a href="<?php echo $item->url; ?>" target="_blank">
								<?php echo $item->headline; ?>
							</a>
						</div>
						<div style="clear: both;"></div>
					</div>	
				<?php endforeach; ?>								
											
				</div>
 			</div>
			<a href="<?php echo base_url('notification/category/news-and-notifications');?>" class="list-more">और देखे </a>
							
		</div>
		</div>

		<div class="col-md-6">
		<div class="col-lg-12 back tile-card">
			<div class="heading_blue pad_zero classic-title">
			विश्वविद्यालय मे आयोजन
			</div>
	 		<div class=" list-group bg_note">
				<div class="player" style="height: 100%;overflow-y: auto;text-align: justify;">

				<?php $notification = fuel_model('notification', array('limit'=>'15','where'=> array('name'=>'Events-at-University'))); ?>
				

				<?php foreach($notification as $item) : ?>		
											
					<div class="sh">
						<div class="date_box">
							<div class="datehome">
								<div class="date_mm"><?php echo date('d', strtotime($item->release_date)) .' '.lang(date('M', strtotime($item->release_date)));?></div>
								<div class="date_dd"><?php echo date('Y', strtotime($item->release_date));?></div>
							</div>
						</div>
						<div class="data_block">
							<a href="<?=$item->url?>" target="_blank">
								<?=$item->headline?>
							</a>
						</div>
						<div style="clear: both;"></div>
					</div>
				<?php endforeach; ?>								
											
				</div>
 			</div>
			<a href="<?php echo base_url('notification/category/events-at-university');?>" class="list-more">और देखे </a>
							
		</div>
		</div>

</div>
</div>
			
	</section>
<!--notification section -->


<div class="h10 "></div>
</div>
</div>
</div>