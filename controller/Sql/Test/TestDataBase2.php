<?php
// Include the necessary files
require_once '../controller/Community_Sql_Controller.php';

// Create an instance of User_Sql_Controller
$Community_Sql_Controller = new Community_Sql_Controller();

// Fetch users
$Communities = $Community_Sql_Controller->getCommunities();

// Check if users were retrieved
if (!empty($Communities)) {
    echo "<h1>User List</h1>";
    echo "<table border='1'>";
    echo "<tr><th>ID</th><th>Community Name</th><th>Description</th>";
    
    // Loop through each user and display their information
    foreach ($Communities as $Community) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($Community->getCommunityID()) . "</td>";
        echo "<td>" . htmlspecialchars($Community->getCommunityName()) . "</td>";
        echo "<td>" . htmlspecialchars($Community->getCommunityDescription()) . "</td>";
        echo "</tr>";
    }
    
    echo "</table>";
} else {
    echo "<p>No users found.</p>";
}
?>
