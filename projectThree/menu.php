<?php include 'header.php'; ?>

<main style="padding-top: 100px;">
    <section>
        <div class="section-title">
            <span>Culinary Delights</span>
            <h2>Our Gourmet Menu</h2>
        </div>
        
        <table class="menu-table">
            <thead>
                <tr>
                    <th>Item Category</th>
                    <th>Dish Name</th>
                    <th>Description</th>
                    <th>Price</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Fish</td>
                    <td>Grilled Salmon</td>
                    <td>Fresh Atlantic salmon with lemon butter sauce.</td>
                    <td>$28.00</td>
                </tr>
                <tr>
                    <td>Fish</td>
                    <td>Tuna Tartare</td>
                    <td>Premium Ahi tuna with avocado and soy ginger.</td>
                    <td>$22.00</td>
                </tr>
                <tr>
                    <td>Drink</td>
                    <td>Vintage Red Wine</td>
                    <td>Selected from our private cellar.</td>
                    <td>$45.00</td>
                </tr>
                <tr>
                    <td>Fresh Juice</td>
                    <td>Sunrise Citrus</td>
                    <td>Mix of orange, grapefruit, and lime.</td>
                    <td>$8.00</td>
                </tr>
                <tr>
                    <td>Fresh Juice</td>
                    <td>Green Vitality</td>
                    <td>Spinach, apple, and cucumber blend.</td>
                    <td>$9.00</td>
                </tr>
            </tbody>
        </table>
        
        <div style="text-align: center; margin-top: 3rem;">
            <a href="order.php" class="btn">Place an Order</a>
        </div>
    </section>
</main>

<?php include 'footer.php'; ?>
