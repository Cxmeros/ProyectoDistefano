<h1>Gestionar categorias</h1>

<a href="?controller=categoria&action=crear"class="button button-small">
    Crear categoria
</a>


<table>
    <tr>
        <th>ID</td>
        <th>NOMBRE</td>
    </tr>

<?php while($cat = $categorias->fetch_object()): ?>
    <tr>
        <td><?=$cat->id;?></td>
        <td><?=$cat->nombre;?></td>
    </tr>
<?php endwhile; ?>
</table>