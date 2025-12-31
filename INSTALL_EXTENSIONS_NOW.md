# Installation des Extensions PDO - Commandes à exécuter

## ✅ Diagnostic

D'après votre sortie, **PDO et pdo_mysql sont ABSENTS**. Vous avez :
- ✅ `mysqli` (présent)
- ✅ `mysqlnd` (présent)
- ❌ `pdo` (MANQUANT)
- ❌ `pdo_mysql` (MANQUANT)

## 🔧 Installation

Exécutez ces commandes **dans l'ordre** :

### 1. Installer PDO et pdo_mysql

```bash
yum install alt-php82-php-pdo alt-php82-php-pdo_mysql
```

### 2. Installer les autres extensions requises (si manquantes)

```bash
yum install alt-php82-php-mbstring alt-php82-php-openssl alt-php82-php-json alt-php82-php-curl alt-php82-php-xml alt-php82-php-fileinfo alt-php82-php-tokenizer alt-php82-php-ctype
```

### 3. Vérifier l'installation

```bash
# Vérifier PDO
/opt/alt/php82/usr/bin/php -m | grep -i pdo

# Vérifier pdo_mysql
/opt/alt/php82/usr/bin/php -m | grep -i mysql

# Test complet
/opt/alt/php82/usr/bin/php -r "echo class_exists('PDO') ? 'PDO OK ✅' : 'PDO MANQUANT ❌'; echo PHP_EOL;"
/opt/alt/php82/usr/bin/php -r "if(class_exists('PDO')) { print_r(PDO::getAvailableDrivers()); } else { echo 'PDO non disponible'; }"
```

## 📋 Résultat attendu

Après installation, vous devriez voir :

```
pdo
pdo_mysql
```

Dans la liste des modules PHP.

## ⚠️ Si vous n'avez pas les droits root

Si la commande `yum install` échoue avec "Permission denied", vous devez :

1. **Contacter votre administrateur système** ou
2. **Ouvrir un ticket support** avec ce message :

```
Bonjour,

Je dois installer les extensions PHP suivantes pour PHP 8.2 :
- alt-php82-php-pdo
- alt-php82-php-pdo_mysql

Le domaine concerné est : gestionv3.partenairesmtn.ci

Merci d'avance.
```

## 🔄 Redémarrer les services (si vous avez les droits)

Après installation, redémarrez PHP-FPM :

```bash
# Redémarrer PHP-FPM pour PHP 8.2
service alt-php82-php-fpm restart

# Ou redémarrer Apache
service httpd restart
```

## ✅ Vérification finale

Exécutez cette commande pour voir toutes les extensions :

```bash
/opt/alt/php82/usr/bin/php -m | sort
```

Vous devriez maintenant voir `pdo` et `pdo_mysql` dans la liste.

