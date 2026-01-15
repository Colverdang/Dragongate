<?php
session_start();
include('background_db_connector.php');

$userId = $_SESSION['Id'];

$sql = "
SELECT 
    p.Id,
    p.Title,
    p.Content,
    p.Date,

    CONCAT(
        UPPER(LEFT(u.Name, 1)),
        UPPER(LEFT(u.Surname, 1))
    ) AS Initials,

    CONCAT(u.Name, ' ', u.Surname) AS Name,

    COUNT(pl.UserId) AS likeCount,

    MAX(
        CASE 
            WHEN pl.UserId = ? AND pl.Active = 1 THEN 1
            ELSE 0
        END
    ) AS likedByUser

FROM post p
JOIN user u ON u.Id = p.UserId
LEFT JOIN postlike pl 
    ON pl.PostId = p.Id AND pl.Active = 1

GROUP BY p.Id
ORDER BY p.Date DESC
";

$stmt = $DbConnectionObj->prepare($sql);
$stmt->bind_param("i", $userId);
$stmt->execute();

$result = $stmt->get_result();
$data = $result->fetch_all(MYSQLI_ASSOC);

function e($str) {
    return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}

$cleanData = [];

foreach ($data as $row) {
    $cleanData[] = [
        'Id' => (int)$row['Id'],
        'Title' => e($row['Title']),
        'Content' => e($row['Content']),
        'Date' => $row['Date'],
        'Initials' => e($row['Initials']),
        'Name' => e($row['Name']),
        'likeCount' => (int)$row['likeCount'],
        'likedByUser' => (int)$row['likedByUser']
    ];
}

echo json_encode($cleanData);

