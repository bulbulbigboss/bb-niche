<?php
// Custom widget section for BB niche theme

class recentpostwidget extends WP_Widget{

            public function __construct(){

            parent::__construct('recentpostwidget','BB Niche Recent Post ',array(

            'description' => 'BB Niche Recent Post'

            ));
            }


            public function widget($args, $instance){

                $title = $instance['title'];
                $bbpostnum = $instance['bbpostnum'];

                echo $args['before_widget'] ;
                    echo $args['before_title'];
                        echo $title ;
                    echo $args['after_title'];





                $args = array(
                    'numberposts' =>1 ,
                    'offset' => 0,
                    'category' => 0,
                    'orderby' => 'post_date',
                    'order' => 'DESC',
                    'exclude' => '',
                    'meta_key' => '',
                    'meta_value' =>'',
                    'post_type' => 'post',
                    'post_status' => 'draft, publish, future, pending, private',
                    'suppress_filters' => true
                );

               $postnn = $args['numberposts'] = $bbpostnum  ;

                $recent_posts = wp_get_recent_posts( $args, ARRAY_A );

                echo  $postnn ;


                ?>



                    <?php


                    $recent_posts = wp_get_recent_posts();
                    foreach( $recent_posts as $recent  ){ ?>

                        <div class="bb-recent-post-widget-area">

                    <div class="bb-widget-recent-post-thumb"><?php echo get_the_post_thumbnail($recent['ID'], 'thumbnail'); ?></div>

                      <div class="bb_recent-widget_title">
                          <?php echo '<a href="' . get_permalink($recent["ID"]) . '">' .   $recent["post_title"].'</a> ';?>
                      </div>

                        </div>

                       <?php  }
                    wp_reset_query();?>

            <?php

                echo $args['after_widget'];



            } // public  function  widget here


            public  function  form($instance){

                $title = $instance['title'];
                $bbpostnum = $instance['bbpostnum'];

                ?>

                <p>
                    <label for="<?php echo $this->get_field_id('title'); ?>">Widget Title here</label>
                    <input class="widefat" type="text" name="<?php echo $this->get_field_name('title'); ?>"
                           id="<?php echo $this->get_field_id('title'); ?>" value="<?php echo $title ;?>"/>
                </p>

                <p>
                    <label for="<?php echo $this->get_field_id('bbpostnum'); ?>">Number of post</label>
                    <input class="widefat" type="number" name="<?php echo $this->get_field_name('bbpostnum'); ?>"
                           id="<?php echo $this->get_field_id('bbpostnum'); ?>" value="<?php echo $bbpostnum ;?>"/>
                </p>




    <?php


}





}//end


//widget register

        function bb_niche_widget_register(){

            register_widget('recentpostwidget');

        }

        add_action('widgets_init','bb_niche_widget_register');

?>