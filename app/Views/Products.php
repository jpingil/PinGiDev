
<main>
    <h2>Products</h2>
    <?php
    if (!empty($products)) {
        ?>
        <div class="products">
            <?php
            foreach ($products as $product) {
                ?>
                <div class="product">
                    <a href="/Product/"<?php echo $product['id_product'] ?>>
                        <img src="assets/<?php echo $product['folder_imgs'] . '/Main Image/' . $product['product_name']; ?>.jpg" alt="<?php echo $product['product_description']; ?>"/>
                    </a>
                    <div class="buttons">
                        <button class="btnCompra"><?php echo $product['product_name']; ?></button>
                        <button class="btnFavorito"><i class="fa fa-heart"></i></button>
                    </div>
                </div>
                <?php
            }
            ?>
        </div>
        <?php
    }
    ?>
</main>