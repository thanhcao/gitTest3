<?php $awada_theme_options = awada_theme_options();
$col = 12 / (int)$awada_theme_options['home_service_column']; ?>
<section class="grey-wrapper section-shadow" id="home_service">
	<div class="container">
		<div class="main_title">
			<?php if ($awada_theme_options['home_service_title'] != ""){ ?>
			<h2 id="home_service_title"><?php echo wp_kses_post($awada_theme_options['home_service_title']); ?></h2>
			<hr>
			<?php } if ($awada_theme_options['home_service_description'] != ""){ ?>
			<p id="home_service_description" class="lead"><?php echo wp_kses_post($awada_theme_options['home_service_description']); ?></p>
			<?php } ?>
		</div><!-- end general title -->
		
		<div class="services-one padding-top text-center">
			<?php $i = 1;
			for ($j = 1; $j <= 4; $j++) {
			if($col==3){
				if($i==1){
					$pos = 'first';
				} elseif(($i==2) || ($i==3)){
					$pos = '';
				} else if($i==4){
					$pos = 'last';
					$i = 0;
				}
			} else if($col==4){
				if($i==1){
					$pos = 'first';
				} elseif($i==2){
					$pos = '';
				} else if($i==3){
					$pos = 'last';
					$i = 0;
				}
			} else if($col==6){
				if($i==1){
					$pos = 'first';
				} else if($i==2){
					$pos = 'last';
					$i = 0;
				}
			} ?>
			<div class="service_col col-lg-<?php echo $col; ?> col-md-<?php echo $col; ?> col-sm-6 col-xs-12 <?php echo $pos; ?>">
				<div class="servicelayout">
					<?php if($awada_theme_options['service_link_' . $j]) {
						$service_url = $awada_theme_options['service_link_' . $j];
					}
					if($awada_theme_options['service_icon_' . $j] != ""){ ?>
					<a href="<?php echo esc_url($service_url); ?>">
					<div id="service_box_<?php echo $j; ?>"class="service-icon-square  <?php if($i==2){ echo 'active'; } ?>">
						<i id="service_icon_<?php echo $j; ?>" class="fa fa-<?php echo wp_kses_post($awada_theme_options['service_icon_' . $j]); ?>"></i>
					</div><!-- end service icon -->
					</a>
					<?php } ?>
					<div class="title">
						<a href="<?php echo esc_url($service_url); ?>"><h3 id="service_title_<?php echo $j; ?>"><?php echo wp_kses_post($awada_theme_options['service_title_' . $j]); ?></h3></a>
					</div><!-- end title -->
					<?php if($awada_theme_options['service_text_' . $j] != ""){ ?>
					<p id="service_description_<?php echo $j; ?>"><?php echo wp_kses_post($awada_theme_options['service_text_' . $j]); ?></p>
					<?php } ?>
					<a id="service_link_<?php echo $j; ?>" class="readmore" href="<?php echo esc_url($service_url); ?>" target="_blank" ><?php _e('Read More', 'awada'); ?></a>
				</div><!-- end Service Layout -->
			</div><!-- end col-lg-3 -->
			<?php $i++; } ?>
		</div><!-- end services -->
	</div><!-- end container -->
</section><!-- end grey-wrapper -->