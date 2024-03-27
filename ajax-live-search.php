<?php
include "connection.php";

if (isset($_POST['search'])) {
    $search_term = $_POST['search'];

    $sql = "SELECT * FROM students WHERE Name LIKE '%$search_term%'"; // Assuming 'Name' is the column you want to search
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            // Output the search results in HTML format
            echo "<tr>";
            echo "<td>" . $row['id'] . "</td>";
            echo "<td>" . $row['Name'] . "</td>";
            echo "<td>" . $row['Age'] . "</td>";
            echo "<td>" . $row['City'] . "</td>";
            echo "<td>" . $row['Major'] . "</td>";
            echo "<td>" . $row['Marks'] . "</td>";
            echo "<td>
                    <a class='btn btn-success' href='edit.php?id=" . $row['id'] . "'>Edit</a>
                    <a class='btn btn-danger' href='delete.php?id=" . $row['id'] . "'>Delete</a>
                  </td>";
            echo "</tr>";
        }
    } else {
        // If no results found
        echo "<tr><td colspan='7'>No results found</td></tr>";
    }
}
