
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
                        <img src="assets/<?php echo $product['img_folder'] . '/Main Image/' . $product['product_name'] . '.' . $product['img_extension']; ?>" alt="<?php echo $product['product_description']; ?>"/>
                    </a>
                    <div class="buttons">
                        <a <?php echo (!isset($_SESSION['user'])) ? 'href="/LoginRegister"' : 'disabled'; ?>>
                            <i class="fa fa-heart btnFav <?php
                            if (isset($_SESSION['user'])) {
                                foreach ($favsProducts as $favProduct) {
                                    if ($favProduct['id_product'] == $product['id_product']) {
                                        echo 'fav';
                                    } else {
                                        echo 'noFav';
                                    }
                                }
                            } else {
                                echo 'noFav';
                            }
                            ?>"  id="<?php echo $product['id_product']; ?>"></i>
                        </a>
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