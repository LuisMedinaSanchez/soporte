<?php
$reservation = TicketData::getById($_GET["id"]);
$pacients = ProjectData::getAll();
$medics = PriorityData::getAll();
$statuses = StatusData::getAll();
$payments = KindData::getAll();
$conexion = mysqli_connect("localhost", "root", "", "soporte");
$sql2 = "SELECT 
t.title                 AS  TIT_TIC,
t.created_at		AS  FEC_TIC,
t.description           AS  DES_TIC,
h.description           AS  DES_HIS,
h.created_at            AS  FEC_HIS,
h.user_id               AS  ID_TEC,
u.name                  AS  NOM_TEC,
u.lastname              AS  APE_TEC,
u.email                 AS  MAI_TEC,
p.name			AS  NOM_PER,
p.lastname		AS  APE_PER,
p.email			AS  MAI_PER,
s.name                  AS  EST_TIC,
c.name                  AS  SISTEMA,
h.evidenciahistory_id   AS  EVI_TIC
FROM tickethistory        h
RIGHT OUTER JOIN user     u ON u.id = h.user_id
RIGHT OUTER JOIN ticket   t ON t.id = h.ticket_id
RIGHT OUTER JOIN person	  p ON p.id = t.person_id
RIGHT OUTER JOIN status	  s ON s.id = t.status_id
RIGHT OUTER JOIN category c ON c.id = t.category_id
WHERE h.ticket_id = $reservation->id
ORDER BY h.created_at DESC";
$resultado2 = mysqli_query($conexion, $sql2);
$mostrar2 = mysqli_fetch_array($resultado2)
?>
<div class="card">
    <div class="card-header" data-background-color="blue">
        <h3 class="title">Historial del ticket # <?php echo $reservation->id; ?></h3>
    </div>
    <div class="card-content table-responsive">
        <div class="col-md-12">
            <div class="panel-body">
                    <div class="col-md-6">
                        <h3><strong><?php echo $reservation->title; ?></strong></h3>
                        <p><?php echo " <strong>Descripción:</strong>   " .$reservation->description; ?></p>
                    </div>
                    <div class="col-md-4">
                        <?php echo "<br> <strong>Creado el:</strong> " . $reservation->created_at."<br> <strong>Creado por:</strong> ". $mostrar2['NOM_TEC']." ". $mostrar2['APE_TEC']."<br><strong>Solicitado por:</strong> ".$mostrar2['NOM_PER']." ".$mostrar2['APE_PER']."<br><strong>Estado:</strong> ".$mostrar2['EST_TIC']."<br><strong>Sistema:</strong> ".$mostrar2['SISTEMA']; ?>
                    </div>
                    <div class="col-md-2">
                        <a href="<?php echo $reservation->evidencia_id; ?>" target=”_blank”><img width="20" src="<?php echo $reservation->evidencia_id; ?>"/></a>
                    </div>
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
t.title                 AS  TIT_TIC,
t.created_at		AS  FEC_TIC,
t.description           AS  DES_TIC,
h.description           AS  DES_HIS,
h.created_at            AS  FEC_HIS,
h.user_id               AS  ID_TEC,
u.name                  AS  NOM_TEC,
u.lastname              AS  APE_TEC,
u.email                 AS  MAI_TEC,
p.name			AS  NOM_PER,
p.lastname		AS  APE_PER,
p.email			AS  MAI_PER,
s.name                  AS  EST_TIC,
h.evidenciahistory_id   AS  EVI_TIC
FROM tickethistory      h
RIGHT OUTER JOIN user   u ON u.id = h.user_id
RIGHT OUTER JOIN ticket t ON t.id = h.ticket_id
RIGHT OUTER JOIN person	p ON p.id = t.person_id
RIGHT OUTER JOIN status	s ON s.id = t.status_id
WHERE h.ticket_id = $reservation->id
ORDER BY h.created_at DESC";
                        $resultado = mysqli_query($conexion, $sql);
                        while ($mostrar = mysqli_fetch_array($resultado)) {
                            ?>
                            <tr>
                                <td>
                                    <div class="col-md-10"><?php echo "<strong>" . $mostrar['NOM_TEC'] . " " . $mostrar['APE_TEC'] . "</strong>" . " " . $mostrar['FEC_HIS'] . "<br>" . $mostrar['DES_HIS'] ?>
                                    </div>

                                    <div class="col-md-2"><a href="<?php echo $mostrar['EVI_TIC']; ?>" target=”_blank”><img width="10" height="10" src="<?php echo $mostrar['EVI_TIC']; ?>" ></a>
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
</div>

