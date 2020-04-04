<?php
/**
 * La configuration de base de votre installation WordPress.
 *
 * Ce fichier contient les réglages de configuration suivants : réglages MySQL,
 * préfixe de table, clés secrètes, langue utilisée, et ABSPATH.
 * Vous pouvez en savoir plus à leur sujet en allant sur
 * {@link http://codex.wordpress.org/fr:Modifier_wp-config.php Modifier
 * wp-config.php}. C’est votre hébergeur qui doit vous donner vos
 * codes MySQL.
 *
 * Ce fichier est utilisé par le script de création de wp-config.php pendant
 * le processus d’installation. Vous n’avez pas à utiliser le site web, vous
 * pouvez simplement renommer ce fichier en "wp-config.php" et remplir les
 * valeurs.
 *
 * @package WordPress
 */

// ** Réglages MySQL - Votre hébergeur doit vous fournir ces informations. ** //
/** Nom de la base de données de WordPress. */
define( 'DB_NAME', 'chaletsetcaviar' );

/** Utilisateur de la base de données MySQL. */
define( 'DB_USER', 'root' );

/** Mot de passe de la base de données MySQL. */
define( 'DB_PASSWORD', '' );

/** Adresse de l’hébergement MySQL. */
define( 'DB_HOST', 'localhost' );

/** Jeu de caractères à utiliser par la base de données lors de la création des tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** Type de collation de la base de données.
  * N’y touchez que si vous savez ce que vous faites.
  */
define('DB_COLLATE', '');

/**#@+
 * Clés uniques d’authentification et salage.
 *
 * Remplacez les valeurs par défaut par des phrases uniques !
 * Vous pouvez générer des phrases aléatoires en utilisant
 * {@link https://api.wordpress.org/secret-key/1.1/salt/ le service de clefs secrètes de WordPress.org}.
 * Vous pouvez modifier ces phrases à n’importe quel moment, afin d’invalider tous les cookies existants.
 * Cela forcera également tous les utilisateurs à se reconnecter.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'eR!ockw @v|E.-i4*XdW7Vsww(jz}Z24[R^Xe_UR6[u^Z!& 0X4lR=SyD`dQ )X{' );
define('WP_MEMORY_LIMIT', '128M'); 
define( 'SECURE_AUTH_KEY',  '%<b Z@CQxz1xJV5+L$]xQc/L([EP2_}gE]VRIom|t^z$Qdr#^_K<=$) U+gE5y{,' );
define( 'LOGGED_IN_KEY',    'JO/4hZ@2f}Wpr7i_}#_zWxM=c/5H?@[U%DM!1^kT;%%c,`u3u@WF(%zd3=HCR@s ' );
define( 'NONCE_KEY',        'eG&!V_[mA3yP_fcvukj7)UHo,m]>Z[8iT7JG?~pqsX-$cuE8t2N]|jkZAq-=$G9z' );
define( 'AUTH_SALT',        'eGi5yI^GPpOok5rBJt%,L) B/xVw1/k7|eo]DGbgFZ8A+,<Zye/!,UHD]kurSBbm' );
define( 'SECURE_AUTH_SALT', '5pqQJbSLEQS:[&(rZ:$N&K}9Ew$W+[^e{renW0FW[I,I$)i*/BcqB]DK[dA[*42k' );
define( 'LOGGED_IN_SALT',   'D)RF1^!)KZp_S6MH#hS*Rlg$n]:[UZprK=d{T_~D]khug>}M(qoe6yw#yo!e,*G-' );
define( 'NONCE_SALT',       'X00X{ex@&ej:$o{&+^tBQ+C-Fj;Kqq:!(Lhl8o(^IkQF6Q..F2V(GvX[x8!Pom*Q' );
/**#@-*/

/**
 * Préfixe de base de données pour les tables de WordPress.
 *
 * Vous pouvez installer plusieurs WordPress sur une seule base de données
 * si vous leur donnez chacune un préfixe unique.
 * N’utilisez que des chiffres, des lettres non-accentuées, et des caractères soulignés !
 */
$table_prefix = 'wp_';

/**
 * Pour les développeurs : le mode déboguage de WordPress.
 *
 * En passant la valeur suivante à "true", vous activez l’affichage des
 * notifications d’erreurs pendant vos essais.
 * Il est fortemment recommandé que les développeurs d’extensions et
 * de thèmes se servent de WP_DEBUG dans leur environnement de
 * développement.
 *
 * Pour plus d’information sur les autres constantes qui peuvent être utilisées
 * pour le déboguage, rendez-vous sur le Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* C’est tout, ne touchez pas à ce qui suit ! Bonne publication. */

/** Chemin absolu vers le dossier de WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Réglage des variables de WordPress et de ses fichiers inclus. */
require_once(ABSPATH . 'wp-settings.php');
