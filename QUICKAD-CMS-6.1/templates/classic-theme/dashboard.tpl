{OVERALL_HEADER}
<!-- ad-dashboard-page -->
<section id="main" class="clearfix  ad-profile-page">
    <div class="container">
        <div class="breadcrumb-section"><!-- breadcrumb -->
            <ol class="breadcrumb">
                <li><a href="{LINK_INDEX}"><i class="fa fa-home"></i> {LANG_HOME}</a></li>
                <li class="active">{LANG_DASHBOARD}</li>
                <div class="pull-right back-result"><a href="{LINK_LISTING}"><i class="fa fa-angle-double-left"></i>
                    {LANG_BACK-RESULT}</a></div>
            </ol>
            <!-- breadcrumb --></div>
        <!-- Main Content -->
        <div class="row"><!-- Page-Sidebar -->
            <aside class="col-sm-3 page-sidebar">
                <div class="section">
                    <div class="user-panel-sidebar">
                        <div class="collapse-box">
                            <h5 class="collapse-title no-border"> {LANG_MY-CLASSIFIED} <a class="pull-right"
                                                                                          data-toggle="collapse"
                                                                                          href="#MyClassified"><i
                                    class="fa fa-angle-down"></i></a></h5>

                            <div id="MyClassified" class="panel-collapse collapse in">
                                <ul class="acc-list">
                                    <li class="active"><a href="{LINK_DASHBOARD}" class="waves-effect"><i
                                            class="fa fa-home"></i> {LANG_DASHBOARD} </a></li>
                                    <li><a href="{LINK_PROFILE}/{USERNAME}" class="waves-effect"><i
                                            class="fa fa-user"></i> {LANG_PROFILE-PUBLIC}</a></li>
                                    <li><a href="{LINK_POST-AD}" class="waves-effect"><i class="fa fa-pencil"></i>
                                        {LANG_POST-AD}</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="collapse-box">
                            <h5 class="collapse-title"> {LANG_MY-ADS} <a class="pull-right" data-toggle="collapse"
                                                                         href="#MyAds"><i class="fa fa-angle-down"></i></a>
                            </h5>

                            <div id="MyAds" class="panel-collapse collapse in">
                                <ul class="acc-list">
                                    <li><a href="{LINK_MYADS}" class="waves-effect"><i class="fa fa-book"></i>
                                        {LANG_MY-ADS}<span class="badge">{MYADS}</span> </a></li>
                                    <li><a href="{LINK_FAVADS}" class="waves-effect"><i class="fa fa-heart"></i>
                                        {LANG_FAVOURITE-ADS}<span class="badge">{FAVORITEADS}</span> </a></li>
                                    <li><a href="{LINK_PENDINGADS}" class="waves-effect"><i
                                            class="fa fa-info-circle"></i> {LANG_PENDING-ADS}<span class="badge">{PENDINGADS}</span></a>
                                    </li>
                                    <li><a href="{LINK_HIDDENADS}" class="waves-effect"><i class="fa fa-eye-slash"></i>
                                        {LANG_HIDDEN-ADS} <span class="badge">{HIDDENADS}</span></a></li>
                                    <li><a href="{LINK_RESUBMITADS}" class="waves-effect"><i
                                            class="fa fa-briefcase"></i> {LANG_RESUBMITED-ADS} <span class="badge">{RESUBMITADS}</span></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="collapse-box">
                            <h5 class="collapse-title no-border"> {LANG_MY-ACCOUNT} <a class="pull-right"
                                                                                       data-toggle="collapse"
                                                                                       href="#account"><i
                                    class="fa fa-angle-down"></i></a></h5>

                            <div id="account" class="panel-collapse collapse in">
                                <ul class="acc-list">
                                    <li><a href="{LINK_TRANSACTION}" class="waves-effect"><i class="fa fa-money"></i>
                                    {LANG_TRANSACTION}</a></li>
                                    <li><a href="{LINK_ACCOUNT_SETTING}" class="waves-effect"><i class="fa fa-cog"></i>
                                        {LANG_ACCOUNT-SETTING}</a></li>
                                    <li><a href="{LINK_LOGOUT}" class="waves-effect"><i class="fa fa-unlock"></i>
                                        {LANG_LOGOUT}</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </aside>
            <!-- # End Page-Sidebar --><!-- Page-Content -->
            <div class="col-sm-9 page-content">
                <div class="panel-user-details">

                    <!-- profile-details -->
                    <div class="user-details section">
                        <div class="user-img"><img src="{SITE_URL}storage/profile/small_{AUTHORIMG}" alt="{AUTHORNAME}"
                                                   class="img-responsive"></div>
                        <div class="user-admin">
                            <h3><a href="#">{LANG_HELLO} {AUTHORNAME}</a></h3>
                            <small>{LANG_YOU-LOGIN}: {LASTACTIVE}</small>
                        </div>
                        <div class="user-ads-details">
                            <div class="my-quickad">
                                <h3><a href="{LINK_MYADS}">{MYADS}</a></h3>
                                <small>{LANG_MY-ADS}</small>
                            </div>
                            <div class="favourites">
                                <h3><a href="{LINK_FAVADS}">{FAVORITEADS}</a></h3>
                                <small>{LANG_FAVOURITES}</small>
                            </div>
                        </div>
                    </div>
                    <!-- profile-details --><!-- My Details -->
                    <div class="section my-details">
                        {LOOP: ERRORS}
                            <article class="byMsg byMsgError" id="formErrors">! {ERRORS.message}</article>
                        {/LOOP: ERRORS}
                        <div class="section-title">
                            <h2>{LANG_MY-DETAILS}</h2>
                        </div>
                        <div class="section-body">
                            <form class="row" method="post" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">{LANG_USERNAME} <span
                                            class="required">*</span></label>

                                    <div class="col-sm-9">
                                        <input class="form-control border-form" type="text" value="{USERNAME}"
                                               placeholder="{USERNAME}" disabled="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">{LANG_EMAILAD} <span class="required">*</span></label>

                                    <div class="col-sm-9">
                                        <input class="form-control border-form" name="email" type="email" value="{EMAIL}"
                                               placeholder="{EMAIL}" disabled="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">{LANG_FULL-NAME} <span
                                            class="required">*</span></label>

                                    <div class="col-sm-9">
                                        <input class="form-control border-form" type="text" name="name"
                                               value="{AUTHORNAME}" placeholder="Enter Full Name">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">{LANG_AVATAR}</label>

                                    <div class="col-sm-9">
                                        <input type="file" class="filestyle" id="filestyle-0" name="avatar"
                                               tabindex="-1" style="position: absolute; clip: rect(0px 0px 0px 0px);">

                                        <div class="bootstrap-filestyle input-group">
                                            <input type="text" class="border-form form-control " placeholder=""
                                                   disabled="">
                      <span class="group-span-filestyle input-group-btn" tabindex="0">
                      <label for="filestyle-0" class="btn btn-outline btn-upload "><span
                              class="icon-span-filestyle glyphicon glyphicon-folder-open"></span> <span
                              class="buttonText">{LANG_CHOOSE-FILE}</span></label>
                      </span></div>
                                        <span class="help-block"></span></div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">{LANG_PHONE-NO} <span
                                            class="required">*</span></label>

                                    <div class="col-sm-9">
                                        <input type="text" class="form-control border-form" value="{PHONE}"
                                               required="required" placeholder="e.g. +91-123456789" name="phone">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">{LANG_ADDRESS} <span class="required">*</span></label>

                                    <div class="col-sm-9">
                                        <input class="form-control border-form" type="text" name="address"
                                               value="{ADDRESS}" placeholder="Enter Address">
                                    </div>
                                </div>
                                <section>
                                    <div class="section-title">
                                        <h2>{LANG_SOCIAL-NETWORKS}</h2>
                                    </div>
                                    <div class="row">
                                        <div class="input-field">
                                            <label for="facebook" class="col-sm-3 control-label active">Facebook</label>

                                            <div class="col-sm-9">
                                                <input class="form-control border-form" type="text" name="facebook"
                                                       id="facebook" value="{FACEBOOK}">
                                            </div>
                                        </div>
                                        <!--end input-field-->
                                        <div class="input-field">
                                            <label for="Twitter" class="col-sm-3 control-label active">Twitter</label>

                                            <div class="col-sm-9">
                                                <input class="form-control border-form" type="text" name="twitter"
                                                       id="twitter" value="{TWITTER}">
                                            </div>
                                        </div>
                                        <!--end input-field-->
                                        <div class="input-field">
                                            <label for="googleplus"
                                                   class="col-sm-3 control-label active">Google+</label>

                                            <div class="col-sm-9">
                                                <input class="form-control border-form" type="text" name="googleplus"
                                                       id="googleplus" value="{GOOGLEPLUS}">
                                            </div>
                                        </div>
                                        <!--end input-field-->
                                        <div class="input-field">
                                            <label for="instagram"
                                                   class="col-sm-3 active control-label">Instagram</label>

                                            <div class="col-sm-9">
                                                <input class="form-control border-form" type="text" name="instagram"
                                                       id="instagram" value="{INSTAGRAM}">
                                            </div>
                                        </div>
                                        <!--end input-field-->
                                        <div class="input-field">
                                            <label for="linkedin" class="col-sm-3 control-label active">Linked
                                                In</label>

                                            <div class="col-sm-9">
                                                <input class="form-control border-form" type="text" name="linkedin"
                                                       id="linkedin" value="{LINKEDIN}">
                                            </div>
                                        </div>
                                        <!--end input-field-->
                                        <div class="input-field">
                                            <label for="youtube" class="col-sm-3 control-label active">Youtube</label>

                                            <div class="col-sm-9">
                                                <input class="form-control border-form" type="text" name="youtube"
                                                       id="youtube" value="{YOUTUBE}">
                                            </div>
                                        </div>
                                        <!--end input-field--></div>
                                    <!--end row--></section>
                                <div class="form-group">
                                    <div class="col-sm-offset-3 col-sm-9">
                                        <!--<a href="#" class="btn btn-outline">Update Details</a>-->
                                        <button type="submit" class="btn btn-outline" name="submit"> {LANG_UPDATE}
                                        </button>
                                        <a href="#" class="btn btn-outline cancel">{LANG_CANCEL}</a></div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- My Details --></div>
                <!-- user-pro-edit --></div>
            <!-- # End Page-Content --></div>
        <!-- row --></div>
    <!-- container --></section>
<!-- ad-dashboard-page -->
{OVERALL_FOOTER}