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
define('DB_NAME', 'red_sand_project');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

/** MySQL hostname */
define('DB_HOST', 'localhost');

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
define('AUTH_KEY',         'Y`S%>qN?eNpg[F]Q[D/w|Cf!g6eskJuWPP(gkwp^Y-T.m:}qY=||;JhR.5P$q4W6');
define('SECURE_AUTH_KEY',  'Je7|Gc1G<N7-67dt(n%)W)bH;fawq/v9xiuM-idMa.OF+~0o+_0bOc.#d0cg.3{J');
define('LOGGED_IN_KEY',    '1sA%#h))`/V69r6=Ge_G$+^WDu$95q6QUPeD^5{ySA>sd|arD[_`*m$wst1sw-!Y');
define('NONCE_KEY',        '=b ow)+`y{a;M;: k7h!_/7_-~OkcC(}m:IB7BKFMs/tb;G8zeJ]^K(b,ZfE4kiH');
define('AUTH_SALT',        'IZT$r6.Koz5[t&g|VNDFFs 8[dm#4s.VOwN|fSUNC!L}_!ujP_J%)h|0 tJ4o],C');
define('SECURE_AUTH_SALT', 'G0}NXt64)~v:7P(mva*F.CN?%K}(Fpn#K KI?q}H`gKIqNHeW?ug[`Hq~IbQd+@0');
define('LOGGED_IN_SALT',   '2ZRTl#9NX>~s4>#Z*AMfFwBAoCuqCA~gl>EuS#f2<)Uf6j?EZvGtNWtX*R=XCOj_');
define('NONCE_SALT',       'GFy8u|kU.iY ^Eg^u=}F=e^syH^JC  1ni@ZaaKlE:hEBKgh b,{%r4!F~o}[ov1');

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
