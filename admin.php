<?php

echo "Admin Area<br>";

try {
    $pdo = new PDO("mysql:host=localhost;dbname=burger", "burger", "burger");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo $e->getMessage();
}

echo "Registered Users:<br>";

$sql = "SELECT * FROM users";
foreach ($pdo->query($sql) as $row) {
    echo "User: " . $row["name"] . " Email: " . $row["email"] . "<br>";
}
echo "<br><hr>";
$sql = "SELECT * FROM orders INNER JOIN users WHERE orders.user_id = users.id";
echo "<table border='1'>";
echo "<caption>Orders Table</caption>";
echo "<th>Order Id</th>";
echo "<th>Street</th>";
echo "<th>Home</th>";
echo "<th>Part</th>";
echo "<th>Apartment</th>";
echo "<th>Floor</th>";
echo "<th>User Email</th>";
foreach ($pdo->query($sql) as $row) {
    $output = "<tr>";
    $output .= "<td>" . $row['id'] . "</td>";
    $output .= "<td>" . $row["street"] . "</td>";
    $output .= "<td>" . $row["home"] . "</td>";
    $output .= "<td>" . $row["part"] . "</td>";
    $output .= "<td>" . $row["appt"] . "</td>";
    $output .= "<td>" . $row["floor"] . "</td>";
    $output .= "<td>" . $row["email"] . "</td>";
    $output .= "</tr>";
    echo $output;
}
echo '</table>';