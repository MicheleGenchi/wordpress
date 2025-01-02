<?php
// Exit if accessed directly
if (!defined('ABSPATH')) exit;

// BEGIN ENQUEUE PARENT ACTION
// AUTO GENERATED - Do not modify or remove comment markers above or below:

if (!function_exists('chld_thm_cfg_locale_css')) :
    function chld_thm_cfg_locale_css($uri)
    {
        if (empty($uri) && is_rtl() && file_exists(get_template_directory() . '/rtl.css'))
            $uri = get_template_directory_uri() . '/rtl.css';
        return $uri;
    }
endif;
add_filter('locale_stylesheet_uri', 'chld_thm_cfg_locale_css');

if (!function_exists('child_theme_configurator_css')) :
    function child_theme_configurator_css()
    {
        wp_enqueue_style('chld_thm_cfg_child', trailingslashit(get_stylesheet_directory_uri()) . 'style.css', array());
    }
endif;
add_action('wp_enqueue_scripts', 'child_theme_configurator_css', 10);

// END ENQUEUE PARENT ACTION

// To enable the use, add this in your *functions.php* file:
add_filter('widget_text', 'do_shortcode');

function wpb_date_today($atts, $content = null)
{
    $fmt = new \IntlDateFormatter('it_IT', NULL, NULL);
    $atts = shortcode_atts(array(
        'format' => '',
    ), $atts);
    $date_time = '';
    if ($atts['format'] == '') {
        $date_time .= date(get_option('date_format'));
    } else {
        $fmt->setPattern($atts['format']);
        $date_time .= $date = wp_date(__('l, j F Y', 'textdomain'));
        //$fmt->format(new \DateTime()); 
        $date_time = ucwords($date_time);
    }
    return $date_time;
}

add_shortcode('date-today', 'wpb_date_today');



function wpdocs_check_logged_in()
{
    $current_user = wp_get_current_user();
    if (!($current_user instanceof WP_User))
        return "no user";
    return $current_user->user_login;
}
add_shortcode('current-user', 'wpdocs_check_logged_in');

function wpdocs_check_role_logged_in()
{
    if (is_user_logged_in()) {
        $user = wp_get_current_user();
        $roles = (array) $user->roles;
        //return $roles; // This will returns an array
        return $roles[0];
    } else {
        return "";
    }
}
add_shortcode('role-user', 'wpdocs_check_role_logged_in');


function pn_ajaxurl_head()
{
    echo '<script type="text/javascript">var ajaxurl = "' . admin_url('admin-ajax.php') . '";</script>';
}
add_action('wp_head', 'pn_ajaxurl_head', 99);

function misha_uploader_callback()
{
    $current_user = wp_get_current_user();

    $user = $current_user->user_login;
    $roles = (array) $user->roles;
    $role = $roles[0];
    $date = date('d-mm-Y');
    return
        '
        <br>
        <form id="myform" class="form" method="post" action="" enctype="multipart/form-data">
            <div class="field"><label for="user">Utente:</label><strong><input id="user" disabled value="' . $user . '"></strong></div>
            <div class="field"><label for="data">Data:</label><strong><input id="data" disabled value="' . Date("d-m-Y") . '"></strong></div>
            <div class="field"><label for="file">File:</label><strong><input id="file" value="" title=" " type="file" name="myfilefield" class="form-control" value=""></strong></div>
            ' . wp_nonce_field("myuploadnonce", "mynonce") . ' 
            <button type="submit" class="btn btn-primary">SALVA</button><br>
            <p id="confirm">Risultato: </p>
        </form>
        <br>
        <script>
        jQuery(document).ready(function($) {
            var myForm = $("#myform");
            var user=$("#user").val();
            var pagefile="http://localhost:8004/?page_id=142#elf_l2_Lw";
            $("#divform").hide();

            let temp = "";
            temp =$(".user_role").text();
            let role =temp.split("/")[1].toString().toLowerCase().trim();
            console.log("role :"+role);
            if (role=="administrator" || role=="editor") {
                $(".gestore").show();
            } else {
                $(".gestore").hide();
            }

            $(".aggiungi").click(function(){
                if (user==="") {
                    console.log("no user");
                    $("#confirm").append("NO USER");  
                    return;
                } 
                $("section.form").toggle();
            });

            $(".gestore").click(function(){
                window.location.replace(pagefile);
            });
            

            $(myForm).submit(function(e) {
                var filename=$("#file").val(); 
   
                if (user==="") {
                    console.log("no user");
                    $("#confirm").append("NO USER");  
                    return;
                }

                if (filename=== "") {
                    console.log("no file");
                    $("#confirm").append("NO FILE");  
                    return;
                }

                //Prevent normal form submission
                e.preventDefault();

                //Get the form data and store in a variable
                var myformData = new FormData(myForm[0]);

                //Add our own action to the data
                //action is where we will be hooking our php function
                myformData.append("action", "pn_wp_frontend_ajax_upload");

                //Prepare and send the call
                $.ajax({
                    type: "POST",
                    data: myformData,
                    dataType: "json",
                    url: ajaxurl, //basename."/"."file-manager".user."/",
                    cache: false,
                    processData: false,
                    contentType: false,
                    enctype: "multipart/form-data",
                    success: function(data, textStatus, jqXHR) {
                        document.getElementById("confirm").insertAdjacentText("beforeend", jqXHR.responseText);
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        //if fails     
                        document.getElementById("confirm").insertAdjacentText("beforeend", jqXHR.responseText);
                        console.log(jqXHR);
                    }
                });
            });
        });
    </script>';
}

add_shortcode('file_uploader', 'misha_uploader_callback');

function pn_upload_files()
{

    //Do the nonce security check
    if (!isset($_POST['mynonce']) || !wp_verify_nonce($_POST['mynonce'], 'myuploadnonce')) {
        //Send the security check failed message
        _e('Security Check Failed', 'pixelnet');
    } else {
        //Security check cleared, let's proceed
        //If your form has other fields, process them here.

        if (isset($_FILES) && !empty($_FILES)) {

            //Include the required files from backend
            require_once(ABSPATH . 'wp-admin/includes/image.php');
            require_once(ABSPATH . 'wp-admin/includes/file.php');
            require_once(ABSPATH . 'wp-admin/includes/media.php');

            //Check if uploaded file doesn't contain any error
            if (isset($_FILES['myfilefield']['error']) && $_FILES['myfilefield']['error'] == 0) {
                /*
                 * 'myfilefield' is the name of the file upload field.
                 * Replace the second parameter (0) with the post id
                 * you want your file to be attached to
                 */
                $file_id = media_handle_upload('myfilefield', 0);

                if (!is_wp_error($file_id)) {
                    /*
                     * File uploaded successfully and you have the attachment id
                     * Do your stuff with the attachment id here
                    */
                }
            }
        }

        //Send the sucess message
        _e('Success', 'pixelnet');
    }
    wp_die();
}

//Hook our function to the action we set at jQuery code
add_action('wp_ajax_pn_wp_frontend_ajax_upload', 'pn_upload_files');
add_action('wp_ajax_nopriv_pn_wp_frontend_ajax_upload', 'pn_upload_files');

function getCopyright() {
    return 
    '<p id="footer-copyright">Copyright &copy; '.Date('Y').' - '.get_bloginfo( 'name' ).'  powered by <a href="https://www.tedescoconsulting.it">Tedesco Consulting</a>';  
}

add_shortcode('copyright', 'getCopyright');