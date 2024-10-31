<?php

if (!defined('ABSPATH'))
  exit;

if (!class_exists('SCPFW_admin_menu')) {

    class SCPFW_admin_menu {

        protected static $SCPFW_instance;

        function SCPFW_submenu_page() {
            add_menu_page(__( 'woocommerce Sales Count Product', 'Sales Count Product for WooCommerce' ),'Sales Count Product settings','manage_options','sales-count-product-settings',array($this, 'SCPFW_callback'));
        }

        function SCPFW_callback(){
        	global $scpfw_comman;
        	?>
        	<div class="scpfw-container">
	            <form method="post" >
	            	<?php wp_nonce_field( 'scpfw_nonce_action', 'scpfw_nonce_field' ); ?>
	            	<div class="wrap">
	                	<h2><?php echo __('Sales Count Product for WooCommerce','sales-count-product-for-woocommerce');?></h2>
	            	</div>
	            	<div class="scpfw-table-main">
	            		<h2 class="scpfw_heading"><?php echo __('General Setting','sales-count-product-for-woocommerce');?></h2>
		            	<table class="data_table">
	                        <tbody>    
	                            <tr>
	                                <th scope="row">
	                                	<label><?php echo __('Enable/Disable Sales Count','sales-count-product-for-woocommerce');?></label>
	                                </th>
	                                <td>
	                                	<input type="checkbox" name="scpfw_comman[scpfw_enable_disable_sales_count]" value="yes"<?php if($scpfw_comman['scpfw_enable_disable_sales_count'] == 'yes'){echo "checked";}?>>
	                                </td>
	                            </tr>
	                            <tr>
	                                <th scope="row">
	                                	<label><?php echo __('Display On Pages','sales-count-product-for-woocommerce');?></label>
	                                </th>
	                                <td class="scpfw_visibility_on_pages">
	                                	<div>
	                                		<input type="checkbox" name="scpfw_display_shop_page" value="yes" disabled>
		                                	<label><?php echo __('Display On Shop Page','sales-count-product-for-woocommerce');?></label></br>
		                                	<input type="checkbox" name="scpfw_display_product_page" value="yes" checked disabled>
		                                	<label><?php echo __('Display On Product Page','sales-count-product-for-woocommerce');?></label></br>
		                                	<input type="checkbox" name="scpfw_display_category_page" value="yes" disabled>
		                                	<label><?php echo __('Display On Category Page','sales-count-product-for-woocommerce');?></label></br>
		                                	<input type="checkbox" name="scpfw_display_tag_page" value="yes" disabled>
		                                	<label><?php echo __('Display On Tag Page','sales-count-product-for-woocommerce');?></label>
	                                	</div>
	                                	<div>
	                                		<label class="scpfw_pro_link">Only available in pro version <a href="https://xthemeshop.com/product/sales-count-product-for-woocommerce-pro/" target="_blank">link</a></label>
	                                	</div>
	                                </td>
	                            </tr>
	                            <tr class="show_count_position_shop_page">
	                                <th scope="row">
	                                	<label><?php echo __('Show position on shop page','sales-count-product-for-woocommerce');?></label>
	                                </th>
	                                <td>
	                                	<select name="scpfw_show_position_shop_page" class="regular-text" disabled>
	                                		<option value=""><?php echo __('--- Select Option ---','sales-count-product-for-woocommerce');?></option>
	                                		<option value="1"><?php echo __('Above product title','sales-count-product-for-woocommerce');?></option>
	                                		<option value="10"><?php echo __('After product title','sales-count-product-for-woocommerce');?></option>
	                                	</select>
	                                	<label class="scpfw_pro_link">Only available in pro version <a href="https://xthemeshop.com/product/sales-count-product-for-woocommerce-pro/" target="_blank">link</a></label>
	                                </td>
	                            </tr>
	                            <tr class="show_count_position_product_page">
	                                <th scope="row">
	                                	<label><?php echo __('Show position on product page','sales-count-product-for-woocommerce');?></label>
	                                </th>
	                                <td>
	                                	<select name="scpfw_comman[scpfw_show_position_single_ppage]" class="regular-text">
	                                		<option value="1" <?php if($scpfw_comman['scpfw_show_position_single_ppage'] == "1"){echo "selected";}?>><?php echo __('Above product title','sales-count-product-for-woocommerce');?></option>
	                                		<option value="5" <?php if($scpfw_comman['scpfw_show_position_single_ppage'] == "5"){echo "selected";}?>><?php echo __('After product title','sales-count-product-for-woocommerce');?></option>
	                                		<option value="10" <?php if($scpfw_comman['scpfw_show_position_single_ppage'] == "10"){echo "selected";}?>><?php echo __('Above product short discription','sales-count-product-for-woocommerce');?></option>
	                                		<option value="20" <?php if($scpfw_comman['scpfw_show_position_single_ppage'] == "20"){echo "selected";}?>><?php echo __('Above add to cart','sales-count-product-for-woocommerce');?></option>
	                                		<option value="30" <?php if($scpfw_comman['scpfw_show_position_single_ppage'] == "30"){echo "selected";}?>><?php echo __('After add to cart','sales-count-product-for-woocommerce');?></option>
	                                	</select>
	                                </td>
	                            </tr>
	                            <tr>
	                                <th scope="row">
	                                	<label><?php echo __('Sales count type','sales-count-product-for-woocommerce');?></label>
	                                </th>
	                                <td>
	                                	<select name="scpfw_comman[scpfw_sales_count_type]"  class="regular-text" id="scpfw_sales_count_dropdown">
	                                		<option value="color_style"<?php if($scpfw_comman['scpfw_sales_count_type'] == 'color_style'){echo "selected";}?>><?php echo __('Color style','sales-count-product-for-woocommerce');?></option>
	                                		<option value="normal_text"<?php if($scpfw_comman['scpfw_sales_count_type'] == 'normal_text'){echo "selected";}?>><?php echo __('Normal text','sales-count-product-for-woocommerce');?></option>
	                                	</select>
	                                </td>
	                            </tr> 
	                            <tr class="scpfw_sales_count_color">
	                                <th scope="row">
	                                	<label><?php echo __('Text color','sales-count-product-for-woocommerce');?></label>
	                                </th>
	                                <td>
	                                	<input type="text" class="color-picker" data-alpha="true" data-default-color="" name="scpfw_comman[scpfw_sales_count_text_color]" value="<?php echo $scpfw_comman['scpfw_sales_count_text_color'];?>"/>
	                                </td>
	                            </tr>
	                            <tr class="scpfw_sales_count_color">
	                                <th scope="row">
	                                	<label><?php echo __('Count color','sales-count-product-for-woocommerce');?></label>
	                                </th>
	                                <td>
	                                	<input type="text" class="color-picker" data-alpha="true" data-default-color="" name="scpfw_comman[scpfw_sales_count_color]" value="<?php echo $scpfw_comman['scpfw_sales_count_color'];?>"/>
	                                </td>
	                            </tr>
	                            <tr class="scpfw_sales_count_color">
	                                <th scope="row">
	                                	<label><?php echo __('Background color','sales-count-product-for-woocommerce');?></label>
	                                </th>
	                                <td>
	                                	<input type="text" class="color-picker" data-alpha="true" data-default-color="" name="scpfw_comman[scpfw_sales_count_background_color]" value="<?php echo $scpfw_comman['scpfw_sales_count_background_color'];?>"/>
	                                </td>
	                            </tr>
	                            <tr>
	                                <th scope="row">
	                                	<label><?php echo __('Total Sales count Enable/Disable','sales-count-product-for-woocommerce');?></label>
	                                </th>
	                                <td>
	                                	<input type="checkbox"  name="scpfw_comman[scpfw_sales_count_enable_disable]" value="yes" <?php if($scpfw_comman['scpfw_sales_count_enable_disable'] == 'yes'){echo "checked";}?>>
	                                </td>
	                            </tr>
	                            <tr>
	                                <th scope="row">
	                                	<label><?php echo __('Sales count text','sales-count-product-for-woocommerce');?></label>
	                                </th>
	                                <td>
	                                	<input type="text" class="regular-text" name="scpfw_comman[scpfw_sales_count_text]" value="<?php echo $scpfw_comman['scpfw_sales_count_text'];?>">
	                                </td>
	                            </tr> 
	                            <tr>
	                                <th scope="row">
	                                	<label><?php echo __('Sales In Days Enable/Disable','sales-count-product-for-woocommerce');?></label>
	                                </th>
	                                <td>
	                                	<input type="checkbox" class="scpfw_days_count_checkbox" name="scpfw_comman[scpfw_sales_in_days_enable_disable]" value="yes" <?php if($scpfw_comman['scpfw_sales_in_days_enable_disable'] == 'yes'){echo "checked";}?>>
	                                </td>
	                            </tr>
	                            <tr class="scpfw_days_count_section">
	                                <th scope="row">
	                                	<label><?php echo __('Select Days For Sold In Days','sales-count-product-for-woocommerce');?></label>
	                                </th>
	                                <td>
	                                	<input type="text" class="regular-text" name="scpfw_comman[scpfw_sales_in_days_text]" value="<?php echo $scpfw_comman['scpfw_sales_in_days_text'];?>">
	                                	<span class="scpfw_discription">Use tag <strong>{day}</strong> for sales in days</span>
	                                </td>
	                            </tr>  
	                            <tr class="scpfw_days_count_section">
	                                <th scope="row">
	                                	<label><?php echo __('Select Days For Sales Count','sales-count-product-for-woocommerce');?></label>
	                                </th>
	                                <td>
	                                	<input type="number" class="regular-text" name="scpfw_comman[scpfw_sales_in_days]" value="<?php echo $scpfw_comman['scpfw_sales_in_days'];?>">
	                                </td>
	                            </tr>  
	                            <tr class="scpfw_days_count_section">
	                            	<th scope="row">
	                                	<label><?php echo __('Maximum Limit to Show Sales Count','sales-count-product-for-woocommerce');?></label>
	                                </th>
	                                <td>
	                                	<input type="number" class="regular-text" name="scpfw_comman[scpfw_maximum_limit_to_show]" value="<?php echo $scpfw_comman['scpfw_maximum_limit_to_show'];?>">
	                                </td>
	                            <tr>
	                            <tr>
	                                <th scope="row">
	                                	<label><?php echo __('Display count text for 0 sales','sales-count-product-for-woocommerce');?></label>
	                                </th>
	                                <td>
	                                	<input type="checkbox" name="scpfw_comman[scpfw_display_count_0text]" value="yes" checked disabled>
	                                	<label><?php echo __('Enable/Disable','sales-count-product-for-woocommerce');?></label>
	                                	<label class="scpfw_pro_link">Only available in pro version <a href="https://xthemeshop.com/product/sales-count-product-for-woocommerce-pro/" target="_blank">link</a></label>
	                                </td>
	                            </tr>
	                            <tr>
	                                <th scope="row">
	                                	<label><?php echo __('Text for 0 sales products','sales-count-product-for-woocommerce');?></label>
	                                </th>
	                                <td>
	                                	<input type="text" name="scpfw_comman[scpfw_0sales_text]" value="<?php echo $scpfw_comman['scpfw_0sales_text'];?>">
	                                </td>
	                            </tr>
	                        </tbody>
	                    </table>
	                    <p class="scpfw_notes"><strong>Note : </strong> You can Use Shortcode <strong><code>[sales_count_product]</code></strong> in product description any way position on product page and remind only use in product page.</p>
	                </div>
	                <div class="submit_button">
	                    <input type="hidden" name="scpfw_form_submit" value="scpfw_save_option">
	                    <input type="submit" value="Save changes" name="submit" class="button-primary" id="scpfw-btn-space">
	                </div>              
	            </form>   
	        </div>
	        <?php
        }


        function SCPFW_save_option(){
        	if( current_user_can('administrator') ) {
	            if(isset($_REQUEST['scpfw_form_submit']) && $_REQUEST['scpfw_form_submit'] == 'scpfw_save_option'){
	    		 	if(!isset( $_POST['scpfw_nonce_field'] ) || !wp_verify_nonce( $_POST['scpfw_nonce_field'], 'scpfw_nonce_action' ) ){
	                    print 'Sorry, your nonce did not verify.';
	                    exit;
	                }else{
	                    $isecheckbox = array(
	                    	'scpfw_enable_disable_sales_count',
	                    	'scpfw_sales_in_days_enable_disable',
	                    	'scpfw_sales_count_enable_disable',
	                    	'scpfw_display_count_0text',
	                    );
	                    foreach ($isecheckbox as $key_isecheckbox => $value_isecheckbox) {
	                        if(!isset($_REQUEST['scpfw_comman'][$value_isecheckbox])){
	                            $_REQUEST['scpfw_comman'][$value_isecheckbox] ='no';
	                        }
	                    }	
	                    foreach ($_REQUEST['scpfw_comman'] as $key_scpfw_comman => $value_scpfw_comman) {
	                        update_option($key_scpfw_comman, sanitize_text_field($value_scpfw_comman), 'yes');
	                    }                   
		                wp_redirect( admin_url( '/admin.php?page=sales-count-product-settings' ) );
		                exit();     
	                } 
	            }
	        }
        }

        function init() {
        	add_action( 'admin_menu',  array($this, 'SCPFW_submenu_page'));
        	add_action( 'init',  array($this, 'SCPFW_save_option'));

        }		

        public static function SCPFW_instance() {
            if (!isset(self::$SCPFW_instance)) {
                self::$SCPFW_instance = new self();
                self::$SCPFW_instance->init();
            }
            return self::$SCPFW_instance;
        }
    }
    SCPFW_admin_menu::SCPFW_instance();
}

?>