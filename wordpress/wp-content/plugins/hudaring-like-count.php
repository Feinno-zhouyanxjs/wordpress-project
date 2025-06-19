<?php
   /*
    Plugin Name: Hudaring Like Count
    */

   add_action('init', function () {
       register_post_meta(
           'post',
           'hudaring_like_count',
           [
               'show_in_rest' => true,
               'single' => true,
               'type' => 'integer',
               'default' => 0,
           ]
       );
   });