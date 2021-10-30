<h1>Algunos de nuestros productos</h1>



<?php while($product = $productos->fetch_object()): ?>
    <?php if($product->stock >= 1): ?>
    <div class="product">
        <a href="?controller=producto&action=ver&id=<?=$product->id?>">
            <?php if($product->imagen != null): ?>
            <img src="<?=base_url?>uploads/images/<?=$product->imagen?>" />
            <?php else: ?>
                <img src="<?=base_url?>assets/img/camisa.jpg" />
            <?php endif; ?>
            <h2><?=$product->nombre?></h2>
        </a>
        <p>Q<?=$product->precio?></p>
        <a href="?controller=carrito&action=add&id=<?=$product->id?>" class="button">Comprar</a>
    </div>

<?php endif; ?>
<?php endwhile; ?>
