<?php require APPROOT . '/views/inc/header.php'; ?>

<!-- Hero Section -->
<div class="row mb-5 align-items-center">
    <div class="col-lg-6">
        <h1 class="display-4 fw-bold mb-4 text-primary">G.C.S Football Club <br><span class="text-dark">Passion & Victoire</span></h1>
        <p class="lead text-muted mb-4">
            Bienvenue sur la plateforme officielle du G.C.S. <br>
            Gestion des licences, calendrier des matchs, entraînements et vie du club. Tout pour le ballon rond.
        </p>
        <div class="d-grid gap-2 d-md-flex justify-content-md-start">
            <?php if(!isLoggedIn()) : ?>
                <a href="<?php echo URLROOT; ?>/users/register" class="btn btn-primary btn-lg px-4 me-md-2">Devenir Licencié</a>
                <a href="<?php echo URLROOT; ?>/users/login" class="btn btn-outline-secondary btn-lg px-4">Espace Joueur/Coach</a>
            <?php else : ?>
                <?php if(isAdmin()) : ?>
                    <a href="<?php echo URLROOT; ?>/admin" class="btn btn-primary btn-lg px-4">Accéder au Dashboard</a>
                <?php else : ?>
                    <div class="alert alert-info d-inline-block px-4">
                        <i class="fa fa-info-circle me-2"></i> Bienvenue ! Vous êtes connecté en tant que membre.
                    </div>
                <?php endif; ?>
            <?php endif; ?>
        </div>
    </div>
    <div class="col-lg-6 d-none d-lg-block">
        <!-- Football Image -->
        <img src="https://images.unsplash.com/photo-1551958219-acbc608c6377?ixlib=rb-4.0.3&auto=format&fit=crop&w=1000&q=80" alt="Football Action" class="img-fluid rounded-4 shadow-lg">
    </div>
</div>

<!-- Features Section -->
<div class="row g-4 py-5 row-cols-1 row-cols-lg-3">
    <div class="feature col">
        <div class="feature-icon bg-primary bg-gradient text-white rounded-3 mb-3 p-3 d-inline-block">
            <i class="fa fa-users fa-2x"></i>
        </div>
        <h2>Effectif & Joueurs</h2>
        <p>Gérez l'effectif, des débutants aux vétérans. Suivi des licences et des fiches médicales en toute simplicité.</p>
    </div>
    <div class="feature col">
        <div class="feature-icon bg-success bg-gradient text-white rounded-3 mb-3 p-3 d-inline-block">
            <i class="fa fa-futbol fa-2x"></i>
        </div>
        <h2>Entraînements</h2>
        <p>Planifiez les séances tactiques et physiques. Gérez les présences sur le terrain pour préparer le match du dimanche.</p>
    </div>
    <div class="feature col">
        <div class="feature-icon bg-warning bg-gradient text-white rounded-3 mb-3 p-3 d-inline-block">
            <i class="fa fa-trophy fa-2x"></i>
        </div>
        <h2>Matchs & Championnat</h2>
        <p>Le calendrier de la saison, les convocations, les résultats et le classement. Vivez la saison à fond.</p>
    </div>
</div>

<!-- Call to Action -->
<div class="cta-section text-center text-white rounded-3 shadow-lg p-5 mb-4 position-relative overflow-hidden">
    <div class="cta-overlay"></div>
    <div class="position-relative z-1 py-4">
        <h2 class="display-5 fw-bold mb-3"><i class="fa fa-futbol me-3"></i>Prêt pour le coup d'envoi ?</h2>
        <p class="fs-4 mb-4">Rejoignez le <strong>G.C.S Football Club</strong> dès maintenant.<br>Prenez votre licence et entrez sur le terrain !</p>
        <?php if(!isLoggedIn()) : ?>
            <button class="btn btn-light btn-lg px-5 py-3 fw-bold rounded-pill shadow-sm cta-btn" type="button" onclick="window.location.href='<?php echo URLROOT; ?>/users/register'">
                S'inscrire au Club <i class="fa fa-arrow-right ms-2"></i>
            </button>
        <?php endif; ?>
    </div>
</div>

<?php require APPROOT . '/views/inc/footer.php'; ?>
