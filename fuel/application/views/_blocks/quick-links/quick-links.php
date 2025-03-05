	<!-- Modal -->
	<div class="modal left fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;">
		<div class="modal-dialog" role="document">
			<div class="modal-content">

				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
						<div class=" heading_blue pad_zero clearfix classic-title text-center" style="color:#fff;">
							<img alt="APSU" src="<?php echo img_path('logo.png')?>" class="img-responsive"><p class="text-center">QUICK LINKS</p>
						</div>				
				</div>
				
				<div class="modal-body" style="overflow-y: scroll;height: 100%;background-color:rgb(252, 231, 179);">
					<div class=" list-group" style="">
					<?php $Quk_navs = $this->fuel->navigation->data(array('group_id' => 'quick-link'));?>
					<?php $limit = 1;
					foreach($Quk_navs as $Quk_nav):?>
					<?php if ($Quk_nav['hidden'] == 'no'):?>
					
						<a href="<?php echo base_url(). $Quk_nav['nav_key'];?>" class="list-group-item">
						<span class="glyphicon glyphicon-circle-arrow-right"></span>&nbsp;&nbsp;<?php echo $Quk_nav['label'];?></a>
					
					<?php if($limit >= 10) break; ?>
					<?php $limit++; endif; endforeach;?>

					<br><br><br><br><br></div>
				</div>

			</div><!-- modal-content -->
		</div><!-- modal-dialog -->
	</div><!-- modal -->