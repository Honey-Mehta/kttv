
<?php 
            // Fetch employee records
            $missions = fuel_model('vision', [
              'where' => ['published' => 'yes']
          ]);

           
            
            
            if (!empty($missions)): // Check if records are available
               // foreach ($vc_messages as $vc_message): 
                
                ?>  




<!-- about us section start  -->
    <div class=" vision-container py-5" >
        <div class="container vision-section" id="vision">
            <div class="row">
                <div class="col-lg-5 col-md-4 col-sm-12">
                    <div class="vision-img-section">
                      
                        <img class="img-fluid vision-img" src="<?php echo img_path('vision/'.$missions[0]['image']);?>" alt="">
                        <div class="vision--bg">
                        </div>
                    </div>
                </div>
                <div class="col-lg-7 col-md-8 col-sm-12">
                    <div class="vision-content">
                        <div class="vision--bg-2">
                        </div> 
                        <p class="pre-text">VISI<img src="<?php echo img_path('/icons/vision-text-icon.png');?>" />N</p>
                        <h2 class="heading-2">
                            Dreams and <span>Aspirations</span>
                        </h2>
                        <p class="para-2">It will be recognized as a hub of scientific research and development. </p>
                        <div class="d-flex align-items-start">
                            <img class="vision--icon me-2" src="<?php echo img_path('/icons/scientific-icon.svg');?>" alt="" />
                            <div>
                                <h5 class="heading-3">Hub of scientific research and development</h5>
                                <p class="para-3">  <?php echo $missions[0]['research_and_development']; ?></p>
                            </div>
                        </div>
                        <div class="d-flex align-items-start">
                            <img class="vision--icon me-2" src="<?php echo img_path('/icons/societal-icon');?>" alt="" />
                            <div>
                                <h5 class="heading-3">Revolutionary societal change </h5>
                                <p class="para-3"> <?php echo $missions[0]['revolutionary_change']; ?></p>
                            </div>
                        </div>
                        <div class="d-flex align-items-start">
                            <img class="vision--icon me-2" src="<?php echo img_path('/icons/nationalism-icon');?>" alt="" />
                            <div>
                                <h5 class="heading-3">Concept of Nationalism </h5>
                                <p class="para-3"><?php echo $missions[0]['concept_nationalism']; ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php 
        //endforeach; 
            else: ?>
                <!-- No records message -->
                <p class="text-center">No  Vision Details found in the directory.</p>
            <?php endif; ?>