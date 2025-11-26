# 🌟 Genshin Impact Collection - Projet PHP MVC

Ce projet est une application web de gestion de collection de personnages (CRUD) basée sur l'univers de Genshin Impact, réalisée en PHP natif avec une architecture MVC et Programmation Orientée Objet.

## 📋 Prérequis et Installation

1.  **Base de données** : Importer le script SQL fourni dans votre SGBD (MySQL/MariaDB).
2.  **Configuration** : Assurez-vous que le fichier `Config/dev.ini` (ou `prod.ini`) contient les bons identifiants de connexion à la base de données.

## 🚀 Particularités du Projet

Bien que le fonctionnement global suive les standards MVC vus en cours, voici quelques spécificités à noter pour la correction :

### 1. Authentification et Sécurité
* **Protection des Logs** : Le système de journaux (`/logs`) n'est pas public. Il est impératif d'être **connecté** à une session utilisateur pour pouvoir consulter l'historique des actions (Création, Modification, Suppression).
* **Redirection** : Toute tentative d'accès à une route protégée sans session redirige automatiquement vers la page de login.

### 2. Gestion des Images (Origines)
* **Problème d'affichage connu** : Vous remarquerez que les petites icônes représentant les "Origines" (Mondstadt, Liyue, etc.) ne s'affichent pas correctement.
* **Cause** : Les URLs externes utilisées proviennent de wikis ou de sites tiers qui ont activé une protection contre le **hotlinking** (blocage des requêtes externes), empêchant le chargement des images sur ce domaine. Le code de gestion d'image fonctionne, mais la source distante refuse l'accès.

## 🔐 Identifiants de Connexion

Pour tester les fonctionnalités administratives (Ajout/Édition/Suppression, Logs, Collection) :

* **Identifiant** : `admin`
* **Mot de passe** : `admin`

> **Note technique** : Un fichier utilitaire `mdp.php` est présent dans le projet. Il a servi à générer les hachages de mots de passe (`password_hash`) utilisés en base de données. Vous pouvez vous y référer pour vérifier la correspondance des hashs.

## 🛠️ Architecture Technique

* **Routeur** : `Controllers\Router\Router.php` (Gestion dynamique des routes via des classes dédiées).
* **Vues** : Moteur de template *Plates*.
* **Modèle** : Utilisation de DAO (Data Access Object) pour chaque entité (`Personnage`, `Element`, `UnitClass`, `Origin`).
* **Services** : Logique métier déportée dans des Services (`AuthService`, `PersonnageService`, `LogService`).

---
*Projet réalisé dans le cadre du module Développement Web & Base de Données.*