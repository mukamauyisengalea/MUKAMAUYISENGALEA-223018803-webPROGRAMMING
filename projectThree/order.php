<?php 
require_once 'config.php';
include 'header.php'; 

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['place_order'])) {
    $fullName = $_POST['full_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $menuItem = $_POST['menu_item'];
    $address = $_POST['address'];
    $orderDate = $_POST['order_date'];

    try {
        $sql = "INSERT INTO orders (full_name, email, phone, menu_item, address, order_date) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$fullName, $email, $phone, $menuItem, $address, $orderDate]);
        header("Location: order.php?success=1");
        exit();
    } catch (PDOException $e) {
        header("Location: order.php?error=1");
        exit();
    }
}
?>

<main style="padding-top: 100px;">
    <section>
        <div class="section-title">
            <span>Online Dining</span>
            <h2>Place Your Order</h2>
        </div>

        <div class="form-container">
            <form action="order.php" method="POST">
                <div class="form-group">
                    <label for="full_name">Full Name</label>
                    <input type="text" id="full_name" name="full_name" required placeholder="John Doe">
                </div>
                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="email" id="email" name="email" required placeholder="john@example.com">
                </div>
                <div class="form-group">
                    <label for="phone">Phone Number</label>
                    <input type="tel" id="phone" name="phone" required placeholder="+1 234 567 890">
                </div>
                <div class="form-group">
                    <label for="menu_item">Select Menu Item</label>
                    <select id="menu_item" name="menu_item" required>
                        <option value="">-- Choose an Option --</option>
                        <option value="Grilled Salmon">Grilled Salmon</option>
                        <option value="Tuna Tartare">Tuna Tartare</option>
                        <option value="Vintage Red Wine">Vintage Red Wine</option>
                        <option value="Sunrise Citrus">Sunrise Citrus</option>
                        <option value="Green Vitality">Green Vitality</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="address">Delivery Address</label>
                    <textarea id="address" name="address" rows="3" required placeholder="123 Luxury Lane, Horizon City"></textarea>
                </div>
                <div class="form-group">
                    <label for="order_date">Date</label>
                    <input type="date" id="order_date" name="order_date" required>
                </div>
                <button type="submit" name="place_order" class="btn" style="width: 100%; cursor: pointer;">Place Order</button>
            </form>
        </div>
    </section>
</main>

<?php include 'footer.php'; ?>
