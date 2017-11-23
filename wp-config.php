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
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'wordpressdb');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '123sqwert');

/** MySQL hostname */
define('DB_HOST', 'db');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         ')5a/nXV#ce~wQ@);[hDs#g>_o<cuVEZ;tP>G{?kb?OHtB0R%-haDdMo:`9f~xfgq');
define('SECURE_AUTH_KEY',  '(=5DkK#jY-8S;/5@cPXoqjN65RvV#d=!-NK[F[Ap#1KhXM7&pa_#_HT7!)*Bpywj');
define('LOGGED_IN_KEY',    '@wqY3#.|y@FjAO^zv5>5]R1x<<O~GV@f$E~rT$[iceT`DdZkCvxN]hoGtM?aJd 3');
define('NONCE_KEY',        'Cy}/]h~L,RM@T%}ZhdJ>@R>OY/g3;I~A>]u)zc &rkx+fXN~WoAj|MiK54%ui8nE');
define('AUTH_SALT',        'C%fjlvm ju`etfmLqN)6`bRf_6UIDSAFV-yNbEqI8;X$g{;2@3=I~Ut`L|R`~1QS');
define('SECURE_AUTH_SALT', 'uc*o;Z1tMs{qPDYy]6f~y97oK@F)Uj nAp3}(*heXapE;(CPKp}<c<i}UhdG<l#L');
define('LOGGED_IN_SALT',   '&#]V,gOLzSH.-&{g7I;t9h-8FH&ciMjA>j3SU[oh=D06i:Bp3#U_Uuh(6yW/!t@&');
define('NONCE_SALT',       'cvqj-P-fY|Ldzrq9BEOkA%kv7WO_`f**v/O^T+UvJZhyB+;dD8R`a|O.F52:B#|B');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
