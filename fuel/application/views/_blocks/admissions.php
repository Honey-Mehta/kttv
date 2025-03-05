<div class="main_headrani">
    Admissions <span>
        <svg xmlns="http://www.w3.org/2000/svg" width="120" height="9" viewBox="0 0 120 9" fill="none">
            <path fill-rule="evenodd" clip-rule="evenodd" d="M115.442 8.25039C64.7892 -2.54947 20.433 3.78533 4.88329 8.17023C3.53609 8.55013 1.62363 8.4481 0.611686 7.94234C-0.400258 7.43658 -0.128479 6.71861 1.21872 6.33871C18.3618 1.5045 65.3347 -5.06747 118.455 6.25855C119.92 6.57094 120.434 7.27006 119.601 7.82009C118.769 8.37012 116.907 8.56277 115.442 8.25039Z" fill="#161613"></path>
        </svg>
    </span>
</div>

<div class="container" style="min-height:400px;">
    <div class="row">
        <div class="col-md-12">
            <div class="bg_clrdrk">
                
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Headline</th>
                            <th>View Details</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $news = fuel_model('admissions', array('limit' => 20, 'where' => array('published' => 'yes')));
                        $id=1;
                        if (!empty($news) && is_array($news)):
                          
                            foreach ($news as $key => $item): 
                                
                        ?>
                            <tr>
                                <td><?= $id++;?></td>
                                <td><?= $item['headline'];?></td>
                                <td>
                                    <a href="<?= site_url('assets/images/admissions/' .$item['pdf']) ?>" target="_blank" download>
                                        View
                                    </a>
                                </td>
                            </tr>
                        <?php 
                                
                            endforeach; 
                        else: 
                        ?>
                            <tr>
                                <td colspan="3">No admissions data available.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
