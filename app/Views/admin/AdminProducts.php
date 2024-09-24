<main>
    <article>
        <a class="add" href="/AdminProducts/add">Add New Product</a>
        <h2>PinGiDev Products</h2>
        <div class="filter">
            <form method="get" action="/AdminProducts/filter">       
                <div class="filterParams">
                    <div class="mb-3">
                        <label for="product_name">Product name:</label>
                        <input class="adminInput" id="product_name" name="product_name" value="<?php echo (isset($input['product_name'])) ? $input['product_name'] : ''; ?>" placeholder="Product name"/>
                        <p><?php echo isset($errors['product_name']) ? $errors['product_name'] : ''; ?></p>
                    </div>

                    <div class="mb-3">
                        <label for="product_description">Product description:</label>
                        <input name="product_description" id="product_description" class="select2" data-placeholder="Product description"/>
                        <p><?php echo isset($errors['product_description']) ? $errors['product_description'] : ''; ?></p>
                    </div>
                </div>
                <div class="filterButtons">
                    <a href="/AdminProducts" value="" name="reiniciar" class="btn btn-danger">Reiniciar filtros</a>
                    <input type="submit" value="Aplicar filtros" name="enviar" class="btn btn-primary ml-2" href="/AdminProducts/filter"/>
                </div>
                <p class="mb-3 text-danger"><?php echo isset($errors['form']) ? $errors['form'] : ''; ?></p>
            </form>
        </div>
        <?php
        if (isset($message)) {
            ?>
            <div class="alert alert-<?= $message['class']; ?>">
                <p><?= $message['message']; ?></p>
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
                                <a class="fa-regular fa-pen-to-square icon" href="/AdminProducts/edit/<?= $product['id_product']; ?>" aria-label="edit user"></a>
                                <i class="fa-solid fa-toggle-<?php echo ($product['product_ban']) ? 'off' : 'on'; ?> icon btnBan" 
                                   id="AdminProducts-<?php echo $product['id_product']; ?>" aria-label="ban user"></i>
                                <a class="fa-regular fa-trash-can icon" href="/AdminProducts/delete/<?php echo $product['id_product']; ?>" aria-label="delete user"></a>
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

