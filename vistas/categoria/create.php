<h1>Crear nueva categoría.</h1>

<div class="form_container">
    <form action="<?=base_url?>Categoria/save" method="POST">
        <label for="nombre">Nombre de la categoría</label>
        <input type="text" name="nombre" required>
        
        <input class="btn-form-submit" type="submit" value="Crear">
    </form>
</div>