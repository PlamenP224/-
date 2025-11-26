<?php

$conn = new mysqli("localhost", "root", "", "citiy");

if ($conn->connect_error) {
    die("Грешка при свързване: " . $conn->connect_error);
}

$sql = "SELECT name, COUNT(*) AS count FROM cities GROUP BY name ORDER BY count DESC";
    
$result = $conn->query($sql);

$cities = $result->fetch_all(MYSQLI_ASSOC);

echo "<table border='1' padding='6'>";
echo "<tr><th>Град</th><th>Брой срещания</th></tr>";

foreach ($cities as $row) {
    
    
    <td>" .htmlspecialchars ($row["name"]) . "</td><td>" . $row["count"] . "</td></tr>";
}

echo "</table>";

$conn->close();
?>