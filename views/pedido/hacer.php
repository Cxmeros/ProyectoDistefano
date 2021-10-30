<?php if (isset($_SESSION['identity'])): ?>
	<h1>Hacer pedido</h1>
	<p>
		<a href="?controller=carrito&action=index">Ver los productos y el precio del pedido</a>
	</p>
	<br/>
	
	<h3>Dirección para el envio:</h3>
	<form action="?controller=pedido&action=add" method="POST">
		<label for="departamento">Departamento</label>
		<input type="text" name="departamento" required />
		
		<label for="municipio">Municipio</label>
		<input type="text" name="municipio" required />
		
		<label for="direccion">Dirección</label>
		<input type="text" name="direccion" required />
		
		<input type="submit" value="Confirmar pedido" />
	</form>
		
<?php else: ?>
	<h1>Necesitas estar identificado</h1>
	<p>Necesitas estar logueado en la web para poder realizar tu pedido.</p>
<?php endif; ?>