<?php
/**
 * Created by PhpStorm.
 * User: Mattias
 * Date: 2014-01-22
 * Time: 00:04
 */

namespace IndieSoft\FacebookEventImport;

require_once('CustomPostType.php');

class FacebookEvent extends CustomPostType {

    public function __construct() {
        parent::__construct("Facebook Event", array(
            'supports' => array('title', 'editor', 'thumbnail', 'custom-fields')
        ));
    }

    public static function registerPostType() {
        return new FacebookEvent();
    }

} 