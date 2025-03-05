<div class="wrapper-codes">
    <div class="page-title">
        <div class="container">
            <h2>Photo Gallery</h2>
        </div>
    </div>

    <div class="container">
        <div class="row team-row">
        <?php 
            // Fetch only published faculty data from the table
            $photo_gallerys = fuel_model('photo_gallery', ['where' => ['published' => 'yes']]); 
            var_dump($photo_gallerys);
            if (!empty($photo_gallerys)): // Check if there are records
            ?>
             <?php   foreach ($photo_gallerys as $photo_gallery): ?>
                    <div class="col-md-3 col-sm-6 team-wrap">
                        <div class="team-member text-center">
                            <div class="team-img">
                                <!-- Display employee image -->
                                <img src="<?php echo img_path('employeepics/' . $photo_gallery['image']); ?>" 
                                     alt="<?= htmlentities($photo_gallery['name']); ?>" 
                                     style="width: 300px; height: 300px;" 
                                />
                            </div>
                            <!-- Display employee name -->
                            <h6 class="team-title"><?= htmlentities($photo_gallery['name']); ?></h6>
                            <!-- Display employee description -->
                            <span><?= htmlentities($photo_gallery['description']); ?></span>
                        </div>
                    </div>
                    <?php endforeach; ?>
               
            <?php else: ?>
                <p class="text-center">No published faculty members found.</p>
            <?php endif; ?>
        </div>
    </div>
</div>
