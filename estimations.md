# Mise en place architecture

*NOTE : symfony + dépendances + configuration...*

- installation : ~0.5j

# Header - Footer

- header/footer : ~1.5j
  - intégration
  - gestion des cookies
  - Mentions légales
  - Politique de protection des données

# Connection

## FranceConnect

*NOTE : Utilisation `thephpleague/oauth2-client` (https://github.com/thephpleague/oauth2-client)*

- analyse/test/mise en place : ~3j

## Compte

- Créer un compte + Connection : ~1.5j
  - création du compte
  - envoie email avec lien d'activation
- Mot de passe oublié : ~0.5j
- Synchro avec FranceConnect (mécanique à préciser) => nouvelle estimation à prévoir

# Page d'accueil

- Liste des demandes (historique) : ~0.5j
- Consultation/suppresion demande : ~0.5j

# Intégration formulaire

## Pré-requis

- FormKit (CSS, templates) : ~2j
- Upload `https://uppy.io/` : ~2.5j
- Validation JS (reprendre HM CCI) : ~1j

## Etapes

- étape 1 : ~1.5j
- étapes 2-3 : ~0.5j
- étape 4 : ~1.5j
- étape 5 : ~0.5j
- étapes 6-7 : ~0.5j

# Suivi des demandes

*NOTE : Utilisation `nodevo\grid-bundle`*

- liste des demandes : ~0.5j
- workflow : ~1j
- gestion de la GED ? appels API ? => nouvelle estimation à prévoir

# Gestion des utilisateurs

*NOTE : Utilisation `nodevo\grid-bundle`*

QUID de la gestion des utilisateurs entre les comptes `Symfony` et les comptes `FranceConnect`

- liste des utilisateurs + CRUD : ~0.5j

# Gestion des médicaments

*NOTE : import du ficher `https://base-donnees-publique.medicaments.gouv.fr/telechargement.php?fichier=CIS_bdpm.txt`*

- commande Symfony pour parser le fichier et mettre à jour la table des médicaments : ~1j
