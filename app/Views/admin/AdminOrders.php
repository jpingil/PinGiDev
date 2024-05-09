<main>
    <article class="col-12 p-3">
        <h2>PinGiDev Orders</h2>
        <table class="table table-dark">
            <thead>
            <th scope="col">Order ID</th>
            <th scope="col">Order Description</th>
            <th scope="col">User Name</th>
            <th scope="col">Product Name</th>
            </thead>
            <tbody>
                <?php
                if (count($orders)) {
                    foreach ($orders as $order) {
                        ?>
                        <tr>
                            <td><?php echo $order['id_order']; ?></td>
                            <td><?php echo $order['order_description']; ?></td>
                            <td><?php echo $order['user_name']; ?></td>
                            <td><?php echo $order['product_name']; ?></td>
                        </tr>  
                        <?php
                    }
                }
                ?>
            </tbody>
        </table>
    </article>
</main>


