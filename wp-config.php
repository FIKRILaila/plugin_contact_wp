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
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'plugin_contact_wp' );

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
define( 'AUTH_KEY',         '5.]zs1#DuC$0{v#xpKFABD9 oH d<pd[<ld5#h(9L!v*,F-`n8fBxKs4{aFQ3z1u' );
define( 'SECURE_AUTH_KEY',  '>H&UKnK@6fQJ6WO*Nkj)%xaj`%kJOQ<`M=^V8&A>%_FJST~2#mOvQ7Lq3{f,xnLG' );
define( 'LOGGED_IN_KEY',    '|iI#y.UYWHj*}tHo <>a)sTkyFn[0fWwNNzr}mB=zv4]O&[8xRVKs`kz*94} lB>' );
define( 'NONCE_KEY',        '5-gR&6Etmrq>i~{v%S{M[hV59@@@e$?ef_OCCf{VDtHHRu2Sg]J`QKUwY,d#G%]D' );
define( 'AUTH_SALT',        '0Fia36:ZNvYb-ph[)|B^nQq.c~|oz_rj5v7ddgD5VmhJ}8`:2P8a3nc#?2jSt!<!' );
define( 'SECURE_AUTH_SALT', '6`hJ(KtX=H8h3@9:d4)r9oYg)l}[=u9{[=_vg)Fj|tFPMq~ }^CagNO}&&);,S&M' );
define( 'LOGGED_IN_SALT',   '.Ob|(Ko}Y+b/H0R&e3@uw-2%;r/ugTj%5S6`I8H=i[^ O-L-7vB a>#6Qr(T6n?z' );
define( 'NONCE_SALT',       'B**Dgq^jjLv`&6K];A[aaS.IE{XA/x&Q.V<@zFB-%eUr(B)ke(_nSWf1ljh#*%2e' );

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
 * visit the documentation.
 *
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
