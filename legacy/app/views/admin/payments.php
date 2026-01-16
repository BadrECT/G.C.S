<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="row mb-3">
    <div class="col-md-6">
        <h1>Suivi Financier</h1>
    </div>
    <div class="col-md-6">
        <a href="<?php echo URLROOT; ?>/admin/addPayment" class="btn btn-warning float-end">
            <i class="fa fa-plus"></i> Enregistrer Paiement
        </a>
        <a href="<?php echo URLROOT; ?>/admin" class="btn btn-light float-end me-2">
            <i class="fa fa-backward"></i> Retour
        </a>
    </div>
</div>

<?php flash('payment_message'); ?>

<div class="card">
    <div class="card-body">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Membre</th>
                    <th>Motif</th>
                    <th>Montant</th>
                    <th>Date</th>
                    <th>Statut</th>
                    <th>Reçu</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($data['payments'] as $payment) : ?>
                    <tr>
                        <td><?php echo $payment->member_name; ?> <small class="text-muted">(<?php echo $payment->email; ?>)</small></td>
                        <td><?php echo $payment->motif; ?></td>
                        <td><strong><?php echo number_format($payment->montant, 2); ?> €</strong></td>
                        <td><?php echo date('d/m/Y', strtotime($payment->date_paiement)); ?></td>
                        <td>
                            <?php if($payment->statut == 'payé') : ?>
                                <span class="badge bg-success">Payé</span>
                            <?php else : ?>
                                <span class="badge bg-warning text-dark">En attente</span>
                            <?php endif; ?>
                        </td>
                        <td class="d-flex align-items-center gap-1">
                            <a href="<?php echo URLROOT; ?>/admin/paymentReceipt/<?php echo $payment->id; ?>" target="_blank" class="btn btn-sm btn-outline-secondary">Reçu</a>
                            <a href="<?php echo URLROOT; ?>/admin/editPayment/<?php echo $payment->id; ?>" class="btn btn-sm btn-dark">Modifier</a>
                            <form action="<?php echo URLROOT; ?>/admin/deletePayment/<?php echo $payment->id; ?>" method="post" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce paiement ?');" class="mb-0">
                                <button type="submit" class="btn btn-sm btn-danger btn-sm-action"><i class="fa fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
                <?php if(empty($data['payments'])) : ?>
                    <tr><td colspan="6" class="text-center">Aucun paiement enregistré.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
<?php require APPROOT . '/views/inc/footer.php'; ?>
