<?php
include('background_db_connector.php');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'error' => 'Invalid request method']);
    exit;
}

// Collect and sanitize inputs
$name = $_POST['name'] ?? null;
$description = $_POST['description'] ?? null;
$price = $_POST['price'] ?? null;
$category = $_POST['category'] ?? null;
$carbon = $_POST['carbon'] ?? null;

if (!$name || !$description || !$price || !$category || !$carbon) {
    echo json_encode(['success' => false, 'error' => 'Missing required fields']);
    exit;
}

// Handle image upload if provided
$imagePath = null;
if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
    $uploadDir = 'uploads/'; // Make sure this folder exists and is writable
    if (!is_dir($uploadDir)) mkdir($uploadDir, 0777, true);

    $fileTmp = $_FILES['image']['tmp_name'];
    $fileName = basename($_FILES['image']['name']);
    $ext = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

    // Optional: validate image extension
    $allowed = ['jpg','jpeg','png','gif'];
    if (!in_array($ext, $allowed)) {
        echo json_encode(['success' => false, 'error' => 'Invalid image type']);
        exit;
    }

    $newFileName = uniqid('prod_', true) . '.' . $ext;
    $imagePath = $uploadDir . $newFileName;

    if (!move_uploaded_file($fileTmp, $imagePath)) {
        echo json_encode(['success' => false, 'error' => 'Failed to upload image']);
        exit;
    }
}

// Insert product using prepared statement
$stmt = $DbConnectionObj->prepare("INSERT INTO product (Name, Description, Price, Category, CarbonFootprint, Image) VALUES (?, ?, ?, ?, ?, ?)");
if (!$stmt) {
    echo json_encode(['success' => false, 'error' => $DbConnectionObj->error]);
    exit;
}

$stmt->bind_param("ssddds", $name, $description, $price, $category, $carbon, $imagePath);

if ($stmt->execute()) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'error' => $stmt->error]);
}

$stmt->close();
exit;
?>
