<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="row">
    <div class="col-md-8 mx-auto">
        <div class="card card-body bg-light mt-5">
            <div class="d-flex justify-content-between align-items-center mb-3">
                 <h2>Créer un Entraînement</h2>
                 <a href="<?php echo URLROOT; ?>/admin/trainings" class="btn btn-light"><i class="fa fa-backward"></i> Retour</a>
            </div>
           
            <form action="<?php echo URLROOT; ?>/admin/addTraining" method="post">
                <div class="form-group mb-3">
                    <label>Titre de la séance: <sup>*</sup></label>
                    <input type="text" name="titre" class="form-control form-control-lg <?php echo (!empty($data['titre_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['titre']; ?>">
                    <span class="invalid-feedback"><?php echo $data['titre_err']; ?></span>
                </div>

                <div class="form-group mb-3">
                    <label>Date et Heure: <sup>*</sup></label>
                    <input type="datetime-local" name="date_heure" class="form-control form-control-lg <?php echo (!empty($data['date_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['date_heure']; ?>">
                    <span class="invalid-feedback"><?php echo $data['date_err']; ?></span>
                </div>

                <div class="form-group mb-3">
                    <label>Lieu: <sup>*</sup></label>
                    <input type="text" name="lieu" class="form-control form-control-lg <?php echo (!empty($data['lieu_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['lieu']; ?>">
                    <span class="invalid-feedback"><?php echo $data['lieu_err']; ?></span>
                </div>

                <div class="form-group mb-3">
                    <label>Places Maximum:</label>
                    <input type="number" name="places_max" class="form-control form-control-lg" value="<?php echo $data['places_max']; ?>">
                </div>

                <div class="form-group mb-3">
                    <label>Description (optionnel):</label>
                    <textarea name="description" class="form-control form-control-lg"><?php echo $data['description']; ?></textarea>
                </div>

                <input type="submit" class="btn btn-success" value="Valider l'entrainement">
            </form>
        </div>
    </div>
</div>
<?php require APPROOT . '/views/inc/footer.php'; ?>
