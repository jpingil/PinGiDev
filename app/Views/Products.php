
<main>
    <h2>Products</h2>
    <?php
    if (!empty($products)) {
        foreach ($products as $product) {
            ?>
            <div class="products">
                <div class="product">
                    <a href="Product.html">
                        <img src="assets/<?php echo $product['folder_imgs'] . '/Main Image/' . $product['product_name']; ?>.jpg" alt="<?php echo $product['product_description']; ?>"/>
                    </a>
                    <div class="buttons">
                        <button class="btnCompra"><?php echo $product['product_name']; ?></button>
                        <button class="btnFavorito"><i class="fa fa-heart"></i></button>
                    </div>
                </div>
            </div>
            <?php
        }
    }
    ?>
</main>