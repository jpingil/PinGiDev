<main>
    <article class="col-12">
        <a class="add" href="/AdminProducts/add">Add New Product</a>
        <h2>PinGiDev Products</h2>
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
                    foreach ($products as $product) {
                        ?>
                        <tr>
                            <td><?php echo $product['id_product']; ?></td>
                            <td><?php echo $product['product_name']; ?></td>
                            <td><?php echo $product['product_description']; ?></td>
                            <td><?php echo $product['folder_imgs']; ?></td>
                            <td>
                                <a class="fa-regular fa-pen-to-square icon" style="
                                   color: #ffffff;" href="/AdminProducts/edit/<?= $product['id_product']; ?>"></a>
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

