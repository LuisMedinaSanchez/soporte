<div class="row">
	<div class="col-md-12">

<div class="card">
  <div class="card-header" data-background-color="blue">
      <h4 class="title">Perfiles</h4>
  </div>
  <div class="card-content table-responsive">


	<a href="index?view=newuser" class="btn btn-default"><i class='fa fa-user'></i> Nuevo Perfil</a>
<br>
		<?php

		$users = UserData::getAll();
		if(count($users)>0){
			// si hay usuarios
			?>
			<table class="table table-bordered table-hover">
			<thead>
			<th>Nombre completo</th>
			<th>Email</th>
			<th>Username</th>
			<th>Activo</th>
			<th>Perfil</th>
			<th></th>
			</thead>
			<?php
			foreach($users as $user){
				?>
				<tr>
				<td><?php echo $user->name." ".$user->lastname; ?></td>
				<td><?php echo $user->email; ?></td>
				<td><?php echo $user->username; ?></td>
				<td>
					<?php if($user->is_active):?>
						<i class="fa fa-check"></i>
					<?php endif; ?>
				</td>
				<td>
					<?php if($user->kind==1):?>
					Administrador
					<?php elseif($user->kind==2):?>
					Usuario
					<?php endif; ?>
				</td>
				<td style="width:180px;">
				<a href="index?view=edituser&id=<?php echo $user->id;?>" class="btn btn-warning btn-xs">Editar</a>
<a href="index?action=deluser&id=<?php echo $user->id;?>" class="btn btn-danger btn-xs">Eliminar</a>
				</td>
				</tr>
				<?php

			}
			?>
			</table>
			<?php



		}else{
			// no hay usuarios
		}


		?>

</div>
</div>
	</div>
</div>