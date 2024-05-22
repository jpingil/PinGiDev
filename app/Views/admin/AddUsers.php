<main>
    <article>
        <h2><?php echo $title; ?></h2>
        <form action="<?php $action; ?>" method="post">
            <div class="projectName form-floating">
                <input
                    type="text"
                    class="form-control"
                    id="floatingInput"
                    name="user_name"
                    placeholder="PinGiDev"
                    value="<?php echo(isset($input['user_name'])) ? $input['user_name'] : ''; ?>"
                    />
                <label for="floatingInput">User Name</label>
            </div>
            <div class="projectName form-floating">
                <input
                    type="email"
                    class="form-control"
                    id="floatingInput"
                    name="email"
                    placeholder="PinGiDev"
                    value="<?php echo(isset($input['email'])) ? $input['email'] : ''; ?>"
                    <?php echo (isset($readonly)) ? 'disabled' : ""; ?>
                    />
                <label for="floatingInput">Email</label>
            </div>
            <div class="projectName form-floating">
                <input
                    type="password"
                    class="form-control"
                    id="floatingInput"
                    name="pass"
                    placeholder="PinGiDev"

                    />
                <label for="floatingInput">Pass</label>
            </div>
            <div class="projectName form-floating">
                <input
                    type="password"
                    class="form-control"
                    id="floatingInput"
                    name="pass2"
                    placeholder="PinGiDev"
                    />
                <label for="floatingInput">Verify Pass</label>
            </div>
            <div>
                <select class="form-select"  name="id_rol" <?php echo (isset($readonly)) ? 'disabled' : ''; ?>>
                    <?php
                    if (isset($input['id_rol'])) {
                        foreach ($rols as $rol) {
                            ?>
                            <option value="<?php echo $rol['id_rol']; ?>" 
                                    <?php echo ($input['id_rol'] == $rol['id_rol']) ? 'selected' : ''; ?>>
                                <?php echo $rol['rol_name']; ?></option>
                            <?php
                        }
                    } else {
                        ?>
                        <option selected>Select a rol</option>

                        <?php
                        foreach ($rols as $rol) {
                            ?>
                            <option value="<?php echo $rol['id_rol']; ?>"><?php echo $rol['rol_name']; ?></option>
                            <?php
                        }
                    }
                    ?>                
                </select>

            </div>

            <?php
            if (isset($errors['register'])) {
                ?>
                <div class="alert alert-danger">
                    <p><?php echo $errors['register']; ?></p>
                </div>
                <?php
            }
            ?>
            <button class="form-btn">Enviar</button>
        </form>
    </article>
</main>