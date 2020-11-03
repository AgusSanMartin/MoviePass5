<div id="listaCines">
    <div class ="container"> 
        <div class="listcinema-container">
            <div class="row">
                <div class="col-9">
                    <h2> Sucursales
                </div>
                <div class="col-3">
                    <form method="get" action="<?php echo FRONT_ROOT . "cineController/ShowAdd" ?> ">
                        <button type"submit" class="btn btn-dark">Agregar nuevo cine</button>
                    </form>
                </div>
            </div>
            <div class="row">
                <?php 
                foreach($cines_list as $cine)
                ?>
                <div class="col-3" style="margin-bottom:20px">
                    <div class="card">
                        <div class="card-img-top cinema-card container">
                            <div class="row" style="height:inherit">
                                <div class="col align-self-center">
                                    <span class="h2 border-text"> <?php echo $cine->getNombre(); ?></span>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                        <?php echo $cine->getNombre(); ?>
                        <span class="h5 card-title">Direccion:  <?php echo $cine->getDireccion(); ?></span></br>
                        <form class="" action="<?php echo FRONT_ROOT . "cineController/Delete" ?> ">
                            <button type="submit" name="id" class="btn-dark btn-sm" value="<?php echo $cine->GetById($id); ?>">Eliminar</button>
                        </form>
                        </div>
                    </div>
                
                </div>
            </div>
        </div>
    </div>
</div>