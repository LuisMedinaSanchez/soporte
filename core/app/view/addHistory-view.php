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
        <h3 class="title">Agregar historial al ticket # <?php echo $reservation->id; ?></h3>
    </div>
    <div class="card-content table-responsive">
        <form class="form-horizontal" role="form" method="post" action="./?action=addHistory">
            <div class="form-group">


                <label for="inputEmail1" class="col-lg-2 control-label">Respuesta</label>
                <div class="col-lg-10">
                    <input type="text" name='description' id="description">
                </div>
                <br>


                <div class="form-group">
                    <label for="inputEmail1" class="col-lg-2 control-label"><i class="fa fa-camera"></i> Evidencia</label>
                    <div class="col-lg-4">
                        <button>Tomar evidencia<input class="btn btn-default"  id="evidenciahistory_id" accept="image/*" name='evidenciahistory_id' type="file" title="Foto"></button>
                    </div>
                </div>


                <label for="inputEmail1" class="col-md-2 control-label">Estado</label>
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
                <button type="submit" class="btn btn-primary">Agregar</button>
                <button type="button" class="btn btn-default" action="./?action=historyticket?id=<?php echo $reservation->id; ?>">Cerrar</button>

            </div>
        </form>

        <!--Modulo para actualizar categorias-->

    </div>
</div>


