var chat_actions = {
    disconnectChat: function () {
        chat_script.disconnectChat();
    },
    go_to_app: function () {
        chat_script.go_to_app();
    },
    register: function (email, password) {
        jQuery.ajax({
            type: "POST",
            url: chat_api_url+"api/v1/register",
            dataType : 'json',
            data: {
                companyName : register_companyName,
                website : register_website,
                operatorName : register_operatorName,
                employeesNumber: register_employeesNumber,
                email : email.val,
                password : password.val,
                createdType : register_createdType
            },
            success : function(data) {
                chat_script.action(data.data.companyId, data.data.email, data.data.token);
            },
            error : function(err) {
                chat_actions.handle_errors(err, email, password);
            }
        });
    },
    login: function (email, password) {
        jQuery.ajax({
            type: "GET",
            url: chat_api_url+"api/v1/register/getToken",
            dataType : 'json',
            headers: { "Authorization": email.val + "::" + password.val },
            success : function(data) {
                chat_script.action(data.data.companyId, data.data.email, data.data.token);
            },
            error : function(err) {
                chat_actions.handle_errors(err, email, password);
            }
        });
    },
    operator_exists : function(email, password) {
        jQuery.ajax({
            type: "GET",
            url: chat_api_url+"api/v1/register/checkOperator/"+email.val,
            dataType : 'json',
            success : function(data) {
                chat_actions.register(email, password)
            },
            error : function(err) {
                chat_actions.handle_errors(err, email, password);
            }
        });
    },
    handle_errors: function (err, email, password) {
        if(err.responseText){
            try
            {
                var json = jQuery.parseJSON(err.responseText);
            }
            catch(e)
            {
                chat_integration.renderModal('Something went wrong.');
                return false;
            }

            if(json.error.message.email || json.error.message.password){
                if(json.error.message.email){
                    chat_integration.updateErrorMsg(email.input_name, json.error.message.email[0]);
                }
                if(json.error.message.password){
                    chat_integration.updateErrorMsg(password.input_name, json.error.message.password[0]);
                }
            }
            else if(typeof json.error.message === 'string' || json.error.message instanceof String){
                chat_integration.updateErrorMsg(email.input_name, json.error.message);
                chat_integration.updateErrorMsg(password.input_name, json.error.message);
            }
            else {
                chat_integration.renderModal('Something went wrong.');
            }
        }
        else {
            chat_integration.renderModal('Something went wrong.');
        }
    }
};