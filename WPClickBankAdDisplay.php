<?php
/*
  Plugin Name: WP ClickBank Ad Display
  Plugin URI: http://wprocks.biswajitdey.com
  Description: This plugin creates an widget to display CliclBank keyword sensitive ad on your wordpress blog. Founded in 1998, ClickBank is a secure online retail outlet for more than 70,000 digital product vendors and 110,000 active affiliate marketers. This widget will help you to maximize your earnings from ClickBank ads.
  Version: 1.5
  Author: Biswajit Dey
  Author URI: http://wprocks.biswajitdey.com
 *
 *  This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.
 */
add_action('widgets_init', 'ClickBank_load_advertisement_widgets');

function ClickBank_load_advertisement_widgets() {
    register_widget('ClickBankAdDisplayWidget');
}

class ClickBankAdDisplayWidget extends WP_Widget {

    function ClickBankAdDisplayWidget() {
        $widget_ops = array('classname' => 'ClickBank', 'description' => __('Use this widget to display ClickBank contextual Ad. For details, visit: http://wprocks.biswajitdey.com', 'ClickBank'));
        $control_ops = array('width' => 200);
        $this->WP_Widget('ClickBank-widget', __('ClickBank Ad Display', 'ClickBank'), $widget_ops, $control_ops);
        //   parent::WP_Widget( false, $name = 'ClickBank Ad Display',$widget_ops);
    }

    function widget($args, $instance) {
        extract($args);
        $title = apply_filters('widget_title', $instance['title']);
        $user = $instance['name'];
        $height = $instance['height'];
        $width = $instance['width'];
        $keywords = $instance ['keywords'];
        $rows = (($height * $width) / 100) * 3 / 400;
        echo $before_widget;
        if ($title)
            echo $before_title . $title . $after_title;
        if (empty($user)) {
            $user = biswajit13;
        };
?>
        <script type="text/javascript">
            hopfeed_template='';
            hopfeed_align='left';
            hopfeed_type='IFRAME';
            hopfeed_affiliate_tid='';
            hopfeed_affiliate='<?php echo $user; ?>';
            hopfeed_fill_slots='true';
            hopfeed_height='<?php echo $height ?>';
            hopfeed_width='<?php echo $width ?>';
            hopfeed_cellpadding='1';
            hopfeed_rows='<?php echo $rows ?>';
            hopfeed_cols='1';
            hopfeed_font='Verdana, Arial, Helvetica, Sans Serif';
            hopfeed_font_size='8pt';
            hopfeed_font_color='000000';
            hopfeed_border_color='FFFFFF';
            hopfeed_link_font_color='3300FF';
            hopfeed_link_font_hover_color='3300FF';
            hopfeed_background_color='FFFFFF';
            hopfeed_keywords='<?php echo $keywords ?>';
            hopfeed_path='http://<?php echo $user; ?>.hopfeed.com';
            hopfeed_link_target='_blank';
        </script>
        <script type="text/javascript" src='http://<?php echo $user; ?>.hopfeed.com/script/hopfeed.js'></script>
<?php
        echo $after_widget;
    }

    function update($new_instance, $old_instance) {
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['name'] = strip_tags($new_instance['name']);
        $instance['height'] = strip_tags($new_instance['height']);
        $instance['width'] = strip_tags($new_instance['width']);
        $instance['keywords'] = strip_tags($new_instance['keywords']);
        return $instance;
    }

    function form($instance) {
        $defaults = array('title' => __('Ads by ClickBank', 'ClickBank'), 'name' => __('biswajit13', 'ClickBank'), 'height' => __('600', 'ClickBank'), 'width' => __('200', 'ClickBank'));
        $instance = wp_parse_args((array) $instance, $defaults); ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'hybrid'); ?></label>
            <input id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>" style="width:100%;" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('name'); ?>"><?php _e('Your clickbank ID:', 'ClickBank'); ?></label>
            <input id="<?php echo $this->get_field_id('name'); ?>" name="<?php echo $this->get_field_name('name'); ?>" value="<?php echo $instance['name']; ?>" style="width:100%;" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('height'); ?>"><?php _e('Height of the Widget:', 'ClickBank'); ?></label>
            <input id="<?php echo $this->get_field_id('height'); ?>" name="<?php echo $this->get_field_name('height'); ?>" value="<?php echo $instance['height']; ?>" style="width:100%;" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('width'); ?>"><?php _e('Width of the Widget:', 'ClickBank'); ?></label>
            <input id="<?php echo $this->get_field_id('width'); ?>" name="<?php echo $this->get_field_name('width'); ?>" value="<?php echo $instance['width']; ?>" style="width:100%;" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('keywords'); ?>"><?php _e('Keywords (seperated by comma):', 'ClickBank'); ?></label>
            <input id="<?php echo $this->get_field_id('keywords'); ?>" name="<?php echo $this->get_field_name('keywords'); ?>" value="<?php echo $instance['keywords']; ?>" style="width:100%;" />
        </p>
<?php
    }

}

// visit http://wprocks.biswajitdey.com for more information
?>