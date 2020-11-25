<?php
/** Enable W3 Total Cache */
define('WP_CACHE', true); // Added by W3 Total Cache

/**
 * As configurações básicas do WordPress
 *
 * O script de criação wp-config.php usa esse arquivo durante a instalação.
 * Você não precisa usar o site, você pode copiar este arquivo
 * para "wp-config.php" e preencher os valores.
 *
 * Este arquivo contém as seguintes configurações:
 *
 * * Configurações do MySQL
 * * Chaves secretas
 * * Prefixo do banco de dados
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/pt-br:Editando_wp-config.php
 *
 * @package WordPress
 */
if (isset($_SERVER["HTTP_X_FORWARDED_PROTO"] ) && "https" == $_SERVER["HTTP_X_FORWARDED_PROTO"] ) {
$_SERVER["HTTPS"] = "on";
}
// ** Configurações do MySQL - Você pode pegar estas informações com o serviço de hospedagem ** //
/** O nome do banco de dados do WordPress */
define('DB_NAME', 'dbesfera');

/** Usuário do banco de dados MySQL */
define('DB_USER', 'useresfera@mysqlsebeducacao');

/** Senha do banco de dados MySQL */
define('DB_PASSWORD', 'User#sfera');

/** Nome do host do MySQL */
define('DB_HOST', 'mysqlsebeducacao.mysql.database.azure.com');

/** Charset do banco de dados a ser usado na criação das tabelas. */
define('DB_CHARSET', 'utf8mb4');

/** O tipo de Collate do banco de dados. Não altere isso se tiver dúvidas. */
define('DB_COLLATE', 'utf8mb4_unicode.ci');

/**#@+
 * Chaves únicas de autenticação e salts.
 *
 * Altere cada chave para um frase única!
 * Você pode gerá-las
 * usando o {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org
 * secret-key service}
 * Você pode alterá-las a qualquer momento para invalidar quaisquer
 * cookies existentes. Isto irá forçar todos os
 * usuários a fazerem login novamente.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'mQ&~?Y~m7y^&(43%Z.=/c%O}HBMa*;hZKU@VCVw=aIHWt;hF|`uNBe `i<R+3SGv');
define('SECURE_AUTH_KEY',  'R+$KIB)(Cm_g&.ag- _%K;~Gr_X>9,[#?A>s6N%zHW>V!cF@3Jsu~UQ)Nlk;(LK~');
define('LOGGED_IN_KEY',    ' ~U1~Qbd1A&K`.hJI4UIY$`5r~S8/tb(D,idE@T3u[#+_$g2/dwLHmVRfXL#H2g#');
define('NONCE_KEY',        'Azpe}-Q$in1ABgf*?[gs-}AYFIaWIg3b$8(Fqd&F$yfphn>%A}kQ4+cDb*oODP&`');
define('AUTH_SALT',        '>tqH*jB+4WP5{|by3J%C15sy!h#.4XWpo/q!GQawYhfdyQbdc54iD ]Xj,j2zA~8');
define('SECURE_AUTH_SALT', 'h.d6u$*~k>.uI;W^4B!x)N%T>)mh6}E~ZS,0zpB16C52Cjf4VT<LY,L/doZg-+B#');
define('LOGGED_IN_SALT',   '^lj-kIa !$2?*#t(fqHg )<:)+)}?Al!+g<%dp|D*m@No~L]*EvDof[vv6JT~7fN');
define('NONCE_SALT',       'Qo4aUs]P4{S%tH+.|F{lIrB76zjt(5etdyhBu)`_q};-z0iEgHaV$led,07jK7ss');



/**#@-*/

/**
 * Prefixo da tabela do banco de dados do WordPress.
 *
 * Você pode ter várias instalações em um único banco de dados se você der
 * um prefixo único para cada um. Somente números, letras e sublinhados!
 */
$table_prefix  = 'wp_';

/**
 * Para desenvolvedores: Modo de debug do WordPress.
 *
 * Altere isto para true para ativar a exibição de avisos
 * durante o desenvolvimento. É altamente recomendável que os
 * desenvolvedores de plugins e temas usem o WP_DEBUG
 * em seus ambientes de desenvolvimento.
 *
 * Para informações sobre outras constantes que podem ser utilizadas
 * para depuração, visite o Codex.
 *
 * @link https://codex.wordpress.org/pt-br:Depura%C3%A7%C3%A3o_no_WordPress
 */
define('WP_DEBUG', true);

/* Isto é tudo, pode parar de editar! :) */

/* Multisite */
define('MULTISITE', true);
define('SUBDOMAIN_INSTALL', false);
define('DOMAIN_CURRENT_SITE', 'app-siteesfera.azurewebsites.net');
define('PATH_CURRENT_SITE', '/');
define('SITE_ID_CURRENT_SITE', 1);
define('BLOG_ID_CURRENT_SITE', 1);

define( 'ALLOW_UNFILTERED_UPLOADS', true );

/** Caminho absoluto para o diretório WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Configura as variáveis e arquivos do WordPress. */
require_once(ABSPATH . 'wp-settings.php');