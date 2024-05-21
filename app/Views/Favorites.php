<main>
    <h2>Favorites</h2>
    <?php
    if (!empty($favorites)) {
        ?>
        <div class="products">
            <?php
            foreach ($favorites as $favorite) {
                if ($favorite['product_ban'] !== 1) {
                    ?>
                    <div class="product">
                        <a href="/Product/<?php echo $favorite['id_product']; ?>">
                            <img src="assets/<?php echo $favorite['img_folder'] . '/Main Image/' . $favorite['product_name'] . '.' . $favorite['img_extension']; ?>" alt="<?php echo $favorite['product_description']; ?>"/>
                        </a>
                        <div class="button-container">
                            <h3><?php echo $favorite['product_name']; ?></h3>
                            <a <?php echo (!isset($_SESSION['user'])) ? 'href="/LoginRegister"' : 'disabled'; ?>>
                                <i class="fa fa-heart btnFav fav"  id="<?php echo $favorite['id_product']; ?>"></i>
                            </a>
                        </div>

                        <div class="moreInformation">
                            <a href="/Product/<?php echo $favorite['id_product']; ?>">More information</a>
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