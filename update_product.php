<?php
include('background_db_connector.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $id = $_POST['id'] ?? null;

    if (!$id) {
        echo json_encode([
            'success' => false,
            'error' => 'Invalid or missing product ID'
        ]);
        exit;
    }

    $name = $_POST['name'] ?? null;
    $description = $_POST['description'] ?? null;
    $price = $_POST['price'] ?? null;
    $catagory = $_POST['category'] ?? null;
    $carbon  = $_POST['carbon'] ?? null;
    $image = $_POST['image'] ?? null;

    $fields = [];
    $params = [];
    $types  = "";

    if ($name !== null) {
        $fields[] = "name = ?";
        $params[] = $name;
        $types .= "s";
    }

    if ($description !== null) {
        $fields[] = "description = ?";
        $params[] = $description;
        $types .= "s";
    }

    if ($price !== null) {
        if (!is_numeric($price)) {
            echo json_encode(['success' => false, 'error' => 'Invalid price']);
            exit;
        }
        $fields[] = "price = ?";
        $params[] = (float)$price;
        $types .= "d";
    }

    if ($catagory !== null) {
        if (!is_numeric($catagory)) {
            echo json_encode(['success' => false, 'error' => 'Invalid category']);
            exit;
        }
        $fields[] = "catagory = ?";
        $params[] = (int)$catagory;
        $types .= "i";
    }

    if ($carbon !== null) {
        if (!is_numeric($carbon)) {
            echo json_encode(['success' => false, 'error' => 'Invalid carbon value']);
            exit;
        }
        $fields[] = "carbon = ?";
        $params[] = (float)$carbon;
        $types .= "d";
    }

    if ($image !== null) {
        $fields[] = "Image = ?";
        $params[] = $image;
        $types .= "s";
    }

    if (empty($fields)) {
        echo json_encode([
            'success' => false,
            'error' => 'No fields provided to update'
        ]);
        exit;
    }

    $sql = "UPDATE products SET " . implode(", ", $fields) . " WHERE Id = ?";
    $params[] = (int)$id;
    $types .= "i";

    $stmt = $DbConnectionObj->prepare($sql);

    if (!$stmt) {
        echo json_encode([
            'success' => false,
            'error' => $DbConnectionObj->error
        ]);
        exit;
    }

    $stmt->bind_param($types, ...$params);

    if ($stmt->execute()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode([
            'success' => false,
            'error' => $stmt->error
        ]);
    }

    $stmt->close();
    exit;
}
?>
