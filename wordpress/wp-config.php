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
define('DB_NAME', 'Base7Booking');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'root');

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
define('AUTH_KEY',         'gV.ioZ_ <5KR<]v=K*6utJK7>I3,b@YGlUf:s4xMEew&Yi0b@ktAadB6_DkAxThC');
define('SECURE_AUTH_KEY',  '<R_pXn!9Cq KfQ!h}0E5ge&+;5Ky9a(GA=!oWod`_^FZ{Li+ifA@r|U*z*(X]7zm');
define('LOGGED_IN_KEY',    'Kvh#1gjfX[!g#X8YW_hPUe3F;a @c:clLK(*]94i$/k|ux?.vXn9dc_Q,c(_N@fb');
define('NONCE_KEY',        'UY85(6K8/upvB*6VB2R``F8fg[FZ6E2F0fVB}WBJqp3fSweDIS*E/ uM tt$BwNr');
define('AUTH_SALT',        'Wdca1,?Yozl_Ev$!sZ/;R>;nnaq=nK~SsNsVGn8%0`)bKBI/j&ZM*eM.kuuEDUyl');
define('SECURE_AUTH_SALT', 'mv(qJ}4ne[F}JRbY[,1[2[h$@qc8;!>[UQXJm-to{jSWSl89%[.*/$f*)NEJ4%f3');
define('LOGGED_IN_SALT',   'QCDexa,k9wy21/=S,ye(o>W;e+m=p]=|1IWIuUh{K[B_;l[*p`F{VK`7%?[#Tz#:');
define('NONCE_SALT',       '~@q@skuLAPm7=yi+uO&?I*l4zb?^2S;duVGdhJ.NxHTODQ3<Apv(z^Y4Om)JC2}U');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'b7_';

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
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
