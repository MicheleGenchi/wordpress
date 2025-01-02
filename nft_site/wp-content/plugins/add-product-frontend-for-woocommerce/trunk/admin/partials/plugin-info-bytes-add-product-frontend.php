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
            <a href="<?php echo esc_url($bytes_product_frontend_info); ?>" id="switch_tabs_general_section" class="nav-tab nav-tab-active"><?php esc_html_e('Information', 'bytes_product_frontend'); ?></a>
            <a href="<?php echo esc_url($bytes_product_frontend_setting); ?>" id="switch_tabs_general_section" class="nav-tab"><?php esc_html_e('Settings', 'bytes_product_frontend'); ?></a>
            <a href="<?php echo esc_url($bytes_product_list); ?>" id="switch_tabs_general_section" class="nav-tab nav-tab-active"><?php esc_html_e('Product List', 'bytes_product_frontend'); ?></a>
        </h2>
    </div>
    <div class="entry-edit">
        <div class="container">            
            <div class="row shadow-sm m-3 pt-5 pb-3 px-5 bg-white rounded">
                <div class="col-md-3">
                    <img src="<?php echo APFFW_PLUGIN_DIR_URL.'admin/images/bytes-logo.svg'; ?>" alt="Bytes Add Product Frontend" />
                </div>
                <div class="col-md-6">
                    <div class="row align-items-center h-100">
                        <div class="col">
                            <h3><?php esc_html_e('Add Product Frontend', 'bytes_product_frontend'); ?></h3>
                            <p class="lead"><?php esc_html_e('Using frontend pages insert your product.', 'bytes_product_frontend'); ?></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3"></div>
            </div> 
            <div class="row shadow-sm m-3 pt-5 pb-3 px-5 bg-white rounded">
                <div class="col-md-12">
                    <h3><?php esc_html_e('All ready to go!', 'bytes_product_frontend'); ?></h3>
                    <p class="lead">Add this page (<b>Add Products Frontend</b>) inside Menus and start to use the plugin!</p>
                    <p class="lead"><a href="<?php echo esc_url(get_admin_url()); ?>nav-menus.php"><?php esc_html_e('Goto Menus', 'bytes_product_frontend'); ?></a></p>
                </div>
                <div class="col-md-3"></div>
            </div>
        </div>
    </div>
</div>