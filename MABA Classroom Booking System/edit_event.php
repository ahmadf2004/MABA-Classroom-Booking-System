<?php
require 'database_connection.php';

if(isset($_GET['event_id'])) {
    $event_id = $_GET['event_id'];
    
    // Retrieve event details from the database based on event ID
    $select_query = "SELECT * FROM calendar_event_master WHERE event_id = $event_id";
    $result = mysqli_query($con, $select_query);
    $event = mysqli_fetch_assoc($result);
    
    if(!$event) {
        // Event not found
        echo 'Event not found.';
        exit;
    }
} else {
    // Event ID not provided
    echo 'Event ID not provided.';
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Event</title>
</head>
<body>
    <h2>Edit Event</h2>
    <form action="update_event.php" method="POST">
        <input type="hidden" name="event_id" value="<?php echo $event['event_id']; ?>">
        Event Name: <input type="text" name="event_name" value="<?php echo $event['event_name']; ?>"><br>
        Start Date: <input type="date" name="start_date" value="<?php echo $event['event_start_date']; ?>"><br>
        End Date: <input type="date" name="end_date" value="<?php echo $event['event_end_date']; ?>"><br>
        <input type="submit" value="Update">
    </form>
</body>
</html>
