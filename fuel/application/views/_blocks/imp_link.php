<!-- mycode -->


<div class="main_headrani">
        Important <span>
            Links <svg xmlns="http://www.w3.org/2000/svg" width="120" height="9" viewBox="0 0 120 9" fill="none">
                <path fill-rule="evenodd" clip-rule="evenodd" d="M115.442 8.25039C64.7892 -2.54947 20.433 3.78533 4.88329 8.17023C3.53609 8.55013 1.62363 8.4481 0.611686 7.94234C-0.400258 7.43658 -0.128479 6.71861 1.21872 6.33871C18.3618 1.5045 65.3347 -5.06747 118.455 6.25855C119.92 6.57094 120.434 7.27006 119.601 7.82009C118.769 8.37012 116.907 8.56277 115.442 8.25039Z" fill="#161613"></path>
            </svg>
        </span>
    </div>
	


	<div id='impsection'>
        <div class="container implinks_area">
            <div class="row">
                <div class="col-md-12">
                    <div id="news-slider" class="owl-carouse"> 
                    
						 <?php $implinks = fuel_model('imp_links', array('limit'=>'11')); ?>
                         
						 <?php foreach($implinks as $item) : ?>	
                        <div class="post-slide">
                            <div class="categories__item">
                                <a href="/courses">
                                    <div class="icon">
                                       <img src="<?php echo img_path('svgs/' . $item['image']); ?>" />
                                        
                                    </div><div class="name"><?=$item['headline']?> </div><div class="courses"><?=$item['slug']?></div>
                                </a>
                            </div>
                        </div>
						<?php endforeach; ?>		 
                    </div>
                </div>
            </div>  
        </div>
    </div>

   
 <!--Important Links Slidder Script Start-->
 <script>
        $(document).ready(function () {
            $("#news-slider").owlCarousel({
                items: 4,
                itemsDesktop: [1199, 3],
                itemsDesktopSmall: [980, 2],
                //itemsMobile: [600, 1],
                navigation: true,
                navigationText: ["", ""],
                pagination: true,
                autoPlay: true
            });
        });
    </script>
    <!--Important Links Slidder Script Start-->


<style>
	#impsection{
		padding:40px 10px;  
        position: relative;
        min-height: 75%; 
        background: #1a2a6c;  /* fallback for old browsers */
        background: -webkit-linear-gradient(to right, #402759, #660606, #1a2a6c);  /* Chrome 10-25, Safari 5.1-6 */
        background: linear-gradient(to right, #402759, #660606, #1a2a6c); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
        background-attachment:fixed;
        z-index: 1;
	}
</style>