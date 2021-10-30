<?php if (isset($categoria)): ?>
	<h1><?= $categoria->nombre ?></h1>

	<?php if ($productos->num_rows == 0): ?>
		<p>No hay productos para mostrar</p>

	<?php else: ?>

		<?php while ($product = $productos->fetch_object()): ?>
			<?php if($product->stock >= 1): ?>
				<div class="product">
					<a href="?controller=producto&action=ver&id=<?=$product->id?>">
						<?php if ($product->imagen != null): ?>
							<img src="<?= base_url ?>uploads/images/<?= $product->imagen ?>" />
						<?php else: ?>
							<img src="<?= base_url ?>assets/img/camiseta.png" />
						<?php endif; ?>
						<h2><?= $product->nombre ?></h2>
					</a>
					<p>Q<?= $product->precio ?></p>
					<a href="?controller=carrito&action=add&id=<?=$product->id?>" class="button">Comprar</a>
				</div>
			<?php endif; ?>
		<?php endwhile; ?>

	<?php endif; ?>
<?php else: ?>
	<h1>La categoría no existe</h1>
<?php endif; ?>
