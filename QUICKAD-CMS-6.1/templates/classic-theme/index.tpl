{OVERALL_HEADER}<!-- home-one-info -->
<section id="home-one-info" class="clearfix home-one"><!-- world -->
    <div id="banner-two" style="background-image:url({SITE_URL}storage/banner/{BANNER_IMAGE});background-size: cover;">
        <div class="row text-center"><!-- banner -->
            <div class="col-sm-12 ">
                <div class="banner">
                    <h1 class="title">{LANG_HOME_BANNER_HEADING}</h1>
                    <h3>{LANG_HOME_BANNER_TAGLINE}</h3>
                    <!-- banner-form -->
                    <div class="banner-form">
                        <form method="get" action="{LINK_LISTING}">
                            <!-- category-change -->
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="dropdown category-dropdown"><a data-toggle="dropdown" href="#"><span
                                            class="change-text">{LANG_SELECT-CATEGORY}</span><i
                                            class="fa fa-navicon"></i></a>
                                        {CAT_DROPDOWN}
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <input type="text" class="form-control" name="serachStr" placeholder="{LANG_WHAT} ?"
                                           id="keywords">
                                </div>
                                <div class="col-md-3 banner-icon"><i class="fa fa-map-marker"></i>
                                    <input type="text" id="searchStateCity" name="location" class="form-control"
                                           placeholder="{LANG_WHERE} ?">
                                    <input type="hidden" name="placetype" id="searchPlaceType" value="">
                                    <input type="hidden" name="placeid" id="searchPlaceId" value="">
                                </div>
                                <div class="col-md-2">
                                    <input type="hidden" id="input-maincat" name="cat" value=""/>
                                    <input type="hidden" id="input-subcat" name="subcat" value=""/>
                                    <button data-ajax-response='map' type="submit" name="searchform"
                                            class="form-control"><i class="fa fa-search"></i> {LANG_SEARCH}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- banner-form -->
                </div>
            </div>
            <!-- banner -->
        </div>
        <!-- row -->
    </div>
    <!-- world -->
    <div class="container">
        <!-- main-content -->
        <div class="main-content" id="serchlist">
            <!-- row -->
            <div class="row">
                IF("{LEFT_ADSTATUS}"=="1"){
                <div class="hidden-xs hidden-sm col-md-2 text-center">
                    <div class="advertisement" id="quickad-left">{LEFT_ADSCODE}</div>
                </div>
                {:IF}
                <!-- product-list -->
                <div class="{CATEGORY_COLUMN}">
                    <!-- categorys -->
                    <div class="section category-quickad text-center">
                        <ul class="category-list">
                            {LOOP: CAT}
                            <li class="category-item"><a href="{CAT.catlink}">
                                <div class="category-icon"><i class="{CAT.icon}"></i></div>
                                <span class="category-title">{CAT.main_title}</span><span class="category-quantity">({CAT.main_ads_count})</span></a>
                            </li>
                            <!-- category-item -->
                            {/LOOP: CAT}
                        </ul>
                    </div>
                    <!-- category-ad -->
                    <!-- quickad-section -->
                    <div class="quickad-section text-center" id="quickad-top">{TOP_ADSCODE}</div>
                    <!-- quickad-section -->

                    <!-- featured-slide -->
                    <div class="section featured-slide">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="section-title featured-top">
                                    <h4>{LANG_PREMIUM-ADS}</h4>
                                </div>
                            </div>
                        </div>
                        <!-- featured-slider -->
                        <div class="featured-slider">
                            <div id="featured-slider" >
                                {LOOP: ITEM}
                                <div class='quick-item IF("{ITEM.highlight}"=="1"){ highlight {:IF}'>
                                <!-- item-image -->
                                <div class="item-image-box">
                                    <div class="item-image"><a href="{ITEM.link}"><img
                                            src="{SITE_URL}storage/products/thumb/{ITEM.picture}" alt="{ITEM.product_name}"
                                            class="img-responsive"></a>

                                        <div class="item-badges">
                                            IF("{ITEM.featured}"=="1"){ <span class="featured">{LANG_FEATURED}</span>{:IF}
                                            IF("{ITEM.urgent}"=="1"){ <span>{LANG_URGENT}</span>{:IF}
                                        </div>
                                    </div>
                                    <!-- item-image -->
                                </div>
                                <div class="item-info">
                                    <!-- ad-info -->
                                    <div class="ad-info">
                                        <h4 class="item-title"><a href="{ITEM.link}">{ITEM.product_name}</a></h4>
                                        <ol class="breadcrumb">
                                            <li><a href="{ITEM.catlink}">{ITEM.category}</a></li>
                                            <li class="hidden"><a title="{ITEM.sub_category}" href="{ITEM.subcatlink}">{ITEM.sub_category}</a>
                                            </li>
                                        </ol>
                                        <ul class="item-details">
                                            <li><i class="fa fa-map-marker"></i><a href="{ITEM.citylink}">{ITEM.location}</a></li>
                                            <li><i class="fa fa-clock-o"></i>{ITEM.created_at}</li>
                                        </ul>
                                        <div class="ad-meta">
                                            IF("{ITEM.price}"!="0"){ <span class="item-price"> {ITEM.price} </span> {:IF}
                                            <ul class="contact-options pull-right" id="set-favorite">
                                                <li><a href="#" data-item-id="{ITEM.id}" data-userid="{USER_ID}"
                                                       data-action="setFavAd" class="fav_{ITEM.id} fa fa-heart IF("{ITEM.favorite}"=="1"){ active {:IF}"></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <!-- ad-info -->
                                </div>
                                <!-- item-info -->
                            </div>
                            <!-- quick-item -->
                            {/LOOP: ITEM}
                        </div>
                        <!-- featured-slider -->
                    </div>
                        <!-- #featured-slider -->
                    </div>
                    <!-- featured-slide -->
                    <!-- recent-slide -->
                    <div class="section recommended-ads">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="featured-top">
                                    <h4>{LANG_LATEST_ADS}</h4>
                                </div>
                            </div>
                        </div>
                        <!-- recent-slider -->
                        <div class="recommended-slider" id="serchlist">
                            <div id="latest-slider">
                                {LOOP: ITEM2}
                                <div class='quick-item IF(" {ITEM2.highlight}"=="1"){ highlight {:IF}'>
                                <!-- item-image -->
                                <div class="item-image-box">
                                    <div class="item-image"><a href="{ITEM2.link}"><img
                                            src="{SITE_URL}storage/products/thumb/{ITEM2.picture}" alt="{ITEM2.product_name}" class="img-responsive"></a>

                                        <div class="item-badges">
                                            IF("{ITEM2.featured}"=="1"){ <span class="featured">{LANG_FEATURED}</span> {:IF}
                                            IF("{ITEM2.urgent}"=="1"){ <span>{LANG_URGENT}</span> {:IF}
                                        </div>
                                    </div>
                                    <!-- item-image -->
                                </div>
                                <div class="item-info">
                                    <!-- ad-info -->
                                    <div class="ad-info">
                                        <h4 class="item-title"><a href="{ITEM2.link}">{ITEM2.product_name}</a></h4>
                                        <ol class="breadcrumb">
                                            <li><a href="{ITEM2.catlink}">{ITEM2.category}</a></li>
                                            <li class="hidden"><a title="{ITEM2.sub_category}" href="{ITEM2.subcatlink}">{ITEM2.sub_category}</a>
                                            </li>
                                        </ol>
                                        <ul class="item-details">
                                            <li><i class="fa fa-map-marker"></i><a href="{ITEM2.citylink}">{ITEM2.location}</a></li>
                                            <li><i class="fa fa-clock-o"></i>{ITEM2.created_at}</li>
                                        </ul>
                                        <div class="ad-meta">
                                            IF("{ITEM2.price}"!="0"){ <span class="item-price"> {ITEM2.price} </span> {:IF}
                                            <ul class="contact-options pull-right" id="set-favorite">
                                                <li><a href="#" data-item-id="{ITEM2.id}" data-userid="{USER_ID}" data-action="setFavAd"
                                                       class="fav_{ITEM2.id} fa fa-heart IF("{ITEM2.favorite}"=="1"){ active {:IF}"></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <!-- ad-info -->
                                </div>
                                <!-- item-info -->
                            </div>
                            <!-- quick-item -->
                            {/LOOP: ITEM2}
                        </div>
                        <!-- recent-slider -->
                    </div>
                        <!-- #recent-slider -->
                    </div>
                    <!-- recent-slide -->
                </div>
                <!-- product-list -->
                <!-- advertisement -->

                IF("{RIGHT_ADSTATUS}"=="1"){
                <div class="hidden-xs hidden-sm col-md-2 text-center">
                    <div class="advertisement" id="quickad-right">{RIGHT_ADSCODE}</div>
                </div>
                {:IF}
                <!-- advertisement -->
            </div>
            <!-- row -->
        </div>
        <!-- main-content -->
    </div>
    <!-- container -->
</section>
<!-- home-one-info -->
<script>
    var loginurl = "{LINK_LOGIN}?ref=index.php";
</script>

{OVERALL_FOOTER}




