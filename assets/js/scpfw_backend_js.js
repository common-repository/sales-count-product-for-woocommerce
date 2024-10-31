jQuery(document).ready(function(){
    jQuery('#scpfw_sales_count_dropdown').on('change', function() {
      if ( this.value == 'color_style'){
        jQuery(".scpfw_sales_count_color").show(200);
      } else {
        jQuery(".scpfw_sales_count_color").hide(200);
      }
    });

    if(jQuery("#scpfw_sales_count_dropdown").val() == 'color_style'){
      jQuery(".scpfw_sales_count_color").show();
    }
    if(jQuery("#scpfw_sales_count_dropdown").val() == 'normal_text'){
      jQuery(".scpfw_sales_count_color").hide();
    }

    jQuery('#scpfw_sales_count_show_dropdown').on('change', function() {
      if ( this.value == 'show_count_both'){
        jQuery(".show_count_position_product_page").show(200);
        jQuery(".show_count_position_shop_page").show(200);
      } else if ( this.value == 'show_count_shop'){
        jQuery(".show_count_position_shop_page").show(200);
        jQuery(".show_count_position_product_page").hide(200);
      } else if ( this.value == 'show_count_product'){
        jQuery(".show_count_position_product_page").show(200);
        jQuery(".show_count_position_shop_page").hide(200);
      }
    });

    if(jQuery("#scpfw_sales_count_show_dropdown").val() == 'show_count_both'){
      jQuery(".show_count_position_product_page").show();
        jQuery(".show_count_position_shop_page").show();
    }
    if(jQuery("#scpfw_sales_count_show_dropdown").val() == 'show_count_shop'){
      jQuery(".show_count_position_shop_page").show();
      jQuery(".show_count_position_product_page").hide();
    }
    if(jQuery("#scpfw_sales_count_show_dropdown").val() == 'show_count_product'){
      jQuery(".show_count_position_product_page").show();
      jQuery(".show_count_position_shop_page").hide();
    }

    if(jQuery(".scpfw_days_count_checkbox").is(":checked")){ 
        jQuery(".scpfw_days_count_section").show();
    }else{
        jQuery(".scpfw_days_count_section").hide();
    }
    jQuery(".scpfw_days_count_checkbox").click(function() {
        if(jQuery(this).is(":checked")) {
            jQuery(".scpfw_days_count_section").fadeIn(300);
        } else {
            jQuery(".scpfw_days_count_section").fadeOut(200);
        }
    });
});