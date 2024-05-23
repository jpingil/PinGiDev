<main>
    <article>
        <h2><?php echo $title; ?></h2>
        <form action='<?php echo $action; ?>' method="post"  enctype="multipart/form-data">
            <?php if (isset($errors['form'])) {
                ?>
                <div class="alert alert-danger" role="alert">
                    <p><?= $errors['form'] ?></p>
                </div>  
                <?php
            }
            ?>
            <div>
                <select class="form-select"  name="id_user">
                    <?php
                    if (isset($input['id_user'])) {
                        foreach ($users as $user) {
                            ?>
                            <option value="<?php echo $user['id_user']; ?>" 
                                    <?php echo ($input['id_user'] == $user['id_user']) ? 'selected' : ''; ?>>
                                <?php echo $user['email']; ?></option>
                            <?php
                        }
                    } else {
                        ?>
                        <option selected>Select a user</option>

                        <?php
                        foreach ($users as $user) {
                            ?>
                            <option value="<?php echo $user['id_user']; ?>"><?php echo $user['email']; ?></option>
                            <?php
                        }
                    }
                    ?>                
                </select>

            </div>
            <?php if (isset($errors['product'])) {
                ?>
                <div class="alert alert-danger">
                    <p><?= $errors['product'] ?></p>
                </div>  
                <?php
            }
            ?>
            <div>
                <select class="form-select"  name="id_product">
                    <?php
                    if (isset($input['id_product'])) {
                        foreach ($products as $product) {
                            ?>
                            <option value="<?php echo $product['id_product']; ?>" 
                                    <?php echo ($input['id_product'] == $product['id_product']) ? 'selected' : ''; ?>>
                                <?php echo $product['product_name']; ?></option>
                            <?php
                        }
                    } else {
                        ?>
                        <option selected>Select a product</option>

                        <?php
                        foreach ($products as $product) {
                            ?>
                            <option value="<?php echo $product['id_product']; ?>"><?php echo $product['product_name']; ?></option>
                            <?php
                        }
                    }
                    ?>                
                </select>

            </div>
            <?php if (isset($errors['email'])) {
                ?>
                <div class="alert alert-danger">
                    <p><?= $errors['email'] ?></p>
                </div>  
                <?php
            }
            ?>
            <div class="description form-floating">
                <textarea
                    class="form-control"
                    name="order_description"
                    id="floatingarea"
                    cols="30"
                    rows="10"
                    placeholder="Order Description"
                    ><?= (isset($input['order_description'])) ? $input['order_description'] : ''; ?></textarea>
                <label for="floatingarea">Order Description</label>
            </div>
            <?php if (isset($errors['order_description'])) {
                ?>
                <div class="alert alert-danger">
                    <p><?= $errors['order_description'] ?></p>
                </div>  
                <?php
            }
            ?>
            <button class="form-btn">Enviar</button>
        </form>
    </article>
</main>