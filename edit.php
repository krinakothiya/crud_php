<?php
include "connection.php";

$id = $name = $age = $city = $major = $marks = "";
$error = "";
$success = "";

if ($_SERVER["REQUEST_METHOD"] == 'GET') {
    if (!isset($_GET['id'])) {
        header("location: crud_php/index.php");
        exit;
    }

    $id = $_GET['id'];
    $sql = "SELECT * FROM students WHERE id = $id";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();

    if (!$row) {
        header("location: crud_php/index.php");
        exit;
    }

    $name = $row['Name'];
    $age = $row['Age'];
    $city = $row['City'];
    $major = $row['Major'];
    $marks = $row['Marks'];
} else {
    $id = $_POST['id'];
    $name = $_POST['Name'];
    $age = $_POST['Age'];
    $city = $_POST['City'];
    $major = $_POST['Major'];
    $marks = $_POST['Marks'];

    $sql = "UPDATE students SET Name=?, Age=?, City=?, Major=?, Marks=? WHERE id=?";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("sssssi", $name, $age, $city, $major, $marks, $id);

        if ($stmt->execute()) {
            $success = "Record updated successfully";
            header("Location: index.php");
            exit;
        } else {
            $error = "Error updating record: " . $stmt->error;
        }

        $stmt->close();
    } else {
        $error = "Error in prepared statement: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>CRUD</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
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

                </ul>
            </div>
        </div>
    </nav>

    <div class="col-lg-6 m-auto">

        <form method="post">

            <br><br>
            <div class="card">

                <div class="card-header bg-primary">
                    <h1 class="text-white text-center"> update data </h1>
                </div><br>

                <input type="hidden" name="id" value="<?php echo $id; ?>" class="form-control" required> <br>

                <label> NAME: </label>
                <input type="text" name="Name" value="<?php echo $name; ?>" class="form-control" required> <br>

                <label> AGE: </label>
                <input type="number" name="Age" value="<?php echo $age; ?>" class="form-control" required> <br>

                <label> CITY: </label>
                <input type="text" name="City" value="<?php echo $city; ?>" class="form-control" required> <br>

                <label> MAJOR: </label>
                <input type="text" name="Major" value="<?php echo $major; ?>" class="form-control" required> <br>

                <label> MARKS: </label>
                <input type="number" name="Marks" value="<?php echo $marks; ?>" class="form-control" required> <br>

                <button class="btn btn-success" type="submit" name="Update"> Update </button><br>

                <a class="btn btn-info" type="submit" name="cancel" href="index.php"> Cancel </a><br>
            </div>
        </form>
    </div>
</body>

</html>