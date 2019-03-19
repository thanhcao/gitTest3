<section class="post-wrapper-top section-shadow clearfix">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<div class="col-lg-7 awada_pag_title">
					<?php if(class_exists('woocommerce') && is_shop()){
						echo '<h2>'.__('Shop','awada').'</h2>';
						}else{?>
						<h2><?php the_title(); ?></h2>
						<?php } ?>
				</div>
				<div class="col-lg-5 awada_pag_breadcrumb">
					<?php awada_breadcrumbs(); ?>
				</div>
			</div>
		</div>
	</div>
</section><!-- end post-wrapper-top -->