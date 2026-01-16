<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="row mb-3">
    <div class="col-md-6">
        <h1>Gestion des Membres</h1>
    </div>
    <div class="col-md-6">
        <a href="<?php echo URLROOT; ?>/users/register" class="btn btn-primary float-end">
            <i class="fa fa-plus"></i> Ajouter un membre
        </a>
        <a href="<?php echo URLROOT; ?>/admin" class="btn btn-light float-end me-2">
            <i class="fa fa-backward"></i> Retour
        </a>
    </div>
</div>

<?php flash('member_message'); ?>

<div class="card">
    <div class="card-body">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Membre</th>
                    <th>Rôle</th>
                    <th>Statut</th>
                    <th>Inscrit le</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($data['members'] as $member) : ?>
                    <tr>
                        <td><?php echo $member->name; ?> <small class="text-muted">(<?php echo $member->email; ?>)</small></td>
                        <td>
                            <?php 
                                if($member->role == 'admin') echo '<span class="badge bg-danger">Admin</span>';
                                elseif($member->role == 'coach') echo '<span class="badge bg-warning text-dark">Coach</span>';
                                elseif($member->role == 'treasurer') echo '<span class="badge bg-info text-dark">Trésorier</span>';
                                else echo '<span class="badge bg-secondary">Membre</span>';
                            ?>
                        </td>
                        <td>
                            <?php if($member->statut == 'actif') : ?>
                                <span class="badge bg-success">Actif</span>
                            <?php else : ?>
                                <span class="badge bg-secondary">Inactif</span>
                            <?php endif; ?>
                        </td>
                        <td><?php echo date('d/m/Y', strtotime($member->created_at)); ?></td>
                         <td class="d-flex align-items-center gap-1">
                            <a href="#" class="btn btn-sm btn-info text-white">Voir</a>
                            <a href="<?php echo URLROOT; ?>/admin/editMember/<?php echo $member->userId; ?>" class="btn btn-sm btn-dark">Editer</a>
                            <form action="<?php echo URLROOT; ?>/admin/deleteMember/<?php echo $member->userId; ?>" method="post" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce membre ?');" class="mb-0">
                                <button type="submit" class="btn btn-sm btn-danger btn-sm-action"><i class="fa fa-trash"></i></button>
                            </form>
                         </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<?php require APPROOT . '/views/inc/footer.php'; ?>
