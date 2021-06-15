<?php
// Sicherheit, das A und O
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

function sc_cta_anfrage($atts, $content = null){
    // override default attributes with user attributes
    $atts = shortcode_atts([
         'title' => 'Default Title',
         'background' => '',
         'form_shortcode' => ''
    ], $atts);

    global $wpdb;
t

    $background_html = ($atts["background"] != "" ? ' style="background-image:url(' . $atts["background"] . ');"' : '');


	ob_start();
	?>
	<section class="outerWrap element-cta-anfrage" <?php echo $background_html; ?> >
        <div class="innerWrap">
            <div class="text centered">
                <p class="highlight-text"><?php echo $atts["title"]; ?></p>
				<?php echo ($atts["form_shortcode"] != "" ? $atts["form_shortcode"] : ""); ?>
            </div>
        </div>
    </section>

	<?php
	$output = ob_get_contents();
	ob_end_clean();

    return $output;
}
add_shortcode('cta-anfrage', 'sc_cta_anfrage');

/*
	Dem Visual Composer beibringen, diesen Shortcode zu nutzen und zu konfigurieren
*/
add_action( 'vc_before_init', 'VCInit_cta_anfrage' );
function VCInit_cta_anfrage() {
    vc_map( array(
        "name" => "CTA-Anfrage",
        "description" => "CTA über die komplette Breite",
        "base" => "cta-anfrage",
        "class" => "",
        "icon" => get_template_directory_uri() . "/shortcodes/bundesweit.digital.png", // Simply pass url to your icon here
        "category" => "bundesweit.digital",
        // 'admin_enqueue_js' => array(get_template_directory_uri().'/vc_extend/bartag.js'),
        // 'admin_enqueue_css' => array(get_template_directory_uri().'/vc_extend/bartag.css'),
        "params" => array(
            array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => "Überschrift",
                "param_name" => "title",
                "value" => "Überschrift",
                "description" => "Description for foo param.",
                "admin_label" => 1 // Bild wird nicht in Editorübersicht angezeigt
            ),
            array(
                "type" => "attach_image",
                "class" => "",
                "heading" => "Hintergrund URL",
                "param_name" => "background",
                "value" => "",
                "description" => "Maße: 1920 x min. 392px",
                "admin_label" => 0 // Bild wird nicht in Editorübersicht angezeigt
            ),
            array(
                "type" => "textfield",
                "class" => "",
                "heading" => "Formular Shortcode",
                "param_name" => "form_shortcode",
                "value" => "",
                "description" => "Shortcode für Formular inklusive eckiger Klammern.",
                "admin_label" => 0 // Bild wird nicht in Editorübersicht angezeigt
            )
        )
    ) );
}

?>
