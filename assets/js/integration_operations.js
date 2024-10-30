// CONFIG
var register_companyName      = 'Advice Online',
    register_operatorName     = 'Operator',
    register_employeesNumber  = '1-5',
    register_createdType      = 'wordpress';

var chat_script = {
    action: function (companyid, email, token) {
        jQuery.post( "?page=admin-settings-chatpirate", { chat_save: "true", companyid: companyid, email: email, token: token }, function( data ) {
            if(data === true){
                chat_integration.setView('connected');
            }
            else {
                chat_integration.renderModal('Something went wrong.');
            }
        })
        .fail(function() {
            chat_integration.renderModal('Something went wrong.');
        });
    },
    disconnectChat: function () {
        jQuery.get( "?page=admin-settings-chatpirate&chat_disconnect=true", function( data ) {
            if(data === true){
                chat_integration.setView('register');
            }
            else {
                chat_integration.renderModal('Disconnecting your chat account failed');
            }
        })
        .fail(function() {
            chat_integration.renderModal('Something went wrong.');
        });
    },
    go_to_app: function () {
        jQuery.get( "?page=admin-settings-chatpirate&chat_redirect=true", function( data ) {
            if(data.url){
                window.location = data.url;
            }
            else {
                chat_integration.renderModal('Something went wrong.');
            }
        })
        .fail(function() {
            chat_integration.renderModal('Something went wrong.');
        });
    },
};

jQuery(document).ready(function () {
    chat_integration.initialize();
    chat_integration.setView(view);
});