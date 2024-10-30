<?php
if ( !defined( 'ABSPATH' ) ) {
    exit;
}

class front_chatpirate
{
    public function __construct()
    {
        add_action('init', array($this, 'init'));
    }

    public function init()
    {
        add_action ('wp_footer', array($this, 'render'));
    }

    public function render()
    {
        $companyid = get_option('chatpirate_companyid');
        if(!empty($companyid))
        {
            echo "<script type=\"text/javascript\">
                    var __cp = {};
                    __cp.license = ".$companyid.";

                    (function(){
                        var s = document.createElement('script'); s.type = 'text/javascript'; s.async = true;
                        s.src = ('https:' == window.location.protocol ? 'https://' : 'http://') + 'cdn.chatpirate.com/plugin.js';
                        var sc = document.getElementsByTagName('script')[0]; sc.parentNode.insertBefore(s, sc);
                    })();
            </script>";
        }
    }

}
