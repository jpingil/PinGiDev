<main>
    <article class="col-12">
        <a class="add" href="/AdminProducts/add">Add New Product</a>
        <h2>PinGiDev Products</h2>
        <?php
        if (isset($message)) {
            ?>
            <div class="alert alert-<?= $class; ?>">
                <p><?= $message; ?></p>
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
                    foreach ($products as $favorite) {
                        ?>
                        <tr>
                            <td><?php echo $favorite['id_product']; ?></td>
                            <td><?php echo $favorite['product_name']; ?></td>
                            <td><?php echo $favorite['product_description']; ?></td>
                            <td><?php echo $favorite['img_folder']; ?></td>
                            <td>
                                <a class="fa-regular fa-pen-to-square icon" style="
                                   color: #ffffff;" href="/AdminProducts/edit/<?= $favorite['id_product']; ?>"></a>
                                <a class="fa-solid fa-toggle-on icon" style="color: #ffffff;" onclick="changeButton()"></a>
                                <a class="fa-regular fa-trash-can icon" style="color: #ffffff;"></a>
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

