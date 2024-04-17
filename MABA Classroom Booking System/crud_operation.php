<?php
require 'database_connection.php';

// Create operation
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action']) && $_POST['action'] == 'create') {
    $event_name = $_POST['event_name'];
    $event_start_date = date("y-m-d", strtotime($_POST['event_start_date'])); 
    $event_end_date = date("y-m-d", strtotime($_POST['event_end_date'])); 

    $insert_query = "INSERT INTO calendar_event_master (event_name, event_start_date, event_end_date) VALUES ('$event_name', '$event_start_date', '$event_end_date')";
    
    if(mysqli_query($con, $insert_query)) {
        $data = array('status' => true, 'msg' => 'Event added successfully!');
    } else {
        $data = array('status' => false, 'msg' => 'Sorry, Event not added.');
    }
    echo json_encode($data);
    exit;
}

// Read operation
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['action']) && $_GET['action'] == 'read') {
    $display_query = "SELECT event_id, event_name, event_start_date, event_end_date FROM calendar_event_master";
    $results = mysqli_query($con, $display_query);
    $count = mysqli_num_rows($results);
    
    if ($count > 0) {
        $data_arr = array();
        $i = 1;
        
        while ($data_row = mysqli_fetch_array($results, MYSQLI_ASSOC)) {
            $data_arr[$i]['event_id'] = $data_row['event_id'];
            $data_arr[$i]['title'] = $data_row['event_name'];
            $data_arr[$i]['start'] = date("Y-m-d", strtotime($data_row['event_start_date']));
            $data_arr[$i]['end'] = date("Y-m-d", strtotime($data_row['event_end_date']));
            $data_arr[$i]['color'] = '#' . substr(uniqid(), -6); // 'green'; pass colour name
            $data_arr[$i]['url'] = 'https://www.shinerweb.com';
            $i++;
        }
        
        $data = array('status' => true, 'msg' => 'Successfully!', 'data' => $data_arr);
    } else {
        $data = array('status' => false, 'msg' => 'Error!');
    }
    
    echo json_encode($data);
    exit;
}

// Update operation
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action']) && $_POST['action'] == 'update') {
    $event_id = $_POST['event_id'];
    $event_name = $_POST['event_name'];
    $event_start_date = date("y-m-d", strtotime($_POST['event_start_date'])); 
    $event_end_date = date("y-m-d", strtotime($_POST['event_end_date'])); 

    $update_query = "UPDATE calendar_event_master SET event_name='$event_name', event_start_date='$event_start_date', event_end_date='$event_end_date' WHERE event_id=$event_id";
    
    if(mysqli_query($con, $update_query)) {
        $data = array('status' => true, 'msg' => 'Event updated successfully!');
    } else {
        $data = array('status' => false, 'msg' => 'Sorry, Event not updated.');
    }
    echo json_encode($data);
    exit;
}

// Delete operation
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action']) && $_POST['action'] == 'delete') {
    $event_id = $_POST['event_id'];
    $delete_query = "DELETE FROM calendar_event_master WHERE event_id = $event_id";
    
    if(mysqli_query($con, $delete_query)) {
        $data = array('status' => true, 'msg' => 'Event deleted successfully!');
    } else {
        $data = array('status' => false, 'msg' => 'Sorry, Event not deleted.');
    }
    echo json_encode($data);
    exit;
}
?>