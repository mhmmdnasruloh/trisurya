<?php
$conn = mysqli_connect('127.0.0.1', 'root', '', 'db_skripsi');

if (!$conn) {
    die('Connection failed: ' . mysqli_connect_error());
}

// Check owner user
$result = mysqli_query($conn, "SELECT id, username, role FROM users WHERE username = 'owner' OR role = 'owner'");

if ($result && mysqli_num_rows($result) > 0) {
    echo "✓ Owner users found:\n";
    while ($row = mysqli_fetch_assoc($result)) {
        echo "  - ID: {$row['id']}, Username: {$row['username']}, Role: {$row['role']}\n";
    }
} else {
    echo "⚠ No owner user found\n";
}

// Check all users
echo "\n📋 All users in database:\n";
$result = mysqli_query($conn, "SELECT id, username, role FROM users ORDER BY id");
if ($result && mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        echo "  {$row['id']}. {$row['username']} (role: {$row['role']})\n";
    }
}

mysqli_close($conn);
