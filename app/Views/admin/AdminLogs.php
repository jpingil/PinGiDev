<main>
    <article    >
        <h2>PinGiDev Logs</h2>
        <div class="card mt-4 mb-4">
            <form method="get" action="/AdminLogs/filter">       
                <input type="hidden" name="order" value="<?php echo $order; ?>" />
                <div
                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-dark">Filter</h6>                                    
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 col-lg-4">
                            <div class="mb-3">
                                <label for="id_user">User email:</label>
                                <select name="id_user" id="id_user" class="form-control select2" data-placeholder="email">
                                    <option value="">-</option>
                                    <?php foreach ($users as $user) { ?>
                                        <option value="<?php echo $user['id_user']; ?>" <?php echo (isset($input['id_user']) && $user['id_user'] == $input['id_user']) ? 'selected' : ''; ?>><?php echo ucfirst($user['email']); ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <div class="col-12 col-lg-4">
                            <div class="mb-3">
                                <label for="id_action">Action:</label>
                                <select name="id_action" id="id_action" class="form-control select2" data-placeholder="Action">
                                    <option value="">-</option>
                                    <?php foreach ($actions as $action) { ?>
                                        <option value="<?php echo $action['id_action']; ?>" <?php echo (isset($input['id_action']) && $action['id_action'] == $input['id_action']) ? 'selected' : ''; ?>><?php echo ucfirst($action['action_name']); ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div> 

                        <div class="col-12 col-lg-4">
                            <div class="mb-3">
                                <label for="log_date">Date:</label>
                                <select name="log_date" id="log_date" class="form-control select2" data-placeholder="Dates">
                                    <option value="">-</option>
                                    <?php foreach ($dates as $date) { ?>
                                        <option value="<?php echo $date['date']; ?>" <?php echo (isset($input['date']) && $date == $input['date']) ? 'selected' : ''; ?>><?php echo $date['date']; ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div> 
                    </div>
                </div>
                <div class="card-footer">
                    <div class="col-12 text-right">                     
                        <a href="/usuarios" value="" name="reiniciar" class="btn btn-danger">Reiniciar filtros</a>
                        <input type="submit" value="Aplicar filtros" name="enviar" class="btn btn-primary ml-2" href="/AdminLogs/filter"/>
                    </div>
                </div>
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

