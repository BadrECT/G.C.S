<?php require APPROOT . '/views/inc/header.php'; ?>

<div class="row justify-content-center mb-5">
    <div class="col-md-10 text-center">
        <h1 class="mb-3 display-4 fw-bold text-primary">À Propos du G.C.S</h1>
        <p class="lead text-muted">
            Plus qu'un club, une famille. La passion du football au cœur de notre gestion.
        </p>
    </div>
</div>

<div class="row align-items-center mb-5">
    <div class="col-lg-6 mb-4 mb-lg-0">
        <div class="position-relative">
            <!-- Football Field Image -->
            <img src="https://images.unsplash.com/photo-1577223625816-7546f13df25d?ixlib=rb-4.0.3&auto=format&fit=crop&w=1000&q=80" alt="Terrain de Football" class="img-fluid rounded-4 shadow-lg">
            <div class="position-absolute bottom-0 start-0 bg-white p-3 m-3 rounded-3 shadow-sm d-none d-md-block" style="opacity: 0.9;">
                <p class="mb-0 fw-bold text-primary"><i class="fa fa-map-marker-alt me-2"></i>Stade Municipal</p>
            </div>
        </div>
    </div>
    
    <div class="col-lg-6">
        <div class="ps-lg-4">
            <h3 class="fw-bold mb-3">Notre Histoire & Nos Valeurs</h3>
            <p class="text-muted mb-4">
                Fondé avec l'ambition de réunir les talents locaux, le <strong>G.C.S</strong> est aujourd'hui une référence en matière de formation et de compétition. 
                Nous visons l'excellence sur et en dehors du terrain, en inculquant des valeurs de respect, de travail et de solidarité.
            </p>
            <p class="text-muted mb-4">
                Cette application est le cœur numérique du club : elle permet au staff technique, aux dirigeants et aux joueurs de rester connectés pour une saison réussie.
            </p>
            
            <div class="row g-3 mb-4">
                <div class="col-md-6">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0 btn-sm-square bg-primary text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                            <i class="fa fa-graduation-cap"></i>
                        </div>
                        <div class="ms-3">
                            <h6 class="mb-0 fw-bold">Formation</h6>
                            <small class="text-muted">École labellisée</small>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0 btn-sm-square bg-success text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                            <i class="fa fa-users"></i>
                        </div>
                        <div class="ms-3">
                            <h6 class="mb-0 fw-bold">Communauté</h6>
                            <small class="text-muted">Esprit d'équipe</small>
                        </div>
                    </div>
                </div>
            </div>

            <div class="p-4 bg-light rounded-3 border-start border-4 border-primary">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <small class="text-uppercase text-muted fw-bold">Fiche Technique</small>
                        <h5 class="fw-bold mb-0">Club G.C.S</h5>
                    </div>
                    <div class="text-end">
                        <span class="badge bg-primary mb-1">Fondé en 2024</span><br>
                        <span class="badge bg-secondary">Couleurs: Bleu/Blanc</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require APPROOT . '/views/inc/footer.php'; ?>
