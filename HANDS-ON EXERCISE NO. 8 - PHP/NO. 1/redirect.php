<?php
    
    if($_SERVER['REQUEST_METHOD'] === 'GET'){
        $req_type = '$_GET';
    }

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $req_type = '$_POST';
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Output No. 1</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h2>Data is sent here, and it is store at <?php echo $req_type; ?> variable</h2>
    <table>
        <tr>
            <td width="120">First Name:</td>
            <td style="text-decoration: underline">
                <!-- Use ternary operator to check if the request type is GET or POST -->
                <?php echo ($req_type == '$_GET') ? $_GET['fname'] : $_POST['fname']; ?>
            </td>
        </tr>
        <tr>
            <td>Middle Name:</td>
            <td style="text-decoration: underline">
                <!-- Use ternary operator to check if the request type is GET or POST -->
                <?php echo ($req_type == '$_GET') ? $_GET['mname'] : $_POST['mname']; ?>
            </td>
        </tr>
        <tr>
            <td>Last Name:</td>
            <td style="text-decoration: underline">
                <!-- Use ternary operator to check if the request type is GET or POST -->
                <?php echo ($req_type == '$_GET') ? $_GET['lname'] : $_POST['lname'];?>
            </td>
        </tr>

        <tr>
            <td>Age:</td>
            <td style="text-decoration: underline">
                <?php echo ($req_type == '$_GET') ? $_GET['age'] : $_POST['age']; ?>
            </td>
        </tr>
        <tr>
            <td>Gender:</td>
            <td style="text-decoration: underline">
                <?php echo ($req_type == '$_GET') ? $_GET['gender'] : $_POST['gender']; ?>
            </td>
        </tr>
        <tr>
            <td>Email:</td>
            <td style="text-decoration: underline">
                <?php echo ($req_type == '$_GET') ? $_GET['email'] : $_POST['email']; ?>
            </td>
        </tr>
        <tr>
            <td>Address:</td>
            <td style="text-decoration: underline">
                <?php echo ($req_type == '$_GET') ? $_GET['address'] : $_POST['address']; ?>
            </td>
        </tr>
        <tr>
            <td>Contact Number:</td>
            <td style="text-decoration: underline">
                <?php echo ($req_type == '$_GET') ? $_GET['contact'] : $_POST['contact']; ?>
            </td>
        </tr>
    </table>
    <br><br>
    <a href="./">Return to Main Form</a>
</body>
</html>