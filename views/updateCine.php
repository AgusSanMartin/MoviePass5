<main class="container">
    <h1>Update Cine</h1>
    <form class="form-center" action="<?php echo FRONT_ROOT ?>cineController/Update" method="post">
        <div class="form-group text-center">

            <label for="name"><span>Nombre</span> </label>
            <input type="text" name="nombre" id="nombre" value=" <?php echo $cine->getName() ?>"  required>

            <label for="room"><span>Rooms</span> </label>
            <input type="text" name="room" id="room" value=" <?php echo $cine->getRoom() ?>"  required>

            <label for="address"><span>Direccion</span></label>
            <input type="address" name="direccion" id="direccion" value=" <?php echo $cine->getDireccion() ?>" required>

            <button type="submit">Cambiar</button>
    </form>
</main>