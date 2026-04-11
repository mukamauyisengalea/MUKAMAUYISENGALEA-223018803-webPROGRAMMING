<?php
require_once 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Basic Info
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    
    // Construct Date of Birth (YYYY-MM-DD format for MySQL)
    $day = $_POST['dob_day'];
    $month_name = $_POST['dob_month'];
    $year = $_POST['dob_year'];
    
    $month_num = date('m', strtotime($month_name));
    $dob = "$year-$month_num-" . str_pad($day, 2, '0', STR_PAD_LEFT);
    
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $gender = $_POST['gender'];
    $address = $_POST['address'];
    $city = $_POST['city'];
    $pin_code = $_POST['pin_code'];
    $state = $_POST['state'];
    $country = $_POST['country'];
    
    // Hobbies
    $hobbies_arr = isset($_POST['hobbies']) ? $_POST['hobbies'] : [];
    $hobbies_str = implode(", ", $hobbies_arr);
    $other_hobby = $_POST['other_hobby'];
    
    // Qualification
    $class_x_board = $_POST['class_x_board'];
    $class_x_per = !empty($_POST['class_x_per']) ? $_POST['class_x_per'] : NULL;
    $class_x_year = $_POST['class_x_year'];
    
    $class_xii_board = $_POST['class_xii_board'];
    $class_xii_per = !empty($_POST['class_xii_per']) ? $_POST['class_xii_per'] : NULL;
    $class_xii_year = $_POST['class_xii_year'];
    
    $grad_board = $_POST['grad_board'];
    $grad_per = !empty($_POST['grad_per']) ? $_POST['grad_per'] : NULL;
    $grad_year = $_POST['grad_year'];
    
    $masters_board = $_POST['masters_board'];
    $masters_per = !empty($_POST['masters_per']) ? $_POST['masters_per'] : NULL;
    $masters_year = $_POST['masters_year'];
    
    $course = $_POST['course'];

    // Prepare SQL Statement
    $sql = "INSERT INTO student_registration (
                first_name, last_name, dob, email, mobile, gender, address, city, pin_code, state, country, 
                hobbies, other_hobby, 
                class_x_board, class_x_percentage, class_x_year, 
                class_xii_board, class_xii_percentage, class_xii_year, 
                graduation_board, graduation_percentage, graduation_year, 
                masters_board, masters_percentage, masters_year, 
                course_applied
            ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    
    if ($stmt) {
        $stmt->bind_param("ssssssssssssssdssdssdssdss", 
            $first_name, $last_name, $dob, $email, $mobile, $gender, $address, $city, $pin_code, $state, $country,
            $hobbies_str, $other_hobby,
            $class_x_board, $class_x_per, $class_x_year,
            $class_xii_board, $class_xii_per, $class_xii_year,
            $grad_board, $grad_per, $grad_year,
            $masters_board, $masters_per, $masters_year,
            $course
        );

        if ($stmt->execute()) {
            echo "<script>alert('Registration Successful!'); window.location.href='review.php';</script>";
        } else {
            echo "Error: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "Error: " . $conn->error;
    }
    
    $conn->close();
} else {
    header("Location: index.php");
}
?>
