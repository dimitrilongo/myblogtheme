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
define('DB_NAME', 'myblogtheme');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'root');

/** MySQL hostname */
define('DB_HOST', 'localhost');

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
define('AUTH_KEY',         'uyL=u Gh24SzCwgm*Y>X|L{Sn6&6A:-~o-d!VZm<ku!~/N1SV]Z0L?$PdoI&yJ#[');
define('SECURE_AUTH_KEY',  '}MQF--TcqwOeFgMVey.s A+v4jPbq>I8xGYGbP@[$wZ[hlG5q|lfn1(Y?,}p#=MG');
define('LOGGED_IN_KEY',    '[e]+GLN CloN.q@#@}vX~;wTKW+^jNt}BX8D$Kwqi^lH./+~ZUEtu+S<,]+]5m6Z');
define('NONCE_KEY',        'bs4+N6S,hv!1e[]fJt-Q#|+z/f&H8-BOQ%2o)$n}-s=1HDS9:q=tGC#Qf<kc)+4Z');
define('AUTH_SALT',        '|g:lj:Toxrj64tc+aysLk$9d{NN=PN.a-p8OZ+Q[V~-^-5Il9}J}5~fzGm-~|<hS');
define('SECURE_AUTH_SALT', 'V{cg6ZJW[)21$JVxAKbCc#2!!kYMW2i>f~-0fE!V=B:EhUaT[LJ+^{QF:h<C|%H%');
define('LOGGED_IN_SALT',   ']1+1QN6 vrEhjxRQB<2&^skkFj;;y]y&3?[t(I8tu&?|rbiXW1[qY;4/Bh#hB*P~');
define('NONCE_SALT',       'X)II9F/52F|3X;<:>&z}+ht:H3v]E>v xwx5Cg6h$h^@t`blsm8ZwY{%T4-P-a-#');

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
