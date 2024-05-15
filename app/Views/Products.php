
<main>
    <h2>Products</h2>
    <?php
    if (!empty($products)) {
        ?>
        <div class="products">
            <?php
            foreach ($products as $product) {
                if ($product['product_ban'] !== 1) {
                    ?>
                    <div class="product">
                        <a href="/Product/<?php echo $product['id_product']; ?>">
                            <img src="assets/<?php echo $product['img_folder'] . '/Main Image/' . $product['product_name'] . '.' . $product['img_extension']; ?>" alt="<?php echo $product['product_description']; ?>"/>
                        </a>
                        <div class="button-container">
                                                    <h3><?php echo $product['product_name']; ?></h3>
                            <a <?php echo (!isset($_SESSION['user'])) ? 'href="/LoginRegister"' : 'disabled'; ?>>
                                <i class="fa-solid fa-heart btnFav <?php
                                if (isset($_SESSION['user'])) {
                                    foreach ($favsProducts as $favProduct) {
                                        if ($favProduct['id_product'] == $product['id_product']) {
                                            echo 'fav';
                                        }
                                    }
                                } else {
                                    echo 'noFav';
                                }
                                ?>"  id="<?php echo $product['id_product']; ?>"></i>
                            </a>
                        </div>
                        <div class="moreInformation">
                            <a href="/Product/<?php echo $product['id_product']; ?>">More information</a>
                        </div>
                    </div>
                    <?php
                }
            }
            ?>
        </div>
        <?php
    }
    ?>
</main>