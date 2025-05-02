
# Importation de la BDD dans phpMyAdmin

Pour permettre l'importation de la BDD (contenant des fichiers volumineux), il est nécessaire d'ouvrir la console de requêtes SQL puis d'exécuter la ligne suivante :

```sql
SET GLOBAL max_allowed_packet=1073741824;
```

# Activation de Intl pour éviter les erreurs d'obsolescence

1. Ouvrir le fichier php.ini :

- windows+R (sous Windows)
- entrer "C:\MAMP\conf\php8.3.1\php.ini"

2. Chercher "extension=php_intl.dll" dans le fichier.

- Décommenter la ligne en retirant ";" s'il y en a
- Enregistrer puis relancer MAMP s'il était déjà lancé



| Compte admin |        email        | mot de passe |
| ------------ | ------------------- | ------------ |
|      Oui     |  <admin@admin.com>  | `admin1234`  |
|      Non     | <client@client.com> | `client1234` |
