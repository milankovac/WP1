<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'wp1' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         '{EKPQG()Btp>e*~ 8N(&&wR? a5D7ul!ehqIeTqK7k-%s.}UU%F1, _qPkj*uDq-' );
define( 'SECURE_AUTH_KEY',  ']l4ZZ8gRk4GWO bVkU}6YoaEl|Ni=@:$rhz%Q$Jx*AtVXUqGhv*K]edN2eJ-HAji' );
define( 'LOGGED_IN_KEY',    'ao<azv*G%XFFvH8Uv2MXUahOg|(>L&BYCoW2TF)Y*[CbkjaB7u1Hn$ mRY=SEn{v' );
define( 'NONCE_KEY',        '*?Ra0i7$:[zF_ 8&[KGhuqzv~)a?rxd47f8qgvOTv59F}!*P2w(P+.ZGtL>Q$BKg' );
define( 'AUTH_SALT',        '@:^g%^Jt2.;zBA$&E%jE3w_]^rBsafIF(=#Nn]9&!*n;<p(8f1*OW`3tx;Pzy^EU' );
define( 'SECURE_AUTH_SALT', '/::B:MfXLhv=$D{p*%nb}h[q @ZR;g9/-<^<i d|2lR2jg$xAyDKMh?}*Df-g})0' );
define( 'LOGGED_IN_SALT',   'i#(:0svl5)z5[g02<(BTQ:BSgnYMz>lyc$@:`K@`Dr.HypF&@tU?i6t^0Q4:x7)0' );
define( 'NONCE_SALT',       'a5J?0jo|5>4odT]!.>b+Da5;4N%_J`|<I;;.n)!gru{d(3Hc*xqXQ(!Ic/R{]`?K' );

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
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
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );
define('ALTERNATE_WP_CRON', true);
define('DISABLE_WP_CRON', false);
/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
