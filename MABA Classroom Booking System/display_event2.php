<!DOCTYPE html>
<html>
<head>
    <title>Display Events</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<div class="container">
    <h2>Event List</h2>
    <?php                
    require 'database_connection.php'; 
    $display_query = "SELECT event_id, event_name, event_start_date, event_end_date FROM calendar_event_master";             
    $results = mysqli_query($con, $display_query);   
    $count = mysqli_num_rows($results);  

    if ($count > 0) {
        echo '<table>
                <tr>
                    <th>Event ID</th>
                    <th>Event Name</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Actions</th>
                </tr>';
        
        while ($data_row = mysqli_fetch_array($results, MYSQLI_ASSOC)) {  
            echo '<tr>';
            echo '<td>'.$data_row['event_id'].'</td>';
            echo '<td>'.$data_row['event_name'].'</td>';
            echo '<td>'.$data_row['event_start_date'].'</td>';
            echo '<td>'.$data_row['event_end_date'].'</td>';
            echo '<td>
                    <button class="edit-btn" onclick="editEvent('.$data_row['event_id'].')">Edit</button>
                    <button class="delete-btn" onclick="deleteEvent('.$data_row['event_id'].')">Delete</button>
                  </td>';
            echo '</tr>';
        }
        
        echo '</table>';
    } else {
        echo '<p>No events found.</p>';
    }
    ?>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
function deleteEvent(eventId) {
    if (confirm("Are you sure you want to delete this event?")) {
        $.ajax({
            url: 'delete_event.php',
            type: 'POST',
            dataType: 'json',
            data: { event_id: eventId },
            success: function(response) {
                if (response.status == true) {
                    alert(response.msg);
                    location.reload();
                } else {
                    alert(response.msg);
                }
            },
            error: function(xhr, status) {
                console.log('ajax error = ' + xhr.statusText);
                alert('Error occurred while deleting the event.');
            }
        });
    }
}

function editEvent(eventId) {
    window.location.href = 'edit_event.php?event_id=' + eventId;
}
</script>
</body>
</html>
