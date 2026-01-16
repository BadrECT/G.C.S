<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="row">
    <div class="col-md-8 mx-auto">
        <div class="card card-body bg-light mt-5">
            <div class="d-flex justify-content-between align-items-center mb-3">
                 <h2>Modifier le Membre</h2>
                 <a href="<?php echo URLROOT; ?>/admin/members" class="btn btn-light"><i class="fa fa-backward"></i> Retour</a>
            </div>
           
            <form action="<?php echo URLROOT; ?>/admin/editMember/<?php echo $data['id']; ?>" method="post">
                <div class="form-group mb-3">
                    <label>Nom: <sup>*</sup></label>
                    <input type="text" name="name" class="form-control form-control-lg" value="<?php echo $data['name']; ?>">
                </div>

                <div class="form-group mb-3">
                    <label>Email:</label>
                    <input type="email" name="email" class="form-control form-control-lg" value="<?php echo $data['email']; ?>">
                </div>

                <div class="form-group mb-3">
                    <label>Rôle:</label>
                    <select name="role" class="form-control">
                        <option value="member" <?php echo ($data['role'] == 'member') ? 'selected' : ''; ?>>Membre</option>
                        <option value="coach" <?php echo ($data['role'] == 'coach') ? 'selected' : ''; ?>>Coach</option>
                        <option value="treasurer" <?php echo ($data['role'] == 'treasurer') ? 'selected' : ''; ?>>Trésorier</option>
                        <option value="admin" <?php echo ($data['role'] == 'admin') ? 'selected' : ''; ?>>Admin</option>
                    </select>
                </div>

                <div class="form-group mb-3">
                    <label>Téléphone:</label>
                    <input type="text" name="telephone" class="form-control form-control-lg" value="<?php echo $data['telephone']; ?>">
                </div>

                <div class="form-group mb-3">
                    <label>Catégorie (ex: Senior, Junior):</label>
                    <input type="text" name="categorie" class="form-control form-control-lg" value="<?php echo $data['categorie']; ?>">
                </div>

                <div class="form-group mb-3">
                    <label>Statut:</label>
                    <select name="statut" class="form-control">
                        <option value="actif" <?php echo ($data['statut'] == 'actif') ? 'selected' : ''; ?>>Actif</option>
                        <option value="inactif" <?php echo ($data['statut'] == 'inactif') ? 'selected' : ''; ?>>Inactif</option>
                    </select>
                </div>

                <input type="submit" class="btn btn-warning" value="Mettre à jour">
            </form>
        </div>
    </div>
</div>
<?php require APPROOT . '/views/inc/footer.php'; ?>
