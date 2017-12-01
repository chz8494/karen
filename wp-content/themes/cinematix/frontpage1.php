<?php
/*
Template Name: Frontpage 1
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
