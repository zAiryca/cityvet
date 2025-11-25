<?php
$pdo = new PDO('mysql:host=localhost;dbname=cityvet_db', 'root', '');
$stmt = $pdo->query('SELECT id, first_name, last_name, email, role, email_verified_at FROM users ORDER BY id');
echo "=== USERS TABLE ===\n";
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    echo 'ID: ' . $row['id'] . ' | ' . $row['first_name'] . ' ' . $row['last_name'] . ' | ' . $row['email'] . ' | Role: ' . $row['role'] . ' | Verified: ' . ($row['email_verified_at'] ? 'YES' : 'NO') . "\n";
}
echo "\n=== PETS TABLE ===\n";
$stmt2 = $pdo->query('SELECT COUNT(*) as total, status FROM pets GROUP BY status');
while ($row = $stmt2->fetch(PDO::FETCH_ASSOC)) {
    echo 'Status: ' . $row['status'] . ' | Count: ' . $row['total'] . "\n";
}
echo "\n=== ANNOUNCEMENTS TABLE ===\n";
$stmt3 = $pdo->query('SELECT COUNT(*) as total FROM announcements');
$row = $stmt3->fetch(PDO::FETCH_ASSOC);
echo 'Total Announcements: ' . $row['total'] . "\n";

echo "\n=== POSTERS TABLE ===\n";
$stmt4 = $pdo->query('SELECT COUNT(*) as total FROM posters');
$row = $stmt4->fetch(PDO::FETCH_ASSOC);
echo 'Total Posters: ' . $row['total'] . "\n";

echo "\n=== PET REQUESTS TABLE ===\n";
$stmt5 = $pdo->query('SELECT COUNT(*) as total FROM pet_requests');
$row = $stmt5->fetch(PDO::FETCH_ASSOC);
echo 'Total Pet Requests: ' . $row['total'] . "\n";
?>
