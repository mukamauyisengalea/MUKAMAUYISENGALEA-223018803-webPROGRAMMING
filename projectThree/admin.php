<?php 
require_once 'config.php';
include 'header.php'; 

if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit();
}

// Fetch all orders
$stmtOrders = $pdo->query("SELECT * FROM orders ORDER BY created_at DESC");
$orders = $stmtOrders->fetchAll();

// Fetch all messages
$stmtMessages = $pdo->query("SELECT * FROM messages ORDER BY created_at DESC");
$messages = $stmtMessages->fetchAll();
?>

<main style="padding-top: 100px;">
    <section>
        <div class="section-title">
            <span>Management</span>
            <h2>Dashboard</h2>
        </div>

        <h3 style="color: var(--primary); margin-bottom: 1rem;">Customer Orders</h3>
        <div class="admin-table-container">
            <table class="menu-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Menu Item</th>
                        <th>Date</th>
                        <th>Created At</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($orders)): ?>
                        <tr><td colspan="7" style="text-align:center;">No orders found.</td></tr>
                    <?php else: ?>
                        <?php foreach ($orders as $order): ?>
                            <tr>
                                <td><?= $order['id'] ?></td>
                                <td><?= htmlspecialchars($order['full_name']) ?></td>
                                <td><?= htmlspecialchars($order['email']) ?></td>
                                <td><?= htmlspecialchars($order['phone']) ?></td>
                                <td><?= htmlspecialchars($order['menu_item']) ?></td>
                                <td><?= htmlspecialchars($order['order_date']) ?></td>
                                <td><?= $order['created_at'] ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <h3 style="color: var(--primary); margin-top: 4rem; margin-bottom: 1rem;">Contact Messages</h3>
        <div class="admin-table-container">
            <table class="menu-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Location</th>
                        <th>Message</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($messages)): ?>
                        <tr><td colspan="6" style="text-align:center;">No messages found.</td></tr>
                    <?php else: ?>
                        <?php foreach ($messages as $msg): ?>
                            <tr>
                                <td><?= $msg['id'] ?></td>
                                <td><?= htmlspecialchars($msg['full_name']) ?></td>
                                <td><?= htmlspecialchars($msg['email']) ?></td>
                                <td><?= htmlspecialchars($msg['location']) ?></td>
                                <td><?= htmlspecialchars($msg['message']) ?></td>
                                <td><?= $msg['created_at'] ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </section>
</main>

<?php include 'footer.php'; ?>
