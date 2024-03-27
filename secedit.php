<?php
include "connection.php";
$id = $name = $phone = $age = $address = $gender = $hobby = $city = $img = "";
$error = "";
$success = "";

$id = $_GET['id'];
$sql = "SELECT * FROM student2 WHERE id = $id";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$name = $row['Name'];
$phone = $row['Phone'];
$age = $row['Age'];
$address = $row['Address'];
$gender = $row['Gender'];

$hobby = $row['Hobby'];
$hobby1 = explode(",", $hobby);
$city = $row['City'];
$img = $row['Img'];

if ($_SERVER["REQUEST_METHOD"] == 'POST') {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $age = $_POST['age'];
    $address = $_POST['address'];
    $gender = $_POST['gender'];

    if (isset($_POST['hobby'])) {
        if (is_array($_POST['hobby'])) {
            $hobby = implode(',', $_POST['hobby']);
        } else {
            $hobby = $_POST['hobby'];
        }
    } else {
        $hobby = '';
    }

    $city = $_POST['city'];


    // Check if a new image is uploaded
    if (!empty($_FILES['img']['name'])) {

        $img_tmp = $_FILES['img']['tmp_name'];
        $img = $_FILES['img']['name'];
        move_uploaded_file($img_tmp, "uploads/$img");
    } else {

        // No new image uploaded, retain the current image path
        $img = $row['Img'];
    }


    $sql = "UPDATE student2 SET name=?, phone=?, age=?, address=?, gender=?, hobby=?, city=?, img=? WHERE id=?";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("ssisssssi", $name, $phone, $age, $address, $gender, $hobby, $city, $img, $id);

        if ($stmt->execute()) {
            $success = "Record updated successfully";
            header("Location: secindex.php");
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
            <a class="navbar-brand" href="secindex.php">PHP CRUD OPERATION</a>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="secindex.php">Home</a>
                    </li>

                </ul>
            </div>
        </div>
    </nav>

    <form method="post" enctype="multipart/form-data">

        <div class="container mt-4 cardp-3 bg-white">

            <div class="row">
                <input type="hidden" name="id" value="<?php echo $id; ?>" class="form-control" required> <br>

                <div class="form-group col-md-6 ">
                    <label for="">Name:</label>
                    <input type="text" name="name" id="" value="<?php echo $name; ?>" class="form-control">

                </div>

                <div class="form-group col-md-6">
                    <label for="">Phone:</label>
                    <input type="number" name="phone" id="" value="<?php echo $phone; ?>" class="form-control">
                </div>

                <div class="form-group col-md-6 ">
                    <label for="">Age:</label>
                    <input type="number" name="age" id="" value="<?php echo $age; ?>" class="form-control">

                </div>

                <div class="form-group col-md-6 required">
                    <label for="address">Address:</label>
                    <textarea name="address" id="address" rows="1" class="form-control"><?php echo $address; ?></textarea>
                </div>

                <div class="form-group col-md-6 required">
                    <label for="gender">Gender:</label><br>
                    <input type="radio" id="male" name="gender" value="male" <?php if ($gender === "male") echo "checked"; ?>>
                    <label for="male">Male</label>
                    <input type="radio" id="female" name="gender" value="female" <?php if ($gender === "female") echo "checked"; ?>>
                    <label for="female">Female</label>
                    <input type="radio" id="other" name="gender" value="other" <?php if ($gender === "other") echo "checked"; ?>>
                    <label for="other">Other</label>
                    <span id="genderError" class="error"></span>
                </div>

                <div class="form-group col-md-6">
                    <label for="">Hobby:</label><br>
                    <label><input type="checkbox" name="hobby[]" value="sports" <?php if (in_array('sports', $hobby1)) {
                                                                                    echo "checked";
                                                                                } ?>> Sports</label>
                    <label><input type="checkbox" name="hobby[]" value="reading" <?php if (in_array('reading', $hobby1)) {
                                                                                        echo "checked";
                                                                                    } ?>> Reading</label>
                    <label><input type="checkbox" name="hobby[]" value="music" <?php if (in_array('music', $hobby1)) {
                                                                                    echo "checked";
                                                                                } ?>> Music</label>
                    <label><input type="checkbox" name="hobby[]" value="traveling" <?php if (in_array('traveling', $hobby1)) {
                                                                                        echo "checked";
                                                                                    } ?>> Traveling</label>
                </div>

                <div class="form-group col-md-6 required">
                    <label for="city">City:</label>
                    <select id="city" name="city" required>
                        <option value="">Select City</option>
                        <option value="New York" <?php if ($city === "New York") echo "selected"; ?>>New York</option>
                        <option value="Los Angeles" <?php if ($city === "Los Angeles") echo "selected"; ?>>Los Angeles</option>
                        <option value="Chicago" <?php if ($city === "Chicago") echo "selected"; ?>>Chicago</option>
                    </select>
                </div>

                <div class="form-group col-md-6">
                    <label for="img">Image:</label>
                    <input type="file" id="img" name="img" accept="image/*">
                    <br>
                    <?php if (!empty($img) && file_exists("uploads/$img")) : ?>
                        <img src="<?php echo "uploads/$img"; ?>" alt="Image" width="100" height="100">
                    <?php else : ?>
                        <span>No image uploaded</span>
                    <?php endif; ?>
                </div>



                <!-- <div class="input_filed">
                    <lable class="check">
                        <input type="checkbox">
                        <span class="checkmark text-dark"> Agree to terms and condition </span>
                    </lable>
                </div> -->

            </div>
            <br>

            <button class="btn btn-success" type="submit" name="Update"> Update </button>
            <button type="cancel" class="btn btn-secondary"><a href="secindex.php" class="text-white" style="text-decoration : none"> Cancel</a></button>

        </div>


    </form>

</body>

</html>