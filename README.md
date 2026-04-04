# Mini LMS Pédagogique — Laravel

Mini plateforme d'apprentissage en ligne permettant à un administrateur de gérer
des formations, chapitres, sous-chapitres, quiz et notes. Les apprenants peuvent
consulter leur contenu, passer des quiz et voir leurs résultats. Développé en
Laravel avec authentification, relations Eloquent et vues Blade.

## Prérequis

- PHP 8.3+
- Composer 2.x
- Node.js 20+

## Installation

git clone <url-du-repo>
cd mini-lms
composer install
npm install && npm run build
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan db:seed

## Lancer le projet

php artisan serve

Ouvrir : http://127.0.0.1:8000

## Comptes de démonstration

| Rôle      | Email               | Mot de passe      |
|-----------|---------------------|-------------------|
| Admin     | admin@lms.fr        | Admin@LMS2026!    |
| Apprenant | apprenant@lms.fr    | Apprenant@LMS2026!|

## Fonctionnalités

- Authentification avec deux rôles (admin / apprenant)
- CRUD Formations, Chapitres, Sous-chapitres
- CRUD Quiz avec questions à choix multiple
- Calcul automatique du score après soumission
- Gestion des notes par apprenant
- Contenu de démonstration sur les verbes irréguliers en anglais (seeder)
- Protection des routes selon le rôle

## Stack technique

- Laravel 13
- PHP 8.3
- SQLite
- Laravel Breeze (auth)
- Blade + Tailwind CSS
- Vite