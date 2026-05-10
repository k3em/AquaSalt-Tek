<?php
include 'config/db.php';
$pdo = aquasalt_db();
$stmt = $pdo->query('DESCRIBE monitoring');
while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    echo $row['Field'] . ' - ' . $row['Type'] . PHP_EOL;
}
?>