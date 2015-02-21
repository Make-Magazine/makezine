<?php
# Database Configuration
define( 'DB_NAME', 'wpe_makezine' );
define( 'DB_USER', 'projects' );
define( 'DB_PASSWORD', 'projects' );
define( 'DB_HOST', 'localhost' );
define( 'DB_HOST_SLAVE', '127.0.0.1' );
define('DB_CHARSET', 'utf8');
define('DB_COLLATE', 'utf8_unicode_ci');
$table_prefix = 'wp_';

# Security Salts, Keys, Etc
define('AUTH_KEY',         'lJ2H!:s|hkX-0&i9%Ehi-bdt,G!E.j. 9:{!S0FYp9{Gp*8IlD0 @=bm!M&PWFmI');
define('SECURE_AUTH_KEY',  ' kVFf&NlfymWSQvpeNU|sn1r]FruIsYkC{DbN|TXdZ-o+$[-X/}D3fl`(,p,jXyj');
define('LOGGED_IN_KEY',    '8:z?XR.aO|-^+u(A?}|5uENdu,tw}q+9z/0teTe-=(gO|U}a_P[y|X0$,o,V)7nf');
define('NONCE_KEY',        '#G-t7Ep_Q~WeG(.%h4Ix-)*2{BH].b|+oiDRSuY8*J0fg.sMV:}hl=l&C-6.tFE ');
define('AUTH_SALT',        '1Uo]2+X0Z:)Z>2x^/[3xT^>a*.3&ykb0<_!DZ4#F!GayuyIc,Vt;HqU `5MgBSVc');
define('SECURE_AUTH_SALT', '9TU9@`Dv&21:W RtHDunZ--48LDPLxG`>h_U}!-&,-MfjoA#/|@[YvGjkt|zZJ3m');
define('LOGGED_IN_SALT',   'e:Db^G+EaO`EC9Im$A+kIy!M001Yr||}Vpc}=X3(-9}Xq</JikE-Y9z-q$e~3X^|');
define('NONCE_SALT',       '|!.]]&rt8._xD!Ldfh4Q8EM)lVSbg,I*IWlp&jT%BxXrhOx</]os]F&C7M>Jt3=q');


# Localized Language Stuff

define('WP_DEBUG', true);

define( 'WP_CACHE', TRUE );

define( 'WP_AUTO_UPDATE_CORE', false );

define( 'PWP_NAME', 'makezine' );

define( 'FS_METHOD', 'direct' );

define( 'FS_CHMOD_DIR', 0775 );

define( 'FS_CHMOD_FILE', 0664 );

define( 'PWP_ROOT_DIR', '/nas/wp' );

define( 'WPE_APIKEY', 'b610dcc950c477cb23c6972dd3a313af9315dd8f' );

define( 'WPE_FOOTER_HTML', "" );

define( 'WPE_CLUSTER_ID', '272' );

define( 'WPE_CLUSTER_TYPE', 'utility' );

define( 'WPE_ISP', false );

define( 'WPE_BPOD', false );

define( 'WPE_RO_FILESYSTEM', true );

define( 'WPE_LARGEFS_BUCKET', 'make-cdn' );

define( 'WPE_SFTP_PORT', 22 );

define( 'WPE_CDN_DISABLE_ALLOWED', false );

define( 'DISALLOW_FILE_EDIT', TRUE );

define( 'DISALLOW_FILE_MODS', TRUE );

define( 'DISABLE_WP_CRON', false );

define( 'WPE_FORCE_SSL_LOGIN', false );

define( 'FORCE_SSL_LOGIN', false );

/*SSLSTART*/ if ( isset($_SERVER['HTTP_X_WPE_SSL']) && $_SERVER['HTTP_X_WPE_SSL'] ) $_SERVER['HTTPS'] = 'on'; /*SSLEND*/

define( 'WPE_EXTERNAL_URL', false );

define( 'WP_POST_REVISIONS', FALSE );

define( 'WPE_WHITELABEL', 'wpengine' );

define( 'WP_TURN_OFF_ADMIN_BAR', false );

define( 'WPE_BETA_TESTER', false );

umask(0002);

$wpe_cdn_uris=array ( );

$wpe_no_cdn_uris=array ( );

$wpe_content_regexs=array ( );

$wpe_all_domains=array ( 0 => 'makezine.wpengine.com', );

$wpe_varnish_servers=array ( 0 => 'web-272-2', 1 => 'web-272-1', );

$wpe_special_ips=array ( 0 => '162.242.217.194', 1 => '162.242.216.220', 2 => '172.16.0.4', 3 => '162.209.96.68', );

$wpe_ec_servers=array ( );

$wpe_largefs=array ( 0 =>  array ( 'path' => '/wp-content/uploads/', ), );

$wpe_netdna_domains=array ( );

$wpe_netdna_domains_secure=array ( );

$wpe_netdna_push_domains=array ( );

$wpe_domain_mappings=array ( );

$memcached_servers=array ( 'default' =>  array ( 0 => '172.16.0.1:11211', ), );

define( 'WPE_HYPER_DB', 'safe' );
define('WPLANG','');

# WP Engine ID


# WP Engine Settings






# That's It. Pencils down
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');
require_once(ABSPATH . 'wp-settings.php');

$_wpe_preamble_path = null; if(false){}
