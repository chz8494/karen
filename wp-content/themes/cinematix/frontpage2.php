<?php
/*
Template Name: Frontpage 2
*/
?>

<?php get_header() ?>

<div class="front-container">

<div id="slider">
<div id="banner">

	<div class="oneByOne_item">
		<div class="slider-text-a1" data-animate="bounceInDown"><?php echo get_theme_mod( 'DD_1st_slide_row1', 'Cinematix' ); ?></div>
	  	<div class="slider-text-a2" data-animate="bounceInLeft"><span><?php echo get_theme_mod( 'DD_1st_slide_row2', 'A Social Network Service' ); ?></span></div>
	  	<div class="slider-text-a3" data-animate="fadeInRight"><?php echo get_theme_mod( 'DD_1st_slide_row3', 'Register on our site and start creating profiles, posting messages, making connections, creating and interacting in groups and much more.' ); ?></div>
		<?php
		if ( is_user_logged_in() ) {
		?>
		    <a href="<?php echo home_url(); ?>/<?php echo get_theme_mod( 'DD_1st_slide_link2', 'about-us' ); ?>" class="slider-join" data-animate="bounceInUp"></a>
		<?php
		} else {
		?>
		    <a href="<?php echo home_url(); ?>/<?php echo get_theme_mod( 'DD_1st_slide_link1', 'register' ); ?>" class="slider-join" data-animate="bounceInUp"></a>
		<?php
		}
		?>
		</div>


	<div class="oneByOne_item">
		<div class="slider-text-b1" data-animate="bounceInLeft"><?php echo get_theme_mod( 'DD_2nd_slide_1', 'A social networking service' ); ?></div>
	  	<div class="slider-text-b2" data-animate="bounceInUp"><?php echo get_theme_mod( 'DD_2nd_slide_2', 'How does it work?' ); ?></div>
	  	<div class="slider-text-b3" data-animate="fadeInRight"><?php echo get_theme_mod( 'DD_2nd_slide_3', 'Users must register before using the site, after which they may create a personal profile, add other users as friends, and exchange messages, including automatic notifications when they update their profile. Additionally, users may join common-interest user groups, organized by workplace, school or college, or other characteristics.' ); ?></div>
	</div>


	<div class="oneByOne_item">
		<a class="slider-text-c1" href="<?php echo home_url(); ?>/<?php echo get_theme_mod( 'DD_3rd_slide_link', 'about-us' ); ?>" data-animate="bounceInUp"><img src="<?php if ( get_theme_mod( 'DD_3rd_slide' ) ) : ?><?php echo esc_url( get_theme_mod( 'DD_3rd_slide' ) ); ?><?php else : ?><?php echo esc_attr( get_bloginfo( 'stylesheet_directory', 'display' ) ); ?>/images/tour.png<?php endif; ?>" alt="<?php echo get_theme_mod( 'DD_3rd_slide_alt', 'Take a tour' ); ?>" /></a>
	</div>

</div>
</div><!-- #slider -->


</div><!--front-container ends-->

<div id="slider-spacer"></div>

<div id="content">

		<?php do_action( 'bp_after_header' ) ?>
		<?php do_action( 'bp_before_container' ) ?>

<div class="front-container front-metro">
<div id="metro">

<div class="tile tile1">
<?php
$temp = $wp_query;
$wp_query = null;
$wp_query = new WP_Query();
$wp_query->query('posts_per_page=1&offset=1&ignore_sticky_posts=1');
while ($wp_query->have_posts()) : $wp_query->the_post();
?>

	<?php the_post_thumbnail('tile-1'); ?>

	<div class="tile-title"><span><a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"><?php $thetitle = $post->post_title; $getlength = strlen($thetitle); $thelength = 55; echo mb_substr($thetitle, 0, $thelength, 'UTF-8'); if ($getlength > $thelength) echo "..."; ?></a></span></div>

<?php endwhile; // end of loop
 $wp_query = null; $wp_query = $temp; ?>
</div>


<div class="tile tile2">

<?php
$temp = $wp_query;
$wp_query= null;
$wp_query = new WP_Query();
$wp_query->query('posts_per_page=1&ignore_sticky_posts=1');
while ($wp_query->have_posts()) : $wp_query->the_post();
?>

<?php the_post_thumbnail('tile-2'); ?>

	<div class="tile-title"><span><a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"><?php $thetitle = $post->post_title; $getlength = strlen($thetitle); $thelength = 60; echo mb_substr($thetitle, 0, $thelength, 'UTF-8'); if ($getlength > $thelength) echo "..."; ?></a></span></div>

<?php endwhile; // end of loop
 $wp_query = null; $wp_query = $temp; ?>

</div>

<div class="tile tile3">
<?php
$temp = $wp_query;
$wp_query= null;
$wp_query = new WP_Query();
$wp_query->query('posts_per_page=1&offset=2&ignore_sticky_posts=1');
while ($wp_query->have_posts()) : $wp_query->the_post();
?>

<?php the_post_thumbnail('tile-1'); ?>
	<div class="tile-title"><span><a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"><?php $thetitle = $post->post_title; $getlength = strlen($thetitle); $thelength = 60; echo mb_substr($thetitle, 0, $thelength, 'UTF-8'); if ($getlength > $thelength) echo "..."; ?></a></span></div>
<?php endwhile; // end of loop
 $wp_query = null; $wp_query = $temp; ?>

</div>

<div class="tile tile4">

	<div class="tile tile4a">
<?php
$temp = $wp_query;
$wp_query= null;
$wp_query = new WP_Query();
$wp_query->query('posts_per_page=1&offset=3&ignore_sticky_posts=1');
while ($wp_query->have_posts()) : $wp_query->the_post();
?>

<?php the_post_thumbnail('tile-4'); ?>

	<div class="tile-title"><span><a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"><?php $thetitle = $post->post_title; $getlength = strlen($thetitle); $thelength = 60; echo mb_substr($thetitle, 0, $thelength, 'UTF-8'); if ($getlength > $thelength) echo "..."; ?></a></span></div>

<?php endwhile; // end of loop
 $wp_query = null; $wp_query = $temp; ?>
	</div>

	<div class="tile tile4b">
<?php
$temp = $wp_query;
$wp_query= null;
$wp_query = new WP_Query();
$wp_query->query('posts_per_page=1&offset=4&ignore_sticky_posts=1');
while ($wp_query->have_posts()) : $wp_query->the_post();
?>

<?php the_post_thumbnail('tile-4'); ?>

	<div class="tile-title"><span><a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"><?php $thetitle = $post->post_title; $getlength = strlen($thetitle); $thelength = 60; echo mb_substr($thetitle, 0, $thelength, 'UTF-8'); if ($getlength > $thelength) echo "..."; ?></a></span></div>

<?php endwhile; // end of loop
 $wp_query = null; $wp_query = $temp; ?>
	</div>

</div>

<div class="tile tile5">
<?php
$temp = $wp_query;
$wp_query= null;
$wp_query = new WP_Query();
$wp_query->query('posts_per_page=1&offset=5&ignore_sticky_posts=1');
while ($wp_query->have_posts()) : $wp_query->the_post();
?>

<?php the_post_thumbnail('tile-5'); ?>

	<div class="tile-title"><span><a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"><?php $thetitle = $post->post_title; $getlength = strlen($thetitle); $thelength = 60; echo mb_substr($thetitle, 0, $thelength, 'UTF-8'); if ($getlength > $thelength) echo "..."; ?></a></span></div>

<?php endwhile; // end of loop
 $wp_query = null; $wp_query = $temp; ?>

</div>


<div class="tile tile6">
<?php
$temp = $wp_query;
$wp_query= null;
$wp_query = new WP_Query();
$wp_query->query('posts_per_page=1&offset=6&ignore_sticky_posts=1');
while ($wp_query->have_posts()) : $wp_query->the_post();
?>

<?php the_post_thumbnail('tile-5'); ?>

	<div class="tile-title"><span><a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"><?php $thetitle = $post->post_title; $getlength = strlen($thetitle); $thelength = 60; echo mb_substr($thetitle, 0, $thelength, 'UTF-8'); if ($getlength > $thelength) echo "..."; ?></a></span></div>

<?php endwhile; // end of loop
 $wp_query = null; $wp_query = $temp; ?>

</div>


<div class="tile tile7">

<?php
$temp = $wp_query;
$wp_query= null;
$wp_query = new WP_Query();
$wp_query->query('posts_per_page=1&offset=7&ignore_sticky_posts=1');
while ($wp_query->have_posts()) : $wp_query->the_post();
?>

<?php the_post_thumbnail('tile-7'); ?>

	<div class="tile-title"><span><a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"><?php $thetitle = $post->post_title; $getlength = strlen($thetitle); $thelength = 60; echo mb_substr($thetitle, 0, $thelength, 'UTF-8'); if ($getlength > $thelength) echo "..."; ?></a></span></div>

<?php endwhile; // end of loop
 $wp_query = null; $wp_query = $temp; ?>

</div>

<div class="tile tile8">
<?php
$temp = $wp_query;
$wp_query= null;
$wp_query = new WP_Query();
$wp_query->query('posts_per_page=1&offset=8&ignore_sticky_posts=1');
while ($wp_query->have_posts()) : $wp_query->the_post();
?>

<?php the_post_thumbnail('tile-8'); ?>

	<div class="tile-title"><span><a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"><?php $thetitle = $post->post_title; $getlength = strlen($thetitle); $thelength = 60; echo mb_substr($thetitle, 0, $thelength, 'UTF-8'); if ($getlength > $thelength) echo "..."; ?></a></span></div>

<?php endwhile; // end of loop
 $wp_query = null; $wp_query = $temp; ?>
</div>

</div><!-- #metro -->

</div><!-- front-container -->


<div id="slider-spacer"></div>





<?php if ( function_exists( 'bp_is_active' ) ) { ?>
<div class="front-container front-member">
<div class="sub-title-m"><a href="<?php echo home_url(); ?>/<?php esc_html_e('members', 'cinematix'); ?>"><?php esc_html_e('Our Members', 'cinematix'); ?></a></div>

	<div class="front-member-child">
	<?php if ( bp_has_members( 'type=active&max=11' ) ) : ?>
			<?php while ( bp_members() ) : bp_the_member(); ?>
				<a href="<?php bp_member_permalink() ?>" class="front-member-item" title="<?php bp_member_name(); ?> (<?php bp_member_last_active(); ?>)"><?php bp_member_avatar('type=full&width=60&height=60') ?></a>
			<?php endwhile; ?>
	<?php endif; ?>
	<div class="sub-title-d">...</div>
	</div>
</div>
<div class="clear"></div>

<div class="front-spacer"></div>
<?php } ?>


<div class="front-container front-container-bottom">
<?php if ( function_exists( 'bp_is_active' ) ) { ?>
<div id="tabs-container">

<div class="sub-title-bold"><?php esc_html_e('Our Groups', 'cinematix'); ?></div>

<div id="object-nav">
        	<ul class="tabs-nav">
                <li class="nav-one"><a href="#popular" class="current"><?php esc_html_e('Popular', 'cinematix'); ?></a></li>
                <li class="nav-two"><a href="#active"><?php esc_html_e('Active', 'cinematix'); ?></a></li>
                <li class="nav-three"><a href="#alphabetical"><?php esc_html_e('Alphabetical', 'cinematix'); ?></a></li>
                <li class="nav-four"><a href="#newest"><?php esc_html_e('Newest', 'cinematix'); ?></a></li>
            </ul>
</div>

<div class="list-wrap">

<!-- NEWEST GROUPS LOOP POPULAR -->
<?php if ( bp_has_groups( 'type=popular&max=6' ) ) : ?>

<ul id="popular">
      <?php while ( bp_groups() ) : bp_the_group(); ?>
<li>
       <div class="group-box">
	<div class="group-box-image-container">
		<a class="group-box-image" href="<?php bp_group_permalink() ?>forum"><?php bp_group_avatar( 'type=full' ) ?></a>
	</div>
	<div class="group-box-right">
		<div class="group-box-title"><a href="<?php bp_group_permalink() ?>forum"><?php $grouptitle = bp_get_group_name(); $getlength = strlen($grouptitle); $thelength = 20; echo mb_substr($grouptitle, 0, $thelength, 'UTF-8'); if ($getlength > $thelength) echo "..."; ?></a></div>
		<div class="group-box-details">
			<div class="gb-a"><?php esc_html_e('Active', 'cinematix'); ?> <?php echo bp_get_group_last_active(); ?></div>
			<div class="gb-m"><?php bp_group_member_count(); ?></div>
		</div>
	</div>
        </div><!--group-box ends-->
</li>
      <?php endwhile; ?>
</ul>

  <div class="clear"></div>
    <?php do_action( 'bp_after_groups_loop' ) ?>

<?php else: ?>

<ul id="popular">
    <div id="message" class="info">
        <p><?php esc_html_e( 'There were no groups found.', 'buddypress' ) ?></p>
    </div>
<br />
</ul>

<?php endif; ?>
<!-- POPULAR GROUPS LOOP END -->

<!-- NEWEST GROUPS LOOP START -->
<?php if ( bp_has_groups( 'type=newest&max=6' ) ) : ?>

<ul id="newest" class="hidden-tab">
      <?php while ( bp_groups() ) : bp_the_group(); ?>
<li>
       <div class="group-box">
	<div class="group-box-image-container">
		<a class="group-box-image" href="<?php bp_group_permalink() ?>forum"><?php bp_group_avatar( 'type=full' ) ?></a>
	</div>
	<div class="group-box-right">
		<div class="group-box-title"><a href="<?php bp_group_permalink() ?>forum"><?php $grouptitle = bp_get_group_name(); $getlength = strlen($grouptitle); $thelength = 20; echo mb_substr($grouptitle, 0, $thelength, 'UTF-8'); if ($getlength > $thelength) echo "..."; ?></a></div>
		<div class="group-box-details">
			<div class="gb-a"><?php esc_html_e('Active', 'cinematix'); ?> <?php echo bp_get_group_last_active(); ?></div>
			<div class="gb-m"><?php bp_group_member_count(); ?></div>
		</div>
	</div>
        </div><!--group-box ends-->
</li>
      <?php endwhile; ?>
</ul>

  <div class="clear"></div>
    <?php do_action( 'bp_after_groups_loop' ) ?>

<?php else: ?>

<ul id="newest" class="hidden-tab">
    <div id="message" class="info">
        <p><?php esc_html_e( 'There were no groups found.', 'buddypress' ) ?></p>
    </div><br />
</ul>
<?php endif; ?>

<!-- NEWEST GROUPS LOOP END -->


<!-- LAST ACTIVE GROUPS LOOP START -->

<?php if ( bp_has_groups( 'type=active&max=6' ) ) : ?>

<ul id="active" class="hidden-tab">
      <?php while ( bp_groups() ) : bp_the_group(); ?>
<li>
       <div class="group-box">
	<div class="group-box-image-container">
		<a class="group-box-image" href="<?php bp_group_permalink() ?>forum"><?php bp_group_avatar( 'type=full' ) ?></a>
	</div>
	<div class="group-box-right">
		<div class="group-box-title"><a href="<?php bp_group_permalink() ?>forum"><?php $grouptitle = bp_get_group_name(); $getlength = strlen($grouptitle); $thelength = 20; echo mb_substr($grouptitle, 0, $thelength, 'UTF-8'); if ($getlength > $thelength) echo "..."; ?></a></div>
		<div class="group-box-details">
			<div class="gb-a"><?php esc_html_e('Active', 'cinematix'); ?> <?php echo bp_get_group_last_active(); ?></div>
			<div class="gb-m"><?php bp_group_member_count(); ?></div>
		</div>
	</div>
        </div><!--group-box ends-->
</li>
      <?php endwhile; ?>
</ul>

  <div class="clear"></div>
    <?php do_action( 'bp_after_groups_loop' ) ?>

<?php else: ?>

<ul id="active" class="hidden-tab">
    <div id="message" class="info">
        <p><?php esc_html_e( 'There were no groups found.', 'buddypress' ) ?></p>
    </div><br />
</ul>
<?php endif; ?>
<!-- LAST ACTIVE GROUPS LOOP END -->



<!-- ALPHABETICAL GROUPS LOOP -->
<?php if ( bp_has_groups( 'type=alphabetical&max=6' ) ) : ?>

<ul id="alphabetical" class="hidden-tab">
      <?php while ( bp_groups() ) : bp_the_group(); ?>
<li>
       <div class="group-box">
	<div class="group-box-image-container">
		<a class="group-box-image" href="<?php bp_group_permalink() ?>forum"><?php bp_group_avatar( 'type=full' ) ?></a>
	</div>
	<div class="group-box-right">
		<div class="group-box-title"><a href="<?php bp_group_permalink() ?>forum"><?php $grouptitle = bp_get_group_name(); $getlength = strlen($grouptitle); $thelength = 20; echo mb_substr($grouptitle, 0, $thelength, 'UTF-8'); if ($getlength > $thelength) echo "..."; ?></a></div>
		<div class="group-box-details">
			<div class="gb-a"><?php esc_html_e('Active', 'cinematix'); ?> <?php echo bp_get_group_last_active(); ?></div>
			<div class="gb-m"><?php bp_group_member_count(); ?></div>
		</div>
	</div>
        </div><!--group-box ends-->
</li>
      <?php endwhile; ?>
</ul>

  <div class="clear"></div>
    <?php do_action( 'bp_after_groups_loop' ) ?>

<?php else: ?>

<ul id="alphabetical" class="hidden-tab">
    <div id="message" class="info">
        <p><?php esc_html_e( 'There were no groups found.', 'buddypress' ) ?></p>
    </div><br />
</ul>
<?php endif; ?>
<!-- ALPHABETICAL GROUPS LOOP END -->


</div> <!-- List Wrap -->
</div> <!-- tabs-container -->

<div class="front-spacer-v"></div>

<?php } ?>

<?php if ( function_exists( 'bbp_has_topics' ) ) { ?>
<div class="frontpage-right">

<div class="front-box">
<div class="sub-title-bold"><?php esc_html_e('On the Forums', 'cinematix'); ?></div>

<div class="front-box-child">

	<?php if ( bbp_has_topics( array( 'author' => 0, 'show_stickies' => false, 'order' => 'DESC', 'post_parent' => 'any', 'posts_per_page' => 5 ) ) ) : ?>
		<?php bbp_get_template_part( 'loop', 'mytopics' ); ?>
	<?php else : ?>
		<?php bbp_get_template_part( 'feedback', 'no-topics' ); ?>
	<?php endif; ?>

</div>
<div class="clear"></div>
</div>
</div> <!-- frontpage-right -->
<?php } ?>


<div class="clear"> </div>

</div><!--front-container ends-->


<div class="clear"> </div>


</div><!-- #content -->

<?php get_footer() ?>
