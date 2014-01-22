<?php
/**
 * Plugin Name: Facebook Event Import
 * Plugin URI: https://github.com/indiecosmic/facebook-event-import
 * Description: Wordpress plugin for importing events from Facebook into a custom post type.
 * Version: 0.1
 * Author: Mattias Rudén
 * Author URI: https://indiesoft.org
 */

namespace IndieSoft\FacebookEventImport;

require_once('include/FacebookEvent.php');

class FacebookEventImport {

    public function __construct() {
        FacebookEvent::registerPostType();

        if (is_admin()) {
            add_action('admin_menu', array($this, 'createPluginPage'));
        }
    }

    public static function facebookEventImportActivation() {
        if (!current_user_can('activate_plugins'))
            return;
    }

    public function createPluginPage() {
        add_options_page('Facebook Event Import Settings', 'Facebook Event Import', 'manage_options', 'facebook_event_import', array($this, 'renderOptionsPage'));
    }

    public function renderOptionsPage() {
        ?>
        <div class="wrap">
            <h2>My custom plugin</h2>
            Options relating to the Custom Plugin.
            <form action="options.php" method="post">
                <?php settings_fields('plugin_options'); ?>
                <?php do_settings_sections('plugin'); ?>

                <input name="Submit" type="submit" value="<?php esc_attr_e('Save Changes'); ?>" />
            </form></div>
    <?php
    }
}

if (class_exists('IndieSoft\FacebookEventImport\FacebookEventImport')) {
    register_activation_hook(__FILE__, array('IndieSoft\FacebookEventImport\FacebookEventImport', 'facebookEventImportActivation'));

    new FacebookEventImport();
}