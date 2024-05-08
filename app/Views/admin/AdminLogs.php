<main>
    <article class="col-12 p-3">
        <a class="add" href="/AdminProducts/add">Add New Product</a>
        <h2>PinGiDev Logs</h2>
        <table class="table table-dark">
            <thead>
            <th scope="col">Date</th>
            <th scope="col">Id</th>
            <th scope="col">User Name</th>
            <th scope="col">Action</th>
            </thead>
            <tbody>
                <?php
                if (count($logs)) {
                    foreach ($logs as $log) {
                        ?>
                        <tr>
                            <td><?php echo $log['log_date']; ?></td>
                            <td><?php echo $log['id_log']; ?></td>
                            <td><?php echo $log['user_name']; ?></td>
                            <td><?php echo $log['actions_name']; ?></td>
                        </tr>  
                        <?php
                    }
                }
                ?>
            </tbody>
        </table>
    </article>
</main>

