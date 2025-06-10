<?php

session_start();

include('../include/db.php'); 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fish_type = $_POST['fish_type'];
    $weight = $_POST['weight'];
    $length = $_POST['length'];
    $subtopic_id = $_POST['subtopic_id'];  

    $stmt = $conn->prepare("INSERT INTO fish_records (fish_type, weight, length, user_id, subtopic_id) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sddii", $fish_type, $weight, $length, $user_id, $subtopic_id);
    $stmt->execute();
}
?>

<form method="POST" action="add_fish_record.php">
    <input type="text" name="fish_type" placeholder="Fish type" required>
    <input type="number" name="weight" placeholder="Weight of the fish" required>
    <input type="number" name="length" placeholder="Length of the fish" required>
    <select name="subtopic_id" required>
    </select>
    <button type="submit">Add Fish Record</button>
</form>
