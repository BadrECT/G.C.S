# G.C.S - Système de Gestion de Club Sportif

Bienvenue sur le dépôt du projet **G.C.S**, une application web complète développée avec **Symfony** pour la gestion administrative et opérationnelle d'un club sportif.

## 📋 À propos du projet

G.C.S est conçu pour simplifier les tâches quotidiennes des administrateurs de clubs sportifs tout en offrant un espace dédié aux membres. L'application permet une gestion centralisée des adhérents, des cotisations financières et des plannings d'entraînements.

## 🚀 Fonctionnalités Principales

### 👑 Pour les Administrateurs
- **Gestion des Membres** : Inscription, modification des profils, attribution de catégories, et suppression.
- **Suivi des Paiements** : Enregistrement des cotisations, historique complet, édition de reçus, et gestion des statuts de paiement.
- **Planification des Entraînements** : Création de séances, assignation de coachs, gestion des lieux et des capacités.
- **Tableau de Bord** : Vue d'ensemble des activités du club.

### 👤 Pour les Membres
- **Espace Personnel** : Accès au tableau de bord membre.
- **Planning** : Visualisation des prochains entraînements.
- **Historique Financier** : Consultation de l'historique personnel des paiements effectués.

## 🛠️ Stack Technique

Ce projet repose sur une architecture **MVC** solide :

- **Framework Backend** : [Symfony](https://symfony.com/) (PHP)
- **Base de Données** : MySQL (via Doctrine ORM)
- **Moteur de Template** : Twig
- **Frontend** : CSS, JavaScript (Stimulus)
- **Gestionnaire de  Paquets** : Composer (PHP), NPM (Assets)

## ⚙️ Installation et Configuration

Suivez ces étapes pour installer le projet localement :

1.  **Cloner le dépôt** :
    ```bash
    git clone https://github.com/BadrECT/G.C.S.git
    cd G.C.S
    ```

2.  **Installer les dépendances PHP** :
    ```bash
    composer install
    ```

3.  **Configurer l'environnement** :
    - Dupliquez le fichier `.env` et renommez-le en `.env.local`.
    - Configurez votre connexion à la base de données dans `.env.local` :
      ```dotenv
      DATABASE_URL="mysql://db_user:db_password@127.0.0.1:3306/db_name?serverVersion=8.0.32&charset=utf8mb4"
      ```

4.  **Préparer la base de données** :
    ```bash
    php bin/console doctrine:database:create
    php bin/console doctrine:migrations:migrate
    ```

5.  **Démarrer le serveur** :
    ```bash
    symfony server:start
    ```
    L'application sera accessible sur `http://127.0.0.1:8000`.

## 📂 Structure du Projet

- `src/Entity` : Modèles de données (User, Membre, Paiement, Entrainement).
- `src/Controller` : Logique métier (Admin, Dashboard, Registration, etc.).
- `templates/` : Vues Twig organisées par section (admin, dashboard, pages).
- `assets/` : Fichiers statiques (CSS, JS).

## 📄 Licence

Ce projet est sous licence propriétaire.

---
*Développé par [BadrECT](https://github.com/BadrECT)* et [Alaa-Ber](https://github.com/Alaa-Ber)
