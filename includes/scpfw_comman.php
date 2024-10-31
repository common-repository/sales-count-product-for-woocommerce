<?php
if (!defined('ABSPATH'))
  exit;

if (!class_exists('SCPFW_comman')) {

    class SCPFW_comman {

        protected static $instance;

        public static function instance() {
            if (!isset(self::$instance)) {
                self::$instance = new self();
                self::$instance->init();
            }
             return self::$instance;
        }
         function init() {
            global $scpfw_comman;
            $optionget = array(
                'scpfw_enable_disable_sales_count' => 'yes',
                'scpfw_show_position_single_ppage' => '10',
                'scpfw_sales_count_type' => 'color_style',
                'scpfw_sales_count_text_color' => '#000000',
                'scpfw_sales_count_color' => '#a46497',
                'scpfw_sales_count_background_color' => '#eaeff3',
                'scpfw_sales_count_text' => 'Total Sales',
                'scpfw_sales_in_days_enable_disable' => 'yes',
                'scpfw_sales_in_days_text' => 'Sold In Last {day} Days',
                'scpfw_sales_in_days' => '7',
                'scpfw_sales_count_enable_disable'=>'yes',
                'scpfw_maximum_limit_to_show' => '20',
                'scpfw_0sales_text' => 'You are the first :)',
            );
           
            foreach ($optionget as $key_optionget => $value_optionget) {
               $scpfw_comman[$key_optionget] = get_option( $key_optionget,$value_optionget );
            }
        }
    }

    SCPFW_comman::instance();
}
?>