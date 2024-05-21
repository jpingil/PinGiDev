<main>
    <article>
        <a class="add" href="/AdminProducts/add">Add New Product</a>
        <h2>PinGiDev Products</h2>
        <?php
        if (isset($message)) {
            ?>
            <div class="alert alert-<?= $class; ?> m-2">
                <p><?php echo $message; ?></p>
            </div>
            <?php
        }
        ?>
        <table>
            <thead>
            <th scope="col">Id</th>
            <th scope="col">Product Name</th>
            <th scope="col">Description</th>
            <th scope="col">Folder</th>
            <th scope="col">Actions</th>

            </thead>
            <tbody>
                <?php
                if (count($products)) {
                    foreach ($products as $product) {
                        ?>
                        <tr>
                            <td><?php echo $product['id_product']; ?></td>
                            <td><?php echo $product['product_name']; ?></td>
                            <td><?php echo $product['product_description']; ?></td>
                            <td><?php echo $product['img_folder']; ?></td>
                            <td>
                                <a class="fa-regular fa-pen-to-square icon" href="/AdminProducts/edit/<?= $product['id_product']; ?>"></a>
                                <i class="fa-solid fa-toggle-<?php echo ($product['product_ban']) ? 'off' : 'on'; ?> icon btnBan" 
                                   id="AdminProducts-<?php echo $product['id_product']; ?>"></i>
                                <a class="fa-regular fa-trash-can icon" href="/AdminProducts/delete/<?php echo $product['id_product'];?>"></a>
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

