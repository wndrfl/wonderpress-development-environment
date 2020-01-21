<?php /* Template Name: Home Page Template */ get_header(); ?>

<?php
if ( have_posts() ) :
	while ( have_posts() ) :
		the_post();
		?>
<main role="main">

	<section class="home-hero">
		<div class="container fx-when-in-view fx-animate-delay-02">
			<div class="row">
				<div class="col-md-8 col-md-offset-2">
					<h1 class="theme-headline h1 align-center">
						<?php echo get_field( 'hero_headline' ); ?>
					</h1>

					<div class="home-hero-sub-headline theme-sub-headline align-center">
						<?php echo get_field( 'hero_paragraph' ); ?>
					</div>

					<div class="home-hero-hashtag">
						<?php echo get_field( 'hero_hashtag' ); ?>
					</div>
				</div>
			</div>

		</div>
	</section>

	<div class="home-world-map-area">
		<section class="home-about">
			<div class="container">

				<div class="home-about-product-preview fx-when-in-view fx-animate-delay-1"></div>
				<div class="home-about-product-preview-gradient fx-when-in-view fx-animate-delay-02"></div>

				<div class="row">

					<div class="col-md-5 col-md-offset-7">
						<div class="home-about-text fx-when-in-view fx-animate-delay-15">
							<div class="theme-rte">
								<?php echo get_field( 'about_content' ); ?>
							</div>
						</div>

						<div class="home-about-stores">
							<a href="<?php the_field( 'apple_store_url', 'option' ); ?>" class="home-about-store apple"></a>
							<a href="<?php the_field( 'google_play_url', 'option' ); ?>" class="home-about-store google"></a>
						</div>
					</div>

				</div>
			</div>			
		</section>

		<section class="home-quote fx-when-in-view fx-animate-delay-05">
			<div class="container">
				<h2 class="theme-headline h1 align-center">
					<?php echo get_field( 'quote_headline' ); ?>
				</h2>

				<div class="home-quote-text theme-text medium orange align-center">
					<?php echo get_field( 'quote_attribution' ); ?>
				</div>
			</div>
		</section>
	</div>

	<div class="home-steps-header">
		<div class="home-steps-header-content">
			<div class="container">
				<div class="row">
					<div class="col-md-8 col-md-offset-2">
						<div class="home-steps-header-content-payload">
							<span class="home-steps-header-number">3</span>
							<span class="theme-headline h2 visible-xs-block">
								<?php echo get_field( 'steps_headline' ); ?>
							</span>
							<span class="theme-headline h1 hidden-xs">
								<?php echo get_field( 'steps_headline' ); ?>
							</span>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="home-tunnel-area">
		<section class="home-steps">

			<div class="home-steps-bullets">
				<div class="container">
					<div class="row">

						<?php
						while ( have_rows( 'step_bullets' ) ) {
							the_row();
							?>
							<?php $img = get_sub_field( 'image' ); ?>
						<div class="col-md-4">
							<div class="home-steps-bullet step-1 fx-when-in-view fx-animate-delay-02" style="background-image:url('<?php echo $img['sizes']['large']; ?>');">
								<h4 class="theme-headline h3 align-center">
									<?php echo get_sub_field( 'headline' ); ?>
								</h4>
								<div class="home-steps-bullet-text theme-text align-center">
									<?php echo get_sub_field( 'text' ); ?>
								</div>
							</div>
						</div>
						<?php } ?>

					</div>
				</div>
			</div>

		</section>

		<section class="home-form-area">
			<div class="container">
				<div class="row">
					<div class="col-md-4">

						<div class="home-form-area-content fx-when-in-view fx-animate-delay-05">
							<h2 class="theme-headline h1 align-center visible-xs-block">
								<?php echo get_field( 'form_headline' ); ?>
							</h2>
							<h2 class="theme-headline h1 hidden-xs">
								<?php echo get_field( 'form_headline' ); ?>
							</h2>

							<div class="home-form-area-content-text visible-xs-block">
								<div class="row">
									<div class="col-xs-8 col-xs-offset-2">
										<div class="theme-text align-center">
											<?php echo get_field( 'form_text' ); ?>
										</div>
									</div>
								</div>
							</div>

							<div class="home-form-area-content-text hidden-xs">
								<div class="theme-text">
									<?php echo get_field( 'form_text' ); ?>
								</div>
							</div>

							<div class="home-form-area-socials">
								<a href="<?php the_field( 'twitter_url', 'option' ); ?>" class="home-form-area-social twitter" target="_blank"></a>
								<a href="<?php the_field( 'facebook_url', 'option' ); ?>" class="home-form-area-social facebook" target="_blank"></a>
								<a href="<?php the_field( 'instagram_url', 'option' ); ?>" class="home-form-area-social instagram" target="_blank"></a>
							</div>

						</div>

					</div>
					<div class="col-md-8">
						<div class="home-form-area-form"></div>
					</div>
				</div>
			</div>
		</section>
	</div>
</main>

		<?php
	endwhile;
endif;
?>

<?php get_footer(); ?>
