<?php
    /*
    Plugin Name: Zedna Universal Ads
    Plugin URI: https://profiles.wordpress.org/zedna#content-plugins
    Description: Insert Google Adsense into widget area and don´t worry about any settings. You can also insert a shortcode to your content and set ad format, but usually it´s responsive.
    Version: 1.0
    Author: Radek Mezulanik
    Author URI: https://www.mezulanik.cz
    License: GPL2
    */

function gau_init() {
     global $wp_query;
    $gau_pub = get_option( 'gau_pub' );
 }
 add_action('template_redirect', 'gau_init');


//Add admin page
add_action('admin_menu', 'gau_setttings_menu');
 
function gau_setttings_menu(){
    global $lmpImagePath;
 $lmpImagePath = get_option('siteurl').'/wp-content/plugins/'.dirname(plugin_basename(__FILE__));
        add_menu_page( 'Universal Ads', 'Universal Ads', 'manage_options', 'gau', 'gau_settings_init',$lmpImagePath.'/img/gau-ico.png'  );
  // Call update_spamfck function to update database
  add_action( 'admin_init', 'update_gau' );
}

// Create function to register plugin settings in the database
if( !function_exists("update_gau") )
{
function update_gau() {
  register_setting( 'gau-settings', 'gau_pub' );
}
}
 
function gau_settings_init(){
$gau_pub = (get_option('gau_pub') != '') ? get_option('gau_pub') : '9508802362155093';
?>

    <h1>Google Adsense Universal</h1>
    <form method="post" action="options.php">
        <?php settings_fields( 'gau-settings' ); ?>
            <?php do_settings_sections( 'gau-settings' ); ?>
                <table class="form-table">
                    <tr valign="top">
                        <th scope="row">Google Adsense pub-id:</th>
                        <td>pub-
                            <input type="text" name="gau_pub" value="<?php echo $gau_pub;?>" />
                        </td>
                    </tr>
                    <?php if($settings['ga_pub'] == '' ): ?>
                        <tr valign="top">
                            <td scope="row" colspan="2">You can get your ID on <a href="https://www.google.com/adsense/app?hl=cs#main/accountInformation" target="_blank">https://www.google.com/adsense/app?hl=cs#main/accountInformation</a></td>
                        </tr>
                        <?php endif; ?>
                            <tr valign="top">
                                <th scope="row">Shortcodes:</th>
                                <td>
                                    [google_ad data_ad_slot='' data_ad_format='<b>rectangle</b>']
                                </td>
                            </tr>
                            <tr valign="top">
                                <th scope="row">data_ad_formats:</th>
                                <td>
                                    <script src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js" async=""></script>
                                    <p style="border: 1px solid lightgray;"><b>auto</b>
                                        <br>
                                        <ins class="adsbygoogle" style="display: block;" data-ad-client="ca-pub-9508802362155093" data-ad-format="auto"></ins>
                                        <script>
                                            // <![CDATA[
                                            (adsbygoogle = window.adsbygoogle || []).push({});
                                            // ]]>
                                        </script>
                                    </p>
                                    <p style="border: 1px solid lightgray;"><b>rectangle</b>
                                        <br><ins class="adsbygoogle" style="display: block;" data-ad-client="ca-pub-9508802362155093" data-ad-format="rectangle"></ins>
                                        <script>
                                            // <![CDATA[
                                            (adsbygoogle = window.adsbygoogle || []).push({});
                                            // ]]>
                                        </script>
                                    </p>
                                    <p style="border: 1px solid lightgray;"><b>horizontal</b>
                                        <br><ins class="adsbygoogle" style="display: block;" data-ad-client="ca-pub-9508802362155093" data-ad-format="horizontal"></ins>
                                        <script>
                                            // <![CDATA[
                                            (adsbygoogle = window.adsbygoogle || []).push({});
                                            // ]]>
                                        </script>
                                    </p>
                                    <p style="border: 1px solid lightgray;"><b>vertical</b>
                                        <br><ins class="adsbygoogle" style="display: block;" data-ad-client="ca-pub-9508802362155093" data-ad-format="vertical"></ins>
                                        <script>
                                            // <![CDATA[
                                            (adsbygoogle = window.adsbygoogle || []).push({});
                                            // ]]>
                                        </script>
                                    </p>
                                </td>
                            </tr>
                </table>
                <?php submit_button(); ?>
    </form>

    <p>If you like this plugin, please donate us for faster upgrade</p>
    <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
        <input type="hidden" name="cmd" value="_s-xclick">
        <input type="hidden" name="encrypted" value="-----BEGIN PKCS7-----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-----END PKCS7-----
">
        <input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donateCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
        <img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
    </form>
    <?php
} 

/* Load Google Ads widget */
$dir = plugin_dir_path( __FILE__ );
include_once( $dir . 'google_ads_widget.php' );
/* #Load Google Ads widget */

//shortcode for Google Ads in content
function google_ad_shortcode( $atts ) {
    extract( 
        shortcode_atts(
            array(
                'data_ad_slot' => '1',
                'data_ad_format' => '1',
            ), 
        $atts )
    );
ob_start();?>
        <script>
            (function ($) {
                $('document').ready(function () {
                    if ($('#googleadscript').length == 0) {
                        var s = document.createElement('script');
                        s.src = "//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js";
                        document.head.appendChild(s);
                    }
                });
            })(jQuery);
        </script>

        <div class="advertisment">
            <ins class="adsbygoogle" style="display: block;" data-ad-client="ca-pub-<?php echo $selectedoption = get_option('gau_pub');?>" data_ad_slot="<?php echo $data_ad_slot;?>" data-ad-format="<?php echo $data_ad_format;?>"></ins>
            <script>
                // <![CDATA[
                (adsbygoogle = window.adsbygoogle || []).push({});
                // ]]>
            </script>
        </div>
        <?php
    $output = ob_get_clean();
     return $output;
}
add_shortcode( 'google_ad', 'google_ad_shortcode' );
?>
