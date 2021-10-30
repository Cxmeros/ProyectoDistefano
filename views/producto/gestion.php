<h1>Gestión de productos</h1>

<a href="?controller=producto&action=crear"class="button button-small">
    Crear producto
</a>

<?php if(isset($_SESSION['producto']) && $_SESSION['producto'] == 'complete'): ?>
<strong class="alert_green">El producto se ha creado correctamente</strong>
</br>
<?php elseif(isset($_SESSION['producto']) && $_SESSION['producto'] != 'complete'): ?>
<strong class="alert_red">El producto no se ha creado correctamente</strong>
</br>

<?php endif; ?>
<?php Utils::deleteSession('producto'); ?>


<?php if(isset($_SESSION['delete']) && $_SESSION['delete'] == 'complete'): ?>
<strong class="alert_green">El producto se ha borrado</strong>
</br>
<?php elseif(isset($_SESSION['delete']) && $_SESSION['delete'] != 'complete'): ?>
<strong class="alert_red">El producto no se ha borrado</strong>
</br>


<?php endif; ?>
<?php Utils::deleteSession('delete'); ?>


<table>
    <tr>
        <th>ID</th>
        <th>NOMBRE</th>
        <th>PRECIO</th>
        <th>STOCK</th>
        <th>ACCIONES</th>
    </tr>

<?php while($pro = $productos->fetch_object()): ?>
    <tr>
        <td><?=$pro->id;?></td>
        <td><?=$pro->nombre;?></td>
        <td>Q<?=$pro->precio;?></td>
        <td><?=$pro->stock;?></td>
        <td>
            <a href="?controller=producto&action=editar&id=<?=$pro->id?>" class="button button-gestion">Editar</a>
            <a href="?controller=producto&action=eliminar&id=<?=$pro->id?>" class="button button-gestion button-red">Eliminar</a>
        </td>
    </tr>
<?php endwhile; ?>
</table>