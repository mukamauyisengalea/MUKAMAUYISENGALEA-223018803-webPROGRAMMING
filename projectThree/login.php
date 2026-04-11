<?php 
require_once 'config.php';
include 'header.php'; 

if (isset($_SESSION['admin_logged_in'])) {
    header("Location: admin.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    // In a real app, use password_verify with hashed passwords
    if ($user && $password === $user['password']) {
        $_SESSION['admin_logged_in'] = true;
        $_SESSION['username'] = $user['username'];
        header("Location: admin.php");
        exit();
    } else {
        header("Location: login.php?login_failed=1");
        exit();
    }
}
?>

<main style="padding-top: 150px; height: 100vh;">
    <section>
        <div class="section-title">
            <span>Staff Only</span>
            <h2>Admin Login</h2>
        </div>

        <div class="form-container" style="max-width: 400px;">
            <form action="login.php" method="POST">
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <button type="submit" name="login" class="btn" style="width: 100%; cursor: pointer;">Login</button>
            </form>
            <p style="margin-top: 1rem; color: var(--text-muted); font-size: 0.8rem; text-align: center;">
                Hint: admin / admin123
            </p>
        </div>
    </section>
</main>

<?php include 'footer.php'; ?>
