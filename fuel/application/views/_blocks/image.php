<div class="wrapper-codes" >
    <!-- <div class="page-title">
        <div class="container">
        </div>
    </div> -->

    <div class="container" style="min-height:400px;">
        <div class="row team-row">
            <?php 
            $photo = fuel_model('photo', ['where' => ['published' => 'yes']]); 
            if (!empty($photo)): 
                foreach ($photo as $employee): ?>
                    <div class="col-md-3 col-sm-6 team-wrap">
                        <div class="team-member text-center">
                            <div class="team-img">
                                
                                <img src="<?php echo img_path('gallery/' . $employee['image']); ?>" 
                                     alt="<?php echo $employee['name']; ?>" 
                                     style="width: 300px; height: 300px; object-fit: cover;" />
                            </div>
                         
                            <h6 class="team-title"><?php echo $employee['name']; ?></h6>
                          
                        </div>
                    </div>
                <?php endforeach; 
            else: ?>
            
                <p class="text-center">No Picutre Gallery found in the directory.</p>
            <?php endif; ?>
        </div> 
    </div>
</div>
