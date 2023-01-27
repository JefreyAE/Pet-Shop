<h1>Listado de productos.</h1>

    <table >
        <tr>
            <th>Id</th>
            <th>Nombre</th>
            <th>Descripcion</th>
            <th>Precio</th>
            <th>Stock</th>
            <th>Oferta</th>
            <th>Fecha</th>
            <th>Imagen</th>
            <th>Acciones</th>
        </tr>
    <?php while($producto = $productos->fetch_object()): ?>
        <tr>
            <td><?=$producto->id;?></td>    
            <td><?=$producto->nombre;?></td>
            <td><?=$producto->descripcion;?></td>
            <td><?=$producto->precio;?></td>
            <td><?=$producto->stock;?></td>
            <td><?=$producto->oferta;?></td>
            <td><?=$producto->fecha;?></td>
            <td><img src="<?=base_url?>uploads/imagenes/<?=$producto->imagen;?>"></td>  
            <td>
                <a href="<?=base_url?>Combo/agregar_producto&id=<?=$producto->id?>" class="button button-action">Agregar</a>
            </td>
        </tr>
        
    <?php endwhile; ?>
    </table>