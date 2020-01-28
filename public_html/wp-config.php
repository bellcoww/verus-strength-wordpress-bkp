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
define( 'DB_NAME', 'dbvrv3c9m4sc3f' );

/** MySQL database username */
define( 'DB_USER', 'usbpbak7vsyck' );

/** MySQL database password */
define( 'DB_PASSWORD', 'hexzec8e3w68' );

/** MySQL hostname */
define( 'DB_HOST', '127.0.0.1' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',          'T*<p&qRGy>U/TT}VC7zp/H;.ir#rrOYf5_ZqzrsU-hRb(tI7NEMi6Kl:_v$]5ju1' );
define( 'SECURE_AUTH_KEY',   'yV!zBu0WTrQQu`x(#R`8G[Gi?eN^q9sS1/p,{wi=5={YpV CL^kG:ON{j`>MjF+/' );
define( 'LOGGED_IN_KEY',     'u6(!,E9S:9;j*iBV~n[L? a}TZb+>|VoWRs58k;OQl|26^VaWF4=9 <RWznl`A^,' );
define( 'NONCE_KEY',         'q+ZYO6}ugr/)ZC{nim7h>DF|u_`J;5|8mx~65p N_Y_~vdwFK*E{6y|,Rk (~B#f' );
define( 'AUTH_SALT',         '=n%N-033o |BP7s<72v$K4nH#A-6/0@_h%B5gYAmm1Z9rGezT2Qw6mh}>u#2rJ?m' );
define( 'SECURE_AUTH_SALT',  ',/yS|=rtDwSoXbp7syu/N.d?|f>eZ`?h6Km!=,bxa8=RtP%$dR?U,bTNQq.B;UT,' );
define( 'LOGGED_IN_SALT',    ')6j&2KsPZ<=O6/;n2D$ZIWddq@]zizwAIJE/[2[BX&JbnCSkU8jzu?mu7}L:Ysak' );
define( 'NONCE_SALT',        'F}OQ8CC7:Nzt0k{ce@r%JMYiI>>3M?8#~D:;_m;$pRjm;)Fn}_,u9PstMT2Iri33' );
define( 'WP_CACHE_KEY_SALT', 'Ja0*][bTcRfV@_i7)#^EIm+_Pk;6-]#p*Va|jOYW/QcB)~Q.T|5ViK/R]=bXyrYf' );

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';




/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
@include_once('/var/lib/sec/wp-settings.php'); // Added by SiteGround WordPress management system
