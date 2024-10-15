<?php
// Include the necessary files
require_once '..//User_Sql_Controller.php';

// Create an instance of User_Sql_Controller
$userController = new User_Sql_Controller();

// Fetch users
$users = $userController->getUsers();

// Check if users were retrieved
if (!empty($users)) {
    echo "<h1>User List</h1>";
    echo "<table border='1'>";
    echo "<tr><th>ID</th><th>First Name</th><th>Last Name</th><th>Username</th><th>Email</th><th>Role</th><th>Create Date</th></tr>";
    
    // Loop through each user and display their information
    foreach ($users as $user) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($user->getUserID()) . "</td>";
        echo "<td>" . htmlspecialchars($user->getFirstname()) . "</td>";
        echo "<td>" . htmlspecialchars($user->getLastname()) . "</td>";
        echo "<td>" . htmlspecialchars($user->getUsername()) . "</td>";
        echo "<td>" . htmlspecialchars($user->getEmail()) . "</td>";
        echo "<td>" . htmlspecialchars($user->getRole()) . "</td>";
        echo "<td>" . htmlspecialchars($user->getCreatedate()) . "</td>";
        echo "</tr>";
    }
    
    echo "</table>";
} else {
    echo "<p>No users found.</p>";
}
?>
