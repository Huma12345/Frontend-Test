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
define( 'DB_NAME', 'coding-test' );

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
define( 'AUTH_KEY',         'Kq t`i18 zL@KW}9{n4xw>tt=Y:R>eWYX],Eo)AOfcayo$954|wPvpArtIS%Kzyl' );
define( 'SECURE_AUTH_KEY',  'FEy39A9Q7!8z<zWSX{x9{gc^ax4}h%q`|%lS&UBN%0Us:rldOE&A#q?nml^YL+,J' );
define( 'LOGGED_IN_KEY',    'WK)x0^r5O8sZt4I?QED@g16,7LghnyLP&Xl6.F3=.enFil/-: %KsU K@bJ#/5;u' );
define( 'NONCE_KEY',        'Hbmt;jph?V8agYK&P[SsU6nm<eGnwc nT[}{eqy2XxNm) )p pdgN4&>q8(ei`V%' );
define( 'AUTH_SALT',        '2CW$6R{mCD2FcjG^W$&#Eo<8#Rei33B*N63rN|GuRlnjuFRv/5BHMSW.Ds8eWBuC' );
define( 'SECURE_AUTH_SALT', '5PoqIk}re*XK=tnAxu!.BgBq*84)t.=A2Z9s*9dJ;IF{PH]hlbL/RU0piM2FYLJc' );
define( 'LOGGED_IN_SALT',   'UcyHym}^(k`_knIx:.+cswijM_=8};,hS)=WwuZpcCJ9Q(mD0uIE{2d4hA(:{$9;' );
define( 'NONCE_SALT',       '^m;Q/|_^nQ5I1pYg?>n}}6YQ%&7S+?tQ|%~buU6.rj2F%!pLGzb&KJ-cr9&DUN!A' );

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
