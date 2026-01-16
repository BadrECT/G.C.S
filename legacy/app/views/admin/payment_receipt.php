<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reçu de Paiement #<?php echo $data['payment']->id; ?></title>
    <style>
        body { font-family: 'Helvetica', 'Arial', sans-serif; padding: 40px; color: #333; }
        .receipt-box { border: 2px solid #333; padding: 30px; max-width: 600px; margin: 0 auto; }
        .header { text-align: center; border-bottom: 1px solid #ccc; padding-bottom: 20px; margin-bottom: 20px; }
        .header h1 { margin: 0; color: #2E8B57; }
        .details { margin-bottom: 30px; }
        .row { display: flex; justify-content: space-between; margin-bottom: 10px; }
        .label { font-weight: bold; }
        .total { text-align: right; font-size: 1.5em; border-top: 1px solid #ccc; padding-top: 10px; margin-top: 20px; }
        .footer { text-align: center; font-size: 0.8em; color: #777; margin-top: 40px; }
        .print-btn { display: block; width: 100%; text-align: center; margin-top: 20px; }
        @media print { .print-btn { display: none; } }
    </style>
</head>
<body>

<div class="receipt-box">
    <div class="header">
        <h1>REÇU DE PAIEMENT</h1>
        <p>G.C.S - Gestion Club Sportif</p>
    </div>

    <div class="details">
        <div class="row">
            <span class="label">Date de paiement :</span>
            <span><?php echo date('d/m/Y H:i', strtotime($data['payment']->date_paiement)); ?></span>
        </div>
        <div class="row">
            <span class="label">Référence :</span>
            <span>#<?php echo str_pad($data['payment']->id, 6, '0', STR_PAD_LEFT); ?></span>
        </div>
        <div class="row">
            <span class="label">Membre :</span>
            <span><?php echo $data['member']->name; ?></span>
        </div>
        <div class="row">
            <span class="label">Email :</span>
            <span><?php echo $data['member']->email; ?></span>
        </div>
        <hr>
        <div class="row">
            <span class="label">Motif :</span>
            <span><?php echo $data['payment']->motif; ?></span>
        </div>
    </div>

    <div class="total">
        Total Payé : <?php echo number_format($data['payment']->montant, 2); ?> €
    </div>

    <div class="footer">
        Ceci est un document généré automatiquement.<br>
        Merci pour votre confiance.
    </div>
</div>

<div class="print-btn">
    <button onclick="window.print()" style="padding: 10px 20px; cursor: pointer; background: #333; color: #fff; border: none; border-radius: 5px;">Imprimer ce reçu</button>
</div>

</body>
</html>
