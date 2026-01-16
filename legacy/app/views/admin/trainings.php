<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="row mb-3">
    <div class="col-md-6">
        <h1>Gestion des Entraînements</h1>
    </div>
    <div class="col-md-6">
        <a href="<?php echo URLROOT; ?>/admin/addTraining" class="btn btn-success float-end">
            <i class="fa fa-plus"></i> Créer une séance
        </a>
        <a href="<?php echo URLROOT; ?>/admin" class="btn btn-light float-end me-2">
            <i class="fa fa-backward"></i> Retour
        </a>
    </div>
</div>

<?php flash('training_message'); ?>

<div class="row">
    <?php foreach($data['trainings'] as $training) : ?>
    <div class="col-md-4 mb-3">
        <div class="card h-100">
            <div class="card-body">
                <h5 class="card-title"><?php echo $training->titre; ?></h5>
                <h6 class="card-subtitle mb-2 text-muted">
                    <?php echo date('d/m/Y H:i', strtotime($training->date_heure)); ?>
                </h6>
                <p class="card-text">
                    <strong>Lieu:</strong> <?php echo $training->lieu; ?><br>
                    <strong>Max:</strong> <?php echo $training->places_max; ?> pers.<br>
                    <?php echo $training->description; ?>
                </p>
            </div>
            <div class="card-footer bg-transparent border-top-0">
                <a href="<?php echo URLROOT; ?>/admin/editTraining/<?php echo $training->id; ?>" class="btn btn-sm btn-warning">Modifier</a>
                <form action="<?php echo URLROOT; ?>/admin/deleteTraining/<?php echo $training->id; ?>" method="post" class="d-inline">
                    <input type="submit" value="Annuler" class="btn btn-sm btn-danger">
                </form>
            </div>
        </div>
    </div>
    <?php endforeach; ?>
    <?php if(empty($data['trainings'])): ?>
        <p class="text-center">Aucun entrainement prévu pour le moment.</p>
    <?php endif; ?>
</div>
<?php require APPROOT . '/views/inc/footer.php'; ?>
