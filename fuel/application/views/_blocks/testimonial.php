<style>
  .col-sm-6 .col-md-6 .col-xs-6{
    margin-top: 20px;
  }
</style>
<?php $testimonial = fuel_model('testimonial'); ?>

<div class="col-md-12 card-shadow" style="background-color: white;" > 
	<div class="row">
    <div class="panel " >
        <div class="panel-heading message-panel" > <i class="glyphicon glyphicon-envelope"> </i> Messages </div>
		<div class="col-sm-12" ">
        
            <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
              <!-- Wrapper for slides -->
              <div class="carousel-inner" style=" height: 225px;">
                <?php if($testimonial) :?>
                <?php $i = 0; ?>
                <?php foreach($testimonial as $item) : ?>          

                    <div class="item <?php echo ($i == 0 ? "active": ""); ?>">
                        <div class="row">
                            <div class="col-sm-6 col-md-6 col-xs-6" style="margin-top: 20px;">

                            <h4><strong style="white-space: nowrap;"><?php echo $item->name;?></strong></h4>


                            <p class="testimonial_subtitle"><span><?php echo $item->designation;?></span><br>
                          
                            </p>
                        </div>
                        <div class="col-sm-6 col-md-6 col-xs-6 text-right">
                            <img src="<?php echo $item->image_path;?>" class="img-responsive img-circle" style="width: 100px; margin-top: 5px; float: right;">
                            </div>
                        </div>
                        
                        <button style="border: none;"><i class="fa fa-quote-left testimonial_fa" aria-hidden="true"></i></button>
                        <p class="testimonial_para text-justify"><?php echo $item->message;?></p>
                        
                    </div>
                    <?php $i++; ?>
                <?php endforeach; ?>
              <?php endif; ?>
              </div>
            </div>
            <div class="controls testimonial_control pull-right" style="margin-bottom: 5px">
                <a class="left btn btn-sm glyphicon glyphicon-backward testimonial_btn" href="#carousel-example-generic"
                  data-slide="prev"></a>

                <a class="right btn btn-sm glyphicon glyphicon-forward testimonial_btn" href="#carousel-example-generic"
                  data-slide="next"></a>
              </div>
              </div>

        </div>
	</div>
</div>