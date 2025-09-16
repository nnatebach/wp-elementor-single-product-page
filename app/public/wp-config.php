<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * Localized language
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'local' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', 'root' );

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
define( 'AUTH_KEY',          '-^}@VQc|3}rKnHZb)~@fn<k+s! ]Cs5Jfb}bGmuA]fH.h,g6~I_Zq.hTD:L_}p4n' );
define( 'SECURE_AUTH_KEY',   'J5QT[e?:z9VEV tkLSE33BKhwEoY*IQSa x*l><z|,uhlzDx?<M%X6BQI?-d;.C-' );
define( 'LOGGED_IN_KEY',     ')6[,<&2+mX>&=h{|?vw&~(Dg@si@5%URNP0qqNnQ)Y5R}JT4O(8d29402?nBX,e6' );
define( 'NONCE_KEY',         '.(0b4Y!A%3x`uq>O60hR(B>h H@IqF6l{Z#a@D B_5q/&n{i=LesA)27?%6c#:Qe' );
define( 'AUTH_SALT',         ',ydEg}Py&ko=+1y)f%Z7|hxh> =``f|8<G[hca?cfF&l%c@feFwK~LoQ_jr*v<4$' );
define( 'SECURE_AUTH_SALT',  '!FltdOjuHl`7#T_=W:mE>rlULtC8mL}b!t+0NZm>jEBG$|S{PvAixWvLc6.JBxLo' );
define( 'LOGGED_IN_SALT',    '+#{Qj<dl9BuM7FLjA4A1-x1-^@M5RdUKLnK-e4p~J&QZzEd-+tIxrb3-sgqf4rF~' );
define( 'NONCE_SALT',        'a9kO&`wk!K<;@,:}5wGR4Ww>1+qqf41?7.b-gv?RD}.wBIO~aO8w*!$(n<NF? PW' );
define( 'WP_CACHE_KEY_SALT', 'b_cJ-rwwt7_8e_,x2X]a#`]cP<WPD^F}<hpY1zR=2.LG]<z2_LqUd<tIX/]Tfqa3' );


/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';


/* Add any custom values between this line and the "stop editing" line. */



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
if ( ! defined( 'WP_DEBUG' ) ) {
	define( 'WP_DEBUG', false );
}

define( 'WP_ENVIRONMENT_TYPE', 'local' );
/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
