<?php
require('background_db_connector.php'); // adjust path if needed

$sql = "SELECT Id, Name, Description, Price, Catagory, Image, Carbon FROM products";
$result = $DbConnectionObj->query($sql);

$products = [];

while($row = $result->fetch_assoc()) {

    // Convert numeric category -> readable category names (optional)
    $categoryMap = [
        "0" => "Cleaning & Household",
        "1" => "Kitchen & Dining",
        "2" => "Home Décor & Living",
        "3" => "Bathroom & Personal Care",
        "4" => "Lifestyle & Wellness",
        "5" => "Kids & Pets",
        "6" => "Outdoor & Garden"
    ];

    $catKey = trim((string)$row["Catagory"]);

    $products[] = [
        "Id" => $row["Id"],
        "Name" => $row["Name"],
        "Description" => $row["Description"],
        "Price" => $row["Price"],
        "Category" => $categoryMap[$catKey] ?? "Other",
        "Image" => $row["Image"] ? $row["Image"] : "https://via.placeholder.com/400x250?text=No+Image",
        "CarbonFootprint" => $row["Carbon"]
    ];
}

echo json_encode($products);




