<main>
    <article>
        <h2>PinGiDev Users</h2>
        <table class="table table-dark">
            <thead>
            <th scope="col">Id</th>
            <th scope="col">User Name</th>
            <th scope="col">Email</th>
            <th scope="col">Rol</th>
            </thead>
            <tbody>
                <?php
                if (isset($users)) {
                    foreach ($users as $user) {
                        ?>
                        <tr>
                            <td><?php echo $user['id']; ?></td>
                            <td><?php echo $user['user_name']; ?></td>
                            <td><?php echo $user['email']; ?></td>
                            <td><?php echo $user['name']; ?></td>
                        </tr>
                    <?php }
                }
                ?>
            </tbody>
        </table>
    </article>
</main>

