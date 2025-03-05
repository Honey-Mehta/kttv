<div class="panel">
      <div class="panel-heading">
         <h4 class="panel-title">
            <a data-toggle="collapse" data-parent="#bs-collapse" href="#one" class="expand" aria-expanded="true">
            <i class="glyphicon" >&#xe123; </i> News & Notification <div class="right-arrow pull-right ">-</div>
            </a>
         </h4>
      </div>
      <div id="one" class="panel-collapse collapse in">
         <div class="panel-body">
		 <div class="notice-grid">

	 		<div class=" bg_note">
				<div class="player" style="height: 100%;overflow-y: auto;text-align: justify;">

				<?php $notification = fuel_model('notification', array('limit'=>'5','where'=> array('name'=>'News-and-Notifications'))); ?>
				<?php foreach($notification as $item) : ?>		
						

											
					<div class="sh" >
						<div class="date_box" >
							<div class="datehome" >
								<div class="date_mm" style="background-color:#30577a"><?php echo date('d M', strtotime($item->release_date));?></div>
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
			<a href="<?php echo base_url('notification/category/news-and-notifications');?>" class="list-more">Read More</a>


			</div>
         </div>
      </div>
   </div>