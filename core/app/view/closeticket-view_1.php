<?php
$reservation = TicketData::getById($_GET["id"]);
$pacients = ProjectData::getAll();
$medics = PriorityData::getAll();
$statuses = StatusData::getAll();
$payments = KindData::getAll();
$applicant = PersonData::getAll();
?>
<div class="row">
    <div class="col-md-12">

        <div class="card">
            <div class="card-header" data-background-color="gray">
                <h4 class="title">¿Enviar solicitud de cierre?</h4>
            </div>
            <div class="card-content table-responsive">
                <form class="form-horizontal" enctype="multipart/form-data" role="form" method="post" action="./?action=closeticket">

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
                    </div>
                    <div class="form-group">
                        <label for="inputEmail1" class="col-lg-2 control-label">Titulo</label>
                        <div class="col-lg-10">
                            <input type="text" name="title" value="<?php echo $reservation->title; ?>" required class="form-control" id="inputEmail1" placeholder="Asunto">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputEmail1" class="col-lg-2 control-label">Descripcion</label>
                        <div class="col-lg-10">
                            <textarea class="form-control" name="description" placeholder="Descripcion"><?php echo $reservation->description; ?></textarea>
                        </div>

                    </div>
                    <div class="form-group">
                        <label for="inputEmail1" class="col-lg-2 control-label"><i class="fa fa-user"></i> Solicitante</label>
                        <div class="col-lg-4">
                            
                            <select name="person_id" class="form-control" required>
                                <option value="">Selcciona quien solicita soporte</option>
                                <?php foreach ($applicant as $p): ?>
                                    <option value="<?php echo $p->id; ?>" <?php
                                    if ($p->id == $reservation->person_id) {
                                        echo "selected";
                                    }
                                    ?>><?php echo $p->name." ".$p->lastname; ?></option>
                                        <?php endforeach; ?>
                            </select>
                            
                            
                        </div>
                        <label for="inputEmail1" class="col-lg-2 control-label"> <i class="fa fa-cogs"></i> Sistema o recurso</label>
                        <div class="col-lg-4">
                            <select name="category_id" class="form-control" required>
                                <option value="">Sistema que tiene errores</option>
                                <?php foreach (CategoryData::getAll() as $p): ?>
                                    <option value="<?php echo $p->id; ?>" <?php
                                    if ($p->id == $reservation->category_id) {
                                        echo "selected";
                                    }
                                    ?>><?php echo $p->name; ?></option>
                                        <?php endforeach; ?>
                            </select>
                        </div>

                    </div>
                    <div class="form-group">

                        <label for="inputEmail1" class="col-lg-2 control-label"><i class="fa fa-tasks"></i> Prioridad</label>
                        <div class="col-lg-4">
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
                        <label for="inputEmail1" class="col-lg-2 control-label">Proyecto</label>
                        <div class="col-lg-4">
                            <select name="project_id" class="form-control" required>
                                <option value="">El error es de un proyecto?</option>
                                <?php foreach ($pacients as $p): ?>
                                    <option value="<?php echo $p->id; ?>" <?php
                                    if ($p->id == $reservation->project_id) {
                                        echo "selected";
                                    }
                                    ?>><?php echo $p->name; ?></option>
                                        <?php endforeach; ?>
                            </select>
                        </div>       
                    </div>
                    <div class="form-group">
                        <div class="form-group">
                            <div class="col-lg-2"></div>
                            <label for="inputEmail1" class="col-lg-2 control-label"><i class="fa fa-camera"></i> Evidencia</label>
                            <div class="col-lg-1"><a href="<?php echo $reservation->evidencia_id; ?>" target=”_blank”><img width="10" height="10" src="<?php echo $reservation->evidencia_id; ?>" ></a></div>

                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-lg-offset-2 col-lg-10">
                            <input type="hidden" name="id" value="<?php echo $reservation->id; ?>">
                            <button type="submit" class="btn btn-default">Solicitar cierre de ticket</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>