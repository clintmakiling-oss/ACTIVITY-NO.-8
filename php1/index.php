<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Output 1</title>
    <style>
        body {
            font-family: "Arial";
        }
    </style>
</head>
<body>
    <h1>PHP Output No. 1</h1>
    
    <fieldset>
        <legend>This form uses GET request</legend>
        <form action="redirect.php" method="GET">
        <table>
            <tr>
                <td>First Name</td>
                <td>
                    <input type="text" name="fname" placeholder="Enter First Name" required />
                </td>
            </tr>
            <tr>
                <td>Middle Name</td>
                <td>
                    <input type="text" name="mname" placeholder="Enter Middle Name" required />
                </td>
            </tr>
            <tr>
                <td>Last Name</td>
                <td>
                    <input type="text" name="lname" placeholder="Enter Last Name" required />
                </td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <input type="submit" value="Submit Data">
                    <input type="reset" value="Cancel">
                </td>
            </tr>
        </table>
        </form>
    </fieldset>
    
    <fieldset style="margin-top: 20px">
        <legend>This form uses POST request</legend>
        <form action="redirect.php" method="POST">
        <table>
            <tr>
                <td>First Name</td>
                <td>
                    <input type="text" name="fname" placeholder="Enter First Name" required />
                </td>
            </tr>
            <tr>
                <td>Middle Name</td>
                <td>
                    <input type="text" name="mname" placeholder="Enter Middle Name" required />
                </td>
            </tr>
            <tr>
                <td>Last Name</td>
                <td>
                    <input type="text" name="lname" placeholder="Enter Last Name" required />
                </td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <input type="submit" value="Submit Data">
                    <input type="reset" value="Cancel">
                </td>
            </tr>
        </table>
        </form>
    </fieldset>

</body>
</html>