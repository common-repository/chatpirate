<div id="chat_integration">

    <div id="mdl_loader">
        <div class="showbox">
            <div class="full-h">
                <div class="loader">
                    <svg class="circular" viewBox="25 25 50 50">
                        <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10"/>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <div class="success-screen-outer">
        <div class="success-screen">

            <div class="wrapper">
                <span class="text1">Success!</span>
                <span class="text2">Your account has been successfully connected!</span>
                <span class="text3">Choose what you want to do now?</span>

                <div class="buttons">
                    <a href="#" target="_blank" class="button left-button"></a>
                    <a href="#" target="_blank" class="button right-button"></a>
                </div>

            </div>
        </div>
    </div>

    <div class="wrapper wrapper-small">
        <div class="header">
            <div class="logo"></div>
            <div class="logo-integration">
                <span>Live Chat for</span>
            </div>
        </div>

        <div class="view register">
            <h1>Create account</h1>

            <form method="post" id="register_form">
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                    <input name="r_email" id="r_email" type="text" class="mdl-textfield__input"/>
                    <label for="r_email" class="mdl-textfield__label">Email *</label>
                    <span class="mdl-textfield__error"></span>
                </div>

                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                    <input name="r_password" id="r_password" type="password" class="mdl-textfield__input" />
                    <label for="r_password" class="mdl-textfield__label">Password *</label>
                    <span class="mdl-textfield__error"></span>
                </div>

                <p style="margin-top: 20px;">By clicking on Sign up, you agree to</p>
                <p>
                    <a target="_blank" href="//chatpirate.com/termsofuse">terms of use</a>
                    and
                    <a target="_blank" href="//chatpirate.com/privacypolicy">privacy policy</a>
                </p>

                <input class="r_submit" name="r_submit" type="submit" value="SIGN UP"/>

                <p>
                    Already have an account?
                    <a class="change_view" data-view="login" class="login_btn" href="#">Login</a>
                </p>

            </form>

        </div>

        <div class="view login">
            <h1>Log In</h1>

            <form method="post" id="login_form">
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                    <input name="l_email" id="l_email" type="text" class="mdl-textfield__input"/>
                    <label for="l_email" class="mdl-textfield__label">Email *</label>
                    <span class="mdl-textfield__error"></span>
                </div>

                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                    <input name="l_password" id="l_password" type="password" class="mdl-textfield__input" />
                    <label for="l_password" class="mdl-textfield__label">Password *</label>
                    <span class="mdl-textfield__error"></span>
                </div>

                <input class="l_submit" name="l_submit" type="submit" value="LOG IN"/>

                <p>
                    Forgot password?
                    <a target="_blank" href="https://app.chatpirate.com/restore-password">Click here</a>
                </p>

                <p>
                    You do not have an account?
                    <a class="change_view" data-view="register" href="#">Register</a>
                </p>

            </form>

        </div>

        <div class="view connected">
            <h1>Connected</h1>

            <p>What would you like to do now?</p>

            <a id="go_to_app" target="_blank" class="button_go_to_app" href="#">GO TO APP</a>
            <a id="disconnect_chat" class="button_disconnect" href="#">DISCONNECT CHAT</a>

        </div>

        <div class="view error">
            <h1>PROBLEM</h1>

            <p>The following problems occurred:</p>
            <ul>
                
            </ul>
        </div>

    </div>

    <div class="chat_footer">
        <div class="ship-color-small"></div>
        <div class="wave wave-1"></div>
        <div class="wave wave-2"></div>
        <div class="wave wave-3"></div>
    </div>
