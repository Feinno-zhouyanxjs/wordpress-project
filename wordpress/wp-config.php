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
define('AUTH_KEY',         'TZ7bQco_YbDoDv^b7R`BAH+;-tKF4j8~C-1@$@ocv%SN{@XbU3!1Bul?]Zla@+UY');
define('SECURE_AUTH_KEY',  '[85U6+1;),[HW<|20Oy-Bq7Ud>Qbwo d|YOkic2<~)hu#H5S,8Y9r0nbkL<|j^DB');
define('LOGGED_IN_KEY',    '5-i5ltB|G5}kPz+Qb;j/~f}2@oZJ+xS){GykZi-r5ki}|I$)kM*3$ p7Yb|6X{&e');
define('NONCE_KEY',        ' -W+M|Kdw]<J-G*4+jYha8n(4 7TkX&2_ ZXi5`kW&Bd2+z_8IV7j3a{1s)/8=54');
define('AUTH_SALT',        'XLc_I$NlSE<]z6{+[`g6C+L=QI, -h5+/~s4~}|S|:tH%mW4:o?,P]i#|I8O:dX[');
define('SECURE_AUTH_SALT', '6u3aAT(vNJA`--<,+`(nD+NfI?4JeX@Z6Msvs~]Mfbc0x,!,BqX9uJ?I8Q P `-n');
define('LOGGED_IN_SALT',   'n82H2D!/jQBf<S-O$FM_ /mZ3Mjypc@a<Sq&2x`WqMvQhYvO<{>^9cWh+Cb-&4-^');
define('NONCE_SALT',       'm8YifFo`Ci6i{lRBCOqU8:85]3UK/ ;X3;c4_:AM8c`*pPhNZbg0-O|EFS9,dFP9');

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
