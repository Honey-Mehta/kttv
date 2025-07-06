<div class="innerpage-wrapper">
    
    <div class="container">
        <div class="table-responsive">
            <table class="datatable table">
                <tbody>
                    <tr>
                 <td>
                        <input type="date" style="float:right;width:200px;" class="form-control ninja_filter_date_picker" data-date_format="DD/MMM/YYYY" placeholder="Search Date" spellcheck="false" autocorrect="off" autocapitalize="none" id="nt_cf_0_table_31602">   
                            <!-- <div class="searchButtons">
                                <button type="submit" class="btn btn-primary" aria-label="Search" value="Search">
                                    <span class="fooicon fooicon-search">Search</span>
                                </button>
                            </div> -->
                        </td>
                    </tr>
                </tbody>
            </table>

            <!-- Table to display notifications -->
            <table class="datatable table" id="notificationsTable">
                <thead>
                    <tr>
                        <th>Date<span class="fooicon fooicon-sort-desc"></span></th>
                        <th>Title<span class="fooicon fooicon-sort"></span></th>
                    </tr>
                </thead>
                <tbody id="notificationRows">
                    <!-- Notifications will be populated here dynamically -->
                </tbody>
            </table>
        </div>
    </div>
</div>

<style>

/* Data Table */
.datatable th {
  font-size:15px;font-weight:500;
}
.datatable td {
  font-size:14px;
  border:1px solid #ddd;
  padding:5px;
}
.datatable td a{
color: #3e4d76;
}
.datatable td a:hover{
color: #000;text-decoration:underline !important;
}
.datatable td ul {
  margin:0;padding:0 20px;
}
.searchButtons button {
  width:100%;
  border:1px solid #ddd;
  padding:5px ;
}
.datatable td:nth-child(1){
  width:15%;

}

    </style>




<!-- JavaScript to handle AJAX -->
<!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->
 <script>
$(document).ready(function () {

// Function to load filtered notifications
function loadNotifications(selectedDate = '') {
    $.ajax({
        url: '<?php echo site_url("college/get_tender"); ?>', // Controller endpoint
        type: 'GET',
        data: { date: selectedDate }, // Pass selected date
        dataType: 'json',
        success: function (response) {
            // Handle success response
            if (response.status === 'success') {
                var notifications = response.data;
                $('#notificationRows').empty(); // Clear previous rows

                if (notifications.length > 0) {
                    var groupedNotifications = {};

                    // Group notifications by date
                    $.each(notifications, function (index, notification) {
                        var formattedDate = formatDate(notification.tender_date);
                        
                        // Check if PDF exists
                        var pdfLink = notification.pdf ? 
                            '<a href="<?php echo base_url("assets/tender/"); ?>' + notification.pdf + 
                            '" target="_blank" rel="noopener" style="text-decoration:none;">' + notification.name + '</a>' :
                            '<a href="#" onclick="return false;">' + notification.name + '</a>'; // Redirect to #

                        if (!groupedNotifications[formattedDate]) {
                            groupedNotifications[formattedDate] = [];
                        }
                        groupedNotifications[formattedDate].push(pdfLink);
                    });

                    // Append grouped notifications to the table
                    $.each(groupedNotifications, function (date, titles) {
                        var row = '<tr>';
                        row += '<td>' + date + '</td>'; // Display date once
                        row += '<td>' + titles.join('<br>') + '</td>'; // Display all titles for that date
                        row += '</tr>';
                        $('#notificationRows').append(row);
                    });
                } else {
                    $('#notificationRows').html('<tr><td colspan="2">No notifications found for the selected date.</td></tr>');
                }
            } else {
                $('#notificationRows').html('<tr><td colspan="2">' + response.message + '</td></tr>');
            }
        },
        error: function () {
            // Handle error response
            $('#notificationRows').html('<tr><td colspan="2">Error fetching notifications.</td></tr>');
        }
    });
}

// Attach change event to the date input field
$('#nt_cf_0_table_31602').on('change', function () {
    var selectedDate = $(this).val(); // Get selected date value
    loadNotifications(selectedDate);  // Call loadNotifications with the selected date
});

// Function to format date
function formatDate(dateStr) {
    var date = new Date(dateStr);
    return date.toLocaleDateString('en-GB'); // Format as DD/MM/YYYY
}

// Load all notifications by default on page load
loadNotifications();
});

</script>