
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
                    <a href="/Product/<?php echo $product['id_product']; ?>">
                        <img src="assets/<?php echo $product['img_folder'] . '/Main Image/' . $product['product_name']; ?>.jpg" alt="<?php echo $product['product_description']; ?>"/>
                    </a>
                    <div class="buttons">
                        <i class="fa fa-heart btnFav <?php echo ($favorite) ? 'fav' : 'noFav' ?>" id="
                           <?php echo $product['id_product']; ?>"></i>
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