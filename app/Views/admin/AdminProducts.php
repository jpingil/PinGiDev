<main>
    <article class="col-12 p-3">
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
        <table class="table table-dark">
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
                    foreach ($products as $log) {
                        ?>
                        <tr>
                            <td><?php echo $log['id_product']; ?></td>
                            <td><?php echo $log['product_name']; ?></td>
                            <td><?php echo $log['product_description']; ?></td>
                            <td><?php echo $log['img_folder']; ?></td>
                            <td>
                                <a class="fa-regular fa-pen-to-square icon" href="/AdminProducts/edit/<?= $log['id_product']; ?>"></a>
                                <i class="fa-solid fa-toggle-<?php echo ($log['product_ban']) ? 'off' : 'on'; ?> icon btnBan" 
                                   id="AdminProducts-<?php echo $log['id_product']; ?>"></i>
                                <a class="fa-regular fa-trash-can icon" href="/AdminProducts/delete/<?php echo $log['id_product'];?>"></a>
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

