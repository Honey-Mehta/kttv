    <!-- herosection start  -->
    <div class="hero-position">
        <div class="container-fluid p-0">
            <div class="row m-0">
                <div class="col-lg-8 col-md-8 col-sm-12 p-0 d-flex">
                    <div class="herosection">
                          <?php 
            // Fetch employee records
            $about = fuel_model('about', [
              'where' => ['published' => 'yes']
          ]);
            if (!empty($about)): 
                ?>
                        <div class="hero-content">
                            <h1 class="hero-title">Krantivir Tatya Tope<br /> Vishwavidyalay</h1>
                            <p class="hero-para"><?php echo $about[0]['about']; ?></p>
                        </div>

                         <?php 
        //endforeach; 
            else: ?>
           <!-- No records message --> <?php endif; ?>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12 p-0 d-flex">

                    <div class="img-content">
                    <?php 
            $ministers = fuel_model('ministers', ['where' => ['published' => 'yes']]); // Fetch employee records 
            if (!empty($ministers)): // Check if records are available 
                foreach ($ministers as $minister): ?>



                        <div class="cm-img d-flex align-items-center mb-2">
<img class="me-2 minister-img" src="<?= img_path('ministers/'.$minister['image']); ?>" alt="Minister Image" />
                            <div class="">
                                <h3 class=""><?php echo $minister['name'] ?></h3>
                                <p class=""><?php echo $minister['description'] ?></p>
                            </div>
                        </div>
              
                <?php endforeach; 
            else: ?>
                <p class="text-center">No Ministers found in the directory.</p>
            <?php endif; ?>
                
                     
                    </div>
                </div>
            </div>
         
        </div>


    </div>

 <!-- Hero section end -->
<?php 
// Fetch marquee records
$marquee_texts = fuel_model('marquee', [
    'where' => ['published' => 'yes']
]);
?>
<marquee class="marquee">
    <ul class="d-flex align-items-center m-0">
        <?php if (!empty($marquee_texts)): ?>
            <?php foreach ($marquee_texts as $text): ?>
                <li class="mx-3">
                    <?php if ($text['new'] == 'yes'): ?>
                        <div class="containers" style="display: inline-block; margin-right: 10px;">
                            <div class="text-style blink-soft" style="display: inline;">New</div>
                        </div>
                    <?php endif; ?>
                    <span style="color:blue;"><?php echo $text['headline']; ?></span>
                    : <?php echo $text['description']; ?>
                </li>
                <span class="separator">&nbsp;&nbsp;|&nbsp;&nbsp;</span>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="no-announcements">
                <p></p>
            </div>
        <?php endif; ?>
    </ul>
</marquee>


<div class="s-soft">
       
       <a href="https://t.me/KTTVishwavidalaya" class="s-item telegram" target="_blank">
           <img src="<?php echo img_path("telegram.svg"); ?>" />
       </a>
       <a href="https://whatsapp.com/channel/0029VangaszKmCPJ5qCasg2R" class="s-item watsapp" target="_blank"> 
           <img src="<?php echo img_path("whatsapp.svg"); ?>" />
       </a>
    
   </div>
   <a id="so-open" class="s-item print so-collapse">
       <span class="fa fa-arrow-right"></span>
   </a>
 