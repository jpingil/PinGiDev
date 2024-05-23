<main>
    <article>
        <a class="add" href="/AdminUsers/add">Add User</a>
        <h2>PinGiDev Users</h2>
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
                    foreach ($users as $rol) {
                        ?>
                        <tr>
                            <td><?php echo $rol['id_user']; ?></td>
                            <td><?php echo $rol['user_name']; ?></td>
                            <td><?php echo $rol['email']; ?></td>
                            <td><?php echo $rol['rol_name']; ?></td>
                            <td>
                                <a class="fa-regular fa-pen-to-square icon" href="/AdminUsers/edit/<?php echo $rol['id_user']; ?>" data-toggle="tooltip" title="Edit user"></a>
                                <i class="fa-solid fa-toggle-<?php echo ($rol['user_ban'] === 0) ? 'on' : 'off'
                        ?> icon btnBan" id="AdminUsers-<?php echo $rol['id_user']; ?>" data-toggle="tooltip" title="Ban user"></i>
                                <a class="fa-regular fa-trash-can icon" href="/AdminUsers/delete/<?php echo $rol['id_user']; ?>"
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

