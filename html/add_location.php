<?php

session_start();

include('../include/db.php'); 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $coordinates = $_POST['coordinates'];  

    $stmt = $conn->prepare("INSERT INTO subtopics (title, description, coordinates, user_id) VALUES (?, ?, ST_GeomFromText(?), ?)");
    $stmt->bind_param("sssi", $title, $description, $coordinates, $user_id);
    $stmt->execute();
}
?>

<form method="POST" action="add_location.php">
    <input type="text" name="title" placeholder="Location name" required>
    <textarea name="description" placeholder="Description" required></textarea>
    <input type="text" name="coordinates" placeholder="Coordinates (e.g., POINT(56.946 24.105))" required>
    <button type="submit">Add Location</button>
</form>
