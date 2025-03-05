<?php $slider = fuel_model('slider', array('where'=> array('publish_till >='=>datetime_now()), 'order'=>'id desc')); ?>

 
<?php $this->load->library('user_agent');
$Hieght_byCMS = FALSE;
if ($this->agent->is_mobile())
{
    $Hieght_byCMS = fuel_var('banner_height_m','600');
}
else
{
   $Hieght_byCMS = fuel_var('banner_height','400');
}
//echo $Hieght_byCMS;
$jssor_Hieght = $Hieght_byCMS;
$captionHieght = 30;
?> 
<div >


<div class="carousel-frame">
    <!-- Loading Screen --> 
    <div class="carousel-slide">   
       <?php if($slider) :?>
       
            <?php foreach($slider as $item) : ?> 
                    <img data-u="image" src="<?php echo $item->image_path;?>" />
                    <?php if ($item->caption_hidden == 'yes'):?>
                    <!-- <div style="background: rgba(0, 0, 0, 0.33); position:absolute;bottom:<?php echo $captionHieght;?>px;width:100%;height:60px;z-index:0;">
                        <div style="text-align:center;position:absolute;top:15px;width:100%;height:40px;z-index:0;font-size:30px;color:#ffffff;line-height:30px;"><?php echo $item->caption;?></div>
                    </div> -->
                <?php endif;?> 
            <?php endforeach; ?>
        <?php endif;?>

            <!--defualt image-->
            <div>
                    <img data-u="image" src="<?php echo img_path('slider/default.jpg');?>" />
                    <!-- <div style="background: rgba(0, 0, 0, 0.33); position:absolute;bottom:<?php echo $captionHieght;?>px;width:100%;height:60px;z-index:0;">
                        <div style="text-align:center;position:absolute;top:15px;width:100%;height:40px;z-index:0;font-size:30px;color:#ffffff;line-height:30px;"></div>
                    </div>  -->
            </div>
    </div>
    <!-- Bullet Navigator -->
    <ol class="carousel-dots">
            <?php foreach($slider as $item) : ?> 
                <li></li>
            <?php endforeach; ?> 
            <li></li>
        </ol>
    <!-- Arrow Navigator -->
    <i class="carousel-prev fa fa-chevron-left" aria-hidden="true"></i>
        <i class="carousel-next fa fa-chevron-right" aria-hidden="true"></i>
</div>
<!-- #endregion Jssor Slider End -->

</div>  
<!--carousel Script Start-->
<script>
        const carouselFrames = Array.from(document.querySelectorAll('.carousel-frame'));

        function makeCarousel(frame) {
            const carouselSlide = frame.querySelector('.carousel-slide');
            const carouselImages = getImagesPlusClones();
            const prevBtn = frame.querySelector('.carousel-prev');
            const nextBtn = frame.querySelector('.carousel-next');
            const navDots = Array.from(frame.querySelectorAll('.carousel-dots li'));

            let imageCounter = 1;

            function getImagesPlusClones() {
                let images = frame.querySelectorAll('.carousel-slide img');

                const firstClone = images[0].cloneNode();
                const lastClone = images[images.length - 1].cloneNode();

                firstClone.className = 'first-clone';
                lastClone.className = 'last-clone';

                // we need clones to make an infinite loop effect
                carouselSlide.append(firstClone);
                carouselSlide.prepend(lastClone);

                // must reassign images to include the newly cloned images
                images = frame.querySelectorAll('.carousel-slide img');

                return images;
            }

            function initializeNavDots() {
                if (navDots.length) navDots[0].classList.add('active-dot');
            }

            function initializeCarousel() {
                carouselSlide.style.transform = 'translateX(-100%)';
            }

            function slideForward() {
                // first limit counter to prevent fast-change bugs
                if (imageCounter >= carouselImages.length - 1) return;
                carouselSlide.style.transition = 'transform 400ms';
                imageCounter++;
                carouselSlide.style.transform = `translateX(-${100 * imageCounter}%)`;
            }

            function slideBack() {
                // first limit counter to prevent fast-change bugs
                if (imageCounter <= 0) return;
                carouselSlide.style.transition = 'transform 400ms';
                imageCounter--;
                carouselSlide.style.transform = `translateX(-${100 * imageCounter}%)`;
            }

            function makeLoop() {
                // instantly move from clones to originals to produce 'infinite-loop' effect
                if (carouselImages[imageCounter].classList.contains('last-clone')) {
                    carouselSlide.style.transition = 'none';
                    imageCounter = carouselImages.length - 2;
                    carouselSlide.style.transform = `translateX(-${100 * imageCounter}%)`;
                }

                if (carouselImages[imageCounter].classList.contains('first-clone')) {
                    carouselSlide.style.transition = 'none';
                    imageCounter = carouselImages.length - imageCounter;
                    carouselSlide.style.transform = `translateX(-${100 * imageCounter}%)`;
                }
            }

            function goToImage(e) {
                carouselSlide.style.transition = 'transform 400ms';
                imageCounter = 1 + navDots.indexOf(e.target);
                carouselSlide.style.transform = `translateX(-${100 * imageCounter}%)`;
            }

            function highlightCurrentDot() {
                navDots.forEach((dot) => {
                    if (navDots.indexOf(dot) === imageCounter - 1) {
                        dot.classList.add('active-dot');
                    } else {
                        dot.classList.remove('active-dot');
                    }
                });
            }

            function addBtnListeners() {
                nextBtn.addEventListener('click', slideForward);
                prevBtn.addEventListener('click', slideBack);
            }

            function addNavDotListeners() {
                navDots.forEach((dot) => {
                    dot.addEventListener('click', goToImage);
                });
            }

            function addTransitionListener() {
                carouselSlide.addEventListener('transitionend', () => {
                    makeLoop();
                    highlightCurrentDot();
                });
            }

            function autoAdvance() {
                let play = setInterval(slideForward, 5000);

                frame.addEventListener('mouseover', () => {
                    clearInterval(play); // pause when mouse enters carousel
                });

                frame.addEventListener('mouseout', () => {
                    play = setInterval(slideForward, 5000); // resume when mouse leaves carousel
                });

                document.addEventListener('visibilitychange', () => {
                    if (document.hidden) {
                        clearInterval(play); // pause when user leaves page
                    } else {
                        play = setInterval(slideForward, 5000); // resume when user returns to page
                    }
                });
            }

            function buildCarousel() {
                initializeCarousel();
                initializeNavDots();
                addNavDotListeners();
                addBtnListeners();
                addTransitionListener();
                autoAdvance();
            }

            buildCarousel();
        }

        carouselFrames.forEach(frame => makeCarousel(frame));
    </script>
    <!--carousel Script End-->