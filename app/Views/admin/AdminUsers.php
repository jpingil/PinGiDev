<main>
    <article class="col-12">
        <a class="add" href="/AdminUsers/add">Add User</a>
        <h2>PinGiDev Users</h2>
        <?php
        if (isset($banRemoveProcess)) {
            ?>
            <div class="alert alert-<?= $banRemoveProcess['class']; ?>">
                <p><?= $banRemoveProcess['message']; ?></p>
            </div>
            <?php
        }
        ?>
        <table class = "table table-dark">
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
                                <a class="fa-regular fa-pen-to-square icon" href="/AdminUsers/edit/<?php echo $user['id_user']; ?>" style="color: #ffffff;"></a>
                                <a class="fa-solid fa-toggle-<?= ($user['status_name'] === 'activated') ? 'on' : 'off'
                ?> icon" style="color: #ffffff;" href="/AdminUsers/ban<?= $user['id_user']; ?>"></a>
                                <a class="fa-regular fa-trash-can icon" style="color: #ffffff;"></a>
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

