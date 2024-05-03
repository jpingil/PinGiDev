
<main>
    <h2>Products</h2>
    <?php
    if (!empty($favorites)) {
        ?>
        <div class="products">
            <?php
            foreach ($favorites as $favorite) {
                ?>
                <div class="product">
                    <a href="/Product/<?php echo $favorite['id']; ?>">
                        <img src="assets/<?php echo $favorite['img_folder'] . '/Main Image/' .
        $favorite['product_name'];
                ?>.jpg" alt="<?php echo $favorite['product_description']; ?>"/>
                    </a>
                    <div class="buttons">
                        <i class="fa fa-heart btnFav <?php
                        if (isset($_SESSION['user'])) {
                            foreach ($favsProducts as $favProduct) {
                                if ($favProduct['id_product'] == $favorite['id_product']) {
                                    echo 'fav';
                                } else {
                                    echo 'noFav';
                                }
                            }
                        } else {
                            echo 'noFav';
                        }
                        ?>" id="<?php echo $favorite['id_product']; ?>"></i>
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