<?php
require_once 'config.php';

$msg = "";
$mode = "list"; // default mode
$edit_data = null;

// --- HANDLE DELETE ---
if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $conn->prepare("DELETE FROM student_registration WHERE id = ?");
    $stmt->bind_param("i", $id);
    if ($stmt->execute()) {
        $msg = "Record deleted successfully!";
    }
    $stmt->close();
}

// --- HANDLE UPDATE (POST) ---
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_record'])) {
    $id = $_POST['id'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $dob = $_POST['dob_year'] . "-" . date('m', strtotime($_POST['dob_month'])) . "-" . str_pad($_POST['dob_day'], 2, '0', STR_PAD_LEFT);
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $gender = $_POST['gender'];
    $address = $_POST['address'];
    $city = $_POST['city'];
    $pin_code = $_POST['pin_code'];
    $state = $_POST['state'];
    $country = $_POST['country'];
    $hobbies_str = implode(", ", isset($_POST['hobbies']) ? $_POST['hobbies'] : []);
    $other_hobby = $_POST['other_hobby'];
    
    $sql = "UPDATE student_registration SET first_name=?, last_name=?, dob=?, email=?, mobile=?, gender=?, address=?, city=?, pin_code=?, state=?, country=?, hobbies=?, other_hobby=?, class_x_board=?, class_x_percentage=?, class_x_year=?, class_xii_board=?, class_xii_percentage=?, class_xii_year=?, graduation_board=?, graduation_percentage=?, graduation_year=?, masters_board=?, masters_percentage=?, masters_year=?, course_applied=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssssssssssdssdssdssdssi", 
        $first_name, $last_name, $dob, $email, $mobile, $gender, $address, $city, $pin_code, $state, $country,
        $hobbies_str, $other_hobby,
        $_POST['class_x_board'], $_POST['class_x_per'], $_POST['class_x_year'],
        $_POST['class_xii_board'], $_POST['class_xii_per'], $_POST['class_xii_year'],
        $_POST['grad_board'], $_POST['grad_per'], $_POST['grad_year'],
        $_POST['masters_board'], $_POST['masters_per'], $_POST['masters_year'],
        $_POST['course'], $id
    );
    
    if ($stmt->execute()) {
        $msg = "Update Successful!";
    } else {
        $msg = "Error: " . $conn->error;
    }
    $stmt->close();
}

// --- PREPARE DATA FOR EDIT MODE ---
if (isset($_GET['action']) && $_GET['action'] == 'edit' && isset($_GET['id'])) {
    $mode = "edit";
    $id = $_GET['id'];
    $stmt = $conn->prepare("SELECT * FROM student_registration WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $edit_data = $stmt->get_result()->fetch_assoc();
    $stmt->close();
}

// --- FETCH DATA FOR LIST MODE ---
$result = $conn->query("SELECT * FROM student_registration ORDER BY id DESC");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Management</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .review-container { max-width: 1200px; margin: 20px auto; background: white; padding: 30px; border-radius: 10px; box-shadow: 0 0 20px rgba(0,0,0,0.1); }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; font-size: 0.9em; }
        th, td { text-align: left; padding: 12px; border-bottom: 1px solid #ddd; }
        th { background-color: #f8f9fa; }
        .btn-sm { padding: 5px 10px; border-radius: 4px; text-decoration: none; font-size: 0.85em; }
        .btn-edit { background: #e3f2fd; color: #1976d2; }
        .btn-delete { background: #ffebee; color: #d32f2f; margin-left:10px; }
        .msg { padding: 10px; background: #e8f5e9; color: #2e7d32; border-radius: 5px; margin-bottom: 20px; }
    </style>
</head>
<body>
    <div class="container" style="<?php echo ($mode == 'list' ? 'max-width:1200px;' : ''); ?>">
        
        <?php if ($msg): ?>
            <div class="msg"><?php echo $msg; ?></div>
        <?php endif; ?>

        <?php if ($mode == 'list'): ?>
            <h1>Registered Students</h1>
            <div style="margin-bottom: 20px;">
                <a href="index.php" class="btn btn-submit" style="text-decoration:none;">+ Register New Student</a>
            </div>
            <table>
                <thead>
                    <tr>
                        <th>Name</th><th>Email</th><th>Mobile</th><th>Gender</th><th>Course</th><th>Date</th><th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $row['first_name'] . " " . $row['last_name']; ?></td>
                            <td><?php echo $row['email']; ?></td>
                            <td><?php echo $row['mobile']; ?></td>
                            <td><?php echo $row['gender']; ?></td>
                            <td><?php echo $row['course_applied']; ?></td>
                            <td><?php echo date('d-M', strtotime($row['created_at'])); ?></td>
                            <td>
                                <a href="?action=edit&id=<?php echo $row['id']; ?>" class="btn-sm btn-edit">Edit</a>
                                <a href="?action=delete&id=<?php echo $row['id']; ?>" class="btn-sm btn-delete" onclick="return confirm('Delete this record?')">Delete</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>

        <?php elseif ($mode == 'edit' && $edit_data): ?>
            <h1>Edit Registration</h1>
            <form action="review.php" method="POST">
                <input type="hidden" name="id" value="<?php echo $edit_data['id']; ?>">
                <input type="hidden" name="update_record" value="1">
                
                <div class="form-group">
                    <label>FIRST NAME</label>
                    <input type="text" name="first_name" value="<?php echo $edit_data['first_name']; ?>" required>
                </div>
                <div class="form-group">
                    <label>LAST NAME</label>
                    <input type="text" name="last_name" value="<?php echo $edit_data['last_name']; ?>" required>
                </div>
                <!-- Simplified Date for brevity in edit -->
                <div class="form-group">
                    <label>DATE OF BIRTH</label>
                    <div class="dob-group">
                        <?php $d = explode("-", $edit_data['dob']); ?>
                        <input type="number" name="dob_day" value="<?php echo (int)$d[2]; ?>" style="width:60px;">
                        <input type="text" name="dob_month" value="<?php echo date('M', strtotime($edit_data['dob'])); ?>" style="width:80px;">
                        <input type="number" name="dob_year" value="<?php echo $d[0]; ?>" style="width:80px;">
                    </div>
                </div>
                <div class="form-group">
                    <label>EMAIL ID</label>
                    <input type="email" name="email" value="<?php echo $edit_data['email']; ?>" required>
                </div>
                <div class="form-group">
                    <label>MOBILE</label>
                    <input type="text" name="mobile" value="<?php echo $edit_data['mobile']; ?>" required>
                </div>
                <div class="form-group">
                    <label>GENDER</label>
                    <input type="radio" name="gender" value="Male" <?php echo ($edit_data['gender']=='Male'?'checked':''); ?>> Male
                    <input type="radio" name="gender" value="Female" <?php echo ($edit_data['gender']=='Female'?'checked':''); ?>> Female
                </div>
                <div class="form-group">
                    <label>CITY</label>
                    <input type="text" name="city" value="<?php echo $edit_data['city']; ?>">
                </div>
                <div class="form-group">
                    <label>COURSE</label>
                    <select name="course">
                        <?php foreach(['BCA','B.Com','B.Sc','B.A'] as $c) echo "<option ".($edit_data['course_applied']==$c?'selected':'').">$c</option>"; ?>
                    </select>
                </div>

                <!-- Qualification Hidden or partially shown to keep it simple -->
                <input type="hidden" name="address" value="<?php echo $edit_data['address']; ?>">
                <input type="hidden" name="pin_code" value="<?php echo $edit_data['pin_code']; ?>">
                <input type="hidden" name="state" value="<?php echo $edit_data['state']; ?>">
                <input type="hidden" name="country" value="<?php echo $edit_data['country']; ?>">
                <input type="hidden" name="other_hobby" value="<?php echo $edit_data['other_hobby']; ?>">
                <input type="hidden" name="class_x_board" value="<?php echo $edit_data['class_x_board']; ?>">
                <input type="hidden" name="class_x_per" value="<?php echo $edit_data['class_x_percentage']; ?>">
                <input type="hidden" name="class_x_year" value="<?php echo $edit_data['class_x_year']; ?>">
                <input type="hidden" name="class_xii_board" value="<?php echo $edit_data['class_xii_board']; ?>">
                <input type="hidden" name="class_xii_per" value="<?php echo $edit_data['class_xii_percentage']; ?>">
                <input type="hidden" name="class_xii_year" value="<?php echo $edit_data['class_xii_year']; ?>">
                <input type="hidden" name="grad_board" value="<?php echo $edit_data['graduation_board']; ?>">
                <input type="hidden" name="grad_per" value="<?php echo $edit_data['graduation_percentage']; ?>">
                <input type="hidden" name="grad_year" value="<?php echo $edit_data['graduation_year']; ?>">
                <input type="hidden" name="masters_board" value="<?php echo $edit_data['masters_board']; ?>">
                <input type="hidden" name="masters_per" value="<?php echo $edit_data['masters_percentage']; ?>">
                <input type="hidden" name="masters_year" value="<?php echo $edit_data['masters_year']; ?>">

                <div class="btn-group">
                    <button type="submit" class="btn btn-submit">Save Changes</button>
                    <a href="review.php" class="btn" style="background:#666; color:white; text-decoration:none; padding:10px 20px; border-radius:5px;">Cancel</a>
                </div>
            </form>
        <?php endif; ?>
    </div>
</body>
</html>
<?php $conn->close(); ?>
