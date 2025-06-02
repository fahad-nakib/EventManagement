<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the selected date and time from the form
    $selected_date = $_POST['date'];
    $selected_time = $_POST['time'];

    // Display the selected date and time
    echo "You have selected: <br>";
    echo "Date: " . htmlspecialchars($selected_date) . "<br>";
    echo "Time: " . htmlspecialchars($selected_time);
}
?>
