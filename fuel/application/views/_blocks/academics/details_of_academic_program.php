<div class="innerpage-wrapper">
            <div class="innerpage-banner">


             
            </div>
            <div class="container ">

                <article class="tabbed-content tabs-side" style="min-height:800px;">
                    <nav class="tabs">
                        <ul>

                 
                            <li><a href="#side_tab1" class="active">UG</a></li>
                            <li><a href="#side_tab2">PG</a></li>
                            <li><a href="#side_tab8">Diploma </a></li>
                          
                               
                        </ul>
                    </nav>
                    <section id="side_tab1" class="item active" data-title="Tab 1">
                        <div class="item-content">
                            <div class="table-responsive">
                                <table id="UG" class="table table-bordered coursestable">
                                    <tbody>
                                        <tr>
                                            <th width="90%">Course Name</th>
                                         
                                            <th>Details</th>
                                        </tr>

                                        <?php 
            // Fetch employee records
            
            $courses_offered = fuel_model('course_name', [
                'where' => [
                    'published' => 'yes',
                    'course_level' => 'UG'
                ]
            ]);
          
            if (!empty($courses_offered)): // Check if records are available
                foreach ($courses_offered as $courses_offer): 
                
                ?>
                   

                                        <tr>
                                            <td><span style="color: #000000">  <?php echo $courses_offer['course_name'];?></span></td>
                                          
                                            <td>
                                            <button class="openCoursePage"  data-course="<?php echo $courses_offer['course_name']; ?>">
                                            <span style="color: #ff0000">
        <!-- <img src="images/svg/viewmoreicn.svg" /> -->
        <img src="<?= img_path('icons/viewmoreicn.svg'); ?>" alt="View More" />
    </span>
    </button>

</td>
                                        </tr>
                                        <?php 

endforeach; 
else: ?>
<!-- No records message -->
<p class="text-center">No Course List.</p>
<?php endif; ?>


                                     
                                      
                                    
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </section>

                    <section id="side_tab2" class="item" data-title="Tab 2">
                        <div class="item-content">
                            <div class="table-responsive">
                                <table id="PG" class="table table-bordered coursestable">
                                    <tbody>
                                        <tr>
                                            <th width="90%"><span style="color: #000000">Course Name</span></th>
                                       
                                            <th><span style="color: #000000">Details</span></th>
                                        </tr>
                                     
                                        <?php 
            // Fetch employee records
            
            $courses_offered = fuel_model('course_name', [
                'where' => [
                    'published' => 'yes',
                    'course_level' => 'PG'
                ]
            ]);
          
            if (!empty($courses_offered)): // Check if records are available
                foreach ($courses_offered as $courses_offer): 
                
                ?>
                   
       
                                        <tr>
                                            <td><span style="color: #000000"> <?php echo $courses_offer['course_name'];?></span></td>
                                        
                                            <td><span style="color: #ff0000">
                                            <button class="openCoursePage"  data-course="<?php echo $courses_offer['course_name']; ?>">
    <span style="color: #ff0000">
        <!-- <img src="images/svg/viewmoreicn.svg" /> -->
        <img src="<?= img_path('icons/viewmoreicn.svg'); ?>" alt="View More" />
    </span>
                </button></span></td>
                                        </tr>
                                        <?php
                                    endforeach; 
else: ?>
<!-- No records message -->
<p class="text-center">No Course List.</p>
<?php endif; ?>
                   
                              
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </section>

                   
                
                  
                    
                  
                    <section id="side_tab8" class="item" data-title="Tab 8">
                        <div class="item-content">
                            <div class="table-responsive">
                                <table id="diploma" class="table table-bordered coursestable">
                                    <tbody>
                                        <tr>
                                            <th width="90%">Course Name</th>
                                        
                                            <th>Details</th>
                                        </tr>

                                        <?php 
            // Fetch employee records
            
            $courses_offered = fuel_model('course_name', [
                'where' => [
                    'published' => 'yes',
                    'course_level' => 'PGD'
                ]
            ]);
          
            if (!empty($courses_offered)): // Check if records are available
                foreach ($courses_offered as $courses_offer): 
                
                ?>

                                        <tr>
                                            <td><span style="color: #000000"><?php echo $courses_offer['course_name'];?></span></td>
                                           
                                            <td><span style="color: #ff0000">
                                            <button class="openCoursePage"  data-course="<?php echo $courses_offer['course_name']; ?>">
    <span style="color: #ff0000">
        <!-- <img src="images/svg/viewmoreicn.svg" /> -->
        <img src="<?= img_path('icons/viewmoreicn.svg'); ?>" alt="View More" />
    </span>
                </button></span></td>
                                        </tr>
                                        <?php
                                    endforeach; 
else: ?>
<!-- No records message -->
<p class="text-center">No Course List.</p>
<?php endif; ?>                        



                                      
                                       
                                         
                                    
                                      
                                      
                                    </tbody>
                                </table>
                            </div>





                        </div>

                    </section>
              
                </article>

            </div>

        </div>



 <!-- tab courses -->
 <script>
        tabControl();

        /*
        We also apply the switch when a viewport change is detected on the fly
        (e.g. when you resize the browser window or flip your device from
        portrait mode to landscape). We set a timer with a small delay to run
        it only once when the resizing ends. It's not perfect, but it's better
        than have it running constantly during the action of resizing.
        */
        var resizeTimer;
        $(window).on('resize', function (e) {
            clearTimeout(resizeTimer);
            resizeTimer = setTimeout(function () {
                tabControl();
            }, 250);
        });

        /*
        The function below is responsible for switching the tabs when clicked.
        It switches both the tabs and the accordion buttons even if
        only the one or the other can be visible on a screen. We prefer
        that in order to have a consistent selection in case the viewport
        changes (e.g. when you esize the browser window or flip your
        device from portrait mode to landscape).
        */
        function tabControl() {
            var tabs = $('.tabbed-content').find('.tabs');
            if (tabs.is(':visible')) {
                tabs.find('a').on('click', function (event) {
                    event.preventDefault();
                    var target = $(this).attr('href'),
                        tabs = $(this).parents('.tabs'),
                        buttons = tabs.find('a'),
                        item = tabs.parents('.tabbed-content').find('.item');
                    buttons.removeClass('active');
                    item.removeClass('active');
                    $(this).addClass('active');
                    $(target).addClass('active');
                });
            } else {
                $('.item').on('click', function () {
                    var container = $(this).parents('.tabbed-content'),
                        currId = $(this).attr('id'),
                        items = container.find('.item');
                    container.find('.tabs a').removeClass('active');
                    items.removeClass('active');
                    $(this).addClass('active');
                    container.find('.tabs a[href$="#' + currId + '"]').addClass('active');
                });
            }
        }
    </script>



<script>
$(document).ready(function () {
    $(".openCoursePage").click(function () {
        var courseName = $(this).data("course");
        var timestamp = new Date().getTime(); // Prevent caching

        $.ajax({
            url: "<?= site_url('college/set_course_session'); ?>",
            type: "POST",
            data: { course: courseName, nocache: timestamp }, // Send course data
            success: function () {
                window.open("<?= site_url('academics/kttv_courses'); ?>", "_blank");
            },
            cache: false // Prevent AJAX caching
        });
    });
});
</script>