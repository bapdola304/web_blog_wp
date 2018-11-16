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
define( 'DB_NAME', 'tintuc' );

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
define( 'AUTH_KEY',         ':3yy(,kl~:+0<`_^1[6}yCY!=,%x])|Ujq2#>8zkk[;FvI;m+v4YNUYxg;h0.U32' );
define( 'SECURE_AUTH_KEY',  'ur?1rCL;:SWDUI~[=:d[>}[k(E]UA@xRyLA#J;prIlf4!a)]r4PH[6r8LV*M&(X}' );
define( 'LOGGED_IN_KEY',    'y?Ctyc!r;<+G:hx)fqTQKDU>j8:N*`}TR ;{fOv9?cKnY4_sR[]zdiuFz0n5taee' );
define( 'NONCE_KEY',        'yC??Ku=^)MlkS,xf$|w#z,|q.e< m8&/Dmm39:!,U$KmoPF}*#+RpZMt`?gsbN69' );
define( 'AUTH_SALT',        'JsAs{2)?a*1-Nn$npy_({6WbbAH4#*S[4[)|z%(n!-Pb:[wg<FV6[}tn97I),ZGz' );
define( 'SECURE_AUTH_SALT', 'JVnp>X,iZ{II,TU4r{3BcgF7cs>gi5PhTU4UzP/S`?DWEYN/LU.9znG`Z_d u[Bl' );
define( 'LOGGED_IN_SALT',   '4)`JaKPEI)*FQV[f><7{Q_g[)QkMoPU|Xe6@6qw%@{5otTA>s@%<N&BL]<zyvJ,G' );
define( 'NONCE_SALT',       'xx*j2X!RKx!w@^Br3)w5V-*6tn/}S;8jg,k]Bln&o:RL-:h12};!})o]B> : kT?' );

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

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once( ABSPATH . 'wp-settings.php' );
