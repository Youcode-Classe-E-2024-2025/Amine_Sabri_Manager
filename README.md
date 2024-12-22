# Gestion d'Hôpital

Ce projet est une application de gestion d’hôpital permettant de gérer les utilisateurs (patients), les administrateurs et les docteurs. Il offre une solution complète pour la création de comptes, l’administration des utilisateurs et des données médicales, tout en assurant un haut niveau de sécurité et une expérience utilisateur fluide.

## Fonctionnalités principales

### 1. **Utilisateurs (Patients)**
- **Création de compte** :
  - Formulaire sécurisé pour enregistrer un nouvel utilisateur.
  - Validation des champs via **Regex** côté client et serveur.
- **Authentification** :
  - Connexion sécurisée avec redirection vers une page utilisateur personnalisée après succès.

---

### 2. **Administrateurs**
- **Authentification** :
  - Connexion sécurisée avec redirection vers un tableau de bord administratif.
- **Validation des comptes utilisateurs** :
  - Gestion des nouvelles inscriptions avec options pour approuver ou rejeter.
- **Tableau de bord avec statistiques** :
  - Visualisation des données : par exemple, le nombre de nouveaux comptes créés quotidiennement.
- **Gestion des données utilisateur** :
  - **CRUD** (Créer, Lire, Modifier, Supprimer) des comptes utilisateurs et des données associées.
  - **Archivage** : Les comptes supprimés sont marqués comme "archivés" (soft delete) pour préserver les données.

---

### 3. **Docteurs**
- **Gestion des consultations** :
  - Liste des patients associés à un docteur.
  - Gestion des rendez-vous (ajout, mise à jour, suppression).
- **Accès aux dossiers médicaux** :
  - Consultation des dossiers patients.
  - Ajout de notes ou de prescriptions dans les dossiers.
  
---

### 4. **Sécurité des données**
- **Hachage des mots de passe** :
  - Utilisation de bibliothèques comme **bcrypt** ou **argon2** pour sécuriser les mots de passe.
- **Protection contre les attaques XSS et CSRF** :
  - Validation des entrées utilisateur et échappement des scripts.
  - Utilisation de jetons **CSRF** pour protéger les formulaires.
- **Requêtes SQL préparées** :
  - Prévention des injections SQL grâce à des requêtes sécurisées.

---

### 5. **Fonctionnalités JavaScript**
- **Validation avec Regex** :
  - Vérification dynamique des formulaires pour s’assurer du format des e-mails, mots de passe, etc.
- **Formulaires dynamiques** :
  - Possibilité d’ajouter ou de supprimer des champs en temps réel (par exemple : ajout de plusieurs diagnostics pour un patient).
- **Affichage interactif** :
  - Utilisation de **modals** pour afficher des actions ou des détails sans recharger la page.
  - Intégration de **SweetAlerts** pour des notifications conviviales et esthétiques.

---

## Prérequis

Avant de lancer le projet, assurez-vous d’avoir installé :
- [Node.js](https://nodejs.org/) et npm (pour les fonctionnalités côté serveur et JavaScript).
- [MySQL](https://www.mysql.com/) ou un autre système de gestion de base de données relationnelles.
- Un environnement de développement tel que [Visual Studio Code](https://code.visualstudio.com/).

---

## Installation

1. Clonez ce dépôt :  
   ```bash
   git clone https://github.com/Youcode-Classe-E-2024-2025/Amine_Sabri_Manager
   ```
2. Accédez au répertoire du projet :  
   ```bash
   cd gestion-hopital
   ```
3. Installez les dépendances nécessaires :  
   ```bash
   npm install
   ```
4. Configurez votre base de données en remplissant le fichier `.env` avec vos informations :
   ```env
   DB_HOST=localhost
   DB_USER=root
   DB_PASSWORD=mot_de_passe
   DB_NAME=gestion_hopital
   ```
5. Lancez le projet :  
   ```bash
   npm start
   ```

---

## Technologies utilisées

- **Frontend** :
  - HTML5, CSS3, JavaScript (avec SweetAlert et modals).
- **Backend** :
  - php.
- **Base de données** :
  - Postgres avec requêtes SQL préparées.
- **Sécurité** :
  - bcrypt/argon2, validation des entrées, protection XSS et CSRF.

---

## Contributions

Les contributions sont les bienvenues ! Si vous souhaitez ajouter des fonctionnalités ou corriger des bogues, veuillez soumettre une **pull request**.

---

## Licence

Ce projet est sous licence **MIT**. Consultez le fichier [LICENSE](LICENSE) pour plus de détails.

## Modélisation :
    - Diagramme ERD basé sur le schéma fourni.
![image](https://github.com/user-attachments/assets/a0b08203-ca98-4531-a719-0c9afebdfea4)
    - Diagramme UML de cas d’utilisation.

    ![image](https://github.com/user-attachments/assets/7533e854-fb47-4d90-b5b9-3d1140392c30)





    
