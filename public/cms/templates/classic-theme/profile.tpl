{OVERALL_HEADER}<!-- ad-profile-page -->
<section id="main" class="clearfix  ad-profile-page">
    <div class="container">
        <div class="breadcrumb-section"><!-- breadcrumb -->
            <ol class="breadcrumb">
                <li><a href="{LINK_INDEX}"><i class="fa fa-home"></i> {LANG_HOME}</a></li>
                <li class="active">{LANG_PROFILE}</li>
                <div class="pull-right back-result"><a href="{LINK_LISTING}"><i class="fa fa-angle-double-left"></i>
                    {LANG_BACK-RESULT}</a></div>
            </ol>
            <!-- breadcrumb --></div>
        <!-- Main Content  -->
        <div class="row"><!-- Page-Content -->
            <div class="col-sm-12 page-content">
                <div class="panel-user-details"><!-- profile-details -->
                    <div class="user-details section">
                        <div class="row">
                            <div class="col-md-2">
                                <div class="user-img profile-img"><img src="{SITE_URL}storage/profile/{USERIMAGE}"
                                                                       alt="{FULLNAME}" class="img-responsive"></div>
                            </div>
                            <div class="col-md-5">
                                <div class="user-admin">
                                    <h3>{FULLNAME}</h3>

                                    <p>{ABOUT}</p>
                                    <section class="contacts">
                                        <figure class="social-links"><i class="fa fa-user"></i>{USERNAME}</figure>
                                        <figure class="social-links"><i class="fa fa-phone"></i>{PHONE}</figure>
                                        <figure class="social-links"><a href="mailto:{EMAIL}"><i
                                                class="fa fa-envelope"></i>{EMAIL}</a></figure>
                                        <figure class="social-links"><i class="fa fa-map-marker"></i>{ADDRESS}</figure>
                                    </section>
                                    <!--end contacts--></div>
                            </div>
                            <div class="col-md-5">
                                <div class="user-ads-details">
                                    <div class="site-visit">
                                        <h3><a href="#">{PROFILEVISIT}</a></h3>
                                        <small>{LANG_VISITS}</small>
                                    </div>
                                    <div class="my-quickad">
                                        <h3><a href="#">{USERPREMIUMADS}</a></h3>
                                        <small>{LANG_FEATURED}</small>
                                    </div>
                                    <div class="favourites">
                                        <h3><a href="#">{USERADS}</a></h3>
                                        <small>{LANG_TOTAL-ADS}</small>
                                    </div>
                                </div>
                                <ul class="social_share margin-top-170 pull-right">
                                    <li><a href="{FACEBOOK}" target="_blank" class="facebook"><i
                                            class="fa fa-facebook"></i></a></li>
                                    <li><a href="{TWITTER}" target="_blank" class="twitter"><i
                                            class="fa fa-twitter"></i></a></li>
                                    <li><a href="{GPLUS}" target="_blank" class="google"><i
                                            class="fa fa-google-plus"></i></a></li>
                                    <li><a href="{LINKEDIN}" target="_blank" class="linkden"><i
                                            class="fa fa-linkedin"></i></a></li>
                                    <li><a href="{INSTAGRAM}" target="_blank" class="instagram"><i
                                            class="fa fa-instagram"></i></a></li>
                                    <li><a href="{YOUTUBE}" target="_blank" class="youtube"><i
                                            class="fa fa-youtube"></i></a></li>
                                </ul>
                                <!--end social--></div>
                        </div>
                    </div>
                    <!-- profile-details -->
                    <div class="row">
                        IF("{LEFT_ADSTATUS}"=="1"){
                        <div class="hidden-xs hidden-sm col-md-2 text-center">
                            <div class="advertisement" id="quickad-left">{LEFT_ADSCODE}</div>
                        </div>
                        {:IF}

                        <!-- my-quickad -->
                        <div class="my-details section {CATEGORY_COLUMN}"><!-- featured-top -->
                            <div class="featured-top">
                                <div class="filter-section">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <h2>{LANG_ALL-ADS}</h2>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="sorting well">
                                                <div class="btn-group pull-right">
                                                    <button class="btn" id="list"><i
                                                            class="fa fa-th-list fa-white icon-white"></i></button>
                                                    <button class="btn" id="grid"><i class="fa fa-th fa"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- featured-top -->
                            <!-- Tab panes -->
                            <div class="" id="serchlist">
                                <div class="searchresult list hideresult" style="display: none;">
                                    {LOOP: ITEM}
                                    <!-- quick-item -->
                                    <div class="quick-item row IF(" {ITEM.highlight}"=="1"){ highlight {:IF}"><!-- item-image -->
                                        <div class="ad-listing">
                                            <div class="image bg-transfer">
                                                <figure>
                                                    <div class="item-badges">
                                                        IF("{ITEM.featured}"=="1"){ <span class="featured">{LANG_FEATURED}</span>{:IF}
                                                        IF("{ITEM.urgent}"=="1"){ <span>{LANG_URGENT}</span>{:IF}
                                                    </div>
                                                </figure>
                                                <img src="{SITE_URL}storage/products/{ITEM.picture}"
                                                     alt="{ITEM.product_name}"></div>
                                            <div class="item-info col-sm-12"><!-- ad-info -->
                                                <div class="ad-info">
                                                    <h4 class="item-title"><a href="{ITEM.link}">{ITEM.product_name}</a>
                                                    </h4>
                                                    <ul class="contact-options pull-right" id="set-favorite">
                                                        <li><a href="#" data-item-id="{ITEM.id}" data-userid="{USER_ID}"
                                                               data-action="setFavAd" class="fav_{ITEM.id} fa fa-heart IF("
                                                               {ITEM.favorite}"=="1"){ active {:IF}"></a></li>
                                                    </ul>
                                                    <ol class="breadcrumb">
                                                        <li><a href="listing.php?cat={ITEM.cat_id}">{ITEM.category}</a></li>
                                                        <li><a href="listing.php?subcat={ITEM.sub_cat_id}">{ITEM.sub_category}</a>
                                                        </li>
                                                    </ol>
                                                    <ul class="item-details">
                                                        <li><i class="fa fa-map-marker"></i><a href="#">{ITEM.city}</a></li>
                                                        <li><i class="fa fa-clock-o"></i>{ITEM.created_at}</li>
                                                    </ul>
                                                    IF("{ITEM.price}"!="0"){ <span class="item-price"> {ITEM.price} </span> {:IF}

                                                    <div><a class="view-btn" href="{ITEM.link}">{LANG_VIEW-AD}</a></div>
                                                </div>
                                                <!-- ad-info -->
                                            </div>
                                            <!-- item-info -->
                                        </div>
                                    </div>
                                    <!-- quick-item -->
                                    {/LOOP: ITEM}
                                </div>
                                <div class="searchresult grid hideresult" style="display: none;">
                                    <div class="gird-layout my-profile">
                                        {LOOP: ITEM2}
                                        <div class="quick-item clear-left-3 IF(" {ITEM2.highlight}"=="1"){ highlight {:IF}"><!-- item-image -->
                                            <div class="item-image-box">
                                                <div class="item-image"><a href="{ITEM2.link}"><img
                                                        src="{SITE_URL}storage/products/thumb/{ITEM2.picture}"
                                                        alt="{ITEM2.product_name}" class="img-responsive"></a>

                                                    <div class="item-badges">
                                                        IF("{ITEM2.featured}"=="1"){ <span class="featured">{LANG_FEATURED}</span>{:IF}
                                                        IF("{ITEM2.urgent}"=="1"){ <span>{LANG_URGENT}</span>{:IF}
                                                    </div>
                                                </div>
                                                <!-- item-image -->
                                            </div>
                                            <div class="item-info">
                                                <!-- ad-info -->
                                                <div class="ad-info">
                                                    <h4 class="item-title"><a href="{ITEM2.link}">{ITEM2.product_name}</a></h4>
                                                    <ol class="breadcrumb">
                                                        <li>
                                                            <a href="{SITE_URL}listing.php?cat={ITEM2.cat_id}">{ITEM2.category}</a>
                                                        </li>
                                                        <li><a href="{SITE_URL}listing.php?subcat={ITEM2.sub_cat_id}">{ITEM2.sub_category}</a>
                                                        </li>
                                                    </ol>
                                                    <ul class="item-details">
                                                        <li><i class="fa fa-map-marker"></i>{ITEM2.city}</li>
                                                        <li><i class="fa fa-clock-o"></i>{ITEM2.created_at}</li>
                                                    </ul>
                                                    <div class="ad-meta">
                                                        IF("{ITEM2.price}"!="0"){ <span class="item-price"> {ITEM2.price} </span> {:IF}
                                                        <ul class="contact-options pull-right" id="set-favorite">
                                                            <li><a href="#" data-item-id="{ITEM2.id}" data-userid="{USER_ID}"
                                                                   data-action="setFavAd" class="fav_{ITEM2.id} fa fa-heart IF("
                                                                   {ITEM2.favorite}"=="1"){ active {:IF}"></a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <!-- ad-info -->
                                            </div>
                                            <!-- item-info -->
                                        </div>
                                        <!-- quick-item -->
                                        {/LOOP: ITEM2}
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                                <!-- Pagination-->
                                <div class="pagination-container">
                                    <ul class="pagination">
                                        {LOOP: PAGES}IF("{PAGES.current}"=="0"){
                                        <li><a href="{PAGES.link}">{PAGES.title}</a></li>
                                        {:IF}IF("{PAGES.current}"=="1"){
                                        <li class="active"><a>{PAGES.title}</a></li>
                                        {:IF}{/LOOP: PAGES}
                                    </ul>
                                </div>
                                <!-- Pagination-->
                            </div>
                        </div>
                        <!-- my-quickad -->
                        <!-- advertisement -->
                        IF("{RIGHT_ADSTATUS}"=="1"){
                        <div class="hidden-xs hidden-sm col-md-2 text-center">
                            <div class="advertisement" id="quickad-right">{RIGHT_ADSCODE}</div>
                        </div>
                        {:IF}
                        <!-- advertisement -->
                    </div>
                </div>
            </div>
            <!-- # End Page-Content -->
        </div>
        <!-- row -->
    </div>
    <!-- container -->
</section>
<!-- ad-profile-page -->
<script>var loginurl = "{LINK_LOGIN}?ref=profile.php";</script>
{OVERALL_FOOTER} 