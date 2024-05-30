<main>
    <article    >
        <h2>PinGiDev Logs</h2>
        <div class="filter">
            <form method="get" action="/AdminLogs/filter">       
                <div class="filterParams">
                    <div class="mb-3">
                        <label for="id_user">User email:</label>
                        <select name="id_user" id="id_user" class="select2" data-placeholder="Email">
                            <option value=""></option>
                            <?php foreach ($users as $user) { ?>
                                <option value="<?php echo $user['id_user']; ?>" <?php echo (isset($input['id_user']) && $user['id_user'] == $input['id_user']) ? 'selected' : ''; ?>><?php echo $user['email']; ?></option>
                                <?php
                            }
                            ?>
                        </select>
                        <p><?php echo isset($errors['id_user']) ? $errors['id_user'] : ''; ?></p>
                    </div>

                    <div class="mb-3">
                        <label for="id_action">Action:</label>
                        <select name="id_action" id="id_action" class="select2" data-placeholder="Action">
                            <option value=""></option>
                            <?php foreach ($actions as $action) { ?>
                                <option value="<?php echo $action['id_action']; ?>" <?php echo (isset($input['id_action']) && $action['id_action'] == $input['id_action'] && $input['id_action'] !== '') ? 'selected' : ''; ?>><?php echo $action['action_name']; ?></option>
                                <?php
                            }
                            ?>
                        </select>
                        <p class="text-danger"><?php echo isset($errors['id_action']) ? $errors['id_action'] : ''; ?></p>
                    </div>

                    <div class="mb-3">
                        <label for="log_date">Date:</label>
                        <select name="log_date" id="log_date" class="select2" data-placeholder="Dates">
                            <option value=""></option>
                            <?php foreach ($dates as $date) { ?>
                                <option value="<?php echo $date['date']; ?>" <?php echo (isset($input['log_date']) && $date['date'] == $input['log_date']) ? 'selected' : ''; ?>><?php echo $date['date']; ?></option>
                                <?php
                            }
                            ?>
                        </select>
                        <p><?php echo isset($errors['log_date']) ? $errors['log_date'] : ''; ?></p>
                    </div>
                </div>
                <div class="filterButtons">
                    <a href="/AdminLogs" value="" name="reiniciar" class="btn btn-danger">Reiniciar filtros</a>
                    <input type="submit" value="Aplicar filtros" name="enviar" class="btn btn-primary ml-2" href="/AdminLogs/filter"/>
                </div>
                <p class="mb-3 text-danger"><?php echo isset($errors['form']) ? $errors['form'] : ''; ?></p>
            </form>
        </div>
        <table>
            <thead>
            <th scope="col">Date</th>
            <th scope="col">Id</th>
            <th scope="col">User Email</th>
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
                            <td><?php echo $log['email']; ?></td>
                            <td><?php echo $log['action_name']; ?></td>
                        </tr>  
                        <?php
                    }
                }
                ?>
            </tbody>
        </table>
    </article>
</main>

