# Sporty Management

Projet Symfony


Création d’un CMS orienté pour le football.

Fonctionnalitées :

Espace utilisateur
Gestion des rôles des utilisations


Système de :
Article
Todolist
contenu
Catégorie
Story
joueur
Club
Match
Compétition
événements / Tournoi
Configuration
Partenariat

Documentation pour l’installation du CMS
Espace communautaire (plugin)
Création de template
Optimiser pour le SEO
Site responsive
Gestion des médias (photo / vidéo)
Système de newsletter et flux rss
Système de composition d’équipe
Système de mercato (bonus)
Système de live score (commenter les actions du match)


Front :

Liste des pages :
Page Home (déjà fait)
Page article / contenu (déjà fait)
Liste des articles / contenus
Page catégorie / story
Liste des catégories / stories
Feuilleton mercato
Page joueur
Liste des joueurs par saison
Effectif (déjà fait)
Page match & Live score (fait en partie)
Historique des matchs
Notes des joueurs (fait en partie)
Page club (fait en partie)
Liste des clubs
Événement
Liste des événements
Calendrier & résultat par saison
Forum général
Topic
Liste des topics
Liste des forums
Créer des groupes (bonus)
Page de recherche
Page de statistique
Blog pour les rédacteurs
Palmarès
Espace multimédia (Photos / Vidéos)
Contact (déjà fait)

Site vitrine :

Présentation du projet
Téléchargement du CMS
Documentation

Les plugins (payant) :

Retirer les publicités (hors projet symfony)
Espace communautaire
Notation des joueurs
API Football (hors projet symfony)
Thèmes
Traduction
Statistiques (hors projet symfony)
Blog pour les rédacteurs (bonus)
Crée ta compo (bonus)
Fais ton mercato (bonus)

Services :

Thème personnalisé (hors projet symfony)
Achat de nom de domaine + hébergement (hors projet symfony)

## Comment utiliser l'application

    git clone https://github.com/LMDWEB/Sporty.git 
    cd Sporty
    composer install
    --> Modifier le .env par rapport à la base de données  
    php bin/console make:migration    
    php bin/console doctrine:migrations:migrate
    php bin/console doctrine:fixtures:load
    yarn install
    yarn encore dev
    php bin/console server:run
