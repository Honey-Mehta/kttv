<div class="main_headrani">
    UG Courses <span>
        <svg xmlns="http://www.w3.org/2000/svg" width="120" height="9" viewBox="0 0 120 9" fill="none">
            <path fill-rule="evenodd" clip-rule="evenodd" d="M115.442 8.25039C64.7892 -2.54947 20.433 3.78533 4.88329 8.17023C3.53609 8.55013 1.62363 8.4481 0.611686 7.94234C-0.400258 7.43658 -0.128479 6.71861 1.21872 6.33871C18.3618 1.5045 65.3347 -5.06747 118.455 6.25855C119.92 6.57094 120.434 7.27006 119.601 7.82009C118.769 8.37012 116.907 8.56277 115.442 8.25039Z" fill="#161613"></path>
        </svg>
    </span>
</div>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="bg_clrdrk">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Course</th>
                            <th>View Course List</th>
                        </tr>
                    </thead>
                    <tbody id="course-list">
                        <!-- Data will be dynamically inserted here -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        // Fetch UG courses on page load
        fetchCoursesUG('UG');

        function fetchCoursesUG(courseLevel) {
            $.ajax({
                url: '<?= site_url("college/get_coursesug"); ?>', // AJAX URL to controller
                type: 'POST',
                data: { course_level: courseLevel },
                dataType: 'json',
                success: function(response) {
                    // Clear the table body
                    $('#course-list').empty();

                    if (response.length > 0) {
                        let rows = '';
                        let id = 1;

                        // Loop through the response and generate rows
                        response.forEach(course => {
                            rows += `
                                <tr>
                                    <td>${id++}</td>
                                    <td>${course.course_name}</td>
                                    <td>
                                        <a href="<?= site_url('rablu_courses?course='); ?>${encodeURIComponent(course.course_name)}">View</a>
                                    </td>
                                </tr>
                            `;
                        });

                        $('#course-list').html(rows);
                    } else {
                        $('#course-list').html('<tr><td colspan="3">No courses data available.</td></tr>');
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching courses:', error);
                }
            });
        }
    });
</script>
