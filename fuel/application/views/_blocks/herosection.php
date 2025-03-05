<!-- herosection start  -->



<div class="herosection">

<?php 
            // Fetch employee records
            $about = fuel_model('about', [
              'where' => ['published' => 'yes']
          ]);

           
            
            
            if (!empty($about)): // Check if records are available
               // foreach ($vc_messages as $vc_message): 
                
                ?>  

        <div class="container">
            <div class="hero-content">
                <h1 class="hero-title">Krantivir Tatya Tope<br /> Vishwavidyalaya</h1>
                <!-- <p class="hero-para">
                    
               Krantiveer Tatyatope University, Guna aspires to establish itself as a prominent
                    educational Institution in the Malwa area by providing education aligned with the New Education
                    Policy-2020
                

                
                </p> -->

                <?php echo $about[0]['about']; ?>
            </div>
        </div>

        <?php 
        //endforeach; 
            else: ?>
                <!-- No records message -->
                <p class="text-center">No  About Details found in the directory.</p>
            <?php endif; ?>
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
 