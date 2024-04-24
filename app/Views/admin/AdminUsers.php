<main>
    <article class="col-12">
              <a class="add" href="/AdminUsers/add">Add User</a>
        <h2>PinGiDev Users</h2>
        <table class="table table-dark">
            <thead>
            <th scope="col">Id</th>
            <th scope="col">User Name</th>
            <th scope="col">Email</th>
            <th scope="col">Rol</th>
            <th scope="col">Actions</th>
            </thead>
            <tbody>
                <?php
                if (count($users )> 0) {
                    foreach ($users as $user) {
                        ?>
                        <tr>
                            <td><?php echo $user['id']; ?></td>
                            <td><?php echo $user['user_name']; ?></td>
                            <td><?php echo $user['email']; ?></td>
                            <td><?php echo $user['name']; ?></td>
                            <td>
                                <a class="fa-regular fa-pen-to-square icon" style="color: #ffffff;"></a>
                                <a class="fa-solid fa-toggle-on icon" style="color: #ffffff;"></a>
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

