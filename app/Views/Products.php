
<main>
    <h2>Products</h2>
    <?php
    if (!empty($products)) {
        ?>
        <div class="products">
            <?php
            foreach ($products as $log) {
                if ($log['product_ban'] !== 1) {
                    ?>
                    <div class="product">
                        <a href="/Product/<?php echo $log['id_product']; ?>">
                            <img src="assets/<?php echo $log['img_folder'] . '/Main Image/' . $log['product_name'] . '.' . $log['img_extension']; ?>" alt="<?php echo $log['product_description']; ?>"/>
                        </a>
                        <div class="buttons">
                            <a <?php echo (!isset($_SESSION['user'])) ? 'href="/LoginRegister"' : 'disabled'; ?>>
                                <i class="fa fa-heart btnFav <?php
                                if (isset($_SESSION['user'])) {
                                    foreach ($favsProducts as $favProduct) {
                                        if ($favProduct['id_product'] == $log['id_product']) {
                                            echo 'fav';
                                        } else {
                                            echo 'noFav';
                                        }
                                    }
                                } else {
                                    echo 'noFav';
                                }
                                ?>"  id="<?php echo $log['id_product']; ?>"></i>
                            </a>
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