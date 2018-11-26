<div class="row">
    <div class="col-md-12">
        <div class="btn-group pull-right">
            <!--<div class="btn-group pull-right">
              <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                <i class="fa fa-download"></i> Descargar <span class="caret"></span>
              </button>
              <ul class="dropdown-menu" role="menu">
                <li><a href="report/clients-word.php">Word 2007 (.docx)</a></li>
              </ul>
            </div>
            -->
        </div>


        <div class="card">
            <div class="card-header" data-background-color="green">
                <h4 class="title"><i class="fa fa-check-circle"></i> Tickets terminados</h4>
            </div>
            <div class="card-content table-responsive">
                <form class="form-horizontal" role="form">
                    <input type="hidden" name="view" value="tickets">
                    <?php
                    $projects = ProjectData::getAll();
                    $categories = CategoryData::getAll();
                    $user_id = UserData::getAll();
                    ?>

<!--                    <div class="form-group">
                        <div class="col-lg-2">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-search"></i></span>
                                <input type="text" name="q" value="<?php
                                if (isset($_GET["q"]) && $_GET["q"] != "") {
                                    echo $_GET["q"];
                                }
                                ?>" class="form-control" placeholder="Palabra clave">
                            </div>
                        </div>
                        
                        <div class="col-lg-2">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-flask"></i></span>
                                <select name="user_id" class="form-control">
                                    <option value="">TÈCNICO</option>
                                    <?php foreach ($user_id as $p): ?>
                                        <option value="<?php echo $p->id; ?>" <?php
                                                if (isset($_GET["user_id"]) && $_GET["user_id"] == $p->id) {
                                                    echo "selected";
                                                }
                                                ?>><?php echo $p->name . " " . $p->lastname; ?></option>
<?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        
                        <div class="col-lg-2">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-flask"></i></span>
                                <select name="project_id" class="form-control">
                                    <option value="">PROYECTO</option>
                                    <?php foreach ($projects as $p): ?>
                                        <option value="<?php echo $p->id; ?>" <?php
                                                if (isset($_GET["project_id"]) && $_GET["project_id"] == $p->id) {
                                                    echo "selected";
                                                }
                                                ?>><?php echo $p->id . " - " . $p->name; ?></option>
<?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-gears"></i></span>
                                <select name="category_id" class="form-control">
                                    <option value="">SISTEMA</option>
                                            <?php foreach ($categories as $p): ?>
                                        <option value="<?php echo $p->id; ?>" <?php
                                            if (isset($_GET["category_id"]) && $_GET["category_id"] == $p->id) {
                                                echo "selected";
                                            }
                                            ?>><?php echo $p->id . " - " . $p->name . " " . $p->lastname; ?></option>
<?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                <input type="date" name="date_at" value="<?php
if (isset($_GET["date_at"]) && $_GET["date_at"] != "") {
    echo $_GET["date_at"];
}
?>" class="form-control" placeholder="Palabra clave">
                            </div>
                        </div>

                        <div class="col-lg-2">
                            <button class="btn btn-primary btn-block">Buscar</button>
                        </div>

                    </div>-->
                </form>

                <?php
                $users = array();
                if ((isset($_GET["q"]) && isset($_GET["project_id"]) && isset($_GET["category_id"]) && isset($_GET["date_at"])) && ($_GET["q"] != "" || $_GET["project_id"] != "" || $_GET["category_id"] != "" || $_GET["date_at"] != "")) {
                    $sql = "select * from ticket where status_id = 3 and ";
                    if ($_GET["q"] != "") {
                        $sql .= " (title like '%$_GET[q]%' or description like '%$_GET[q]%') ";
                    }
                    
                    if ($_GET["user_id"] != "") {
                        if ($_GET["q"] != "") {
                            $sql .= " and ";
                        }
                        $sql .= " user_id = " . $_GET["user_id"];
                    }

                    if ($_GET["project_id"] != "") {
                        if ($_GET["q"] != "") {
                            $sql .= " and ";
                        }
                        $sql .= " project_id = " . $_GET["project_id"];
                    }

                    if ($_GET["category_id"] != "") {
                        if ($_GET["q"] != "" || $_GET["project_id"] != "") {
                            $sql .= " and ";
                        }

                        $sql .= " category_id = " . $_GET["category_id"];
                    }

                    if ($_GET["date_at"] != "") {
                        if ($_GET["q"] != "" || $_GET["project_id"] != "" || $_GET["category_id"] != "") {
                            $sql .= " and ";
                        }

                        $sql .= " date(created_at) = \"" . $_GET["date_at"] . "\"";
                    }

                    $users = TicketData::getBySQL($sql);
                } else {
                    $users = TicketData::getAllTerminated();
                }
                if (count($users) > 0) {
                    // si hay usuarios
                    ?>
                    <table class="table table-bordered table-hover">
                        <thead>
                        <th>Folio</th>
                        <th>Asunto</th>
                        <th>Proyecto</th>
                        <th>Prioridad</th>
                        <th>Fecha</th>
                        <th></th>
                        </thead>
    <?php
    foreach ($users as $user) {
        $project = $user->getProject();
        $medic = $user->getPriority();
        ?>
                            <tr>
                                <td><a href="index?view=historyticket&id=<?php echo $user->id; ?>"># <?php echo $user->id; ?></a></td>
                                <td><?php echo $user->title; ?></td>
                                <td><?php echo $project->name; ?></td>
                                <td><?php echo $medic->name; ?></td>
                                <td><?php echo $user->created_at; ?></td>
                                <td style="width:180px;">
                                    <a href="index.php?view=editticket&id=<?php echo $user->id; ?>" class="btn btn-warning btn-xs">Editar</a>
<!--                                    <a href="index.php?action=delticket&id=<?php echo $user->id; ?>" class="btn btn-danger btn-xs">Eliminar</a>-->
                                </td>
                            </tr>
                <?php
            }
            ?>
                    </table>
                </div>
            </div>
    <?php
} else {
    echo "<p class='alert alert-danger'>No hay tickets</p>";
}
?>


    </div>
</div>