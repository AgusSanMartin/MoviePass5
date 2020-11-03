<div class="container-fluid">

    <div class="row justify-content-center">

        <div class="col-12 col-sm-6 col-md-3">

        

            <form class="form-container border rounded-lg" action="<?= FRONT_ROOT ?>CuentasController/crear" method="POST">

                <h1>Registro</h1>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputEmail4">Email</label>
                        <input type="email" class="form-control" id="inputEmail4" name="email">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputPassword4">Password</label>
                        <input type="password" class="form-control" id="inputPassword4" name="password">
                    </div>
                </div>

                <div class="form-group">
                        <label for="inputPassword4">Repetir Password</label>
                        <input type="password" class="form-control" id="inputPassword4" name="rPassword">
                </div>

                <div class="form-group">
                        <label for="inputEmail4">Dni</label>
                        <input type="number" class="form-control" id="inputEmail4" name="dni">
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputEmail4">Nombre</label>
                        <input type="text" class="form-control" id="inputEmail4" name="nombre">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputPassword4">Apellido</label>
                        <input type="text" class="form-control" id="inputPassword4" name="apellido">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputEmail4">Telefono</label>
                        <input type="number" class="form-control" id="inputEmail4" name="telefono">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputPassword4">Domicilio</label>
                        <input type="text" class="form-control" id="inputPassword4" name="direccion">
                    </div>
                </div>
                
                <button type="submit" class="btn btn-primary">Registrarse</button>
            </form>

        </div>

    </div>

</div>