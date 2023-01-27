<h1>Listado de servicios.</h1>

    <table >
        <tr>
            <th>Id</th>
            <th>Nombre</th>
            <th>Descripción</th>
            <th>Precio</th>
            <th>Oferta</th>
            <th>Fecha</th>
            <th>Imagen</th>
            <th>Acciones</th>
        </tr>
    <?php while($servicio = $servicios->fetch_object()): ?>
        <tr>
            <td><?=$servicio->id;?></td>    
            <td><?=$servicio->nombre;?></td>
            <td><?=$servicio->descripcion;?></td>
            <td><?=$servicio->precio;?></td>
            <td><?=$servicio->oferta;?></td>
            <td><?=$servicio->fecha;?></td>
            <td><img src="<?=base_url?>uploads/imagenes/<?=$servicio->imagen;?>"></td>  
            <td>
                <a href="<?=base_url?>Combo/agregar_servicio&id=<?=$servicio->id?>" class="button button-action">Agregar</a>
            </td>
        </tr>
        
    <?php endwhile; ?>
    </table>