<?php
include "connection.php";

$nameErr = $phoneErr = $ageErr = $addressErr = $genderErr = $hobbyErr = $cityErr = $imgErr = $checkErr = "";

$name = $phone = $age = $address = $gender = $hobby = $city = $img = $check = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = test_input($_POST['name']);
    $phone = test_input($_POST['phone']);
    $age = test_input($_POST['age']);
    $address = test_input($_POST['address']);
    // $gender = test_input($_POST['gender']);
    $gender = isset($_POST['gender']) ? test_input($_POST['gender']) : '';
    $hobby = isset($_POST['hobby']) ? implode(', ', $_POST['hobby']) : '';
    $city = test_input($_POST['city']);

    $img = $_FILES['img']['name'];
    $img_tmp = $_FILES['img']['tmp_name'];
    move_uploaded_file($img_tmp, "uploads/$img");


    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        if (empty($_POST["name"])) {
            $nameErr = "Name is required";
        } else {
            $name = test_input($_POST["name"]);
            if (!preg_match("/^[a-zA-Z-' ]*$/", $name)) {
                $nameErr = "Only letters and white space allowed";
            }
        }

        if (empty($_POST["phone"])) {
            $phoneErr = "Phone no  is required";
        } else {
            $phone = test_input($_POST["phone"]);
            if (preg_match('/^[0-9]{10}+$/', $phone)) {
                $phoneErr = "Phone number should contain numbers only";
            }
        }


        if (empty($_POST["age"])) {
            $ageErr = "Age is required";
        } else {
            $age = test_input($_POST["age"]);
        }


        if (!empty($_POST["address"])) {
            $addressErr = "Address is required";
        } else {
            $address = test_input($_POST["address"]);
        }


        if (empty($_POST["gender"])) {
            $genderErr = "Gender is required";
        } else {
            $gender = test_input($_POST["gender"]);
        }

        if (empty($_POST["hobby"])) {
            $hobbyErr = "Hobby is required";
        } else {
            $hobby = test_input($_POST["hobby"]);
        }

        if (empty($_POST["city"])) {
            $cityErr = "City is required";
        } else {
            $city = test_input($_POST["city"]);
        }

        if (!empty($_FILES['img']['name'])) {
            $img = $_FILES['img']['name'];
            $img_tmp = $_FILES['img']['tmp_name'];
            move_uploaded_file($img_tmp, "uploads/$img");
        } else {
            $imgErr = "Image is required";
        }

        // Validate checkbox
        if (empty($_POST['check'])) {
            $checkErr = "conditions is required";
        } else {
            $check = test_input($_POST["check"]);
        }

        // Check if all data fields are filled
        if (!empty($name) && !empty($phone) && !empty($age) && !empty($address) && !empty($gender) && !empty($hobby) && !empty($city) && !empty($img)) {
            // $q = "INSERT INTO `student2`(`Name`, `Phone`, `Age`, `Address`, `Gender`, `Hobby`, `City`, `Img`) VALUES ('$name', '$phone', '$age', '$address', '$gender', '$hobby', '$city', '$img')";
            $hobby_str = implode(', ', $hobby);
            $q = "INSERT INTO `student2`(`Name`, `Phone`, `Age`, `Address`, `Gender`, `Hobby`, `City`, `Img`) VALUES ('$name', '$phone', '$age', '$address', '$gender', '$hobby_str', '$city', '$img')";

            if (mysqli_query($conn, $q)) {
                echo "New record created successfully";
            } else {
                echo "Error: " . $q . "<br>" . mysqli_error($conn);
            }
        } else {
            echo "Error: All data fields are required";
        }
    }
}

function test_input($data)
{
    if (is_array($data)) {
        foreach ($data as &$value) {
            $value = test_input($value);
        }
        return $data;
    }

    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

?>

<!DOCTYPE html>
<html>

<head>
    <title>CRUD</title>
    <style>
        span {
            color: red;
        }
    </style>
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

                <div class="form-group col-md-6 ">
                    <label for="">Name:</label>
                    <input type="text" name="name" id="" class="form-control">
                    <span class="error"> <?php echo $nameErr; ?></span>

                </div>

                <div class="form-group col-md-6">
                    <label for="">Phone:</label>
                    <input type="number" name="phone" id="" class="form-control">
                    <span class="error"> <?php echo $phoneErr; ?></span>
                </div>

                <div class="form-group col-md-6 ">
                    <label for="">Age:</label>
                    <input type="number" name="age" id="" class="form-control">
                    <span class="error"> <?php echo $ageErr; ?></span>

                </div>

                <div class="form-group col-md-6 ">
                    <label for="">Address:</label>
                    <textarea type="text" name="address" id="" rows="1" class="form-control"> </textarea>
                    <span class="error"> <?php echo $addressErr; ?></span>

                </div>

                <div class="form-group col-md-6 ">
                    <label>Gender:</label><br>
                    <label><input type="radio" name="gender" value="male"> Male</label>
                    <label><input type="radio" name="gender" value="female"> Female</label>
                    <label><input type="radio" name="gender" value="other"> Other</label>
                    <br>
                    <span class="error"> <?php echo $genderErr; ?></span>
                </div>

                <div class="form-group col-md-6">
                    <label for="">Hobby:</label><br>
                    <label><input type="checkbox" name="hobby[]" value="sports"> Sports</label>
                    <label><input type="checkbox" name="hobby[]" value="reading"> Reading</label>
                    <label><input type="checkbox" name="hobby[]" value="music"> Music</label>
                    <label><input type="checkbox" name="hobby[]" value="traveling"> Traveling</label>
                    <br>
                    <span class="error"> <?php echo $hobbyErr; ?></span>

                </div>

                <div class="form-group col-md-6 ">
                    <label for="">City:</label>
                    <select id="city" name="city">
                        <option value="">Select City</option>
                        <option value="New York">New York</option>
                        <option value="Los Angeles">Los Angeles</option>
                        <option value="Chicago">Chicago</option>
                    </select>
                    <span class="error"> <?php echo $cityErr; ?></span>
                </div>

                <div class="form-group col-md-6 ">
                    <label for="img">Image:</label>
                    <input type="file" id="img" name="img" accept="image/*">
                    <br>
                    <span class="error"> <?php echo $imgErr; ?></span>

                </div>

                <div class="input_filed">
                    <lable class="check">
                        <input type="checkbox">
                        <span class="checkmark text-dark"> Agree to terms and condition </span>
                    </lable>
                    <br>
                    <span class="error"> <?php echo $checkErr; ?></span>
                </div>

            </div>
            <br>

            <button class="btn btn-success" type="submit" name="submit"> Submit </button>
            <button type="cancel" class="btn btn-secondary"><a href="secindex.php" class="text-white" style="text-decoration : none"> Cancel</a></button>

        </div>


    </form>

</body>

</html>