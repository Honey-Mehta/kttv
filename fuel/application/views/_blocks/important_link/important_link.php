<div class="container-fluid bg">
	
	<div class="container bg">
		
		<div class="bg" style="margin-top: 0px;">
			<div class="col-md-3 bg_h1">
				<h2 align="center" class="imp-h2">Important Links <span class="glyphicon glyphicon-hand-right"> </span></h2>
			</div>

			<?php $Imp_navs = $this->fuel->navigation->data(array('group_id' => 'important-links'));?>
			<div class="col-md-9 bg" style="padding-bottom: 7px;">

			<?php $limit = 1;

			foreach($Imp_navs as $imp_nav):?>
				<?php if ($imp_nav['hidden'] == 'no'):?>
				<div class="col-md-3">        
					<a class="btn btn-default bt" href="<?php echo base_url(). $imp_nav['nav_key'];?>">
						<?php echo $imp_nav['attributes'] .' '. $imp_nav['label'];?>
					</a>
				</div>
				<?php if($limit >= 12) break; ?>
			<?php $limit++; endif; endforeach;?>
			</div>
		</div>
	</div>
	
</div>