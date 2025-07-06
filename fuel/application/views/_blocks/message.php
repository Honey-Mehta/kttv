<div class="message-section" id="message">
        <div class="container py-5">
            <div class="row">

            <?php 
            // Fetch employee records
            $vc_messages = fuel_model('vc_message', array('where' => array('published' => 'yes')));

           
            
            
            if (!empty($vc_messages)): // Check if records are available
                //foreach ($vc_messages as $vc_message): ?>  

                <div class="col-lg-4 col-md-4 col-sm-12 mb-3">
                    <div class="message-img">
                        <img class="img-fluid" src="<?php echo img_path('vc_message/' . $vc_messages[0]['image']); ?>" alt="" />
                        <div class="vision--bg">
                        </div>
                    </div>
                </div>

          

                <div class="col-lg-8 col-md-8 col-sm-12 mb-3">
                    <div class="message-content">
                        <div class="vision--bg-2">
                        </div>
                        <h2 class="heading-2 mb-3">The Message of <span>Hon'ble Kulguru</span></h2>
                        <p class="msg-head">Dear students,</p>
                        <p class="para-3">
                        <?php echo $vc_messages[0]['vc_message']  ?>
                        </p>
                        <p class="msg-head">
                        <?php echo $vc_messages[0]['signature']  ?>
                        </p>
                    </div>
                </div>
                <?php
                
            //endforeach; 
            else: ?>
                <!-- No records message -->
                <p class="text-center">No Kulguru message found in the directory.</p>
            <?php endif; ?>


            </div>
        </div>
    </div>