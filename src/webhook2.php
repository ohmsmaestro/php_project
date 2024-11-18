// webhook2.php
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = file_get_contents('php://input');
    // Process the data for webhook2
    file_put_contents('webhook2_data.log', $data . PHP_EOL, FILE_APPEND);
    echo json_encode(['status' => 'success', 'message' => 'Data received for webhook2']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
}
?>