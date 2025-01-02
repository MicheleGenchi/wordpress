<?php
    $bytes_product_frontend_info = get_admin_url()."admin.php?page=bytes-product-frontend-info";
    $bytes_product_frontend_setting = get_admin_url()."admin.php?page=bytes-product-frontend-setting";  
    $bytes_product_list = get_admin_url()."admin.php?page=bytes-product-list";  
?>
<div class="wrap custom-user-wrap">
    <hr class="wp-header-end"> 
    <h1 class="wp-heading-inline"><?php esc_html_e('Add Product Frontend', 'bytes_product_frontend'); ?></h1>
    <div id="tabs" style="padding-bottom: 25px;">
        <h2 class="nav-tab-wrapper">
            <a href="<?php echo esc_url($bytes_product_frontend_info); ?>" id="switch_tabs_general_section" class="nav-tab"><?php esc_html_e('Information', 'bytes_product_frontend'); ?></a>
            <a href="<?php echo esc_url($bytes_product_frontend_setting); ?>" id="switch_tabs_general_section" class="nav-tab nav-tab-active"><?php esc_html_e('Settings', 'bytes_product_frontend'); ?></a>
            <a href="<?php echo esc_url($bytes_product_list); ?>" id="switch_tabs_general_section" class="nav-tab nav-tab-active"><?php esc_html_e('Product List', 'bytes_product_frontend'); ?></a>
        </h2>
    </div>
    <div class="entry-edit">
        <?php settings_errors(); ?>
        <form method="post" action="options.php">
            <?php
                /* add_settings_section callback is displayed here. For every new section we need to call settings_fields */
                settings_fields("header_section");
                /* all the add_settings_field callbacks is displayed here */
                do_settings_sections("plugin-options");
                /* Add the submit button to serialize the options */
                submit_button();
            ?>         
        </form>
    </div>
</div>