<?php $awada_theme_options = awada_theme_options();
if($awada_theme_options['home_slider_enabled']==1){
	if( $awada_theme_options['slider_style'] == 3 ) {
		if($awada_theme_options['home_slider_shortcode']!=""){
			echo do_shortcode($awada_theme_options['home_slider_shortcode']);
		}
	} else if( $awada_theme_options['slider_style'] == 1 ) { ?>
		<div id="slider" class="sl-slider-wrapper demo-2">
			<div class="sl-slider" >
				<?php for ($i = 1; $i <= 3; $i++) {
                if($awada_theme_options['slider_img_'.$i]!=""){
					$image_id = Kirki_Helper::get_image_id( $awada_theme_options['slider_img_'.$i] );
                    if ($image_id!=false) {
                        $img_src = wp_get_attachment_image_url($image_id, 'awada_home_slider_bg_image',false);
                    }else{
                        $img_src =$awada_theme_options['slider_img_'.$i];
                    }

						if ($i % 2 == 0){	$orientation = 'horizontal';	}
						else{	$orientation = 'vertical';	}
					?>
						<div class="sl-slide" data-orientation="<?php echo $orientation; ?>" data-slice1-rotation="-25" data-slice2-rotation="-25" data-slice1-scale="2" data-slice2-scale="2">
							<div class="sl-slide-inner">
								<img src="<?php echo esc_url($img_src); ?>" class="awada_home_slider_bg_image img-responsive bg-img" alt="<?php echo wp_kses_post($awada_theme_options['slider_title_'.$i]); ?>">
								 <?php if($awada_theme_options['slider_title_'.$i]!=""){?>
								<h2><?php echo wp_kses_post($awada_theme_options['slider_title_'.$i]); ?></h2>
								<?php } ?>
								<?php $link='';
	                            if (isset($awada_theme_options['slider_post_page_' . $i]) && $awada_theme_options['slider_post_page_' . $i] == 'post') {
	                                    if (isset($awada_theme_options['post_slider_' . $i]) && $awada_theme_options['post_slider_' . $i] != 0) {$link = get_permalink($awada_theme_options['post_slider_' . $i]);
										 }
	                                } else {
	                                    if (isset($awada_theme_options['page_slider_' . $i]) && $awada_theme_options['page_slider_' . $i] != 0) {$link = get_permalink($awada_theme_options['page_slider_' . $i]);}
	                                } ?>
								<?php if($awada_theme_options['slider_subtitle_'.$i]!="" || $link!=""){?>
								<blockquote>
									<?php if($awada_theme_options['slider_subtitle_'.$i]!=""){?>
									<p><?php echo wp_kses_post($awada_theme_options['slider_subtitle_'.$i]); ?></p>
									<?php }?>
									<?php if($link!='' && isset($awada_theme_options['slider_readmore_' . $i]) && $awada_theme_options['slider_readmore_' . $i]!=''){?>
	                           <a id="slide<?php echo $i; ?>-btn1" href="<?php echo esc_url($link); ?>" class="btn btn-primary btn-lg slider-btn2"><?php if(isset($awada_theme_options['slider_readmore_' . $i]) && $awada_theme_options['slider_readmore_' . $i]!=''){ echo esc_attr($awada_theme_options['slider_readmore_' . $i]); }?></a>
	                            <?php } ?>
								</blockquote>
								<?php } ?>								
							</div>
						</div>

				<?php } //endif;
				 } ?>
			</div><!-- /sl-slider -->
			<?php if($i>1){ ?>
			<nav id="nav-arrows" class="nav-arrows">
				<span class="nav-arrow-prev"><?php _e('Previous', 'awada'); ?></span>
				<span class="nav-arrow-next"><?php _e('Next', 'awada'); ?></span>
			</nav>
			
			<?php } ?>
		</div><!-- /slider-wrapper --><?php 
	} else if( $awada_theme_options['slider_style'] == 2 ){ ?>
		<section class="a-classic-slider" id="home_slider">
        <div class="awada-slider classic-main-wrapper owl-carousel owl-theme" data-items="1" data-loop="true" data-pause-on-hover="true" data-autoplay="true" data-dots="true" data-nav="true"
        data-r-x-small="1" data-r-x-small-nav="false" data-r-x-small-dots="true" data-r-x-medium="1" data-r-x-medium-nav="false"
        data-r-x-medium-dots="true" data-r-small="1" data-r-small-nav="false" data-r-small-dots="true" data-r-medium="1"
        data-r-medium-nav="true" data-r-medium-dots="true" data-r-large="1" data-r-large-nav="true" data-r-large-dots="true">
			<?php for ($i = 1; $i <= 3; $i++) {
			if($awada_theme_options['slider_img_'.$i]!=""){
				$image_id = Kirki_Helper::get_image_id( $awada_theme_options['slider_img_'.$i] );
				if ($image_id!=false) {
					$img_src = wp_get_attachment_image_url($image_id, 'awada_home_slider_bg_image',false);
				}else{
					$img_src =$awada_theme_options['slider_img_'.$i];
				} ?>
            <div class="item">
				<img src="<?php echo esc_url($img_src); ?>" class="img-responsive" alt="<?php echo wp_kses_post($awada_theme_options['slider_title_'.$i]); ?>"/>
                <div class="awada-slide-overlay">
                    <div class="a-slide-inner">
                        <div class="a-slide-inner-cell">
                            <div class="container">
                                <div class="slide-inner-content">
                                    <?php if($awada_theme_options['slider_title_'.$i]!=""){?>
									<h2><?php echo wp_kses_post($awada_theme_options['slider_title_'.$i]); ?></h2>
									<?php } ?>
									<?php $link='';
									if (isset($awada_theme_options['slider_post_page_' . $i]) && $awada_theme_options['slider_post_page_' . $i] == 'post') {
										if (isset($awada_theme_options['post_slider_' . $i]) && $awada_theme_options['post_slider_' . $i] != 0) {$link = get_permalink($awada_theme_options['post_slider_' . $i]);
										 }
									} else {
										if (isset($awada_theme_options['page_slider_' . $i]) && $awada_theme_options['page_slider_' . $i] != 0) {$link = get_permalink($awada_theme_options['page_slider_' . $i]);}
									} ?>
									<?php if($awada_theme_options['slider_subtitle_'.$i]!="" || $link!=""){?>
									<?php if($awada_theme_options['slider_subtitle_'.$i]!=""){?>
                                    <h3><p><?php echo wp_kses_post($awada_theme_options['slider_subtitle_'.$i]); ?></p></h3>
									<?php } ?>
									<?php if($link!='' && isset($awada_theme_options['slider_readmore_' . $i]) && $awada_theme_options['slider_readmore_' . $i]!=''){?>
                                    <a href="<?php echo esc_url($link); ?>" class="btn a-btn-classic btn-primary btn-lg append-button1 btn-shadow"><?php if(isset($awada_theme_options['slider_readmore_' . $i]) && $awada_theme_options['slider_readmore_' . $i]!=''){ echo esc_html($awada_theme_options['slider_readmore_' . $i]); }?></a>
									<?php }
									} ?>
                                </div>
                            </div> 
                        </div>
                    </div>
                </div>
            </div>
			<?php }
			} ?>
        </div>
    </section>
	<?php }
} ?>