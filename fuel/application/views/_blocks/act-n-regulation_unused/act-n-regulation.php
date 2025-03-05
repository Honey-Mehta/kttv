<div class="container-fluid bg">



	<div class="row" style="margin-top: 0px;">


		<?php $Imp_navs = $this->fuel->navigation->data(array('group_id' => 'act-n-regulation')); ?>
		<div class="col-md-12 bg" style="padding-bottom: 7px;">
			<ul class="act-n-regulation_ul" style="list-style-type: none;padding: 0px; ">
				<?php $limit = 1;

				foreach ($Imp_navs as $imp_nav): ?>
					<?php if ($imp_nav['hidden'] == 'no'): ?>

						<li> <a class="btn btn-link " style="text-decoration: none; "
								href="<?php echo base_url() . $imp_nav['nav_key']; ?>">
								<?php echo $imp_nav['attributes'] . ' ' . $imp_nav['label']; ?>
							</a> </li>

						<?php if ($limit >= 12)
							break; ?>
						<?php $limit++; endif; endforeach; ?>
			</ul>
		</div>
	</div>
</div>