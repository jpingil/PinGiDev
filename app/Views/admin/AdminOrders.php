<main>
    <article>
        <h2>PinGiDev Orders</h2>
        <?php
        if (isset($message)) {
            ?>
            <div class="alert alert-<?= $message['class']; ?> m-2">
                <p><?php echo $message['message']; ?></p>
            </div>
            <?php
        }
        ?>
        <table>
            <thead>
            <th scope="col">Order ID</th>
            <th scope="col">Order Description</th>
            <th scope="col">User Email</th>
            <th scope="col">Product Name</th>
            <th scope = "col">Actions</th>
            </thead>
            <tbody>
                <?php
                if (count($orders)) {
                    foreach ($orders as $order) {
                        ?>
                        <tr>
                            <td><?php echo $order['id_order']; ?></td>
                            <td><?php echo $order['order_description']; ?></td>
                            <td><?php echo $order['email']; ?></td>
                            <td><?php echo $order['product_name']; ?></td>
                            <td>
                                <a class="fa-regular fa-pen-to-square icon" href="/AdminOrders/edit/<?= $order['id_order']; ?>" aria-label="edit order"></a>
                                <a class="fa-regular fa-trash-can icon" href="/AdminOrders/delete/<?php echo $order['id_order']; ?>" aria-label="delete order"></a>
                            </td>
                        </tr>  
                        <?php
                    }
                }
                ?>
            </tbody>
        </table>
    </article>
</main>


