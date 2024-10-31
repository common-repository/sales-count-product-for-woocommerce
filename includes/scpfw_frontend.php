<?php

if (!defined('ABSPATH'))
  exit;

if (!class_exists('SCPFW_frontend_menu')) {

    class SCPFW_frontend_menu {

        protected static $SCPFW_instance;

        function day_count_quentity(){
            global $scpfw_comman;
            $count_days = $scpfw_comman['scpfw_sales_in_days'];
            
            $query = new WC_Order_Query( array(
                'limit' => -1,
                'orderby' => 'date',
                'order' => 'DESC',
                'return' => 'ids',
                'status'=> array( 'wc-completed','wc-processing' ),
            ) );
            $orders = $query->get_orders();
            $quantity = 0;
            foreach ($orders as $order_id) {
               
                $all_order = wc_get_order($order_id);
                $order_date = $all_order->get_data()['date_created']->date('Y-m-d');
                $date = strtotime("-".$count_days." day", strtotime(date('Y-m-d')));
                $start_date = strtotime(date('Y-m-d', $date));
                $order_date_current = strtotime($order_date);
                $end_date = strtotime(date('Y-m-d'));
                if ( $start_date <= $order_date_current || $order_date_current >= $end_date ) {
                    foreach ($all_order->get_items() as $item_key => $item ){
                        $item_data    = $item->get_data();
                        $product_id   = $item_data['product_id'];
                        if ($product_id == get_the_id()) {
                            $quantity += $item->get_quantity();
                        }
                    }
                }
            }
            return $quantity;
        }

        function show_sales_count_comman_function(){
            global $product,$scpfw_comman;
            $count_days = $scpfw_comman['scpfw_sales_in_days'];
            $quantity = $this->day_count_quentity();
            $sales_count = $product->get_total_sales();
            if ( !empty($sales_count) && $sales_count > 0) {
                $salecount_shop = false;                      
                if(!empty($scpfw_comman['scpfw_maximum_limit_to_show']) && $scpfw_comman['scpfw_maximum_limit_to_show'] <= $sales_count ){
                    $salecount_shop = true;
                    $set_radiuse = "set_radiuse";
                }
                if($scpfw_comman['scpfw_sales_count_type'] == 'color_style'){
                    ?>
                    <div class="scpfw_product_sales_counter">
                        <div class="scpfw_product_sales_counter_inner <?php if($salecount_shop == true){echo $set_radiuse;}?>" style="background-color: <?php echo $scpfw_comman['scpfw_sales_count_background_color'];?>;">
                            <?php  if ($scpfw_comman['scpfw_sales_count_enable_disable'] == 'yes'  ) {  ?>
                                <span class="scpfw_sales_counter_text" style="color:<?php echo $scpfw_comman['scpfw_sales_count_text_color'];?>;"><?php echo sprintf( __( ''. $scpfw_comman['scpfw_sales_count_text'].' %s', 'woocommerce' ),':');?></span>
                                <span class="scpfw_sales_counter" style="color: <?php echo $scpfw_comman['scpfw_sales_count_color'];?>;"><?php echo $sales_count;?> Items</span>
                            <?php } ?>
                            <?php
                            if ($quantity != 0 && $scpfw_comman['scpfw_sales_in_days_enable_disable'] == 'yes' ) {
                                ?>
                                <div>
                                    <span class="scpfw_sales_counter_text_days" style="color:<?php echo $scpfw_comman['scpfw_sales_count_text_color'];?>;"><?php echo str_replace("{day}",$count_days,$scpfw_comman['scpfw_sales_in_days_text'])." : ";?></span>
                                    <span class="scpfw_sales_counter_days" style="color: <?php echo $scpfw_comman['scpfw_sales_count_color'];?>;"><?php echo $quantity;?> Items</span>
                                </div>
                            <?php }   ?>
                        </div>
                    </div>
                    <?php
                }elseif($scpfw_comman['scpfw_sales_count_type'] == 'normal_text'){ ?>
                    <div class="scpfw_product_sales_counter">
                        <div class="scpfw_product_sales_counter_inner <?php if($salecount_shop == true){echo  $set_radiuse;}?>" style="padding: 8px !important;">
                            <?php  if ($scpfw_comman['scpfw_sales_count_enable_disable'] == 'yes' ) {  ?>
                                <span class="scpfw_sales_counter_text"><?php echo sprintf( __( ''. $scpfw_comman['scpfw_sales_count_text'].' %s', 'woocommerce' ),':');?></span>
                                <span class="scpfw_sales_counter"><?php echo $sales_count;?> Items</span>
                            <?php } ?>
                            <?php if ($quantity != 0 && $scpfw_comman['scpfw_sales_in_days_enable_disable'] == 'yes' ) {  ?>
                                <div>
                                    <span class="scpfw_sales_counter_text_days"><?php echo str_replace("{day}",$count_days,$scpfw_comman['scpfw_sales_in_days_text'])." : ";?></span>
                                    <span class="scpfw_sales_counter_days"><?php echo $quantity;?> Items</span>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                    <?php
                }
            }else{
                if ($scpfw_comman['scpfw_0sales_text'] == '') {
                    $scpfw_0sales_text = 'You are the first :)';
                }else{
                    $scpfw_0sales_text = $scpfw_comman['scpfw_0sales_text'];
                }
                if($scpfw_comman['scpfw_sales_count_type'] == 'color_style'){
                    ?>
                    <div class="scpfw_product_empty_sales">
                        <p class="scpfw_empty_sales_text" style="background-color: <?php echo $scpfw_comman['scpfw_sales_count_background_color'];?>;color:<?php echo $scpfw_comman['scpfw_sales_count_text_color'];?>;"><?php echo $scpfw_0sales_text;?></p>
                    </div>
                    <?php
                }elseif($scpfw_comman['scpfw_sales_count_type'] == 'normal_text'){
                    ?>
                    <div class="scpfw_product_empty_sales">
                        <p class="scpfw_empty_sales_text"><?php echo $scpfw_0sales_text;?></p>
                    </div>
                    <?php
                }
            }
        }


        function show_sales_count_single_product() {
            $this->show_sales_count_comman_function();
        }

        function show_sales_count_shop(){
            $this->show_sales_count_comman_function();
        }

        function show_sales_count_shortcode(){
            $this->show_sales_count_comman_function();
        }

        function init() {
            global $scpfw_comman;
            if ($scpfw_comman['scpfw_enable_disable_sales_count'] == 'yes') {
                $single_position = $scpfw_comman['scpfw_show_position_single_ppage'];
                add_action( 'woocommerce_single_product_summary', array($this,'show_sales_count_single_product') , $single_position );
                add_shortcode('sales_count_product' , array($this,'show_sales_count_shortcode'));                
            }
        }		

        public static function SCPFW_instance() {
            if (!isset(self::$SCPFW_instance)) {
                self::$SCPFW_instance = new self();
                self::$SCPFW_instance->init();
            }
            return self::$SCPFW_instance;
        }
    }
    SCPFW_frontend_menu::SCPFW_instance();
}

?>