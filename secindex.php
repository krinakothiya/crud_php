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
            <a class="navbar-brand" href="secindex.php">PHP CRUD OPERATION</a>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="secindex.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php"><span style="font-size:larger;">First table</span></a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container my-5">
        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
            <button class="btn btn-primary me-5 mt-4" type="button"> <a href="seccreate.php" class="text-white" style="text-decoration : none"> Add New</button> </a>

        </div>
        <table class="table">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Phone</th>
                    <th>Age</th>
                    <th>Address</th>
                    <th>Gender</th>
                    <th>Hobby</th>
                    <th>City</th>
                    <th>Img</th>
                    <th>Action</th>

                </tr>
            </thead>
            <tbody>
                <?php
                include "connection.php";
                $sql = "SELECT * FROM student2";
                $result = $conn->query($sql) or die("connection is fail");

                while ($row = $result->fetch_assoc()) {

                ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['Name']; ?></td>
                        <td><?php echo $row['Phone']; ?></td>
                        <td><?php echo $row['Age']; ?></td>
                        <td><?php echo $row['Address']; ?></td>
                        <td><?php echo $row['Gender']; ?></td>
                        <td><?php echo $row['Hobby']; ?></td>
                        <td><?php echo $row['City']; ?></td>
                        <td>
                            <img src="uploads/<?php echo $row['Img']; ?>" alt="Image" width="100" height="100">
                        </td>

                        <td>
                            <a class='btn btn-success' href='secedit.php?id=<?php echo $row['id']; ?>'>Edit</a>
                            <a class='btn btn-danger' href='secdelete.php?id=<?php echo $row['id']; ?>'>Delete</a>
                        </td>

                    </tr>
                <?php } ?>

            </tbody>
        </table>
    </div>

</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</html>