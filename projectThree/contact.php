<?php 
require_once 'config.php';
include 'header.php'; 

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['send_message'])) {
    $fullName = $_POST['full_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $location = $_POST['location'];
    $message = $_POST['message'];

    try {
        $sql = "INSERT INTO messages (full_name, email, phone, location, message) VALUES (?, ?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$fullName, $email, $phone, $location, $message]);
        header("Location: contact.php?success=1");
        exit();
    } catch (PDOException $e) {
        header("Location: contact.php?error=1");
        exit();
    }
}
?>

<main style="padding-top: 100px;">
    <section>
        <div class="section-title">
            <span>Get In Touch</span>
            <h2>Contact Us</h2>
        </div>

        <div class="form-container">
            <form action="contact.php" method="POST">
                <div class="form-group">
                    <label for="full_name">Full Name</label>
                    <input type="text" id="full_name" name="full_name" required placeholder="Jane Smith">
                </div>
                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="email" id="email" name="email" required placeholder="jane@example.com">
                </div>
                <div class="form-group">
                    <label for="phone">Phone Number</label>
                    <input type="tel" id="phone" name="phone" required placeholder="+1 987 654 321">
                </div>
                <div class="form-group">
                    <label for="location">Location</label>
                    <input type="text" id="location" name="location" required placeholder="City, Country">
                </div>
                <div class="form-group">
                    <label for="message">Your Message</label>
                    <textarea id="message" name="message" rows="4" required placeholder="How can we help you?"></textarea>
                </div>
                <button type="submit" name="send_message" class="btn" style="width: 100%; cursor: pointer;">Send Message</button>
            </form>
        </div>
    </section>
</main>

<?php include 'footer.php'; ?>
