<div class="innerpage-wrapper">
    <div class="innerpage-banner"></div>

    <div class="container">
        <article class="tabbed-content tabs-side" style="min-height:800px;">
            <nav class="tabs">
                <ul>
                    <li><a href="#side_tab1" class="active">SOS Syllabus</a></li>
                    <li>
                        <a href="#side_tab2" class="affiliated-link">
                            Affiliated College Syllabus
                            <span class="dropdown-icon">▼</span>
                        </a>
                        <ul class="sub-tabs" style="display: none;">
                            <li><a href="#ug_tab" class="sub-link">UG</a></li>
                            <li><a href="#pg_tab" class="sub-link">PG</a></li>
                        </ul>
                    </li>
                </ul>
            </nav>

            <!-- SOS Section -->
            <section id="side_tab1" class="item active" data-title="Tab 1">
                <div class="item-content">
                    <div class="table-responsive">
                        <table id="UG" class="table table-bordered coursestable">
                            <tbody>
                                <tr>
                                    <th width="90%">SOS Course Syllabus</th>
                                </tr>
                                <?php 
                                $courses_offered = fuel_model('syllabus', [
                                    'where' => [
                                        'published' => 'yes',
                                        'type' => '1'
                                    ]
                                ]);

                                if (!empty($courses_offered)): 
                                    foreach ($courses_offered as $courses_offer): 
                                ?>
                                <tr>
                                    <td>
                                        <?php if (!empty($courses_offer['pdf'])): ?>
                                            <a href="<?= site_url('assets/images/syllabus/' . $courses_offer['pdf']); ?>" target="_blank" style="text-decoration:none;">
                                                <?= $courses_offer['headline']; ?>
                                            </a>
                                        <?php else: ?>
                                            <?= $courses_offer['headline']; ?>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                                <?php endforeach; else: ?>
                                <tr>
                                    <td colspan="2" class="text-center">No Syllabus List.</td>
                                </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </section>

            <!-- Affiliated Colleges and Courses - UG Section -->
            <section id="ug_tab" class="item" data-title="UG Courses">
                <div class="item-content">
                    <div class="table-responsive">
                        <table class="table table-bordered coursestable">
                            <tbody>
                                <tr>
                                    <th width="90%">UG Course Syllabus</th>
                                   
                                </tr>
                                <tr>
                                
                                    <td>
                                        <a href="https://highereducation.mp.gov.in/?page=JUL9t1LHqftaDqryEIQFtg%3D%3D" target="_blank" style="text-decoration:none;">
                                        UG Course Syllabus
                                        </a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </section>

            <!-- Affiliated Colleges and Courses - PG Section -->
            <section id="pg_tab" class="item" data-title="PG Courses">
                <div class="item-content">
                    <div class="table-responsive">
                        <table class="table table-bordered coursestable">
                            <tbody>
                                <tr>
                                    <th width="90%">PG Course Syllabus</th>
                                </tr>
                                <?php 
                                $pg_courses = fuel_model('syllabus', [
                                    'where' => [
                                        'published' => 'yes',
                                        'type' => '2',
                                        'affiliated_course' => '2'
                                    ]
                                ]);

                                if (!empty($pg_courses)): 
                                    foreach ($pg_courses as $course): 
                                ?>
                                <tr>
                                    <td>
                                        <?php if (!empty($course['pdf'])): ?>
                                            <a href="<?= site_url('assets/images/syllabus/' . $course['pdf']); ?>" target="_blank" style="text-decoration:none;">
                                                <?= $course['headline']; ?>
                                            </a>
                                        <?php else: ?>
                                            <?= $course['headline']; ?>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                                <?php endforeach; else: ?>
                                <tr>
                                    <td colspan="2" class="text-center">No Syllabus List.</td>
                                </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </section>
        </article>
    </div>
</div>

<!-- CSS for Dropdown Icon -->
<style>
    .dropdown-icon {
        font-size: 12px;
        margin-left: 5px;
        transition: transform 0.3s ease;
    }
    .dropdown-open .dropdown-icon {
        transform: rotate(180deg);
    }
</style>

<!-- Tab Switching Script -->
<script>
    $(document).ready(function() {
        $('.tabs a').on('click', function(event) {
            event.preventDefault();
            var target = $(this).attr('href');
            
            $('.tabs a').removeClass('active');
            $('.item').removeClass('active');
            $(this).addClass('active');
            $(target).addClass('active');

            if ($(this).hasClass('affiliated-link')) {
                var subTabs = $('.sub-tabs');
                var dropdownIcon = $(this).find('.dropdown-icon');

                subTabs.slideToggle();
                $(this).toggleClass('dropdown-open');

                $('.sub-tabs .sub-link').first().trigger('click');
            }
        });

        $('.sub-tabs .sub-link').on('click', function(event) {
            event.preventDefault();
            var target = $(this).attr('href');
            $('.sub-tabs .sub-link').removeClass('active');
            $('.item').removeClass('active');
            $(this).addClass('active');
            $(target).addClass('active');
        });
    });
</script>
