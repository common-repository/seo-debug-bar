<?php
/*
Plugin Name: SEO Debug Bar
Plugin URI: https://vincent-guesne.fr/plugins/wordpress/seo-debug-bar.php
Description: Check your SEO with this one clic auditor !
Version: 0.2
Author: Guesne Vincent
Author URI: https://vincent-guesne.fr
License: GPL2
Text Domain: vgseodebugbar
*/


add_action( 'admin_menu', 'vggic_my_plugin_menu' );

function vggic_my_plugin_menu() {
	add_options_page( __('Seo Debug Bar','vgseodebugbar'), __('Seo Debug Bar','vgseodebugbar'), 'manage_options', 'id-vg-super-seo', 'vggic_my_plugin_options' );
}

function vggic_my_plugin_options() {
	if ( !current_user_can( 'manage_options' ) )  {
		wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
	}



if(isset($_POST['vgsdb-save-settings'])){

	// Check Nonce
	check_admin_referer( 'vgsdb-save-settings' );

	// Check Site KEY
  if(isset($_POST['vggic_ips_allowed'])){
    update_option('vggic_ips_allowed',sanitize_text_field($_POST['vggic_ips_allowed']));
  }

}
?>
    <div class="doc">

    </div>
		<div class="wrap">
		<h2><?php _e('Seo Debug Bar Settings : ','vgseodebugbar') ?></h2>
			<form method="POST">
				<table>
				<tbody>
					<tr>
						<td>
							<label for=""> <?php _e('Display debug bar for following IP : ','vgseodebugbar') ?> </label>
						</td>
						<td>
							<input type="text" name="vggic_ips_allowed" id="vggic_ips_allowed" value="<?php echo get_option('vggic_ips_allowed') ?>" />
						</td>
            <td>
							<input type="button" name="add-current-ip" onclick="addIp('<?php echo $_SERVER['REMOTE_ADDR'] ?>'); return false;" value="ADD IP : <?php echo $_SERVER['REMOTE_ADDR'] ?>" />
						</td>
					</tr>

				</table>
				<?php wp_nonce_field( 'vgsdb-save-settings' ); ?>
				<p class="submit">
					<input type="submit" name="vgsdb-save-settings" class="button-primary" value="<?php _e('Save','vgseodebugbar') ?>" />
				</p>

			</form>
		</div>
	<?php

}
add_action('wp_footer' , 'vgsdb_displaydebugbar');

function vgsdb_displaydebugbar(){

$current_IP = $_SERVER['REMOTE_ADDR'];
$authorized_ips = get_option('vggic_ips_allowed');
//echo $authorized_ips; die();
if( !in_array($current_IP , explode( ',' , $authorized_ips ) ) ){

	return;
}


?>
<!-- SUPER SEO : SEO DEBUUGER -->
<script type="text/javascript">
// <![CDATA[

var traineeTxt = "trainee";


var title = "SEO Debug Bar";

var titleTag = "Title tag";
var metaXRobots = "Meta-Robots and X-Robots-Tag index";
var metaDescription = "Meta Description tag";
var metaOgTitle = "Meta og:title property";
var metaOgDescription = "Meta og:description property";
var metaOgImage = "Meta og:image property";
var metaOgURL = "Meta og:url property";
var metaTwitterCard = "Meta twitter:card tag";
var canonicalURL = "Canonical URL";
var favIcon = "Favicon";
var metaOgURL = "Meta og:url property";
var metaTwitterCard = "Meta twitter:card tag";
var metaOgPrice = "Meta og:price";
var metaOgCurrency = "Meta og:currency";
var canonicalURL = "Canonical URL";
var wrongHeadingStructure = "Wrong Heading Structure";
var emptyImgAltAttributes = "Empty image alt attributes";
var emptyLinkTitleAttributes = "Empty link title attributes";
var styleTagsInline = "Inline style tags";
var styleExternals = "External style files";
var styleThirdParty = "Third Party styles";
var scriptTagsInline = "Inline script tags";
var styleTagsInline = "Inline style tags";
var scriptExternals = "External script files";
var scriptThirdParty = "Third Party scripts";
var scriptLinksOutbound = "Outbound links";

var ninja = "Ninja, you make me proud";
var trainee = "Trainee, room for improvement";
var novice = "Novice, you are doing it wrong";
var consoleTxt = "Check the Javascript console for debug information";

var errorTitle = "Title length too short < 60 characters";
var goodTitle = "Title has good size";

var errorDescr = "Description length too short < 120 characters";
var goodDescr = "Description has good size";

var errorSitemap = "No sitemap has been found";
var goodSitemap = "Sitemap has been found";

//]]>
</script>
<div id="seoButtonDisplayBar" class="ss-action-img toggle">
<img  src="data:image/svg+xml;utf8;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pgo8IS0tIEdlbmVyYXRvcjogQWRvYmUgSWxsdXN0cmF0b3IgMTguMS4xLCBTVkcgRXhwb3J0IFBsdWctSW4gLiBTVkcgVmVyc2lvbjogNi4wMCBCdWlsZCAwKSAgLS0+CjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgdmVyc2lvbj0iMS4xIiBpZD0iQ2FwYV8xIiB4PSIwcHgiIHk9IjBweCIgdmlld0JveD0iMCAwIDI1LjY3NyAyNS42NzciIHN0eWxlPSJlbmFibGUtYmFja2dyb3VuZDpuZXcgMCAwIDI1LjY3NyAyNS42Nzc7IiB4bWw6c3BhY2U9InByZXNlcnZlIiB3aWR0aD0iMTI4cHgiIGhlaWdodD0iMTI4cHgiPgo8Zz4KCTxnPgoJCTxwYXRoIGQ9Ik0xNS44NjUsMGMtNS40MiwwLTkuODEyLDQuMzkzLTkuODEyLDkuODEzYzAsMS45OTQsMC41OTgsMy44NDYsMS42MTksNS4zOTRoLTAuNjZ2MS40NCAgICBjLTAuNjM0LTAuMjA4LTEuMzU3LTAuMDY3LTEuODYxLDAuNDM3bC00LjYxNSw0LjYxNGMtMC43MTQsMC43MTMtMC43MTQsMS44NjksMCwyLjU4M2wwLjg2LDAuODYxICAgIGMwLjcxNCwwLjcxMywxLjg3MSwwLjcxMywyLjU4NCwwbDQuNjE1LTQuNjE0YzAuMi0wLjIsMC4zMzgtMC40MzcsMC40MjYtMC42ODhoMC4yNzN2LTIuNzU0YzEuNzQsMS41NzQsNC4wNCwyLjU0LDYuNTcxLDIuNTQgICAgYzUuNDIsMCw5LjgxMy00LjM5Myw5LjgxMy05LjgxM1MyMS4yODUsMCwxNS44NjUsMHogTTE1Ljg2NSwxNy44MTFjLTQuNDE4LDAtNy45OTctMy41OC03Ljk5Ny03Ljk5OHMzLjU3OS03Ljk5OCw3Ljk5Ny03Ljk5OCAgICBzNy45OTcsMy41OCw3Ljk5Nyw3Ljk5OFMyMC4yODIsMTcuODExLDE1Ljg2NSwxNy44MTF6IiBmaWxsPSIjMDAwMDAwIi8+CgkJPHBhdGggZD0iTTIyLjgwOSwxMC40ODdjLTAuNTU3LTEuNjE3LTIuNzI3LTQuNjc0LTYuOTQ1LTQuNjc0Yy00LjIxNywwLTYuMzg3LDMuMDU3LTYuOTQ1LDQuNjc0ICAgIGMtMC4xOCwwLjUyMiwwLjA5NywxLjA5MSwwLjYxOSwxLjI3MWMwLjUyMSwwLjE3OCwxLjA5MS0wLjA5NywxLjI3MS0wLjYxOWMwLjAwMy0wLjAwOCwwLjA2OS0wLjE4NywwLjIwOS0wLjQ1MyAgICBjMC40MDUsMi4zMTgsMi40MTUsNC4wODUsNC44NDksNC4wODVjMi40MywwLDQuNDM5LTEuNzYxLDQuODQ4LTQuMDc0YzAuMTI3LDAuMjQ0LDAuMTkzLDAuNDE1LDAuMjAyLDAuNDQzICAgIGMwLjE0NCwwLjQxMywwLjUzMiwwLjY3MywwLjk0NywwLjY3M2MwLjEwOCwwLDAuMjE5LTAuMDE4LDAuMzI2LTAuMDU1QzIyLjcxNCwxMS41NzgsMjIuOTksMTEuMDA5LDIyLjgwOSwxMC40ODd6IE0xNS44NjgsMTMuOTM4ICAgIGMtMi4yNDksMC0zLjg5OC0xLjQwNi00LjA2NS00LjM3MmMwLjQ4NC0wLjU0LDEuMTY4LTEuMDkxLDIuMTEtMS40MjhjLTAuMzg5LDAuNDUyLTAuNjMyLDEuMDMzLTAuNjMyLDEuNjc1ICAgIGMwLDEuNDI2LDEuMTU3LDIuNTgzLDIuNTgzLDIuNTgzczIuNTgzLTEuMTU3LDIuNTgzLTIuNTgzYzAtMC42NDMtMC4yNDQtMS4yMjUtMC42MzMtMS42NzdjMC45NzMsMC4zNDYsMS42NzEsMC45MTksMi4xNTcsMS40NzUgICAgQzE5Ljc5MiwxMi43MTYsMTguMTEyLDEzLjkzOCwxNS44NjgsMTMuOTM4eiIgZmlsbD0iIzAwMDAwMCIvPgoJPC9nPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+Cjwvc3ZnPgo=" />
<span style="
    font-size: 10px;
    font-weight: bolder;
    text-transform: uppercase;
    text-align: center;
">SEO Debug Bar</span>
</div>

<div id="debugbar" class="" style="display:none">
  <img class="ss-action-img topCloseButton" src="data:image/svg+xml;utf8;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0idXRmLTgiPz4KPCFET0NUWVBFIHN2ZyBQVUJMSUMgIi0vL1czQy8vRFREIFNWRyAxLjEvL0VOIiAiaHR0cDovL3d3dy53My5vcmcvR3JhcGhpY3MvU1ZHLzEuMS9EVEQvc3ZnMTEuZHRkIj4KPHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHhtbG5zOnhsaW5rPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5L3hsaW5rIiB3aWR0aD0iNjRweCIgdmVyc2lvbj0iMS4xIiBoZWlnaHQ9IjY0cHgiIHZpZXdCb3g9IjAgMCA2NCA2NCIgZW5hYmxlLWJhY2tncm91bmQ9Im5ldyAwIDAgNjQgNjQiPgogIDxnPgogICAgPHBhdGggZmlsbD0iIzAwMDAwMCIgZD0iTTI4Ljk0MSwzMS43ODZMMC42MTMsNjAuMTE0Yy0wLjc4NywwLjc4Ny0wLjc4NywyLjA2MiwwLDIuODQ5YzAuMzkzLDAuMzk0LDAuOTA5LDAuNTksMS40MjQsMC41OSAgIGMwLjUxNiwwLDEuMDMxLTAuMTk2LDEuNDI0LTAuNTlsMjguNTQxLTI4LjU0MWwyOC41NDEsMjguNTQxYzAuMzk0LDAuMzk0LDAuOTA5LDAuNTksMS40MjQsMC41OWMwLjUxNSwwLDEuMDMxLTAuMTk2LDEuNDI0LTAuNTkgICBjMC43ODctMC43ODcsMC43ODctMi4wNjIsMC0yLjg0OUwzNS4wNjQsMzEuNzg2TDYzLjQxLDMuNDM4YzAuNzg3LTAuNzg3LDAuNzg3LTIuMDYyLDAtMi44NDljLTAuNzg3LTAuNzg2LTIuMDYyLTAuNzg2LTIuODQ4LDAgICBMMzIuMDAzLDI5LjE1TDMuNDQxLDAuNTljLTAuNzg3LTAuNzg2LTIuMDYxLTAuNzg2LTIuODQ4LDBjLTAuNzg3LDAuNzg3LTAuNzg3LDIuMDYyLDAsMi44NDlMMjguOTQxLDMxLjc4NnoiLz4KICA8L2c+Cjwvc3ZnPgo=" />


</div>

<!-- END SUPER SEO -->

<?php
}

function vggic_load_custom_wp_admin_script($hook) {
        // Load only on ?page=mypluginname
      /*  if($hook != 'settings_page_id-vg-super-seo') {
                return;
        } */
        wp_enqueue_script( 'custom_wp_admin_js', plugins_url('js/seodebugbar.js', __FILE__) , array( 'jquery' )   );
        wp_enqueue_style( 'custom_wp_admin_css', plugins_url('css/seodebugbar.css', __FILE__)   );
}
add_action( 'wp_enqueue_scripts', 'vggic_load_custom_wp_admin_script' );
add_action( 'admin_enqueue_scripts', 'vggic_load_custom_wp_admin_script' );
