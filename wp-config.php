<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the website, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'wordpress' );

/** Database username */
define( 'DB_USER', 'hudaring' );

/** Database password */
define( 'DB_PASSWORD', ']]qUM+xtFv5M].3t' );

/** Database hostname */
define( 'DB_HOST', ':/cloudsql/gcp-project-250430:asia-southeast1:hudaring' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

define('WP_HOME', 'https://hadith.hudaring.com');
define('WP_SITEURL', 'https://hadith.hudaring.com');

// Trust Cloud Run's HTTPS forwarding
if (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https') {
    $_SERVER['HTTPS'] = 'on';
}

/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'urBIJr[/D^Qu;ktozDBi&C4]0/}+=1i4)-Rzu$Qm[/3Exr7X_85y?3KgImygSp}*');
define('SECURE_AUTH_KEY',  ';8c#b{S~*F60/wkZAg,9l+cN:y$WR)z$kh[7clr&<B{A-ZC=Sy<K;J!$cJlBtiZ;');
define('LOGGED_IN_KEY',    '0T3HfFG_+-*_QH=|RW)Tsv||+WE@-%++9!=x-U(&|yB)vhUI?7]jB|JK@GRE6oA~');
define('NONCE_KEY',        'a:A,,V8JMkg*-||-G_k|.2~*1]Ciky%PL?jHH{958+CHkcGQsl?-i:-$c!nT+x).');
define('AUTH_SALT',        '(S6x*{gOj=4)@t~%Icy9/N|9aG#R`g<|Neau7-6?}VuZ(w^X*sD8?A%q*%up[@te');
define('SECURE_AUTH_SALT', '!EUi:FQ+0db;/;tAS=9>>o`^Vb=7|T//Qus.IdPD?aN|vDB=|ScU).^sWyj3&0-@');
define('LOGGED_IN_SALT',   '}*6&X=VcJyanLe}o#vFJL/a38Ibad|@gtRNVl}C!wc2X+@>yX(W^N}U(+g`|^IRz');
define('NONCE_SALT',       '|{W<DeBCy8wp(d4L2Dr+6!/MPHmAnce*s|Co=oqPJg4 E9`;nyW[B- cruY|6K`9');

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 *
 * At the installation time, database tables are created with the specified prefix.
 * Changing this value after WordPress is installed will make your site think
 * it has not been installed.
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/#table-prefix
 */
$table_prefix = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the documentation.
 *
 * @link https://developer.wordpress.org/advanced-administration/debug/debug-wordpress/
 */
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
