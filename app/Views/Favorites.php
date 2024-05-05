
<main>
    <h2>Favorites</h2>
    <?php
    if (!empty($favorites)) {
        ?>
        <div class="products">
            <?php
            foreach ($favorites as $product) {
                ?>
                <div class="product">
                    <a href="/Product/<?php echo $product['id_product']; ?>">
                        <img src="assets/<?php echo $product['img_folder'] . '/Main Image/' . $product['product_name'].'.'.$product['img_extension']; ?>" alt="<?php echo $product['product_description']; ?>"/>
                    </a>
                    <div class="buttons">
                        <i class="fa fa-heart btnFav fav" id="<?php echo $product['id_product']; ?>"></i>
                    </div>
                    <?php
                }
                ?>
            </div>
            <?php
        }
        ?>
</main>