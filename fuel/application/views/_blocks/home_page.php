
    
     
          <?php 
          
          //echo fuel_block('carousel');
          
          ?>

         <?php echo fuel_block('herosection');?>
          <?php echo fuel_block('about-us');?>

          <?php echo fuel_block('mission');?>
          <?php echo fuel_block('message');?>
          <?php //echo fuel_block('imp_link');?>
          <?php //echo fuel_block('news');?>
          <?php //echo fuel_block('contact_us')?>
                      

         

    <script>
        const animatedEls = document.querySelectorAll("[data-animation]");

        const observer = new IntersectionObserver((entries) => {
            entries.forEach((entry) => {
                const animation = entry.target.getAttribute("data-animation");

                if (entry.isIntersecting) {
                    entry.target.classList.add("animated", `${animation}`);
                } else {
                    entry.target.classList.remove("animated", `${animation}`);
                }
            });
        });

        animatedEls.forEach((el) => observer.observe(el));
    </script>
