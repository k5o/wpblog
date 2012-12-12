<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, and ABSPATH. You can find more information
 * by visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */

if (isset($_SERVER["DATABASE_URL"])) {
 $db = parse_url($_SERVER["DATABASE_URL"]);
 define("DB_NAME", trim($db["path"],"/"));
 define("DB_USER", $db["user"]);
 define("DB_PASSWORD", $db["pass"]);
 define("DB_HOST", $db["host"]);
}
else {
 die("Your heroku DATABASE_URL does not appear to be correctly specified.");
}


/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'ic>o4P5}J)(qc.)=Z1x^LAt5<vqp[ITYz~ZsQ7*r2#T33dtb|:(L+EX:51JV%VoE');
define('SECURE_AUTH_KEY',  'AhMFhD Q7QntKh,=Rz%ND<!h)*+~8*SNWzl1Y/sd5|~JP$!R3G#|^+1E~]cwI7fy');
define('LOGGED_IN_KEY',    '-!aC2=<%OmX.))--%NE-zaPVQPqz#O}O+WOaO}Jf>x2V7cAkYu@[3fnv)u?I-|o7');
define('NONCE_KEY',        'lL(IUFsf;E82Pgh81E-Td`u+#=]E[{s!5jIX(pz1]W]9>WpI?g2woBuM8L6;f:Fl');
define('AUTH_SALT',        '98J>FexQ]Xq1E4uf6<F1v,zZ=~UsVW+wouU}4@-@/4&)l~|#e-?^[rT,|*p|8#@^');
define('SECURE_AUTH_SALT', ']* saRZ^h!)s0,};ka4J:x -|@?[FB8~;u*k+;s:S+I=(@k+,hi);w[X&7mf*}2u');
define('LOGGED_IN_SALT',   ')B+_;7O5QuCJIDaJ ?peg^kuCd,Zb~!^[-PKyUgBys-+vqnvmtwzf4<sPCq?rq8>');
define('NONCE_SALT',       '?XW/%yw1YyvfA>x h G|oozCa|&{GW(Fe?5@d7~0Jsa!5[J~_Ie]^-}tc{8swT-A');
define('WP_SITEURL', 'http://' . $_SERVER['SERVER_NAME'] );

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress. A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de_DE.mo to wp-content/languages and set WPLANG to 'de_DE' to enable German
 * language support.
 */
define('WPLANG', '');

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
