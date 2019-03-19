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
define( 'DB_NAME', 'wordpress' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', 'abcd1234' );

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
define( 'AUTH_KEY',         '!{4HFogy?k{]q&`D[vdGP9Qb<pL`HuH vX%hnrQAu4%+ d2!l0eG7x7n6{Ro9xWW' );
define( 'SECURE_AUTH_KEY',  'DC%/WIMjLJ#7<&frvh(Z)O4Ke!7VV3PL7)mu&7k,K}=yPbRC%3+:cgiD#yk#yAlA' );
define( 'LOGGED_IN_KEY',    'kc1:)CBA5h1rgCo36<0qs65pV0L]rlXD 1A;HNhX:!<!:8>Q<*vLzhko;!@G5ymB' );
define( 'NONCE_KEY',        'mNtQSd;-Ywg5Bs#V/z 0LK>9bw`@$X+ks]2@Fr2$BT&)t!u!i&ISzGGFZy[}F%$[' );
define( 'AUTH_SALT',        '=!)[BGsU3]yN~%_b@eM_5PjSR^;]DbPy-.0X&Kga(0< xnPo:m%W*=:|<~INi7/]' );
define( 'SECURE_AUTH_SALT', ']MYdMj-o}$x@1HKb|wJu)QaAP@bgKU5 ju& g*ZV`pG.5}V<b)r0B[R|!xADh$s~' );
define( 'LOGGED_IN_SALT',   'F-6GW.08l5/Vp^cV&]?@:[*k}/0Uy3<o4Q,irHk@E#&zRi=h;WL,%aX{0WuqVki_' );
define( 'NONCE_SALT',       '2~B<r8L#k&0UF~I `Tx5t*ITNcxoR3-^craGT+;iTUSr[SGMpTJW}m7?a6u%<J!M' );

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
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once( ABSPATH . 'wp-settings.php' );
