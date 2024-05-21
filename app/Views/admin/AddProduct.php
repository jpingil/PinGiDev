<main>
    <article>
        <h2><?php echo $title; ?></h2>
        <form action='<?php echo $action ;?>' method="post"  enctype="multipart/form-data">
            <?php if (isset($errors['form'])) {
                ?>
                <div class="alert alert-danger" role="alert">
                    <p><?= $errors['form'] ?></p>
                </div>  
                <?php
            }
            ?>
            <div class="projectName form-floating">
                <input
                    type="text"
                    class="form-control"
                    name="product_name"
                    id="floatingInput"
                    placeholder="PinGiDev"
                    value="<?= (isset($data['product_name'])) ? $data['product_name'] : ''; ?>"
                    />
                <label for="floatingInput">Product Name</label>
            </div>
            <?php if (isset($errors['product_name'])) {
                ?>
                <div class="bg-danger">
                    <p><?= $errors['product_name'] ?></p>
                </div>  
                <?php
            }
            ?>
            <div class="description form-floating">
                <textarea
                    class="form-control"
                    name="product_description"
                    id="floatingarea"
                    cols="30"
                    rows="10"
                    placeholder="Product description"
                    ><?= (isset($data['product_description'])) ? $data['product_description'] : ''; ?></textarea>
                <label for="floatingarea">Description</label>
            </div>
            <?php if (isset($errors['product_description'])) {
                ?>
                <div class="bg-danger">
                    <p><?= $errors['product_description'] ?></p>
                </div>  
                <?php
            }
            ?>
            <div class="imgsPreview">
                <div id="image-preview"></div>


                <?php
                if (isset($section) && strpos($section, 'edit') !== false) {
                    ?>
                    <p><?php echo $data['img_folder'] . '/Main Image'; ?></p>
                    <?php
                } else {
                    ?>
                    <input type="file" name="image" id="image"/>
                    <?php
                }
                ?>
                <label for="image">Image</label>

            </div>
            <?php if (isset($errors['image'])) {
                ?>
                <div class="alert alert-danger">
                    <p><?= $errors['image'] ?></p>
                </div>  
                <?php
            }
            ?>
            <div class="imgsPreview">
                <div id="images-preview"></div>

                <?php
                if (isset($section) && strpos($section, 'edit') !== false) {
                    ?>
                    <p><?php echo $data['img_folder'] . '/Carousel'; ?></p>
                    <?php
                } else {
                    ?>
                    <input
                        type="file"
                        id="images"
                        name="images[]"
                        multiple
                        />
                        <?php
                    }
                    ?>

                <label for="images">Images</label>
            </div>
            <?php
            if (isset($errors['images'])) {
                ?>
                <div class="alert alert-danger">
                    <p><?= $errors['images'] ?></p>
                </div>  
                <?php
            }
            ?>
            <button class="form-btn">Enviar</button>
        </form>
    </article>
</main>