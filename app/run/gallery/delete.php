<?php
header('Content-Type: application/json');
$data = json_decode(file_get_contents('php://input'), true);

if (isset($data['filePath']) && file_exists($data['filePath'])) {
    unlink($data['filePath']);
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false]);
}
?>
