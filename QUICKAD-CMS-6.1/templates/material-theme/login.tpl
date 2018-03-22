{OVERALL_HEADER}
<div id="page-content">
    <div class="container">
        <ol class="breadcrumb">
            <li><a href="{LINK_INDEX}">{LANG_HOME}</a></li>
            <li class="active">{LANG_LOGIN}</li>
        </ol>
        <!--end breadcrumb-->
        <div class="row">
            <div class="col-md-6 col-sm-8 col-md-offset-3 col-sm-offset-2">
                <div class="middle-dabba">
                    <h1>{LANG_LOGIN-HERE}</h1>

                    <div class="social-signup" style="padding-bottom: 20px;">
                        <div class="row">
                            <div class="col-xs-6"><a class="loginBtn loginBtn--facebook" onclick="fblogin()"><i class="fa fa-facebook"></i> <span>Facebook</span></a></div>
                            <div class="col-xs-6"><a class="loginBtn loginBtn--google" onclick="gmlogin()"><i class="fa fa-google-plus"></i> <span>Google+</span></a></div>
                        </div>
                        <div class="clear"></div>
                    </div>

                    <div id="post-form" style="padding:10px">
                        IF("{ERROR}"!=""){<article class="byMsg byMsgError" style="margin-bottom: 40px;" id="formErrors">! {ERROR}</article>{:IF}
                        <form method="post">
                            <div class="input-field">
                                <label for="username">{LANG_USERNAME} / {LANG_EMAIL}</label>
                                <input type="text" name="username" id="username">
                            </div>
                            <!--end form-group-->
                            <div class="input-field">
                                <label for="password">{LANG_PASSWORD}</label>
                                <input type="password" name="password" id="password">
                            </div>
                            <div class="form-group">
                                <input type="hidden" name="ref" value="{REF}"/>
                                <button type="submit" name="submit" id="submit" class="btn btn-primary waves-effect">{LANG_LOGIN}</button>&nbsp;&nbsp;
                                <a href="login.php?fstart=1" class="forgotlink">{LANG_FORGOTPASS}?</a>
                            </div>
                            <!--end form-group-->
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--end container-->
</div>
<!--end page-content-->


<script type="text/javascript">
    var w=640;
    var h=500;
    var left = (screen.width/2)-(w/2);
    var top = (screen.height/2)-(h/2);
    function fblogin()
    {
        var newWin = window.open("includes/social_login/facebook/index.php", "fblogin", 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=yes, copyhistory=no,display=popup, width='+w+', height='+h+', top='+top+', left='+left);
    }

    function gmlogin()
    {
        var newWin = window.open("includes/social_login/google/index.php", "gmlogin", 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=yes, copyhistory=no, width='+w+', height='+h+', top='+top+', left='+left);
    }

    function twlogin()
    {

        var newWin = window.open("/twlogin.php", "twlogin", 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=yes, copyhistory=no, width='+w+', height='+h+', top='+top+', left='+left);

    }



    $(document).ready(function() {

        $('#button').click(function(e) { // Button which will activate our modal

            $('.modal').reveal({ // The item which will be opened with reveal

                animation: 'fade',                   // fade, fadeAndPop, none

                animationspeed: 600,                       // how fast animtions are

                closeonbackgroundclick: true,              // if you click background will modal close?

                dismissmodalclass: 'close'    // the class of a button or element that will close an open modal

            });

            return false;

        });

    });

</script>




{OVERALL_FOOTER}