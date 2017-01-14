<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, and ABSPATH. You can find more information by visiting
 * {@link https://codex.wordpress.org/Editing_wp-config.php Editing wp-config.php}
 * Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', '');

/** MySQL database username */
define('DB_USER', '');

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
define('AUTH_KEY',         '^-Z)49c63_K3iUN$jOE|A0[cUUsC67opreP>V),$AA<tGr4y;:Xm~e%||8%5e+m9');
define('SECURE_AUTH_KEY',  'G:-C4?-ch+D+m,x>k(YGCs$Geq:mDT%!A)M3h?`,kwGRmw<yjh,hL;!iZ&14576W');
define('LOGGED_IN_KEY',    'E:8&2xCN}>zT00t:4uKyA4vb}VmQ45T,IuBe84$F]{~# GwGjy,M;k~)+ncBM_EL');
define('NONCE_KEY',        ':=-H6&O5+?|X!5th-|gABab=jM+o0xAhC~UQC?UWErG+JJ]Z:Y|Mnd)PM4*XM!1v');
define('AUTH_SALT',        'U|Zyso{Jrr*06y.^1RU~IvrD#/:-B7qJS75R{C}2&CKq7p&:[Xfo}==r(`3;KhMg');
define('SECURE_AUTH_SALT', 'v@5ilAvC0LOm?4ej_+q+YXRxq+AgO6Z.b<n5 OHp-)qOBI%{-MJ+^TtD+@y^M|&`');
define('LOGGED_IN_SALT',   'mXWu1{4-kGm.0XB%.QI|`_cyb$~0kTzZ4pw3@U+`Rd>YLs6/5J$.f2W1/j37y>Cv');
define('NONCE_SALT',       '++E~0K#8C!@}_+!RE:Cba78AD>(*.s-|6h0bZ+Kd~eA~&X3dc~X+DpgvcPv13)|.');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'tbl4wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', true);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
