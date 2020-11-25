<?php
/**
 * The template for displaying the footer.
 *
 * Contains the body & html closing tags.
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( ! function_exists( 'elementor_theme_do_location' ) || ! elementor_theme_do_location( 'footer' ) ) {
	get_template_part( 'template-parts/footer' );
}
?>

<style>

.WPP_Botao {
	display: block !important;
	position: fixed; 
	right: 10px; 
	bottom: 10px; 
	z-index: 99;
	max-width: 50px;
	height: auto;
	transition: .1s all;
}

.WPP_Botao img {
	max-width: 100%;
	height: auto;
}

.WPP_Botao:hover {
	-webkit-filter: drop-shadow(-2px 4px 5px rgba(0,0,0,.1));
	filter: drop-shadow(-2px 4px 5px rgba(0,0,0,.1));
	transition: .1s all;
}
</style>

<a href="https://web.whatsapp.com/send?phone=5512996341981" target="_blank" class="WPP_Botao">
	<img src="<?= get_stylesheet_directory_uri() ?>/img/whatsapp.png" alt="Logo WhatsApp">
</a>

<script>


	jQuery(function() {
		header = jQuery(".header");
		back_to_top = jQuery("#back-to-top");
		body = jQuery("body");
		jQuery(window).scroll(function() {
			var scroll = jQuery(window).scrollTop();

			if (scroll >= 61) {
				header.addClass("menuScroll");
				body.css("margin-top", "86px");
			} else {
				header.removeClass("menuScroll");
				body.css("margin-top", "0");
			}

			if (scroll >= 300) {
				back_to_top.fadeIn(500);
			} else {
				back_to_top.fadeOut(1000);
			}
		});


		jQuery("#contato-flutuante").on("click", ".contato-btn", function() {
			jQuery("#contato-fixo-aside").css("right", "0px");
		});

		jQuery("#contato-flutuante").on("click", ".close-contato-btn", function() {
			jQuery("#contato-fixo-aside").css("right", "-280px");
		});

		jQuery("#franqueado_form").on('submit_success', function(){
			setTimeout(function(){ 
				jQuery("#franqueado_form .elementor-message").fadeOut("500", function() {
					jQuery(".close-contato-btn").click();
				}); 
			}, 2000);			
		});

		
	// Add space for Elementor Menu Anchor link
	jQuery(window).on('elementor/frontend/init', function(){
		elementorFrontend.hooks.addFilter( 'frontend/handlers/menu_anchor/scroll_top_distance', function( scrollTop ) {
			return scrollTop - 110;
		} );
	});

	jQuery(".open-search-form, .close-search-form").on("click", function(){
		if(jQuery(".full-top-search-form").hasClass('show')) {
			jQuery(".full-top-search-form").removeClass('show');
		} else {
			jQuery(".full-top-search-form").addClass('show');
			jQuery(".form-control").focus();
		}
	});

	/* CHANGE EDUCATIONS */
	jQuery(".change-educations").on('click', function(e){

		if(!jQuery(this).hasClass('educations-active')) {

			jQuery(".education").fadeOut(0).removeClass("education-active");
			jQuery("." + jQuery(this).attr('rel')).fadeIn(300);

			jQuery(".change-educations").removeClass('educations-active');
			jQuery(this).addClass('educations-active');
		}

		e.preventDefault();
	});


	/* Evento Certificações / hover/click */
	jQuery(".certificacoes-mais").on('mouseenter click', function(e){
		if(!jQuery(this).hasClass('educations-active')) {
			jQuery(".certificacoes-conteudo").fadeOut(400).removeClass("certificacoes-active");
			jQuery("." + jQuery(this).attr('rel')).fadeIn(300).addClass('certificacoes-active');
		}

		e.preventDefault();
	});

	jQuery(".certificacoes-mais").on('mouseleave', function(e){
		jQuery(".certificacoes-conteudo").fadeOut(400).removeClass("certificacoes-active");
		e.preventDefault();
	});

	/* SEJA UM FRANQUEADO - Carrega a página sem nenhum aberto */
	jQuery(".suporte-360 .elementor-active").click();

	/* HEADER MOBILE */

	/* ABRIR  */
	jQuery(".menu-burguer").on("click", function(){
		jQuery(".menu-mobile").show(500);
		jQuery(".responsive-menu-sphere").css("left", 0);
		jQuery("body").addClass('menu-mobile-openned');		
	});

	/* FECHAR  */
	jQuery(".close-responsive-menu-sphere, .menu-mobile").on("click", function(){
		jQuery(".responsive-menu-sphere").css("left", -300);
		jQuery(".menu-mobile").hide(500);
		jQuery("body").removeClass('menu-mobile-openned');	
	});


	/* ABRINDO SUBMENU */
	jQuery(".responsive-menu-sphere .menu-item-has-children").on("click", function(){
		jQuery(this).children(".sub-menu").slideToggle(400);
	});


	/* JQUERY MASK */
	jQuery('.telefone').mask('(00) 0000-00000');

	jQuery('.telefone').focusout(function() {
		jQuery(this).unmask();

           if(jQuery(this).val().length >= 11){ // Celular com 9 dígitos + 2 dígitos DDD e 4 da máscara
           	jQuery(this).mask('(00) 0 0000-0000');
           } else {
           	jQuery(this).mask('(00) 0000-00000');
           }
       });

	jQuery('.cpf').mask('000.000.000-00');

		/* DEFINIR HOJE COMO DATA LIMITE DE ATENDIMENTO */
	(function() {
	    Date.prototype.toYMD = Date_toYMD;
	    function Date_toYMD() {
	        var year, month, day;
	        year = String(this.getFullYear());
	        month = String(this.getMonth() + 1);
	        if (month.length == 1) {
	            month = "0" + month;
	        }
	        day = String(this.getDate());
	        if (day.length == 1) {
	            day = "0" + day;
	        }
	        return year + "-" + month + "-" + day;
	    }
	})();

	now = new Date();
	jQuery(".data_atendimento").attr("min", now.toYMD());

	/*	Nome do arquivo abaixo do input */
	jQuery('.elementor-field-type-upload input').change(function() {
		jQuery(".elementor-field-type-upload").find("small").remove();

		file = jQuery(this)[0].files[0].name;
		
		jQuery(".elementor-field-type-upload").append("<small>Currículo atual: <strong>"+ file +"</strong></small>");	
	});

});


</script>

<script type="application/javascript">(function(w,d,t,r,u){w[u]=w[u]||[];w[u].push({'projectId':'10000','properties':{'pixelId':'10087203'}});var s=d.createElement(t);s.src=r;s.async=true;s.onload=s.onreadystatechange=function(){var y,rs=this.readyState,c=w[u];if(rs&&rs!="complete"&&rs!="loaded"){return}try{y=YAHOO.ywa.I13N.fireBeacon;w[u]=[];w[u].push=function(p){y([p])};y(c)}catch(e){}};var scr=d.getElementsByTagName(t)[0],par=scr.parentNode;par.insertBefore(s,scr)})(window,document,"script","https://s.yimg.com/wi/ytc.js","dotq");</script>

<?php wp_footer(); ?>

</body>
</html>