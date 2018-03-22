{OVERALL_HEADER}

<div id="page-content">
    <div class="container">
        <ol class="breadcrumb bcstyle2">
            <li><a href="{LINK_INDEX}">{LANG_HOME}</a></li>
            <li class="active">{MAINCATEGORY}{SUBCATEGORY}
                IF("{MAINCATEGORY}{SUBCATEGORY}"==""){ {LANG_ALL-CATEGORIES} {:IF}</li>
        </ol>
        <a href="{LINK_POST-AD}" class="postadinner"><span> <i class="fa fa-plus-circle"></i> {LANG_POST-AD}</span></a>

        <form method="get" name="locationForm" id="LocationForm">
            <div class="row">
                <div class="col-md-3 col-sm-3">
                    <aside class="sidebar">
                        <section><h2>{LANG_SEARCH-FILTER}</h2>

                            <div class="input-field">
                                <label>{LANG_WHAT} ?</label>
                                <input type="text" name="keywords" value="{KEYWORDS}">
                            </div>
                            <!--end input-field-->
                            <div class="form-group input-field tg-inputwithicon" id="country-popup">
                                <label for="inputStateCity">{LANG_WHERE} ?</label>
                                <i class="fa fa-close" id="clear-city" style="display: none;color: #323232;"></i>
                                <input type="text" id="inputStateCity" name="location" autocomplete="off">
                                <div id="searchDisplay"></div>
                                <input type="hidden" name="placetype" id="searchPlaceType" value="">
                                <input type="hidden" name="placeid" id="searchPlaceId" value="">
                            </div>


                            <div>
                                <select name="cat" class="meterialselect">
                                    <option value="">{LANG_ALL-CATEGORIES}</option>
                                    {LOOP: CATEGORY}
                                    <option value="{CATEGORY.id}" {CATEGORY.selected}>{CATEGORY.name}</option>
                                    {/LOOP: CATEGORY}
                                </select>
                            </div>

                            <!--end input-field-->
                            <div class="form-group">
                                <label>{LANG_PRICE}</label>
                                <div class="inner">
                                    <div class="range-widget">
                                        <div class="range-inputs">
                                            <input type="text" name="range1" placeholder="{LANG_FROM}" value="{RANGE1}">
                                            <input type="text" name="range2" placeholder="{LANG_TO}" value="{RANGE2}">
                                        </div>
                                        <!--<button type="submit"  name="Submit"><i class="fa fa-search"></i></button>-->
                                    </div>
                                </div>
                                <!--end price-slider-->
                            </div>
                            <!--end input-field-->


                            <div class="input-field">
                                <button type="submit" name="Submit" class="btn btn-primary pull-right">{LANG_SEARCH-NOW}<i class="fa fa-search"></i></button>
                            </div>
                            <!--end input-field-->
                        </section>
                    </aside>
                    <!--end sidebar-->
                </div>
                <!--end col-md-3-->
                <div class="col-md-9 col-sm-9">
                    <section>
                        <h2>{LANG_MY-LISTINGS}</h2>
                        <section>
                            <form action="#" id="filterForm" method="get">
                                <div class="search-results-controls clearfix">
                                    <div class="pull-left">
                                        <span id="grid" class="circle-icon cursor-point active"><i class="fa fa-th icon-white"></i></span>
                                        <span id="list" class="circle-icon cursor-point"><i class="fa fa-bars"></i></span>
                                    </div>
                                    <input type="hidden" name="subcat" value="{SUBCAT}">
                                    <!--end left-->
                                    <div class="pull-right">
                                        <div class="input-group inputs-underline min-width-150px">
                                            <select class="meterialselect" name="limit" onchange="this.form.submit()">
                                                <option value="6">{LANG_LIMIT-ORDER}</option>
                                                <option value="10" IF("{LIMIT}"=="10"){ selected {:IF} >10</option>
                                                <option value="15" IF("{LIMIT}"=="15"){ selected {:IF} >15</option>
                                                <option value="20" IF("{LIMIT}"=="20"){ selected {:IF} >20</option>
                                                <option value="25" IF("{LIMIT}"=="25"){ selected {:IF} >25</option>
                                                <option value="30" IF("{LIMIT}"=="30"){ selected {:IF} >30</option>
                                            </select>
                                        </div>
                                    </div>
                                    <!--end right-->
                                    <div class="pull-right mar-right-20">
                                        <div class="input-group inputs-underline min-width-150px">
                                            <select class="meterialselect" name="sort" onchange="this.form.submit()">
                                                <option value="">{LANG_SORT-BY}</option>
                                                <option value="title" IF("{SORT}"=="title"){ selected {:IF} >{LANG_NAME} </option>
                                                <option value="price" IF("{SORT}"=="price"){ selected {:IF} >{LANG_PRICE} </option>
                                                <option value="date" IF("{SORT}"=="date"){ selected {:IF} >{LANG_DATE} </option>
                                            </select>
                                        </div>
                                    </div>
                                    <!--end right-->
                                    <div class="pull-right mar-right-20">
                                        <div class="input-group inputs-underline min-width-150px">
                                            <select class="meterialselect" name="filter" onchange="this.form.submit()">
                                                <option value="">{LANG_PREMIUM-ADS}</option>
                                                <option value="free" IF("{FILTER}"=="free"){ selected {:IF} >{LANG_FREE-ADS}</option>
                                                <option value="urgent" IF("{FILTER}"=="urgent"){ selected {:IF} >{LANG_URGENT-ADS}</option>
                                                <option value="featured" IF("{FILTER}"=="featured"){ selected {:IF} >{LANG_FEATURED-ADS}</option>
                                                <option value="highlight" IF("{FILTER}"=="highlight"){ selected {:IF} >{LANG_HIGHLIGHT-ADS}</option>
                                            </select>
                                        </div>
                                    </div>
                                    <!--end right-->
                                </div>
                                <!--end search-results-controls-->
                            </form>
                        </section>
                        <section>
                            <!-- Subcategory -->
                            <div class="row">
                                <div class="col-sm-12 col-md-12">
                                    <div class="tg-applyedfilters">
                                        <ul>
                                            {LOOP: SUBCATLIST}
                                                <li class="alert alert-dismissable fade in">
                                                    <a href="{SUBCATLIST.link}"><span class="count"> {SUBCATLIST.name} ({SUBCATLIST.adcount})</span></a>
                                                </li>
                                            {/LOOP: SUBCATLIST}

                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <!-- Subcategory -->
                        </section>
                        <section>
                            <div class="" id="serchlist">
                                <div class="searchresult grid hideresult" style="display: none;">
                                    <div class="row">
                                        {LOOP: ITEM}
                                        <div class="col-md-4 col-sm-4">
                                            <div class="item" data-id="{ITEM.id}">
                                                <div class="premium">
                                                    IF("{ITEM.featured}"=="1"){ <span class="listing-box-premium featured">{LANG_FEATURED}</span> {:IF}
                                                    IF("{ITEM.urgent}"=="1"){ <span class="listing-box-premium urgent">{LANG_URGENT}</span> {:IF}
                                                    IF("{ITEM.highlight}"=="1"){ <span class="listing-box-premium highlight">{LANG_HIGHLIGHT}</span> {:IF}

                                                </div>
                                                <div class="ad-listing">
                                                    <div class="description">

                                                        <a href="{ITEM.catlink}"><div class="label label-default">{ITEM.category}</div></a>

                                                        <h3 title="{ITEM.product_name}">
                                                            <a href="{ITEM.link}">{ITEM.product_name}</a>
                                                        </h3>
                                                        <h4>{ITEM.location}</h4>
                                                    </div>
                                                    <!--end description-->
                                                    <div class="image bg-transfer">
                                                        <img src="{SITE_URL}storage/products/thumb/{ITEM.picture}" alt="{ITEM.product_name}">
                                                    </div>
                                                    <!--end image-->
                                                </div>
                                                <div class="additional-info">
                                                    <ul class="icondetail">
                                                        <li><i class="fa fa-th-list"></i> {LANG_SUB-CATEGORY} :
                                                            <a title="{ITEM.sub_category}" href="{ITEM.subcatlink}">{ITEM.sub_category}</a>
                                                        </li>
                                                        <li><i class="fa fa-map-marker"></i> {LANG_LOCATION} : {ITEM.city}, {ITEM.country}</li>
                                                        <li><i class="fa fa-calendar"></i> {LANG_POSTED-ON} : {ITEM.created_at}</li>
                                                        <li><i class="fa fa-user"></i> {LANG_POSTED-BY} : <a href="{ITEM.author_link}" target="_blank">{ITEM.username}</a></li>
                                                    </ul>

                                                    <div class="ad-footer-tags">
                                                        <div class="add-to-fav">
                                                            <a href="#" data-toggle="tooltip" data-placement="top" data-original-title='IF("{ITEM.favorite}"=="1"){ {LANG_REMOVE-FAVOURITE} {:IF}
                                                            IF("{ITEM.favorite}"!="1"){ {LANG_ADD-FAVOURITE} {:IF}' data-item-id="{ITEM.id}" data-userid="{USER_ID}" data-action="setFavAd" class="fav_{ITEM.id}">
                                                            IF("{ITEM.favorite}"=="1"){ <i class="fa fa-heart"></i> {:IF}
                                                            IF("{ITEM.favorite}"!="1"){ <i class="fa fa-heart-o"></i> {:IF}
                                                            </a>
                                                        </div>
                                                        IF("{ITEM.price}"!="0"){ <div class="price-tag">{ITEM.price}</div> {:IF}
                                                    </div>
                                                    <!--end controls-more-->
                                                </div>
                                                <!--end additional-info-->
                                            </div>
                                            <!--end item-->
                                        </div>
                                        <!--<end col-md-4-->
                                        {/LOOP: ITEM}
                                    </div>
                                    <!--end row-->
                                </div>
                                <div class="searchresult list hideresult" style="display: none;">
                                    <div class="row">
                                        {LOOP: ITEM2}
                                        <div class="item item-row" data-id="{ITEM2.id}">
                                            <div class="premium">
                                                IF("{ITEM2.featured}"=="1"){ <span class="listing-box-premium featured">{LANG_FEATURED}</span> {:IF}
                                                IF("{ITEM2.urgent}"=="1"){ <span class="listing-box-premium urgent">{LANG_URGENT}</span> {:IF}
                                                IF("{ITEM2.highlight}"=="1"){ <span class="listing-box-premium highlight">{LANG_HIGHLIGHT}</span> {:IF}

                                            </div>
                                            <div class="ad-listing">
                                                <div class="image bg-transfer">

                                                    <figure><a href="{ITEM2.catlink}"><div class="label-featured label label-default">{ITEM2.category}</div></a></figure>

                                                    <img src="{SITE_URL}storage/products/thumb/{ITEM2.picture}" alt="{ITEM2.product_name}">
                                                </div>

                                                <!--end image-->

                                                <div class="description">
                                                    <h3 title="{ITEM2.product_name}">
                                                        <a href="{ITEM2.link}">{ITEM2.product_name}</a>
                                                    </h3>
                                                    <ul class="icondetail">
                                                        <li><i class="fa fa-th-list"></i> {LANG_SUB-CATEGORY} :
                                                            <a title="{ITEM2.sub_category}" href="{ITEM2.subcatlink}">{ITEM2.sub_category}</a>
                                                        </li>
                                                        <li><i class="fa fa-map-marker"></i> {LANG_LOCATION} : {ITEM2.city}, {ITEM2.country}</li>
                                                        <li><i class="fa fa-calendar"></i> {LANG_POSTED-ON} : {ITEM2.created_at}</li>
                                                        <li><i class="fa fa-user"></i> {LANG_POSTED-BY} : <a href="{ITEM2.author_link}" target="_blank">{ITEM2.username}</a></li>
                                                    </ul>
                                                    IF("{ITEM2.showtag}"=="1"){
                                                    <ul class="tags">
                                                        {ITEM2.tag}
                                                    </ul>
                                                    {:IF}
                                                    <div class="ad-footer-tags">
                                                        <div class="add-to-fav">
                                                            <a href="#" data-toggle="tooltip" data-placement="top" data-original-title='IF("{ITEM2.favorite}"=="1"){ {LANG_REMOVE-FAVOURITE} {:IF}
                                                            IF("{ITEM2.favorite}"!="1"){ {LANG_ADD-FAVOURITE} {:IF}' data-item-id="{ITEM2.id}" data-userid="{USER_ID}" data-action="setFavAd" class='fav_{ITEM2.id}'>
                                                            IF("{ITEM2.favorite}"=="1"){ <i class="fa fa-heart"></i> {:IF}
                                                            IF("{ITEM2.favorite}"!="1"){ <i class="fa fa-heart-o"></i> {:IF}
                                                            </a>
                                                        </div>
                                                        IF("{ITEM2.price}"!="0"){ <div class="price-tag">{ITEM2.price}</div> {:IF}
                                                    </div>
                                                </div>
                                                <!--end description-->

                                            </div>

                                        </div>
                                        <!--end item.row-->
                                        {/LOOP: ITEM2}
                                    </div>
                                </div>
                            </div>
                        </section>

                        IF("{ADSFOUND}"=="0"){
                        <section><h4>:( No ads found.</h4></section>
                        {:IF}

                        <section>
                            <div class="center">
                                <ul class="pagination center">
                                    {LOOP: PAGES}
                                    IF("{PAGES.current}"=="0"){ <li><a href="{PAGES.link}">{PAGES.title}</a> </li>{:IF}
                                    IF("{PAGES.current}"=="1"){ <li class="active"> <a>{PAGES.title}</a> </li>{:IF}
                                    {/LOOP: PAGES}
                                </ul>
                            </div>
                        </section>

                    </section>
                </div>
                <!--end col-md-9-->
            </div>
        </form>
        <!--end row-->
    </div>
    <!--end container-->
</div>
<!--end page-content-->
<script type="text/javascript">
    $(document).ready(function () {
        $(".current").addClass("active");
        if ($('.getParent').length > 0) {
            $('.getParent').parent().addClass('in');
        }
    });


</script>

{OVERALL_FOOTER}