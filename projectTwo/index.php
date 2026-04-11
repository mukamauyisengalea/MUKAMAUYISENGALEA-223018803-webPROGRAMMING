<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Registration Form</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Student Registration Form</h1>
        <div style="text-align: right; margin-bottom: 10px;">
            <a href="review.php" style="color: #2b3a67; font-weight: bold; text-decoration: none;">View All Registrations →</a>
        </div>
        
        <form action="submit.php" method="POST">
            <!-- First Name -->
            <div class="form-group">
                <label for="first_name">FIRST NAME</label>
                <input type="text" id="first_name" name="first_name" placeholder="Enter your first name" required>
            </div>

            <!-- Last Name -->
            <div class="form-group">
                <label for="last_name">LAST NAME</label>
                <input type="text" id="last_name" name="last_name" placeholder="Enter your last name" required>
            </div>

            <!-- Date of Birth -->
            <div class="form-group">
                <label>DATE OF BIRTH</label>
                <div class="dob-group">
                    <select name="dob_day" required>
                        <option value="">Day</option>
                        <?php for($i=1; $i<=31; $i++) echo "<option value='$i'>$i</option>"; ?>
                    </select>
                    <select name="dob_month" required>
                        <option value="">Month</option>
                        <?php 
                        $months = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
                        foreach($months as $m) echo "<option value='$m'>$m</option>";
                        ?>
                    </select>
                    <select name="dob_year" required>
                        <option value="">Year</option>
                        <?php for($i=2025; $i>=1980; $i--) echo "<option value='$i'>$i</option>"; ?>
                    </select>
                </div>
            </div>

            <!-- Email -->
            <div class="form-group">
                <label for="email">EMAIL ID</label>
                <input type="email" id="email" name="email" placeholder="example@mail.com" required>
            </div>

            <!-- Mobile -->
            <div class="form-group">
                <label for="mobile">MOBILE NUMBER</label>
                <input type="tel" id="mobile" name="mobile" placeholder="10 digit number" pattern="[0-9]{10}" title="Please enter a 10-digit mobile number" required>
            </div>

            <!-- Gender -->
            <div class="form-group">
                <label>GENDER</label>
                <div class="gender-group">
                    <label class="radio-item"><input type="radio" name="gender" value="Male" required> Male</label>
                    <label class="radio-item"><input type="radio" name="gender" value="Female"> Female</label>
                </div>
            </div>

            <!-- Address -->
            <div class="form-group">
                <label for="address">ADDRESS</label>
                <textarea id="address" name="address" rows="4" placeholder="Enter your full address" required></textarea>
            </div>

            <!-- City -->
            <div class="form-group">
                <label for="city">CITY</label>
                <input type="text" id="city" name="city" required>
            </div>

            <!-- Pin Code -->
            <div class="form-group">
                <label for="pin_code">PIN CODE</label>
                <input type="text" id="pin_code" name="pin_code" placeholder="6 digit code" pattern="[0-9]{4,10}" title="Please enter a valid PIN code (4-10 digits)" required>
            </div>

            <!-- State -->
            <div class="form-group">
                <label for="state">STATE</label>
                <input type="text" id="state" name="state" required>
            </div>

            <!-- Country -->
            <div class="form-group">
                <label for="country">COUNTRY</label>
                <select id="country" name="country" required>
                    <option value="">Select Country</option>
                    <option value="India">India</option>
                    <option value="USA">USA</option>
                    <option value="UK">UK</option>
                    <option value="Canada">Canada</option>
                    <option value="Australia">Australia</option>
                </select>
            </div>

            <!-- Hobbies -->
            <div class="form-group">
                <label>HOBBIES</label>
                <div class="hobby-group">
                    <label class="check-item"><input type="checkbox" name="hobbies[]" value="Drawing"> Drawing</label>
                    <label class="check-item"><input type="checkbox" name="hobbies[]" value="Singing"> Singing</label>
                    <label class="check-item"><input type="checkbox" name="hobbies[]" value="Dancing"> Dancing</label>
                    <label class="check-item"><input type="checkbox" name="hobbies[]" value="Sketching"> Sketching</label>
                    <div style="display:flex; align-items:center; gap:10px; width:100%;">
                        <label class="check-item"><input type="checkbox" name="hobbies[]" value="Others"> Others</label>
                        <input type="text" name="other_hobby" placeholder="Please specify" style="flex:1;">
                    </div>
                </div>
            </div>

            <!-- Qualification -->
            <div class="form-group full-width">
                <label>QUALIFICATION</label>
                <table class="qualification-table">
                    <thead>
                        <tr>
                            <th>Sl.No.</th>
                            <th>Examination</th>
                            <th>Board</th>
                            <th>Percentage</th>
                            <th>Year of Passing</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Class X</td>
                            <td><input type="text" name="class_x_board" maxlength="10"></td>
                            <td><input type="number" step="0.01" name="class_x_per"></td>
                            <td><input type="text" name="class_x_year" maxlength="4"></td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>Class XII</td>
                            <td><input type="text" name="class_xii_board" maxlength="10"></td>
                            <td><input type="number" step="0.01" name="class_xii_per"></td>
                            <td><input type="text" name="class_xii_year" maxlength="4"></td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>Graduation</td>
                            <td><input type="text" name="grad_board" maxlength="10"></td>
                            <td><input type="number" step="0.01" name="grad_per"></td>
                            <td><input type="text" name="grad_year" maxlength="4"></td>
                        </tr>
                        <tr>
                            <td>4</td>
                            <td>Masters</td>
                            <td><input type="text" name="masters_board" maxlength="10"></td>
                            <td><input type="number" step="0.01" name="masters_per"></td>
                            <td><input type="text" name="masters_year" maxlength="4"></td>
                        </tr>
                    </tbody>
                </table>
                <div style="display:flex; justify-content: space-around; padding: 0 100px;">
                    <span class="table-hint">(10 char max)</span>
                    <span class="table-hint">(upto 2 decimal)</span>
                </div>
            </div>

            <!-- Courses Applied For -->
            <div class="form-group">
                <label>COURSES APPLIED FOR</label>
                <div class="course-group">
                    <label class="radio-item"><input type="radio" name="course" value="BCA" required> BCA</label>
                    <label class="radio-item"><input type="radio" name="course" value="B.Com"> B.Com</label>
                    <label class="radio-item"><input type="radio" name="course" value="B.Sc"> B.Sc</label>
                    <label class="radio-item"><input type="radio" name="course" value="B.A"> B.A</label>
                </div>
            </div>

            <!-- Buttons -->
            <div class="btn-group">
                <button type="submit" class="btn btn-submit">Submit</button>
                <button type="reset" class="btn btn-reset">Reset</button>
            </div>
        </form>
    </div>
</body>
</html>
