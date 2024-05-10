<main>
    <article class="col-12">
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
                    foreach ($users as $user) {
                        ?>
                        <tr>
                            <td><?php echo $user['id_user']; ?></td>
                            <td><?php echo $user['user_name']; ?></td>
                            <td><?php echo $user['email']; ?></td>
                            <td><?php echo $user['rol_name']; ?></td>
                            <td>
                                <a class="fa-regular fa-pen-to-square icon" href="/AdminUsers/edit/<?php echo $user['id_user']; ?>"></a>
                                <i class="fa-solid fa-toggle-<?php echo ($user['user_ban'] === 0) ? 'on' : 'off'
                        ?> icon btnBan" id="AdminUsers-<?php echo $user['id_user']; ?>"></i>
                                <a class="fa-regular fa-trash-can icon" href="/AdminUsers/delete/<?php echo $user['id_user']; ?>"></a>
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

