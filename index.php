<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">PHP CRUD OPERATION</a>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="secindex.php"><span style="font-size:larger;">second table</span></a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container my-5">
        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
            <div id="search-bar" class="mt-4 me-3">
                <label for="search"> Search : </label>
                <input type="text" id="search" autocomplete="off">
            </div>
            <button class="btn btn-primary me-5 mt-4" type="button"> <a href="create.php" class="text-white" style="text-decoration : none"> Add New</button> </a>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Age</th>
                    <th>City</th>
                    <th>Major</th>
                    <th>Marks</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include "connection.php";

                // Pagination
                $limit = 5;
                $page = isset($_GET['page']) ? $_GET['page'] : 1;
                $start = ($page - 1) * $limit;
                $sql = "SELECT * FROM students LIMIT $start, $limit";
                $result = $conn->query($sql) or die("connection is fail");

                while ($row = $result->fetch_assoc()) {
                ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['Name']; ?></td>
                        <td><?php echo $row['Age']; ?></td>
                        <td><?php echo $row['City']; ?></td>
                        <td><?php echo $row['Major']; ?></td>
                        <td><?php echo $row['Marks']; ?></td>
                        <td>
                            <a class='btn btn-success' href='edit.php?id=<?php echo $row['id']; ?>'>Edit</a>
                            <a class='btn btn-danger' href='delete.php?id=<?php echo $row['id']; ?>'>Delete</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        <tbody id="table-data">

        </tbody>

        <!-- Pagination Links -->
        <nav aria-label="Page navigation example ">
            <ul class="pagination">
                <?php
                $sql = "SELECT COUNT(id) AS total FROM students";
                $result = $conn->query($sql);
                $row = $result->fetch_assoc();
                $total_pages = ceil($row["total"] / $limit);
                ?>
                <li class="page-item"><a class="page-link" href="?page=1">First</a></li>
                <li class="page-item <?php if ($page <= 1) {
                                            echo 'disabled';
                                        } ?>">
                    <a class="page-link" href="<?php if ($page <= 1) {
                                                    echo '#';
                                                } else {
                                                    echo "?page=" . ($page - 1);
                                                } ?>">
                        < </a>
                </li>
                <li class="page-item <?php if ($page >= $total_pages) {
                                            echo 'disabled';
                                        } ?>">
                    <a class="page-link" href="<?php if ($page >= $total_pages) {
                                                    echo '#';
                                                } else {
                                                    echo "?page=" . ($page + 1);
                                                } ?>"> > </a>
                </li>
                <li class="page-item"><a class="page-link" href="?page=<?php echo $total_pages; ?>">Last</a></li>
            </ul>
        </nav>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<!-- <script>
    $(document).ready(function() {
        $('#search').keyup(function() {
            var search_term = $(this).val();

            $.ajax({
                url: "ajax-live-search.php",
                type: "POST",
                data: {
                    search: search_term
                },
                success: function(data) {
                    $("#table-data").html(data);
                }
            });

        })
    })
</script> -->

</html>