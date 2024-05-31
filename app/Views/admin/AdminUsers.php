<main>
    <article>
        <a class="add" href="/AdminUsers/add">Add User</a>
        <h2>PinGiDev Users</h2>
        <div class="filter">
            <form method="get" action="/AdminUsers/filter">       
                <div class="filterParams">
                    <div class="mb-3">
                        <label for="id_user">User Name:</label>
                        <input class="adminInput" id="user_name" name="user_name" value="<?php echo (isset($input['user_name'])) ? $input['user_name'] : ''; ?>" placeholder="User name"/>
                        <p><?php echo isset($errors['user_name']) ? $errors['user_name'] : ''; ?></p>
                    </div>

                    <div class="mb-3">
                        <label for="email">User email:</label>
                        <select name="filterEmail" id="filterEmail" class="select2" data-placeholder="Email">
                            <option value=""></option>
                            <?php foreach ($filterUsers as $user) { ?>
                                <option value="<?php echo $user['email']; ?>" <?php echo (isset($input['filterEmail']) && $user['email'] == $input['filterEmail']) ? 'selected' : ''; ?>><?php echo $user['email']; ?></option>
                                <?php
                            }
                            ?>
                        </select>
                        <p><?php echo isset($errors['email']) ? $errors['email'] : ''; ?></p>
                    </div>

                    <div class="mb-3">
                        <label for="rol">Rol:</label>
                        <select name="id_rol" id="id_rol" class="select2" data-placeholder="Rols">
                            <option value=""></option>
                            <?php foreach ($rols as $rol) { ?>
                                <option value="<?php echo $rol['id_rol']; ?>" <?php echo (isset($input['id_rol']) && $rol['id_rol'] == $input['id_rol']) ? 'selected' : ''; ?>><?php echo $rol['rol_name']; ?></option>
                                <?php
                            }
                            ?>
                        </select>
                        <p><?php echo isset($errors['rol']) ? $errors['rol'] : ''; ?></p>
                    </div>
                </div>
                <div class="filterButtons">
                    <a href="/AdminUsers" value="" name="reiniciar" class="btn btn-danger">Reiniciar filtros</a>
                    <input type="submit" value="Aplicar filtros" name="enviar" class="btn btn-primary ml-2" href="/AdminUsers/filter"/>
                </div>
                <p class="mb-3 text-danger"><?php echo isset($errors['form']) ? $errors['form'] : ''; ?></p>
            </form>
        </div>
        <?php
        if (isset($message)) {
            ?>
            <div class="alert alert-<?= $message['class']; ?>">
                <p><?= $message['message']; ?></p>
            </div>
            <?php
        }
        ?>
        <table>
            <thead>
            <th scope = "col">Id</th>
            <th scope = "col">User Name</th>
            <th scope = "col">Email</th>
            <th scope = "col">Rol</th>
            <th scope = "col">Actions</th>
            </thead>
            <tbody>
                <?php
                if (count($users) > 0) {
                    foreach ($users as $user) {
                        ?>
                        <tr>
                            <td><?php echo $user['id_user']; ?></td>
                            <td><?php echo $user['user_name']; ?></td>
                            <td><?php echo $user['email']; ?></td>
                            <td><?php echo $user['rol_name']; ?></td>
                            <td>
                                <a class="fa-regular fa-pen-to-square icon" href="/AdminUsers/edit/<?php echo $user['id_user']; ?>" data-toggle="tooltip" title="Edit user"></a>
                                <i class="fa-solid fa-toggle-<?php echo ($user['user_ban'] === 0) ? 'on' : 'off'
                        ?> icon btnBan" id="AdminUsers-<?php echo $user['id_user']; ?>" data-toggle="tooltip" title="Ban user"></i>
                                <a class="fa-regular fa-trash-can icon" href="/AdminUsers/delete/<?php echo $user['id_user']; ?>"
                                   data-toggle="tooltip" title="Delete user"></a>
                            </td>
                        </tr>
                        <?php
                    }
                }
                ?>
            </tbody>
        </table>
    </article>
</main>

