<?php
$reservation = TicketData::getById($_GET["id"]);
$pacients = ProjectData::getAll();
$medics = PriorityData::getAll();
$statuses = StatusData::getAll();
$payments = KindData::getAll();
$conexion = mysqli_connect("localhost", "root", "", "soporte");
?>
<div class="card">
    <div class="card-header" data-background-color="blue">
        <h3 class="title">Historial del ticket # <?php echo $reservation->id; ?></h3>
    </div>
    <form class="form-horizontal" enctype="multipart/form-data" role="form" method="post" action="./?action=addHistory">
        <div class="form-group">
            <div class="col-lg-1"></div>
            <div class="col-lg-3">
                <input type="text" required name='description' id="description" placeholder="Descripcion">
            </div>
            <div class="col-lg-2">
                <button>Tomar evidencia<input class="btn btn-default"  id="evidenciahistory_id" accept="image/*" name='evidenciahistory_id' type="file" title="Foto"></button>
            </div>    
            <div class="col-lg-2">
                <select name="status_id" class="form-control" required>
                    <?php foreach ($statuses as $p): ?>
                        <option value="<?php echo $p->id; ?>" <?php
                        if ($p->id == $reservation->status_id) {
                            echo "selected";
                        }
                        ?>><?php echo $p->name; ?></option>
                            <?php endforeach; ?>
                </select>
            </div>
            <div class="col-lg-3">
                <input type="hidden" name="id" value="<?php echo $reservation->id; ?>">
                <button type="submit" class="btn btn-primary">Agregar avances</button>
            </div>
        </div>
    </form>
    <div class="card-content table-responsive">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="col-md-7">
                        <h4><?php echo $reservation->title; ?></h4>
                        <p><?php echo $reservation->description; ?></p>
                        <a></a>
                    </div>
                    <div class="col-md-3"><?php echo " " . $reservation->created_at; ?></div>
                    <div class="col-md-2"><a href="<?php echo $reservation->evidencia_id; ?>" target=”_blank”><img width="20" src="<?php echo $reservation->evidencia_id; ?>"/></a></div>
                </div>
                <table class="table table-responsive text-left">
                    <thead>
                        <tr>
                            <th>

                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "SELECT 
                            h.description   AS  DESCRIPCION,
                            h.user_id,
                            u.name          AS  NOMBRE,
                            u.lastname      AS  APELLIDO,
                            h.created_at    AS  FECHA,
                            h.evidenciahistory_id   AS EVIDENCIA
                            FROM tickethistory h
                            RIGHT OUTER JOIN user u ON u.id = h.user_id
                            RIGHT OUTER JOIN ticket t ON t.id = h.ticket_id
                            WHERE ticket_id = $reservation->id
                            ORDER BY h.created_at DESC    ";
                        $resultado = mysqli_query($conexion, $sql);
                        while ($mostrar = mysqli_fetch_array($resultado)) {
                            ?>
                            <tr>
                                <td>
                                    <div class="col-md-10"><?php echo "<strong>" . $mostrar['NOMBRE'] . " " . $mostrar['APELLIDO'] . "</strong>" . " " . $mostrar['FECHA'] . "<br>" . $mostrar['DESCRIPCION'] ?>
                                    </div>
                                
                                    <div class="col-md-2"><a href="<?php echo $mostrar['EVIDENCIA']; ?>" target=”_blank”><img width="10" height="10" src="<?php echo $mostrar['EVIDENCIA']; ?>" ></a>
                                    </div>
                                </td>
                            </tr>
                            <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
        <!--Modulo para actualizar categorias-->
        <!--        <div class="col-md-3">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <form class="form-horizontal" role="form" method="post" action="./?action=updateCategory">
                                <div class="form-group">
                                    <label for="inputEmail1" class="col-lg-2 control-label">Tipo</label>
                                    <div class="col-lg-10">
                                        <select name="kind_id" class="form-control" required>
        <?php foreach ($payments as $p): ?>
                                                                        <option value="<?php echo $p->id; ?>" <?php
            if ($p->id == $reservation->kind_id) {
                echo "selected";
            }
            ?>><?php echo $p->name; ?></option>
        <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <label for="inputEmail1" class="col-lg-2 control-label">Proyecto</label>
                                    <div class="col-lg-10">
                                        <select name="project_id" class="form-control" required>
                                            <option value="">¿El error es de un proyecto?</option>
        <?php foreach ($pacients as $p): ?>
                                                                        <option value="<?php echo $p->id; ?>" <?php
            if ($p->id == $reservation->project_id) {
                echo "selected";
            }
            ?>><?php echo $p->name; ?></option>
        <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <label for="inputEmail1" class="col-lg-2 control-label">Sistema</label>
                                    <div class="col-lg-10">
                                        <select name="category_id" class="form-control" required>
                                            <option value="">¿Que sistema que tiene errores?</option>
        <?php foreach (CategoryData::getAll() as $p): ?>
                                                                        <option value="<?php echo $p->id; ?>" <?php
            if ($p->id == $reservation->category_id) {
                echo "selected";
            }
            ?>><?php echo $p->name; ?></option>
        <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <label for="inputEmail1" class="col-lg-2 control-label">Prioridad</label>
                                    <div class="col-lg-10">
                                        <select name="priority_id" class="form-control" required>
                                            <option value="">Define la prioridad del ticket</option>
        <?php foreach ($medics as $p): ?>
                                                                        <option value="<?php echo $p->id; ?>" <?php
            if ($p->id == $reservation->priority_id) {
                echo "selected";
            }
            ?>><?php echo $p->name; ?></option>
        <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <label for="inputEmail1" class="col-lg-2 control-label">Estado</label>
                                    <div class="col-lg-10">
                                        <select name="status_id" class="form-control" required>
        <?php foreach ($statuses as $p): ?>
                                                                        <option value="<?php echo $p->id; ?>" <?php
            if ($p->id == $reservation->status_id) {
                echo "selected";
            }
            ?>><?php echo $p->name; ?></option>
        <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="col-lg-10">
                                        <input type="hidden" name="id" value="<?php echo $reservation->id; ?>">
                                        <button type="submit" class="btn btn-default">Actualizar Ticket</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>-->
    </div>
</div>

