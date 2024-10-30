jQuery(document)
    .ajaxStart(function () {
        jQuery('#mdl_loader').fadeIn( "slow");
    })
    .ajaxStop(function () {
        jQuery('#mdl_loader').fadeOut( "slow");
    });

var chat_integration = {
    initialize: function () {
        this.getView();
        this.disconnectChat();
        this.go_to_app();
        this.formSubmits();
    },
    getView: function () {
        jQuery('#chat_integration .change_view').click(function (e) {
            e.preventDefault();
            var view = jQuery(this).attr('data-view');

            chat_integration.setView(view)

        });
    },
    setView: function (view) {
        if(view == 'error'){
            if(typeof(critical_errors) != "undefined" && critical_errors !== null){
                jQuery.each(critical_errors, function( index, value ) {
                    jQuery('#chat_integration .view.error ul').append('<li>' + value + '</li>')
                });
            } else {
                jQuery('#chat_integration .view.error p').html('Something Went Wrong');
            }
        }

        jQuery('#chat_integration .view').hide();
        jQuery('#chat_integration .view.' + view).fadeIn(400);
    },
    renderModal: function(message){
        var modal = '<div class="chat_info">' +
            '<div class="chat_info-in">' +
                '<div class="chat_info-notification">' +
                    '<div class="close-modal"><i class="material-icons">close</i></div>' +
                    '<span class="chat_message">' + message + '</span>' +
                '</div>' +
            '</div>' +
        '</div>';

        jQuery('#chat_integration').append(modal);
        jQuery('.chat_info').fadeIn("slow");

        jQuery( "#chat_integration .close-modal" ).click(function() {
            jQuery('.chat_info').fadeOut('slow', function(){ jQuery('.chat_info').remove(); });
        });
    },
    disconnectChat: function () {
        jQuery('#chat_integration #disconnect_chat').click(function () {
            if (confirm("Are you sure you want to delete chat from the website?") == true) {
                chat_actions.disconnectChat();
            }
        });
    },
    go_to_app: function () {
        jQuery('#chat_integration #go_to_app').click(function (e) {
            e.preventDefault();
            chat_actions.go_to_app();
        });
    },
    updateErrorMsg : function(name, html){
        var input = jQuery("[name='"+ name +"']");
        input.closest('.mdl-textfield').find( ".mdl-textfield__error" ).html(html);
        input.parent().addClass("is-invalid");
    },
    validateEmail : function(email) {
        var re = /^([a-zA-Z0-9_\.\+\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        return re.test(email);
    },
    getVal : function(name) {
        return jQuery("form").find( "[name='"+ name +"']").val();
    },
    formSubmits: function () {
        jQuery('#register_form').submit(function (e) {
            e.preventDefault();

            var errors = false,
                email = {
                    'input_name' : 'r_email',
                    'val': chat_integration.getVal('r_email')
                },
                password = {
                    'input_name': 'r_password',
                    'val': chat_integration.getVal('r_password')
                };

            if( email.val.length === 0 ) {
                errors = true;
                chat_integration.updateErrorMsg(email.input_name, 'Email can not be empty')
            }
            else if(!chat_integration.validateEmail(email.val)){
                errors = true;
                chat_integration.updateErrorMsg(email.input_name, 'Email is Incorrect')
            }

            if( password.val.length === 0 ) {
                errors = true;
                chat_integration.updateErrorMsg(password.input_name, 'Password can not be empty')
            }

            if(errors !== true){
                chat_actions.operator_exists(
                    email,
                    password
                );
            }
        });

        jQuery('#login_form').submit(function (e) {
            e.preventDefault();

            var errors = false,
                email = {
                    'input_name' : 'l_email',
                    'val': chat_integration.getVal('l_email')
                },
                password = {
                    'input_name': 'l_password',
                    'val': chat_integration.getVal('l_password')
                };

            if( email.val.length === 0 ) {
                errors = true;
                chat_integration.updateErrorMsg(email.input_name, 'Email can not be empty')
            }
            else if(!chat_integration.validateEmail(email.val)){
                errors = true;
                chat_integration.updateErrorMsg(email.input_name, 'Email is Incorrect')
            }

            if( password.val.length === 0 ) {
                errors = true;
                chat_integration.updateErrorMsg(password.input_name, 'Password can not be empty')
            }

            if(errors !== true){
                chat_actions.login(
                    email,
                    password
                );
            }
        })
    },
    displaySuccessScreen: function (back_url) {
        jQuery('#chat_integration .success-screen .left-button').html('BACK');
        jQuery('#chat_integration .success-screen .left-button').attr(back_url);
        jQuery('#chat_integration .success-screen .right-button').html('GO TO APP');
        jQuery('#chat_integration .success-screen .right-button').click(function () {
            chat_actions.go_to_app();
        });
        jQuery('#chat_integration .success-screen-outer').fadeIn('slow');
    }
};