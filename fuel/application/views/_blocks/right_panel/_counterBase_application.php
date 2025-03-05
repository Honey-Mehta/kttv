     <div class="panel">
      <div class="panel-heading">
         <h4 class="panel-title">
            <a data-toggle="collapse" data-parent="#bs-collapse" href="#five" class="expand">
             <i class="glyphicon glyphicon-ok" > </i> Counter Base Application<div class="right-arrow pull-right">+</div>
            </a>
         </h4>
      </div>
      <div id="five" class="panel-collapse collapse">
         <div class="panel-body">
    <div class="notice-grid">

	 		<div class="bg_note">
				<div class="player" style="height: 100%;overflow-y: auto;text-align: justify;">

				<?php $notification = fuel_model('notification', array('limit'=>'5','where'=> array('name'=>'Counter-Base-Application'))); ?>
				<?php foreach($notification as $item) : ?>		
						

											
					<div class="sh">
						<div class="date_box">
							<div class="datehome">
								<div class="date_mm"><?php echo date('d M', strtotime($item->release_date));?></div>
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
			<a href="<?php echo base_url('notification/category/Counter-Base-Application');?>" class="list-more">Read More</a>


			</div>

         </div>
      </div>
   </div>








		 
