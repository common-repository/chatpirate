<?php

class admin_chatpirate{
    private $critical_errors;

    public function __construct(
        $critical_errors = null
    ){
        if(!empty($critical_errors)) $this->critical_errors = $critical_errors;

        $this->actions();

        add_action('init', array($this, 'init'));
        add_action('admin_menu', array($this, 'admin_menu'));
    }

    public function init()
    {
        wp_register_style('cp_background', plugin_dir_url( __FILE__ ).'../assets/css/background.css');
        wp_register_style('cp_integration', plugin_dir_url( __FILE__ ).'../assets/css/integration.css');
        wp_register_style('cp_material', plugin_dir_url( __FILE__ ).'../assets/css/material.min.css');
        wp_register_style('cp_material_icons', plugin_dir_url( __FILE__ ).'../assets/css/material_icons.css');
        wp_register_style('cp_rwd', plugin_dir_url( __FILE__ ).'../assets/css/rwd.css');
        wp_register_style('cp_override', plugin_dir_url( __FILE__ ).'../assets/css/override.css');

        wp_register_script( 'cp_chat_actions', plugin_dir_url( __FILE__ ).'../assets/js/chat_actions.js');
        wp_register_script( 'cp_chat_integration', plugin_dir_url( __FILE__ ).'../assets/js/chat_integration.js');
        wp_register_script( 'cp_integration_operations', plugin_dir_url( __FILE__ ).'../assets/js/integration_operations.js');
        wp_register_script( 'cp_material', plugin_dir_url( __FILE__ ).'../assets/js/material.js');
    }

    public function admin_menu()
    {
        add_menu_page(
            $this->critical_errors ? '<div style="color:#FF7676">ChatPirate</div>' : 'ChatPirate',
            $this->critical_errors ? '<div style="color:#FF7676">ChatPirate</div>' : 'ChatPirate',
            'administrator',
            'admin-settings-chatpirate',
            array($this, 'admin_view'),
            plugin_dir_url( __FILE__ ).'../assets/img/favicon.png'
        );
    }

    public function admin_view()
    {
        wp_enqueue_style('cp_material');
        wp_enqueue_style('cp_material_icons');
        wp_enqueue_style('cp_background');
        wp_enqueue_style('cp_integration');
        wp_enqueue_style('cp_rwd');
        wp_enqueue_style('cp_override');

        wp_enqueue_script('jquery');
        wp_enqueue_script('cp_material');
        wp_enqueue_script('cp_chat_actions');
        wp_enqueue_script('cp_integration_operations');
        wp_enqueue_script('cp_chat_integration');

        $this->javascript_values();

        require plugin_dir_path( __FILE__ ).'../view/view.php';
    }

    private function javascript_values(){
        $html  = '<script type="text/javascript">';
        $html .= 'var chat_api_url = "'.chat_api_url.'";';
        $html .= 'var register_website = "'.get_bloginfo('url').'";';
        $html .= 'var view = "'.$this->view_name().'";';
        $html .= 'var critical_errors = '.json_encode($this->critical_errors).';';
        $html .= '</script>';

        echo $html;
    }

    private function view_name(){
        if($this->critical_errors){
            return 'error';
        }

        if(
            get_option('chatpirate_companyid') &&
            get_option('chatpirate_token') &&
            get_option('chatpirate_email')
        ){
            return 'connected';
        }

        return 'register';
    }

    private function actions(){
        $this->save();
        $this->disconnect();
        $this->redirect();
    }

    private function save(){
        if(!empty($_POST['chat_save'])){
            if(
                !empty($_POST['companyid'])   ||
                !empty($_POST['token'])     ||
                !empty($_POST['email'])
            ){
                if(
                    update_option('chatpirate_companyid', $_POST['companyid']) &&
                    update_option('chatpirate_token',     $_POST['token'])   &&
                    update_option('chatpirate_email',     $_POST['email'])
                ){
                    $this->print_json(true);
                }
            }

            $this->print_json(false);
        }
    }

    private function disconnect(){
        if(!empty($_GET['chat_disconnect'])){
            if(
                update_option('chatpirate_companyid', '') &&
                update_option('chatpirate_token',     '') &&
                update_option('chatpirate_email',     '')
            ){
                $this->print_json(true);
            }

            $this->print_json(false);
        }
    }

    private function redirect(){
        if(!empty($_GET['chat_redirect'])){
            $token = get_option('chatpirate_token');
            $email = get_option('chatpirate_email');

            if($token && $email){
                $url = 'https://app.chatpirate.com/';

                if($token && $email) $url .= 'api/v1/register/loginByToken/'.$email.'/'.$token.'?redirect=true';

                $this->print_json(array('url' => $url));
            }

            $this->print_json(false);
        }
    }

    private function print_json($data){
        header( 'Content-Type: application/json' );
        echo json_encode($data);
        exit();
    }
}