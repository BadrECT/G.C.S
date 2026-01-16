<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-3">
  <div class="container">
      <a class="navbar-brand d-flex align-items-center" href="<?php echo URLROOT; ?>">
        <img src="https://cdn-icons-png.flaticon.com/512/33/33736.png" alt="Football Logo" width="40" height="40" class="d-inline-block align-text-top me-2 navbar-logo">
        <span>G.C.S FC</span>
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav me-auto">
          <li class="nav-item">
            <a class="nav-link" href="<?php echo URLROOT; ?>">Accueil</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo URLROOT; ?>/pages/about">A propos</a>
          </li>
        </ul>
        
        <ul class="navbar-nav ms-auto">
          <?php if(isset($_SESSION['user_id'])) : ?>
            <li class="nav-item">
                <a class="nav-link" href="#">Bienvenue <?php echo $_SESSION['user_name']; ?></a>
            </li>
            <?php if(isAdmin()) : ?>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo URLROOT; ?>/admin">Tableau de bord</a>
            </li>
            <?php endif; ?>
            <li class="nav-item">
              <a class="nav-link" href="<?php echo URLROOT; ?>/users/logout">Déconnexion</a>
            </li>
          <?php else : ?>
            <li class="nav-item">
              <a class="nav-link" href="<?php echo URLROOT; ?>/users/register">Inscription</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?php echo URLROOT; ?>/users/login">Connexion</a>
            </li>
          <?php endif; ?>
        </ul>
      </div>
  </div>
</nav>
