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
define( 'DB_NAME', 'database_name_here' );

/** Database username */
define( 'DB_USER', 'username_here' );

/** Database password */
define( 'DB_PASSWORD', 'password_here' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

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
define('AUTH_KEY',         'Wf`,jGxxw5~.-Nkkk*m0R==(dk3B-Lk|J,su+1.q3j~,aRm|hv~B7::b(JaAqt<_');
define('SECURE_AUTH_KEY',  '/FRXD~Lq{/0~C;*5mWf+;fytpk6+=<[!?CE}w-JPSrMgu U3~=9h,^Yco|FJOU|:');
define('LOGGED_IN_KEY',    '+ynnTx$?1f&]J# Zc(!SWujodrUUa2TUI9QO2-~vzSZjQOvK?5}$M;=av9JSWT0u');
define('NONCE_KEY',        '?(UyXAaUsj Ig;&riJwrmC~+/Z&[oZdnA{bJeO58@Bm^5Hr=k/!|pVzc%Hfzi(-}');
define('AUTH_SALT',        'yw9eaeVK&$$D3];: mYd-.tn)}(fJr cFFQ?o&B+ST,(P-{r,Mgrnd|q)f)g# Wt');
define('SECURE_AUTH_SALT', 'L&|U3]t$*s>K1Bi~oP:mR[wmm0#rnO W?*&V.qM}QaidS=T !WpE5zB{UnBBW%|a');
define('LOGGED_IN_SALT',   'bKp.Xke5.|@zO`ZPbZOui~S>I~-N{8aa0[%v8Fju(E7UXl=pMeh$,:|U=b`UI*zP');
define('NONCE_SALT',       ';1hcnOFh<t!OI_l=/gf`KGjEg(O4qR-o>!3+^9U$T,+ %Mm@ZvPHl@u,s%4xpr!u');

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
define( 'WP_AUTO_UPDATE_CORE', false );


/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
