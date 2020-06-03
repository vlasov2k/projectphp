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
define( 'DB_NAME', 'wordpress' );

/** MySQL database username */
define( 'DB_USER', 'wordpressuser' );

/** MySQL database password */
define( 'DB_PASSWORD', 'password' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

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
define( 'AUTH_KEY',         'qVD4quE/^Go}G5Q`!x1]~)4W&B!`,j%%ebGQoRX1.%}7zTANDXvmDNosNhJl.>6~' );
define( 'SECURE_AUTH_KEY',  'kPOI|Y,%NwLRmJJ_KFgcG!O(&$NEm|R=|l-RC`XJRP-K1PU%+c@af5D]tSdrHH+:' );
define( 'LOGGED_IN_KEY',    'K|^PZ=l]%4JS>So*Vq+}ySIrngFvt|r|8<;[^Vm6^zoD>:+sbl7+dg.Z41@p:4 4' );
define( 'NONCE_KEY',        'Wb/o|Suu}k;1N~c5|8ic}vo5oabYWjC|Fq5xzP>R/]-Ou@0A4+pDQ4?KvZ9EIBb!' );
define( 'AUTH_SALT',        '@CB-K2o2Ikr63i|kJm$JE5g-&pcmsnSdLVmjpt+9._^gWO71+:i:J-FOOQ191=#:' );
define( 'SECURE_AUTH_SALT', '/a`9^Q3A5u/V0F@+$MK&Lkv3GyF+ES6a_AVT|!|<!h~}*oieU=}-<T{=1VmwlV5Q' );
define( 'LOGGED_IN_SALT',   'a:-!<v+WM j@`H-9QehI-.EM,]f[S4><4_.V5`|A~i!0,%t:82w{^05~/<E+9(g~' );
define( 'NONCE_SALT',       'syd4G2J37q+x<;0[:XO+PD?`b.X*:J]NIefl91=Ftf|{:q6>D.tzsjB2+db.+[S{' );

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

define( 'FS_METHOD','direct' );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
