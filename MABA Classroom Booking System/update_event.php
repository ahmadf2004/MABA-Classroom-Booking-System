<?php
require 'database_connection.php';

if(isset($_POST['event_id'], $_POST['event_name'], $_POST['start_date'], $_POST['end_date'])) {
    $event_id = $_POST['event_id'];
    $event_name = $_POST['event_name'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    
    // Update event details in the database
    $update_query = "UPDATE calendar_event_master SET event_name = '$event_name', event_start_date = '$start_date', event_end_date = '$end_date' WHERE event_id = $event_id";
    
    if(mysqli_query($con, $update_query)) {
        // Event updated successfully
        echo json_encode(array('status' => true, 'msg' => 'Event updated successfully.'));
        // Redirect back to display_event2.php after a short delay
        echo '<script>
                setTimeout(function() {
                    window.location.href = "display_event2.php";
                }, 2000); // 2000 milliseconds delay (2 seconds)
              </script>';
    } else {
        // Error occurred while updating event
        echo json_encode(array('status' => false, 'msg' => 'Error occurred while updating the event.'));
    }
} else {
    // Invalid request
    echo json_encode(array('status' => false, 'msg' => 'Invalid request.'));
}
?>
