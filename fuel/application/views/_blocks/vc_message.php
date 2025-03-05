<!--about clg write up -->	
</br>
<div class="container-fluid" >
<div class="container">
<div class="row shadow-lg" style="padding: 15px;">

<?php 
            // Fetch employee records
            $vc_messages = fuel_model('vc_message', ['where' => ['published' => 'yes']]);

           
            
            
            if (!empty($vc_messages)): // Check if records are available
                foreach ($vc_messages as $vc_message): ?> 
<div class="col-md-3 mainpage" style="padding-bottom: 14px;">
<div class="pull-left">
<img class="img-thumbnail vc_image" src="<?php echo img_path('vc_message/' . $vc_message['image']); ?>" width="180px" height="140px" alt="" style="margin-right:15px;">
</div>

<h3 class="text-center"><?php echo $vc_message['vc_name']; ?></h3>
<h5 class="text-center"><?php echo $vc_message['designation']; ?></h5>


                </div>

<div class="col-md-9 py-4">
<p class="justify">
    
<?php echo $vc_message['vc_message']; ?>


</p>
</div>


<?php endforeach; 
            else: ?>
                <!-- No records message -->
                <p class="text-center">No Vc message found in the directory.</p>
            <?php endif; ?>


</div>
</div>
</div>
