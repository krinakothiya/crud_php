<?php

if (isset($_POST['signup'])) {
    $name = trim($_POST['name']);
    $phone = trim($_POST['phone']);
    $age = trim($_POST['age']);
    $address = trim($_POST['address']);
    $gender = trim($_POST['gender']);
    $hobby = isset($_POST['hobby']) ? $_POST['hobby'] : array();
    $city = trim($_POST['city']);
    $city = trim($_POST['img']);
    // Assuming you're handling image uploads separately

    // Validation and other logic remains the same, adapt it accordingly

    if (empty($name)) {
        $error = "Enter your name!";
        $code = 1;
    } else if (!ctype_alpha($name)) {
        $error = "Letters only!";
        $code = 1;
    } else if (empty($phone)) {
        $error = "Enter Phone NO !";
        $code = 2;
    } else if (!is_numeric($phone)) {
        $error = "Numbers only !";
        $code = 2;
    } else if (strlen($phone) != 10) {
        $error = "10 characters only !";
        $code = 2;
    } else if (empty($age)) {
        $error = "Enter Phone NO !";
        $code = 3;
    } else if (!is_numeric($age)) {
        $error = "Numbers only !";
        $code = 3;
    } elseif (empty($address)) {
        $error = "Enter your address!";
        $code = 4;
    } elseif (empty($gender)) {
        $error = "Select your gender!";
        $code = 5;
    } elseif (empty($hobby)) {
        $error = "Select at least one hobby!";
        $code = 6;
    } elseif (empty($city)) {
        $error = "Enter your city!";
        $code = 7;
    }
}
?>

<!-- <script>
    alert('success');
    document.location.href = 'secindex.php';
</script> -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>


    <form method="post">
        <!-- <table align="center" width="50%" border="0"> -->
        <?php if (isset($error)) { ?>

            <div id="error" style="color:red;"><?php echo $error; ?>>

            </div>

        <?php } ?>


        <div class="form-group col-md-6 ">
            <label for="">Name:</label>
            <input type="text" name="name" placeholder="Name" value="<?php if (isset($name)) echo $name; ?>" <?php if (isset($code) && $code == 1) echo "autofocus"; ?> />
        </div>


        <tr>
            <td><input type="text" name="phone" placeholder="Phone" value="<?php if (isset($phone)) echo $phone; ?>" <?php if (isset($code) && $code == 2) echo "autofocus"; ?> /></td>
        </tr>
        <tr>
            <td><input type="text" name="age" placeholder="Age" value="<?php if (isset($age)) echo $age; ?>" <?php if (isset($code) && $code == 3) echo "autofocus"; ?> /></td>
        </tr>
        <tr>
            <td><input type="text" name="address" placeholder="Address" value="<?php if (isset($address)) echo $address; ?>" <?php if (isset($code) && $code == 4) echo "autofocus"; ?> /></td>
        </tr>
        <tr>
            <td><input type="text" name="gender" placeholder="Gender" value="<?php if (isset($gender)) echo $gender; ?>" <?php if (isset($code) && $code == 5) echo "autofocus"; ?> /></td>
        </tr>
        <tr>
            <td><input type="text" name="hobby" placeholder="Hobby" value="<?php if (isset($hobby)) echo $hobby; ?>" <?php if (isset($code) && $code == 6) echo "autofocus"; ?> /></td>
        </tr>
        <tr>
            <td><input type="text" name="city" placeholder="City" value="<?php if (isset($city)) echo $city; ?>" <?php if (isset($code) && $code == 7) echo "autofocus"; ?> /></td>
        </tr>
        <tr>
            <td><input type="file" name="img" /></td>
        </tr>
        <tr>
            <td><button type="submit" name="signup">Submit</button></td>
        </tr>
        </table>
    </form>

</body>

</html>