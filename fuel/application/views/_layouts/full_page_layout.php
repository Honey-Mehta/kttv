<?php $this->load->view('_blocks/header')?>

<?php if(is_home()):?>
	
	<?php echo fuel_var('body', 'This is under construction...'); ?>

<?php else:?>

<section id="main_inner">

	<div class="container ">

		<div class="col-md-12 contentpage">	
				<?php echo $this->fuel->navigation->breadcrumb(array('container_tag_class'=>'breadcrumb', 'arrow_class'=>'hide'));?>

			<div class="row">
				<div class="col-md-12 workarea margin-b-20">
					<div class="row">
					<div class="col-md-12">
						
						<h1><?php echo fuel_var('page_title'); ?></h1>
					</div>
				
					</div>
					<?php echo fuel_var('body', '<img class="img-responsive" src='.'{img_path("webapp/underConstruction.png")}'.' alt="Under Construction" />'); ?>	
				</div>
			</div>	
		</div>
	</div>
</section>

<?php endif;?>

<?php $this->load->view('_blocks/footer')?>
