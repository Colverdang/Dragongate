<?php
require('background_db_connector.php'); // adjust path if needed

$sql = "SELECT Id, Name, Description, Price, Catagory, Image FROM products";
$result = $DbConnectionObj->query($sql);

$products = [];

while($row = $result->fetch_assoc()) {

    // Convert numeric category -> readable category names (optional)
    $categoryMap = [
        "0" => "Cleaning & Household",
        "1" => "Kitchen & Dining",
        "2" => "Home Décor & Living"
    ];

    $products[] = [
        "id" => $row["Id"],
        "name" => $row["Name"],
        "description" => $row["Description"],
        "price" => $row["Price"],
        "category" => isset($categoryMap[$row["Catagory"]]) ? $categoryMap[$row["Catagory"]] : "Other",
        "image" => $row["Image"] ? $row["Image"] : "https://via.placeholder.com/400x250?text=No+Image"
    ];
}

echo json_encode($products);


