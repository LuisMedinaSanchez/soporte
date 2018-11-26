<div class="row">
    <div class="col-md-12">

        <div class="card">
            <div class="card-header" data-background-color="purple">
                <h4 class="title">Personal</h4>
            </div>
            <div class="card-content table-responsive">


                <a href="index?view=newperson" class="btn btn-default"><i class='fa fa-user'></i> Nuevo personal</a>
                <br>
                <?php
                $users = PersonData::getAll();
                if (count($users) > 0) {
                    // si hay usuarios
                    ?>
                    <table class="table table-bordered table-hover">
                        <thead>
                        <th>Nombre completo</th>
                        <th>Email</th>
                        <th>Activo</th>
                        <th></th>
                        </thead>
                        <?php
                        foreach ($users as $user) {
                            ?>
                            <tr>
                                <td><?php echo $user->name . " " . $user->lastname; ?></td>
                                <td><?php echo $user->email; ?></td>

                                <td>
                                    <?php if ($user->is_active): ?>
                                        <i class="fa fa-check"></i>
                                    <?php endif; ?>
                                </td>
                                <td style="width:180px;">
                                    <a href="index?view=editperson&id=<?php echo $user->id; ?>" class="btn btn-warning btn-xs">Editar</a>
                                    <a href="index?action=delperson&id=<?php echo $user->id; ?>" class="btn btn-danger btn-xs">Eliminar</a>
                                </td>
                            </tr>
                            <?php
                        }
                        ?>
                    </table>
                    <?php
                }else {
                    // no hay usuarios
                }
                ?>

            </div>
        </div>
    </div>
</div>