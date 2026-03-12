# Plateforme de Presse / Blog Laravel

Ce projet est une application web de gestion de contenu (CMS) développée avec le framework Laravel. Elle permet de gérer des articles de presse, des catégories, et offre une interface d'administration complète.

## 🚀 Fonctionnalités

### Partie Publique (Front-office)
- **Accueil** :
  - Slider des articles "À la une" (les 5 derniers).
  - Grille des articles récents.
- **Navigation** : Menu dynamique basé sur les catégories.
- **Recherche** : Recherche textuelle dans les titres et contenus des articles.
- **Lecture** : Page de détail d'un article avec suggestions d'articles similaires.
- **Catégories** : Filtrage des articles par catégorie.

### Partie Administration (Back-office)
- **Dashboard** : Vue d'ensemble avec statistiques (nombre d'articles, messages non lus).
- **Gestion des Articles** :
  - Création, modification et suppression.
  - Upload d'images.
  - Gestion du statut "À la une".
- **Messagerie** :
  - Réception des messages via formulaire de contact.
  - Lecture et marquage des messages (Lu/Non lu).
- **Paramètres** :
  - Édition du contenu de la page "Qui sommes-nous" (QSN).

## 🛠 Prérequis

- PHP >= 8.1
- Composer
- MySQL
- Node.js & NPM (pour la compilation des assets)

## ⚙️ Installation

1. **Cloner le projet**
   ```bash
   git clone <votre-repo-url>
   cd projet
   ```

2. **Installer les dépendances PHP**
   ```bash
   composer install
   ```

3. **Configurer l'environnement**
   Copiez le fichier d'exemple `.env` et configurez votre base de données :
   ```bash
   cp .env.example .env
   ```
   Ouvrez le fichier `.env` et modifiez les informations de base de données (`DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`).

4. **Générer la clé d'application**
   ```bash
   php artisan key:generate
   ```

5. **Créer le lien symbolique pour les images**
   Indispensable pour l'affichage des images uploadées :
   ```bash
   php artisan storage:link
   ```

6. **Migrations et Seeders**
   Crée les tables et injecte les données de test (catégories, articles, admin) :
   ```bash
   php artisan migrate --seed
   ```

7. **Lancer le serveur**
   ```bash
   php artisan serve
   ```

L'interface de connexion est accessible via l'URL `/login` ou un lien dédié sur le site.
