<?php
if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly
}

require_once(TEMPLATEPATH . '/class/menu.php');

?>
<header id="site-header" class="site-header" role="banner">
	<!-- <div class="topbar">
		<div class="container">
			<div class="row">
				<div class="col-12 d-inline-flex align-items-center">
					<aside class="icons">
						<ul>
							<li><span class="fa fa-facebook-f"></span></li>
							<li><span class="fa fa-linkedin"></span></li>
						</ul>
					</aside>
					<aside class="infos">
						<ul>
							<li><a href="mailto:contato@sphereinternational.com.br">contato@sphereinternational.com.br</a></li>
							<li><a>Telefone: +55 11 97.364.4251</a></li>
							<li><a href="https://www.sphere.nabile.com.br/fale-conosco/">Fale conosco</a></li>
						</ul>	
					</aside>
				</div>
			</div>
		</div>
	</div> -->
	<div class="header">
		<div class="container">
			<div class="row align-items-center">
				<div id="logo" class="col-6 col-sm-4 col-md-3 p-3">
					<?php the_custom_logo(); ?>
				</div>

				<nav class="menu col-6 col-sm-8 col-md-9 d-none d-md-flex justify-content-end">
					<ul class="menu-itens">
						<?php foreach ($menus as $menu) :

							/* Verifica se algum do submenu está ativo */
							if ($menu->submenu) :
								foreach ($menu->submenu as $submenu) : (get_the_permalink() == $submenu->url) ? $submenuCurrent = "current-item-menu " : "";
								endforeach;
							endif;

							/* Verifica se é para abrir em outra aba*/
							if ($menu->target) :
								$menu->target = "target='{$menu->target}'";
							endif;



						?>

							<li class="<?= ($menu->submenu) ? 'has-submenu ' : ''; ?><?= $submenuCurrent ?><?= (get_the_permalink() == $menu->url) ? "current-item-menu " : ''; ?>post-<?= $menu->id; ?>">
								<a href="<?= $menu->url; ?>" title="<?= $menu->titulo; ?>" <?= $menu->target ?>>
									<?= $menu->titulo; ?>

									<?php if ($menu->submenu) : ?>
										&nbsp; <i class="fa fa-caret-down"></i>
									<?php endif; ?>
								</a>

								<?php if ($menu->submenu) : ?>
									<ul class="submenu-itens">
										<?php foreach ($menu->submenu as $submenu) :

											/* Verifica se é para abrir em outra aba*/
											if ($submenu->target) :
												$submenu->target = "target='{$submenu->target}'";
											endif;

										?>

											<li>
												<a href="<?= $submenu->url; ?>" class="<?= (get_the_permalink() == $submenu->url) ? "current-item-menu " : ''; ?>post-<?= $submenu->id; ?>" <?= $submenu->target ?>>
													<?= $submenu->titulo; ?>
												</a>
												<?php if ($submenu->submenu) : ?>
													<ul class="submenu2-itens">
														<?php foreach ($submenu->submenu as $submenu2) :

															/* Verifica se é para abrir em outra aba*/
															if ($submenu2->target) :
																$submenu2->target = "target='{$submenu2->target}'";
															endif;

														?>
															<li>
																<a href="<?= $submenu2->url; ?>" class="<?= (get_the_permalink() == $submenu2->url) ? "current-item-menu " : ''; ?>post-<?= $submenu2->id; ?>" <?= $submenu2->target ?>>
																	<?= $submenu2->titulo; ?>
																</a>
															</li>
														<?php endforeach; ?>
													</ul>
												<?php endif; ?>
											</li>
										<?php endforeach; ?>
									</ul>
								<?php endif; ?>
							</li>
						<?php
							$submenuCurrent = "";
						endforeach; ?>
						<li class="open-search-form pr-0"><i class="mn-icon-52"></i></li>
						<li class="change-language">
							<?php if (get_current_blog_id() == 1) : ?>
								<a href="<?= get_site_url(2) ?>">
									ENGLISH VERSION <img src="<?= get_template_directory_uri() ?>/img/uk-flag.svg" alt="English Version">
								</a>
							<?php else : ?>
								<a href="<?= get_site_url(1) ?>">
									PORTUGUESE VERSION <img src="<?= get_template_directory_uri() ?>/img/br-flag.svg" alt="Portuguese Version">
								</a>
							<?php endif; ?>
						</li>
					</ul>
				</nav>

				<nav class="d-md-none col-6 d-flex justify-content-end">
					<ul class="menu-itens">
						<li class="menu-burguer"><i class="fa fa-navicon" aria-hidden="true"></i></li>
						<li class="open-search-form pr-0"><i class="mn-icon-52"></i>
						</li>
					</ul>
				</nav>
			</div>
		</div>


		<div class="responsive-menu-sphere">
			<div class="dialog-close-button close-responsive-menu-sphere"><i class="eicon-close"></i></div>
			<?php echo wp_nav_menu() ?>
			<ul>
				<li class="change-language-mobile">
					<?php if (get_current_blog_id() == 1) : ?>
						<a href="<?= get_site_url(2) ?>">
							<strong>ENGLISH VERSION</strong> <img src="<?= get_template_directory_uri() ?>/img/uk-flag.svg" alt="English Version">
						</a>
					<?php else : ?>
						<a href="<?= get_site_url(1) ?>">
							<strong>PORTUGUESE VERSION</strong> <img src="<?= get_template_directory_uri() ?>/img/br-flag.svg" alt="Portuguese Version">
						</a>
					<?php endif; ?>
				</li>
			</ul>

		</div>
		<div class="menu-mobile dialog-type-lightbox"></div>


		<div class="full-top-search-form">
			<div class="apus-search-form">
				<form action="<?= get_site_url() ?>" method="get">
					<div class="input-group">
						<input type="text" placeholder="Pesquisar" value="<?= (!empty($_GET['s'])) ? $_GET['s'] : ""; ?>" name="s" class="apus-search form-control">
						<button class="close-search-form" type="button">
							<i class="mn-icon-4"></i>
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</header>