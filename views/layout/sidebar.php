<div id="content">
    
    <aside id="lateral">

	<div id="carrito" class="block_aside">
		<h3>Mi carrito</h3>
		<ul>
			<?php $stats = Utils::statsCarrito(); ?>
			<li>Productos (<?=$stats['count']?>)</li>
			<li>Total: Q<?=$stats['total']?></li>
			<li><a href="?controller=carrito&action=index">Ver el carrito</a></li>
		</ul>
	</div>

	<div id="login" class="block_aside">
		
		<?php if(!isset($_SESSION['identity'])): ?>
			<h3>Entrar a la web</h3>
			<form action="?controller=usuario&action=login" method="post">
				<label for="email">Email</label>
				<input type="email" name="email" />
				<label for="password">Contraseña</label>
				<input type="password" name="password" />
				<input type="submit" value="Enviar" />
			</form>
		<?php else: ?>
			<h3><?=$_SESSION['identity']->nombre?> <?=$_SESSION['identity']->apellidos?></h3>
		<?php endif; ?>

		<ul>
			<?php if(isset($_SESSION['admin'])): ?>
				<li><a href="?controller=categoria&action=index">Gestionar categorias</a></li>
				<li><a href="?controller=producto&action=gestion">Gestionar productos</a></li>
				<li><a href="?controller=pedido&action=gestion">Gestionar pedidos</a></li>
			<?php endif; ?>
			
			<?php if(isset($_SESSION['identity'])): ?>
				<li><a href="?controller=pedido&action=mis_pedidos">Mis pedidos</a></li>
				<li><a href="?controller=usuario&action=logout">Cerrar sesión</a></li>
			<?php else: ?> 
				<li><a href="?controller=usuario&action=registro">Registrate aqui</a></li>
			<?php endif; ?> 
		</ul>
	</div>

</aside>

<!-- CONTENIDO CENTRAL -->
<div id="central">