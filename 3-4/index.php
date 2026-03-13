<?php
// DB Connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "myfirstdb";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialize messages
$success_msg = '';
$error_msg = '';

// Handle actions
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['submit'])) { // INSERT or UPDATE
        $fname = trim($_POST['fname']);
        $mname = trim($_POST['mname']);
        $lname = trim($_POST['lname']);
        
        if (!empty($fname) && !empty($lname)) {
            if (isset($_POST['edit_id']) && !empty($_POST['edit_id'])) {
                // UPDATE
                $edit_id = (int)$_POST['edit_id'];
                $stmt = $conn->prepare("UPDATE persons SET person_fname=?, person_mname=?, person_lname=? WHERE id=?");
                $stmt->bind_param("sssi", $fname, $mname, $lname, $edit_id);
            } else {
                // INSERT
                $stmt = $conn->prepare("INSERT INTO persons (person_fname, person_mname, person_lname) VALUES (?, ?, ?)");
                $stmt->bind_param("sss", $fname, $mname, $lname);
            }
            
            if ($stmt->execute()) {
                $success_msg = isset($_POST['edit_id']) ? "Record updated successfully!" : "Record inserted successfully!";
            } else {
                $error_msg = "Error: " . $stmt->error;
            }
            $stmt->close();
        } else {
            $error_msg = "First and Last Name are required.";
        }
    }
}

if (isset($_GET['delete'])) {
    $delete_id = (int)$_GET['delete'];
    $stmt = $conn->prepare("DELETE FROM persons WHERE id=?");
    $stmt->bind_param("i", $delete_id);
    if ($stmt->execute()) {
        $success_msg = "Record deleted successfully!";
    } else {
        $error_msg = "Error deleting: " . $stmt->error;
    }
    $stmt->close();
}

// Handle edit
$edit_id = isset($_GET['edit']) ? (int)$_GET['edit'] : 0;
$edit_data = [];
if ($edit_id > 0) {
    $stmt = $conn->prepare("SELECT person_fname, person_mname, person_lname FROM persons WHERE id=?");
    $stmt->bind_param("i", $edit_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $edit_data = $result->fetch_assoc();
    $stmt->close();
}

?>
<?php include './layout/head.php'; ?>
    <?php if ($success_msg): ?>
        <div style="color: green; padding: 10px; border: 1px solid green; margin-bottom: 20px;">
            <?php echo htmlspecialchars($success_msg); ?>
        </div>
    <?php endif; ?>
    
    <?php if ($error_msg): ?>
        <div style="color: red; padding: 10px; border: 1px solid red; margin-bottom: 20px;">
            <?php echo htmlspecialchars($error_msg); ?>
        </div>
    <?php endif; ?>

    <h1>PHP Output 3</h1>
    <p>This output connects to the database and allows the user to save records into it.</p>
    <form action="" method="POST">
        <h2><?php echo $edit_id > 0 ? 'Edit Person' : 'Register Person'; ?></h2>
        <?php if ($edit_id > 0): ?>
            <input type="hidden" name="edit_id" value="<?php echo $edit_id; ?>">
        <?php endif; ?>
        <table>
            <tr>
                <td>
                    <label for="fname">First Name</label>
                </td>
                <td>
                    <input type="text" name="fname" id="fname" value="<?php echo isset($edit_data['person_fname']) ? htmlspecialchars($edit_data['person_fname']) : ''; ?>" placeholder="Enter First Name" required>
                </td>
            </tr>

            <tr>
                <td>
                    <label for="mname">Middle Name</label>
                </td>
                <td>
                    <input type="text" name="mname" id="mname" value="<?php echo isset($edit_data['person_mname']) ? htmlspecialchars($edit_data['person_mname']) : ''; ?>" placeholder="Enter Middle Name">
                </td>
            </tr>

            <tr>
                <td>
                    <label for="lname">Last Name</label>
                </td>
                <td>
                    <input type="text" name="lname" id="lname" value="<?php echo isset($edit_data['person_lname']) ? htmlspecialchars($edit_data['person_lname']) : ''; ?>" placeholder="Enter Last Name" required>
                </td>
            </tr>

            <tr>
                <td></td>
                <td>
                    <input type="submit" name="submit" value="<?php echo $edit_id > 0 ? 'Update' : 'Submit'; ?>">
                    <input type="reset" name="cancel" value="Cancel">
                    <?php if ($edit_id > 0): ?>
                        <a href="index.php" style="padding: 10px 20px; background: #f0f0f0; text-decoration: none;">Cancel Edit</a>
                    <?php endif; ?>
                </td>
            </tr>
        </table>
    </form>
<?php
// Fetch all records for list
$persons_result = $conn->query("SELECT * FROM persons ORDER BY id DESC");
?>

<?php if ($persons_result->num_rows > 0): ?>
    <h2>List of Registered Persons</h2>
    <table border="1" style="width:100%; border-collapse: collapse;">
        <thead>
            <tr>
                <th>ID</th>
                <th>First Name</th>
                <th>Middle Name</th>
                <th>Last Name</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $persons_result->fetch_assoc()): ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo htmlspecialchars($row['person_fname']); ?></td>
                <td><?php echo htmlspecialchars($row['person_mname']); ?></td>
                <td><?php echo htmlspecialchars($row['person_lname']); ?></td>
                <td>
                    <a href="?edit=<?php echo $row['id']; ?>">Edit</a> |
                    <a href="?delete=<?php echo $row['id']; ?>" onclick="return confirm('Delete this record?')">Delete</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
<?php else: ?>
    <p>No records yet. Add some!</p>
<?php endif; ?>

<?php $conn->close(); ?>

<?php include './layout/foot.php'; ?>
