<?php //Con esto sacamos a personas indeseadas :P
if (Session::issetUID()) {
    
} else {
    print "<script>window.location='index?view=login';</script>";
} ?>
<div class="row">
    <div class="col-lg-3 col-md-6 col-sm-6">
        <div  class="card card-stats">
            <a href="./?view=ticketspendings">
                <div class="card-header" data-background-color="red">
                    <i class="fa fa-clock-o"></i>
                </div>
            </a>
            <div class="card-content">
                <p class="category">Pendientes</p>
                <h3 class="title"><?php echo count(TicketData::getAllPendings()); ?></h3>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-6">
        <div class="card card-stats">
            <a href="./?view=ticketsdeveloping"><div class="card-header" data-background-color="orange">
                    <i class="fa fa-wrench"></i>
                </div>
            </a>
            <div class="card-content">
                <p class="category">En desarrollo</p>
                <h3 class="title"><?php echo count(TicketData::getAllDeveloping()); ?></h3>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-6">
        <div class="card card-stats">
            <a href="./?view=ticketsterminated">
                <div class="card-header" data-background-color="green">
                    <i class="fa fa-check-circle"></i>
                </div>
            </a>
            <div class="card-content">
                <p class="category">Terminados</p>
                <h3 class="title"><?php echo count(TicketData::getAllTerminated()); ?></h3>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-6">
        <div class="card card-stats">
            <a href="./?view=projects">
            <div class="card-header" data-background-color="blue">
                <i class="fa fa-flask"></i>
            </div>
            </a>
            <div class="card-content">
                <p class="category">Proyectos</p>
                <h3 class="title"><?php echo count(ProjectData::getAll()); ?></h3>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading text-center" id="encabezado">
                <h4>Tipos de incidencias</h4>
                <h6>y tiempo de atención</h6>
            </div>
            <div class="panel-body">
                <table class="table table-responsive text-center">
                    <thead>
                        <tr>
                            <th><strong>Crítico</strong></th>
                            <th><strong>Alto</strong></th>
                            <th><strong>Medio</strong></th>
                            <th><strong>Bajo</strong></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>15 minutos - 2 horas</td>
                            <td>4 - 8 horas</td>
                            <td>1 - 2 dias</td>
                            <td>5 dias</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <ul>
                <li><strong>Crítico:</strong> Falla o suspensión del servicio que afecte a la totalidad de los procesos de la Operación.</li>
                <li><strong>Alto:</strong> Falla o suspensión parcial del servicio y aplicativos que afecte los procesos de la Operación.</li>
                <li><strong>Medio:</strong> Falla una funcionalidad específica del flujo de algunos procesos de operación de la plataforma y la posibilidad de continuidad de operación de la misma.</li>
                <li><strong>Bajo:</strong> Asesoría sobre el uso de la plataforma, consultas, requerimientos no críticos, entre otros.</li>
                <li><strong>Tiempo de Atención:</strong> Momento contabilizado a partir de la apertura del reporte de incidente en el que se compromete el personal técnico revisando el incidente reportado.</li>
            </ul>
        </div>    
    </div>
</div>