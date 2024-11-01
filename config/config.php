<?php 
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit; 
?>

<div>
  <section class="zargetAPIwrapper">
    <div class="headerContent">
      <img src="<?php echo plugin_dir_url( __FILE__ );?>../public/images/zarget-logo.png" class="center-block" alt="Zarget Logo" />
      <h2 class="zargetVision"><?php _e( 'Optimize your website effortlessly','zarget'); ?></h2>
    </div>
    <div id="zarget-tabs" class="installZAPI">
      <div class="ZcontentWrapper">
        <p class="ZAPIsubheading"><?php _e( 'To get your Zarget API Key:','zarget'); ?></p>
        <ol class="ZAPIinstallstep">
          <li><?php _e( 'Login to','zarget');?> <a href="https://app.zarget.com/accounts/jsp/login.jsp" target="_blank"><?php _e( 'Zarget','zarget'); ?></a></li>
          <li><?php _e( 'Click on “Setup” &#45;> “Integrations”','zarget'); ?></li>
          <li><?php _e( 'Select the Wordpress tile','zarget'); ?></li>
          <li><?php _e( 'Click on “Generate API key”. Copy the key and paste it below.','zarget'); ?></li>
        </ol>
        <div class="inputZcontiner">
	<form action="" method="post" id="zg_approval_form">
	  <input type="hidden" name="auth_token" id="auth_token" value="">
	  <input type="hidden" name="project_id" id="project_id" value="">
	  <input type="hidden" name="org_id" id="org_id" value="">
	  <input type="hidden" name="user_id" id="user_id" value="">
	  <input type="hidden" name="nonce" id="nonce" value="<?php echo wp_create_nonce('wporg_authtoken_verify')?>">
	  <input type="hidden" name="project_code" id="project_code" value="" >
          <input type="text" id="token" name="token" value="<?php echo esc_attr( get_option( 'zarget_token' ) ) ?>" class="Zapiinputbox" placeholder="<?php _e( 'Enter the API key','zarget'); ?>" />
          <button type="button" name="zg_button" id="connect_zarget" class="ZAPIbtn"><?php _e( 'Connect with Zarget','zarget'); ?></button>
	</form>
        </div>
        <p id="zg_disp_msg" class="ZAPIsuccess" style="display:none"><?php _e( 'Your website integrated with Zarget Successfully!','zarget'); ?></p>
        <p id="zg_alert_msg" class="ZAPIwarning" style="display:none"><?php _e( 'Please enter the token in the text field','zarget'); ?></p>
	<?php if ( ! get_option( 'zarget_auth_token' )): ?>
        <p id="zg_info_msg" class="ZAPIsuccess" style="display:block"><?php _e( 'Zarget is almost ready. You must first add your API Token to configure.','zarget'); ?></p>
	<?php endif; ?>
      </div>
    </div>
    <div class="text-center">
      <a class="Zloginbtn" href="https://app.zarget.com/accounts/jsp/login.jsp" target="_blank"><?php _e( 'Login to Zarget','zarget'); ?></a>
      <p class="ZAPIhelp"><?php _e( 'Have more questions? Ask us','zarget'); ?> <span>support@zarget.com</span></p>
    </div>
  </section>
</div>
