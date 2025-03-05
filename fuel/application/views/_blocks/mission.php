<div class="mission-section" id="mission">
        <div class="container mission-container py-5">
            <div class="row mb-4">
                <p class="pre-text text-white">MISSI<img src="<?php echo img_path('/icons/mission-text-icon.png');?>" />N</p>
                <div class="col-lg-6 ">
                    <h2 class="heading-2 text-white">
                        Focus and Direction
                    </h2>
                </div>
                <div class="col-lg-6 ">
                    <p class="para-2 text-white mission-para">Meeting our local and global community’s evolving needs
                        and challenges; our effort will be to prepare our students as per the needs of future workforce.
                    </p>
                </div>
            </div>

            <?php 
            // Fetch employee records
            $missions = fuel_model('mission', [
              'where' => ['published' => 'yes']
          ]);

           
            
            
            if (!empty($missions)): // Check if records are available
               // foreach ($vc_messages as $vc_message): 
                
                ?>  


            <div class="row">
                <div class="col-lg-4 mb-3 d-flex">
                    <div class="box p-3">
                        <div class="box-body">
                            <img class="pb-2" src="<?php echo img_path('/icons/box1-icon.png');?>" alt="" />
                            <h5 class="heading-3">Entrepreneur</h5>
                            <p class="para-3">
                                
                            <!-- We will strive to an ever stronger nexus between our research and economic
                                needs to help
                                shape a new generation of entrepreneurs who will be able to translate new knowledge into
                                societal benefit. -->

                                <?php echo $missions[0]['entrepreneur']; ?>
                            
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 mb-3">
                    <div class="box p-3">
                        <div class="box-body">
                            <img class="pb-2" src="<?php echo img_path('/icons/box2-icon.svg');?>" alt="" />
                            <h5 class="heading-3">Innovative ideas</h5>
                            <p class="para-3">
<!--                                 
                            In a globalised economy, access to creative and innovative ideas is very
                                essential for
                                local
                                socio- economic benefit; our university will strive to optimize the unique potential of
                                the
                                students to make our society more prosperous and culturally evolved. -->
                                <?php echo $missions[0]['innovative_ideas']; ?>
                            
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 mb-3 d-flex">
                    <div class="box p-3">
                        <div class="box-body">
                            <img class="pb-2" src="<?php echo img_path('/icons/box3-icon.svg');?>" alt="" />
                            <h5 class="heading-3">Disciplinary learning</h5>
                            <p class="para-3">
                                
                            <!-- Our focus will be on in depth disciplinary learning, communication,
                                problem solving,
                                leadership, and interpersonal skills. -->

                                <?php echo $missions[0]['disciplinary_learning']; ?>
                            
                            </p>
                        </div>
                    </div>
                </div>

                <?php 
        //endforeach; 
            else: ?>
                <!-- No records message -->
                <p class="text-center">No  Mission Details found in the directory.</p>
            <?php endif; ?>
            </div>
        </div>
    </div>
    </div>
    </div>