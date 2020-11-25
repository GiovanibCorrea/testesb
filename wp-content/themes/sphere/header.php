<?php
/**
 * The template for displaying the header.
 *
 * This is the template that displays all of the <head> section, opens the <body> tag and adds the site's header
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	 <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="profile" href="http://gmpg.org/xfn/11">


<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-K25Z33R');</script>
<!-- End Google Tag Manager -->
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
	<!-- Google Tag Manager (noscript) -->
	<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-K25Z33R"
	height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
	<!-- End Google Tag Manager (noscript) -->
	<?php
	if(get_field('ficou_interessado') ):
		?>

		<!-- Contato Flutuante -->

		<div class="hidden-xs" id="contato-flutuante">
			<div class="contato-btn icone-contato" alt="Abrir contato">
				Clique aqui para mais informações
			</div>
			<aside id="contato-fixo-aside">
				<div class="close-contato-btn" alt="Fechar">					
					<span class="">
						<i class="fa fa-close icone-close-contato"></i>
					</span>
				</div>
				<div class="contato-fixo">
					<h5><strong><?=get_field('ficou_titulo')?></strong></h5>
					<?= do_shortcode('[elementor-template id="1515"]') ?>
				</div>
			</aside>
		</div>
		<?php
	endif;

	if ( ! function_exists( 'elementor_theme_do_location' ) || ! elementor_theme_do_location( 'header' ) ) {
		get_template_part( 'template-parts/header' );
	}