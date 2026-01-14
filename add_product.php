<?php
include('background_db_connector.php');
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'error' => 'Invalid request method']);
    exit;
}

// Collect inputs
$name        = $_POST['name'] ?? null;
$description = $_POST['description'] ?? null;
$price       = $_POST['price'] ?? null;
$category    = $_POST['category'] ?? null;
$carbon      = $_POST['carbon'] ?? null;

// Validate required fields
if (
    empty($name) ||
    empty($description) ||
    !isset($price) ||
    !isset($category) ||
    !isset($carbon)
) {
    echo json_encode(['success' => false, 'error' => 'Missing required fields']);
    exit;
}

// Handle image upload
$imageBase64 = null;

if (!empty($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {

    $tmpName = $_FILES['image']['tmp_name'];

    // Security: ensure it's actually an image
    $mime = mime_content_type($tmpName);
    if (!str_starts_with($mime, 'image/')) {
        echo json_encode(['success' => false, 'error' => 'Invalid image file']);
        exit;
    }

    // Read file & encode
    $imageData = file_get_contents($tmpName);
    $base64 = base64_encode($imageData);

    // Build data URI
    $imageBase64 = "data:$mime;base64,$base64";
}


// Insert product
$stmt = $DbConnectionObj->prepare(
    "INSERT INTO products (Name, Description, Price, Catagory, Carbon, Image)
     VALUES (?, ?, ?, ?, ?, ?)"
);

if (!$stmt) {
    echo json_encode(['success' => false, 'error' => $DbConnectionObj->error]);
    exit;
}

$stmt->bind_param(
    "ssdids",
    $name,
    $description,
    $price,
    $category,
    $carbon,
    $imageBase64
);

if ($stmt->execute()) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'error' => $stmt->error]);
}

$stmt->close();
exit;
