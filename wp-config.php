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
define('DB_NAME', '546986_wp');

/** MySQL database username */
define('DB_USER', '546986_wp');

/** MySQL database password */
define('DB_PASSWORD', 'Zzangna18');

/** MySQL hostname */
define('DB_HOST', 'mysql50-73.wc2.dfw1.stabletransit.com');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

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
define('AUTH_KEY',         'wqw[+j^>L|RP^F 5yb ..3B/j|7G@%g*W$XaQ`!{e;l><{RaL}uRve5_=:gg.+(-');
define('SECURE_AUTH_KEY',  '3]h>9mQAi}H(,_#2<BS;?H[UUxJu>5Yrc4FOI{cv7 +1dw&oqD7Dz6/Y4MHs_0ZB');
define('LOGGED_IN_KEY',    '!1@C3h(sB=m)iEo67?rb[ $0NAv=}7qM`)G[E8F7>|CVf5V}P-==D5 -w%7bu]7d');
define('NONCE_KEY',        'CU%@+7^&gR]l~TPk54$o.`!+8KI#*UrRL{4u$@m_Ye|s[a&vO/^)(:bT8+7t7xO4');
define('AUTH_SALT',        '=.<bAm}wgtYSIa-A)?8*RhM-V]+o.`9Y,-*LyBZ,SR%sT:Va!4S)qO`tFKgjlJ;n');
define('SECURE_AUTH_SALT', 'RKh8qV&!+>3hdz#=0uhvOBx$| m++$f|dy6r]Uky0{O5#?{4@Xz,!lkdPs{viInO');
define('LOGGED_IN_SALT',   'zQ% X|2q[&YD9XLk{;TUYlV73=x)VeKEgxoB^evkRF`Z+FXVq_<023Yk2g5&pY#|');
define('NONCE_SALT',       '`}S[%F?/19GxIVxyl,{|8T7B1RB:o ;b=XR5`c%Rx* .,^e<L$Qt_zuarC?N@L~D');
define('WP_HOME','http://kokev.in/blog');
define('WP_SITEURL','http://kokev.in/blog');

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
 * Change this to localize WordPress.  A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de.mo to wp-content/languages and set WPLANG to 'de' to enable German
 * language support.
 */
define ('WPLANG', '');

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
