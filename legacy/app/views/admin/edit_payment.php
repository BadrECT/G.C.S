<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="row">
    <div class="col-md-8 mx-auto">
        <div class="card card-body bg-light mt-5">
             <div class="d-flex justify-content-between align-items-center mb-3">
                 <h2>Modifier le Paiement</h2>
                 <a href="<?php echo URLROOT; ?>/admin/payments" class="btn btn-light"><i class="fa fa-backward"></i> Retour</a>
            </div>

            <form action="<?php echo URLROOT; ?>/admin/editPayment/<?php echo $data['id']; ?>" method="post">
                <!-- Member not editable to keep integrity simpler -->
                
                <div class="form-group mb-3">
                     <label>Motif: <sup>*</sup></label>
                     <input type="text" name="motif" class="form-control form-control-lg <?php echo (!empty($data['motif_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['motif']; ?>">
                     <span class="invalid-feedback"><?php echo $data['motif_err']; ?></span>
                </div>

                 <div class="form-group mb-3">
                     <label>Montant (€): <sup>*</sup></label>
                     <input type="number" step="0.01" name="montant" class="form-control form-control-lg <?php echo (!empty($data['montant_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['montant']; ?>">
                     <span class="invalid-feedback"><?php echo $data['montant_err']; ?></span>
                </div>

                 <div class="form-group mb-3">
                    <label>Date du paiement:</label>
                    <input type="datetime-local" name="date_paiement" class="form-control form-control-lg" value="<?php echo date('Y-m-d\TH:i', strtotime($data['date_paiement'])); ?>">
                </div>

                <div class="form-group mb-3">
                    <label>Statut:</label>
                    <select name="statut" class="form-control">
                        <option value="payé" <?php echo ($data['statut'] == 'payé') ? 'selected' : ''; ?>>Payé</option>
                        <option value="en_attente" <?php echo ($data['statut'] != 'payé') ? 'selected' : ''; ?>>En attente</option>
                    </select>
                </div>

                <input type="submit" class="btn btn-warning" value="Mettre à jour">
            </form>
        </div>
    </div>
</div>
<?php require APPROOT . '/views/inc/footer.php'; ?>
