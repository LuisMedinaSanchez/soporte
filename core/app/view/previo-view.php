<?php
$conexion_casa = ibase_connect("localhost:C:\__DATOS__\CASA\DB\CASA.GDB", "ADMIN", "admin", "WIN1251");
if (isset($_REQUEST['hori_inic'])) {
    $hori_inic = $_REQUEST['hori_inic'];
}
if (isset($_REQUEST['hor_fina'])) {
    $hor_fina = $_REQUEST['hor_fina'];
}
if (isset($_REQUEST['adu_pat'])) {
    $adu_pat = $_REQUEST['adu_pat'];
}
if (isset($_REQUEST['nom_depe'])) {
    $nom_depe = $_REQUEST['nom_depe'];
}
?>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header" data-background-color="red">
                <h4 class="title">Reporte de previos</h4>
            </div>
            <br>
            <div class="row">
                <div class="form-group">
                    <form role="form" method="post" action="./?view=previo&hori_inic&hor_fina&pat_agen&adu_desp&nom_depe">
                        <div class="col-md-1"></div>
                        <div class="col-md-2">
                            <label>Fecha de inicio</label>
                            <input required="required" type="date" required="required" value='<?php echo $_REQUEST['hori_inic']; ?>'  class="form-control" id="hori_inic" name="hori_inic">
                        </div>
                        <div class="col-md-2">
                            <label>Fecha de inicio</label>
                            <input required="required" type="date" value='<?php echo $_REQUEST['hor_fina']; ?>' class="form-control" id="hor_atencion" id="hor_fina" name="hor_fina">
                        </div>
                        <div class="col-md-2">
                            <label>Aduana / Patente</label>
                            <select class="form-control" id="adu_pat" name="adu_pat" >
                                <option value="">Todas</option>
                                <option value="AND e.adu_desp = '470' AND e.pat_agen = '3646'" >470/3646</option>
                                <option value="AND e.adu_desp = '650' AND e.pat_agen = '1695'" >650/1695</option>
                                <option value="AND e.adu_desp is null AND e.pat_agen is null" >Previos sin asignar</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label>Tramitador</label>
                            <select class="form-control" id="nom_depe" name="nom_depe" >
                                <option value="">Todos</option>
                                <?php
                                $sql2 = "SELECT NOM_DEPE, USU_DEPE FROM CTRAC_DEPEND;";
                                $resultado2 = ibase_query($conexion_casa, $sql2);
                                while ($mostrar2 = ibase_fetch_object($resultado2)) {
                                    ?>
                                    <option value="AND h.dep_asigna in ('<?php echo $mostrar2->USU_DEPE ?>')"><?php echo $mostrar2->NOM_DEPE ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-md-1">
                            <button class="btn btn-default btn-primary" name="Consultar">Consultar</button>
                        </div>

                    </form>
                </div>
            </div>

            <?php if (isset($hori_inic)) {
                ?>

                <div class="col-md-1">
                    <a href="#"><img src="/soporte/resources/xls-icon.png" onclick="tableToExcel('previos', 'Rendimiento de previos')" value="Export to Excel" style="width:40px;height:40px"></a>
                </div>
                <div class="panel-body">
                    <div id="collapseOne" >
                        <div class="panel-body">
                            <table class="table table-responsive" id="previos">
                                <thead>
                                    <tr>
                                        <th>REFERENCIA</th>
                                        <th>ADUANA</th>
                                        <th>PATENTE</th>
                                        <th>PARTIDAS</th>
                                        <th>PIEZAS</th>
                                        <th>TRAMITADOR</th>
                                        <!--<th>FECHA Y HORA DE ASIGNACION</th>-->
                                        <th>FECHA Y HORA DE INICIO</th>
                                        <th>FECHA Y HORA DE FIN</th>
                                        <th>FECHA Y HORA DE ENVIO</th>
                                    <!--<th>ESTADO DE PREVIO</th>
                                        <th>TIEMPO DE INICIO</th>-->
                                        <th>TIEMPO DE PREVIO</th>
                                        <th>TIEMPO DE ENVIO</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $sql = "
                                        SELECT
                                        h.num_refe         AS REFERENCIA,
                                        e.adu_desp         AS ADUANA,
                                        e.pat_agen         AS PATENTE,
                                        COUNT(t.cons_part) AS PARTIDAS,
                                        SUM  (t.can_fact)  AS PIEZAS,
                                        h.dep_asigna       AS TRAMITADOR,
                                        h.fec_asigna       AS FECHA_ASIGNADO,
                                        h.fec_ini          AS FECHA_INICIO,  
                                        h.fec_fin          AS FECHA_FIN,
                                        h.fec_envio        AS FECHA_ENV,
                                        h.edo_prev         AS ESTADO_PREV,
                                        DATEDIFF(minute, h.fec_asigna, h.fec_ini) AS TIEMPO_ASIGNADO,
                                        DATEDIFF(minute, h.fec_ini, h.fec_fin) AS TIEMPO_PREVIO,
                                        DATEDIFF(minute, h.fec_fin, h.fec_envio) AS TIEMPO_ENVIO
                                        FROM ctrao_solprev h
                                        RIGHT OUTER JOIN saaio_facpar t ON t.num_refe = h.num_refe
                                        LEFT  OUTER JOIN ctrao_embar  e ON e.num_refe = h.num_refe
                                        WHERE h.fec_ini BETWEEN '$hori_inic 00:00:01' AND '$hor_fina 23:59:59' $adu_pat $nom_depe
                                        GROUP BY h.num_refe, e.adu_desp, e.pat_agen, h.fec_asigna, h.dep_asigna, h.fec_ini, h.fec_fin, fec_envio, h.edo_prev
                                        ORDER BY partidas;";
                                    $resultado = ibase_query($conexion_casa, $sql);

                                    while ($mostrar = ibase_fetch_object($resultado)) {
                                        ?>
                                        <tr>
                                            <td><?php echo $mostrar->REFERENCIA ?></td>
                                            <td><?php echo $mostrar->ADUANA ?></td>
                                            <td><?php echo $mostrar->PATENTE ?></td>
                                            <td><?php echo $mostrar->PARTIDAS ?></td>
                                            <td><?php echo $mostrar->PIEZAS ?></td>
                                            <td><?php echo $mostrar->TRAMITADOR ?></td>
                                        <!--<td><?php echo $mostrar->FECHA_ASIGNADO ?></td>-->
                                            <td><?php echo $mostrar->FECHA_INICIO ?></td>
                                            <td><?php echo $mostrar->FECHA_FIN ?></td>
                                            <td><?php echo $mostrar->FECHA_ENV ?></td>
                                        <!--<td><?php echo $mostrar->ESTADO_PREV ?></td>
                                            <td><?php echo $mostrar->TIEMPO_ASIGNADO ?></td>-->
                                            <td><?php echo $mostrar->TIEMPO_PREVIO ?></td>
                                            <td><?php echo $mostrar->TIEMPO_ENVIO ?></td>
                                        </tr>
                                        <?php
                                    }
                                    ibase_close();
                                    if (!$conexion_casa)
                                        echo 'conexion a BD no cerrada';
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
                <?php
            } else {
                
            }
            ?>
        </div>
    </div>
</div>