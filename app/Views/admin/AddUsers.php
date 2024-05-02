<main>
    <h2>Add User</h2>
    <form action="/AdminUsers/add" method="post">
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
                value="<?php echo(isset($input['pass'])) ? $input['pass'] : ''; ?>"

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
                value="<?php echo(isset($input['pass'])) ? $input['pass'] : ''; ?>"
                />
            <label for="floatingInput">Verify Pass</label>
        </div>
        <?php
        if (isset($errors)) {
            ?>
            <div class="alert alert-danger">
                <p><?php echo $errors['register']; ?></p>
            </div>
            <?php
        }
        ?>
        <button class="form-btn">Enviar</button>
    </form>
</main>