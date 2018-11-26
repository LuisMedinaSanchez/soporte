<?php
$projects = ProjectData::getAll();
$priorities = PriorityData::getAll();

$statuses = StatusData::getAll();
$kinds = KindData::getAll();
$person = PersonData::getAct();
?>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header" data-background-color="blue">
                <h4 class="title">Nuevo Ticket</h4>
            </div>
            <div class="card-content table-responsive">
                <form class="form-horizontal" role="form" method="post" enctype="multipart/form-data" action="./?action=addticket">

                    <div class="form-group">
                        <label for="inputEmail1" class="col-lg-2 control-label">Tipo</label>
                        <div class="col-lg-10">
                            <select name="kind_id" class="form-control" required>
                                <?php foreach ($kinds as $p): ?>
                                    <option value="<?php echo $p->id; ?>"><?php echo $p->name; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail1" class="col-lg-2 control-label">Titulo</label>
                        <div class="col-lg-10">
                            <input type="text" name="title" required class="form-control" id="inputEmail1" placeholder="Titulo">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputEmail1" class="col-lg-2 control-label">Descripcion</label>
                        <div class="col-lg-10">
                            <textarea class="form-control" name="description" required placeholder="Descripcion"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail1" class="col-lg-2 control-label"><i class="fa fa-user"></i> Solicitante</label>
                        <div class="col-lg-4">
                            <select name="person_id" class="form-control" required>
                                <option value="">Selcciona quien solicita soporte</option>
                                <?php foreach ($person as $p): ?>
                                    <option value="<?php echo $p->id; ?>"><?php echo $p->name." ".$p->lastname ; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <label for="inputEmail1" class="col-lg-2 control-label"> <i class="fa fa-cogs"></i> Sistema o recurso</label>
                        <div class="col-lg-4">
                            <select name="category_id" class="form-control" required>
                                <option value="">Sistema que tiene errores</option>
                                <?php foreach (CategoryData::getAll() as $p): ?>
                                    <option value="<?php echo $p->id; ?>"><?php echo $p->name; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                    </div>
                    <div class="form-group">
                        <label for="inputEmail1" class="col-lg-2 control-label"><i class="fa fa-tasks"></i> Prioridad</label>
                        <div class="col-lg-4">
                            <select name="priority_id" class="form-control" required>
                                <option value="">Define la prioridad del ticket</option>
                                <?php foreach ($priorities as $p): ?>
                                    <option value="<?php echo $p->id; ?>"><?php echo $p->name; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <label for="inputEmail1" class="col-lg-2 control-label">Proyecto</label>
                        <div class="col-lg-4">
                            <select name="project_id" class="form-control" required>
                                <option value="">El error es de un proyecto?</option>
                                <?php foreach ($projects as $p): ?>
                                    <option value="<?php echo $p->id; ?>"><?php echo $p->name; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-4"></div>
                        <label for="inputEmail1" class="col-lg-2 control-label"><i class="fa fa-camera"></i> Evidencia</label>
                        <div class="col-lg-4">
                            <button>Tomar evidencia<input class="btn btn-default"  id="evidencia" accept="image/*" name='evidencia' type="file" title="Foto"></button>
                        </div>
                        <div class="col-lg-4"></div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-offset-2 col-lg-10">
                            <button type="submit" class="btn btn-default">Agregar Ticket</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>