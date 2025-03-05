<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>

   
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table, th, td {
            border: 1px solid black;
        }

        th, td {
            padding: 10px;
            text-align: left;
        }
    </style>
</head>
<body>
<div class="container" style="min-height:500px;">
    <div class="row">
        <div class="col-md-2">
            <!-- Optional Empty Column for Spacing -->
        </div>

        <div class="col-md-4">



        <label for="district">District:</label>
            <select id="district" name="district" class="form-control">
                <option value="">Loading...</option>
            </select>
                    

            
         

        </div>


        <div class="col-md-4">
            <!-- College Dropdown -->
            <label for="college">College:</label>
            <select id="college" name="college" class="form-control">
                <option value="">Select College</option>
            </select>
        </div>
            <!-- Search Button -->
         <div class="col-md-2 mt-2">
            <button id="searchButton" class="btn btn-primary mt-3">Search</button>
          </div>

        
        
    </div>




    <div class="row justify-content-center">
        <!-- Left Spacer -->
        <div class="col-md-2"></div>

        <!-- Main Content -->
        <div class="col-md-8">
            <?php
            // Ensure $CI is initialized
            $CI = &get_instance();

            // Get the course_name from the URL query parameter
            $course_name = $CI->input->get('course'); // Using CI's input class to fetch GET parameters

            // Fetching data based on course_name
            $query = "
                SELECT * 
                FROM colleges_course_list 
                WHERE course_name = ?
            ";
            $results = $CI->db->query($query, [$course_name])->result_array();
            ?>

            <!-- Table -->
            <table id="resultsTable" class="table table-striped mt-3 text-center" 
                   style="<?= !empty($results) ? 'display: table;' : 'display: none;'; ?>">
                <thead>
                    <tr>
                        <th>College Name</th>
                        <th>Course Name</th>
                        <th>Course Level</th>
                        <th>Branch Name</th>
                        <th>District Name</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($results)): ?>
                        <?php foreach ($results as $row): ?>
                            <tr>
                                <td><?php echo $row['college_name']; ?></td>
                                <td><?php echo $row['course_name']; ?></td>
                                <td><?php echo $row['course_level']; ?></td>
                                <td><?php echo $row['branch_name']; ?></td>
                                <td><?php echo $row['district_name']; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5">No results found.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <!-- Right Spacer -->
        <div class="col-md-2"></div>
    </div>














</div>

    <script>
        $(document).ready(function() {
            // Handle district dropdown change

          // Fetch districts using AJAX
        $.ajax({
            url: "<?= site_url('college/get_districts') ?>", // Use the controller method
            type: "GET",
            success: function (data) {
                const districts = JSON.parse(data); // Parse the JSON response
                let options = '<option value="">Select Districts</option>';

                // Loop through districts and add them as options
                districts.forEach(function (district) {
                    options += `<option value="${district.district_name}">${district.district_name}</option>`;
                });

                $('#district').html(options); // Populate the dropdown
            },
            error: function () {
                $('#district').html('<option value="">Failed to load districts</option>');
            }
        });




            $('#district').change(function() {
                const districtName = $(this).val();
                $('#college').html('<option value="">Loading...</option>');

                if (districtName) {
                    $.ajax({
                        url: "<?= site_url('college/get_colleges') ?>",
                        type: "POST",
                        data: { district_name: districtName },
                        success: function(data) {
                            const colleges = JSON.parse(data);
                            let options = '<option value="">All</option>';
                            colleges.forEach(function(college) {
                                options += `<option value="${college.college_name}">${college.college_name}</option>`;
                            });
                            $('#college').html(options);
                        }
                    });
                } else {
                    $('#college').html('<option value="">Select College</option>');
                }
            });

            // Handle Search Button Click
            $('#searchButton').click(function() {
                const districtName = $('#district').val();
                const collegeName = $('#college').val();
                
                if (!districtName) {
                    alert('Please select a district.');
                    return;
                }

                // Fetch filtered results
                $.ajax({
                    url: "<?= site_url('college/filter_results') ?>",
                    type: "POST",
                    data: {
                        district_name: districtName,
                        college_name: collegeName
                    },
                    success: function(data) {
                        const results = JSON.parse(data);
                        const tableBody = $('#resultsTable tbody');
                        tableBody.empty(); // Clear previous results

                        if (results.length > 0) {
                            results.forEach(function(result) {
                                const row = `
                                    <tr>
                                        <td>${result.college_name}</td>
                                        <td>${result.course_name}</td>
                                        <td>${result.course_level}</td>
                                        <td>${result.branch_name}</td>
                                        <td>${result.district_name}</td>
                                    </tr>`;
                                tableBody.append(row);
                            });
                                            // Show the table
                                $('#resultsTable').show();
                        } else {
                            // tableBody.append('<tr><td colspan="5">No results found.</td></tr>');

                              // Hide the table and display a "No results found" message
                $('#resultsTable').hide();
                alert('No results found.');
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('AJAX Error:', error);
                        alert('Failed to fetch data. Please try again.');
                    }
                });
            });
        });
    </script>
</body>
</html>
