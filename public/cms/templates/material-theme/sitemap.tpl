{OVERALL_HEADER}<style>    .grid-sizer, .grid-item {        width: 10%;    }    .sitemap-region {        height: auto;        float: left;    }    .sitemap-region ul li .count {        opacity: 0.8;        display: inline-block;        font-size: 12px;        float: right;        top: 4px;        position: relative;        padding-left: 15px;    }    .cg-nav-wrapper {        background-color: white;        position: relative;        z-index: 2;    }    .cg-nav-wrapper .selected {        border: 2px solid #ff7419;    }    .cg-nav-wrapper .anchor-wrap {        height: 54px;        border: 1px solid #e8e8e8;        position: relative;        z-index: 1;    }    .cg-nav-wrapper .selected a {        color: #ff7529;    }    .cg-nav-wrapper i.caticon {        left: 20px;        width: 18px;        position: absolute;        top: 50%;        font-size: 24px;        transform: translateY(-50%);    }    .cg-nav-wrapper a {        color: #333333;        font-weight: bold;        z-index: 2;        cursor: pointer;        width: 100%;        font-size: 12px;display : block;    }    .cg-nav-wrapper a:hover {        text-decoration: underline;    color: #ff8533;    }    .cg-nav-wrapper .desc {        margin-left: 70px;        margin-right: 0;        display: block;        padding-top: 10px;    }    .cg-main .item {        position: relative;        margin-top: 40px;        box-shadow: none;    }    .cg-main .cg-icon {        width: 30px;        height: 32px;        margin-top: -10px;        position: absolute;        left: 0;        top: 50%;    }    .cg-main .big-title {        height: 22px;        line-height: 22px;        font-size: 22px;        color: #333333;        padding-right: 25px;        background-color: white;        margin-bottom: 0;        padding-left: 50px;        font-weight: normal;        position: relative;    }    .cg-main .sub-item-wrapper {        margin-left: 35px;    }    .cg-main .sub-item {        float: left;        width: 100%;    }    .cg-main .sub-title {        height: 14px;        line-height: 14px;        font-size: 14px;        margin: 25px 0 17px 0;        font-weight: bold;    }    .cg a {        color: #1686cc;    }    .cg-main .sub-title span {        color: #999999;    }    .cg-main .sub-item-cont {        overflow: hidden;    }    .cg ul, .cg li {        list-style: none;        margin: 0;        padding: 0;    }    .cg-main .sub-item-cont li {        line-height: 18px;        height: 18px;        font-size: 12px;        float: left;        width: 30%;        margin-right: 10px;        overflow: hidden;        white-space: nowrap;        text-overflow: ellipsis;    }    .cg ul, .cg li {        list-style: none;        margin: 0;        padding: 0;    }    .cg-main .sub-item-cont a {        color: #333333;    }    .util-clearfix:after {        visibility: hidden;        display: block;        height: 0;        font-size: 0;        content: '\0020';        clear: both;    }    @media (max-width: 767px) {        .cg-nav-wrapper .desc {            display: none !important;        }        .cg-main .sub-item-cont li {            width: 100% !important;        }    }</style><script>    $(document).ready(function() {        $(".jumper").on("click", function( e ) {            e.preventDefault();            $("body, html").animate({                scrollTop: $( $(this).attr('href') ).offset().top            }, 600);        });    });</script><!-- main --><section id="main" class="clearfix page">    <div class="container">        <ul class="breadcrumb bcstyle2">            <li><a href="{LINK_INDEX}">{LANG_HOME}</a></li>            <li class="active"><a>{LANG_SITE-MAP}</a></li>        </ul>        <a href="{LINK_POST-AD}" class="postadinner"><span> <i class="fa fa-plus-circle"></i> {LANG_POST-AD}</span></a>        <!--end breadcrumb-->        <div class="section">            <h2 class="text-center sitemap-h2">{LANG_LIST-CAT-SUBCAT}</h2>            <hr>            <div class="row cg-nav-wrapper cg-nav-wrapper-row-2" data-role="cg-nav-wrapper">                {LOOP: CAT}                <div style="width:20%;float: left">                    <div class="anchor-wrap anchor{CAT.main_id}-wrap" data-role="anchor{CAT.main_id}">                        <a class="anchor{CAT.main_id} jumper" data-role="cont" href="#anchor{CAT.main_id}">                            <i class="caticon {CAT.icon}"></i>                        <span class="desc">                            {CAT.main_title}                        </span>                        </a>                    </div>                </div>                {/LOOP: CAT}            </div>            <div class="cg-main">                {LOOP: SUBCAT}                <div class="item util-clearfix" data-spm="0">                    <h3 class="big-title anchor{SUBCAT.main_id} anchor-agricuture" data-role="anchor{SUBCAT.main_id}-scroll">                        <span id="anchor{SUBCAT.main_id}" class="anchor-subsitution"></span>                        <i class="cg-icon {SUBCAT.icon}"></i>{SUBCAT.main_title}                    </h3>                    <div class="sub-item-wrapper util-clearfix">                        <div class="sub-item">                            <h4 class="sub-title">                                <a href="{SUBCAT.catlink}">{SUBCAT.main_title}</a><span> ({SUBCAT.main_ads_count})</span>                            </h4>                            <div class="sub-item-cont-wrapper">                                <ul class="sub-item-cont util-clearfix">                                    {SUBCAT.sub_title}                                </ul>                            </div>                        </div>                    </div>                </div>                {/LOOP: SUBCAT}            </div>        </div>    </div><!-- container --></section><!-- main -->{OVERALL_FOOTER}