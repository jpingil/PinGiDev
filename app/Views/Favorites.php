
<main>
    <h2>Favorites</h2>
    <?php
    if (!empty($favorites)) {
        ?>
        <div class="products">
            <?php
            foreach ($favorites as $log) {
                ?>
                <div class="product">
                    <a href="/Product/<?php echo $log['id_product']; ?>">
                        <img src="assets/<?php echo $log['img_folder'] . '/Main Image/' . $log['product_name'].'.'.$log['img_extension']; ?>" alt="<?php echo $log['product_description']; ?>"/>
                    </a>
                    <div class="buttons">
                        <i class="fa fa-heart btnFav fav" id="<?php echo $log['id_product']; ?>"></i>
                    </div>
                    <?php
                }
                ?>
            </div>
            <?php
        }
        ?>
</main>