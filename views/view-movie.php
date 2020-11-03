<div class="container-fluid">

    <div class="row justify-content-center">

        <div class="card bg-dark text-white ">
            
            <img src=<?= IMG_BASE_TMBD . "w220_and_h330_face" . $movie->getPoster_path() ?> class="card-img" alt=<?= $movie->getTitle()?>>
        
            <div class="card-img-overlay d-flex align-items-end">
                
                <div class="list-group">
                    <h5 class="card-title "><?= $movie->getTitle()?></h5>
                    <p class="card-text"><?= $movie->getRelease_date()?></p>
                </div>

            </div>

        </div>

    </div>

</div>

