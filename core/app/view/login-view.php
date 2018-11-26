
<?php
if (Session::getUID() != "") {
    print "<script>window.location='index?view=home';</script>"; //si se cambia la contraseña manda al login para usar actualizacion
}
?>
<br><br><br><br><br>
<div class="container">
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <?php if (isset($_COOKIE['password_updated'])): ?>
                <div class="alert alert-success">
                    <p><i class='glyphicon glyphicon-off'></i> Se ha cambiado la contraseña exitosamente !!</p>
                    <p>Pruebe iniciar sesion con su nueva contraseña.</p>

                </div>
                <?php
                setcookie("password_updated", "", time() - 18600);
            endif;
            ?>

            <div class="logo">
                    <img src="resources/logo_TP.png" width="150" alt="" />
            </div>
            <div class="card">
                <div class="card-header" data-background-color="blue">

                    <h4 class="title">Acceder a soporte</h4>
                </div>
                <div class="card-content table-responsive">
                    <form accept-charset="UTF-8" role="form" method="post" action="index?view=processlogin">
                        <fieldset>
                            <div class="form-group">
                                <input class="form-control" placeholder="Usuario" name="mail" type="text">
                            </div>
                            <div class="form-group">
                                <input class="form-control" placeholder="Contraseña" name="password" type="password" value="">
                            </div>
                            <input class="btn btn-primary btn-block" type="submit" value="Iniciar Sesion">
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
