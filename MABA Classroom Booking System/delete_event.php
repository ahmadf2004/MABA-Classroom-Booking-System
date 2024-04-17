<?php
require 'database_connection.php';

if(isset($_POST['event_id'])) {
    $event_id = $_POST['event_id'];
    
    // Perform deletion from the database
    $delete_query = "DELETE FROM calendar_event_master WHERE event_id = $event_id";
    if(mysqli_query($con, $delete_query)) {
        $response = array(
            'status' => true,
            'msg' => 'Event deleted successfully.'
        );
    } else {
        $response = array(
            'status' => false,
            'msg' => 'Error occurred while deleting the event.'
        );
    }
    echo json_encode($response);
} else {
    $response = array(
        'status' => false,
        'msg' => 'Invalid request.'
    );
    echo json_encode($response);
}
?>
