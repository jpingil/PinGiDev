
<main>
    <h2>Products</h2>
    <?php
    if (!empty($products)) {
        foreach ($products as $product) {
            ?>
            <div class="products">
                <div class="product">
                    <a href="Product.html">
                        <img src="assets/imgs/Products" alt="<?php $product['product_name'];?>F" />
                    </a>
                    <div class="buttons">
                        <button class="btnCompra"><?php echo $product['product_name']; ?></button>
                        <button class="btnFavorito"><i class="fa fa-heart"></i></button>
                    </div>
                </div>
            </div>
        <?php }
    } ?>
</main>