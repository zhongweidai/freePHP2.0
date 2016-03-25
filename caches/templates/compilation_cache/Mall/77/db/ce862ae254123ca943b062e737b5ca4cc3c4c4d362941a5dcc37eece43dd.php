<?php

/* layout-webfront.html */
class __TwigTemplate_77dbce862ae254123ca943b062e737b5ca4cc3c4c4d362941a5dcc37eece43dd extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'title' => array($this, 'block_title'),
            'keywords' => array($this, 'block_keywords'),
            'description' => array($this, 'block_description'),
            'content' => array($this, 'block_content'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<!DOCTYPE html>
<!--[if lt IE 7]>      <html class=\"lt-ie9 lt-ie8 lt-ie7\"> <![endif]-->
<!--[if IE 7]>         <html class=\"lt-ie9 lt-ie8\"> <![endif]-->
<!--[if IE 8]>         <html class=\"lt-ie9\"> <![endif]-->
<!--[if gt IE 8]><!--> <html class=\"\"> <!--<![endif]-->
<head>
    <meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\">
    <meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">
    <title>";
        // line 10
        $this->displayBlock('title', $context, $blocks);
        echo "</title>
    <meta name=\"keywords\" content=\"";
        // line 11
        $this->displayBlock('keywords', $context, $blocks);
        echo "\" />
    <meta name=\"description\" content=\"";
        // line 12
        $this->displayBlock('description', $context, $blocks);
        echo "\" />
    <meta content=\"";
        // line 13
        echo twig_escape_filter($this->env, $this->env->getExtension('Web_html_twig')->getCsrfToken("site"), "html", null, true);
        echo "\" name=\"csrf-token\" />
    <style type=\"text/css\">
        body {
            _behavior: url(";
        // line 16
        echo twig_escape_filter($this->env, $this->env->getExtension('Web_html_twig')->getAssets("style/default/css/csshover.htc"), "html", null, true);
        echo ");
        }
    </style>
    <link href=\"";
        // line 19
        echo twig_escape_filter($this->env, $this->env->getExtension('Web_html_twig')->getAssets("style/default/css/base.css"), "html", null, true);
        echo "\" rel=\"stylesheet\" type=\"text/css\">
    <link href=\"";
        // line 20
        echo twig_escape_filter($this->env, $this->env->getExtension('Web_html_twig')->getAssets("style/default/css/home_header.css"), "html", null, true);
        echo "\" rel=\"stylesheet\" type=\"text/css\">
    <link href=\"";
        // line 21
        echo twig_escape_filter($this->env, $this->env->getExtension('Web_html_twig')->getAssets("style/default/css/home_login.css"), "html", null, true);
        echo "\" rel=\"stylesheet\" type=\"text/css\">
    <link href=\"";
        // line 22
        echo twig_escape_filter($this->env, $this->env->getExtension('Web_html_twig')->getAssets("resource/font/font-awesome/css/font-awesome.min.css"), "html", null, true);
        echo "\" rel=\"stylesheet\" />
    <!--[if IE 7]>
    <link rel=\"stylesheet\" href=\"";
        // line 24
        echo twig_escape_filter($this->env, $this->env->getExtension('Web_html_twig')->getAssets("resource/font/font-awesome/css/font-awesome-ie7.min.css"), "html", null, true);
        echo "\">
    <![endif]-->
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src=\"";
        // line 28
        echo twig_escape_filter($this->env, $this->env->getExtension('Web_html_twig')->getAssets("data/resource/js/html5shiv.js"), "html", null, true);
        echo "\"></script>
    <script src=\"";
        // line 29
        echo twig_escape_filter($this->env, $this->env->getExtension('Web_html_twig')->getAssets("data/resource/js/respond.min.js"), "html", null, true);
        echo "\"></script>
    <![endif]-->
    <!--[if IE 6]>
    <script src=\"";
        // line 32
        echo twig_escape_filter($this->env, $this->env->getExtension('Web_html_twig')->getAssets("data/resource/js/IE6_PNG.js"), "html", null, true);
        echo "\"></script>
    <script>
        DD_belatedPNG.fix('.pngFix');
    </script>
    <script>
        // <![CDATA[
if((window.navigator.appName.toUpperCase().indexOf(\"MICROSOFT\")>=0)&&(document.execCommand))
try{
document.execCommand(\"BackgroundImageCache\", false, true);
   }
catch(e){}
// ]]>
</script>
<![endif]-->
    <script>
        var COOKIE_PRE = '4E47_';
\t\tvar _CHARSET = 'utf-8';
\t\tvar SITEURL = '";
        // line 49
        echo twig_escape_filter($this->env, $this->env->getExtension('Web_html_twig')->getAssets(), "html", null, true);
        echo "';
\t\tvar SHOP_SITE_URL = '";
        // line 50
        echo twig_escape_filter($this->env, $this->env->getExtension('Web_html_twig')->getAssets(), "html", null, true);
        echo "';
\t\tvar RESOURCE_SITE_URL = '";
        // line 51
        echo twig_escape_filter($this->env, $this->env->getExtension('Web_html_twig')->getAssets("resource"), "html", null, true);
        echo "';
\t\tvar RESOURCE_SITE_URL = '";
        // line 52
        echo twig_escape_filter($this->env, $this->env->getExtension('Web_html_twig')->getAssets("resource"), "html", null, true);
        echo "';
\t\tvar SHOP_TEMPLATES_URL = '";
        // line 53
        echo twig_escape_filter($this->env, $this->env->getExtension('Web_html_twig')->getAssets("style/default"), "html", null, true);
        echo "';
    </script>
    <script src=\"";
        // line 55
        echo twig_escape_filter($this->env, $this->env->getExtension('Web_html_twig')->getAssets("data/resource/js/jquery.js"), "html", null, true);
        echo "\"></script>
    <script src=\"";
        // line 56
        echo twig_escape_filter($this->env, $this->env->getExtension('Web_html_twig')->getAssets("data/resource/js/common.js"), "html", null, true);
        echo "\" charset=\"utf-8\"></script>
    <script src=\"";
        // line 57
        echo twig_escape_filter($this->env, $this->env->getExtension('Web_html_twig')->getAssets("data/resource/js/jquery-ui/jquery.ui.js"), "html", null, true);
        echo "\"></script>
    <script src=\"";
        // line 58
        echo twig_escape_filter($this->env, $this->env->getExtension('Web_html_twig')->getAssets("data/resource/js/jquery.validation.min.js"), "html", null, true);
        echo "\"></script>
    <script src=\"";
        // line 59
        echo twig_escape_filter($this->env, $this->env->getExtension('Web_html_twig')->getAssets("data/resource/js/jquery.masonry.js"), "html", null, true);
        echo "\"></script>
    <script src=\"";
        // line 60
        echo twig_escape_filter($this->env, $this->env->getExtension('Web_html_twig')->getAssets("data/resource/js/dialog/dialog.js"), "html", null, true);
        echo "\" id=\"dialog_js\" charset=\"utf-8\"></script>
    <script type=\"text/javascript\">
        var PRICE_FORMAT = '&yen;%s';
        \$(function(){
            //首页左侧分类菜单
            \$(\".category ul.menu\").find(\"li\").each(
                    function() {
                        \$(this).hover(
                                function() {
                                    var cat_id = \$(this).attr(\"cat_id\");
                                    var menu = \$(this).find(\"div[cat_menu_id='\"+cat_id+\"']\");
                                    menu.show();
                                    \$(this).addClass(\"hover\");
                                    if(menu.attr(\"hover\")>0) return;
                                    menu.masonry({itemSelector: 'dl'});
                                    var menu_height = menu.height();
                                    if (menu_height < 60) menu.height(80);
                                    menu_height = menu.height();
                                    var li_top = \$(this).position().top;
                                    if ((li_top > 60) && (menu_height >= li_top)) \$(menu).css(\"top\",-li_top+50);
                                    if ((li_top > 150) && (menu_height >= li_top)) \$(menu).css(\"top\",-li_top+90);
                                    if ((li_top > 240) && (li_top > menu_height)) \$(menu).css(\"top\",menu_height-li_top+90);
                                    if (li_top > 300 && (li_top > menu_height)) \$(menu).css(\"top\",60-menu_height);
                                    if ((li_top > 40) && (menu_height <= 120)) \$(menu).css(\"top\",-5);
                                    menu.attr(\"hover\",1);
                                },
                                function() {
                                    \$(this).removeClass(\"hover\");
                                    var cat_id = \$(this).attr(\"cat_id\");
                                    \$(this).find(\"div[cat_menu_id='\"+cat_id+\"']\").hide();
                                }
                        );
                    }
            );
            \$(\".head-user-menu dl\").hover(function() {
                        \$(this).addClass(\"hover\");
                    },
                    function() {
                        \$(this).removeClass(\"hover\");
                    });
            \$('.head-user-menu .my-mall').mouseover(function(){// 最近浏览的商品
                load_history_information();
                \$(this).unbind('mouseover');
            });
            \$('.head-user-menu .my-cart').mouseover(function(){// 运行加载购物车
                load_cart_information();
                \$(this).unbind('mouseover');
            });
            \$('#button').click(function(){
                if (\$('#keyword').val() == '') {
                    return false;
                }
            });
        });
    </script>
    <style type=\"text/css\">
        <!--
        .STYLE1 {
            color: #FF0000;
            font-weight: bold;
            font-size: 24px;
        }
        -->
    </style>
</head>
<body>
<!-- <p align=\"center\">
    PublicTopLayout Begin<br>
    <span class=\"STYLE1\">防止其他【骗子网站使用本站演示】唯一QQ：303501108 </span></p><br><br>
<p> -->
<div id=\"append_parent\"></div>
<div id=\"ajaxwaitid\"></div>
<div class=\"public-top-layout w\">
    <div class=\"topbar wrapper\">
        <div class=\"user-entry\">
            您好，欢迎来到      <a href=\"";
        // line 135
        echo twig_escape_filter($this->env, $this->env->getExtension('Web_html_twig')->getPath(), "html", null, true);
        echo "\" title=\"首页\" alt=\"首页\">溢汇商城</a>
            <span>[<a href=\"";
        // line 136
        echo twig_escape_filter($this->env, $this->env->getExtension('Web_html_twig')->getPath("security/login"), "html", null, true);
        echo "\">登录</a>]</span>
            <span>[<a href=\"";
        // line 137
        echo twig_escape_filter($this->env, $this->env->getExtension('Web_html_twig')->getPath("security/register"), "html", null, true);
        echo "\">注册</a>]</span>
            <span class=\"seller-login\"><a href=\"";
        // line 138
        echo twig_escape_filter($this->env, $this->env->getExtension('Web_html_twig')->getPath("security/sellerLogin"), "html", null, true);
        echo "\" target=\"_blank\" title=\"登录商家管理中心\"><i class=\"icon-signin\"></i>商家管理中心</a></span></div>

        <div class=\"quick-menu\">
            <dl>
                <dt><a href=\"";
        // line 142
        echo twig_escape_filter($this->env, $this->env->getExtension('Web_html_twig')->getPath("order/memberOrder"), "html", null, true);
        echo "\">我的订单</a><i></i></dt>
                <dd>
                    <ul>
                        <li><a href=\"";
        // line 145
        echo twig_escape_filter($this->env, $this->env->getExtension('Web_html_twig')->getPath("order/memberOrder", array("state_type" => "state_new")), "html", null, true);
        echo "\">待付款订单</a></li>
                        <li><a href=\"";
        // line 146
        echo twig_escape_filter($this->env, $this->env->getExtension('Web_html_twig')->getPath("order/memberOrder", array("state_type" => "state_send")), "html", null, true);
        echo "\">待确认收货</a></li>
                        <li><a href=\"";
        // line 147
        echo twig_escape_filter($this->env, $this->env->getExtension('Web_html_twig')->getPath("order/memberOrder", array("state_type" => "state_noeval")), "html", null, true);
        echo "\">待评价交易</a></li>
                    </ul>
                </dd>
            </dl>
            <dl>
                <dt><a href=\"";
        // line 152
        echo twig_escape_filter($this->env, $this->env->getExtension('Web_html_twig')->getPath("member/favorites/fglist"), "html", null, true);
        echo "\">我的收藏</a><i></i></dt>
                <dd>
                    <ul>
                        <li><a href=\"";
        // line 155
        echo twig_escape_filter($this->env, $this->env->getExtension('Web_html_twig')->getPath("member/favorites/fglist"), "html", null, true);
        echo "\">商品收藏</a></li>
                        <li><a href=\"";
        // line 156
        echo twig_escape_filter($this->env, $this->env->getExtension('Web_html_twig')->getPath("member/favorites/flist"), "html", null, true);
        echo "\">店铺收藏</a></li>
                    </ul>
                </dd>
            </dl>
            <dl>
                <dt>客户服务<i></i></dt>
                <dd>
                    <ul>
                        <li><a href=\"";
        // line 164
        echo twig_escape_filter($this->env, $this->env->getExtension('Web_html_twig')->getPath("article/article", array("ac_id" => 2)), "html", null, true);
        echo "\">帮助中心</a></li>
                        <li><a href=\"";
        // line 165
        echo twig_escape_filter($this->env, $this->env->getExtension('Web_html_twig')->getPath("article/article", array("ac_id" => 5)), "html", null, true);
        echo "\">售后服务</a></li>
                        <li><a href=\"";
        // line 166
        echo twig_escape_filter($this->env, $this->env->getExtension('Web_html_twig')->getPath("article/article", array("ac_id" => 6)), "html", null, true);
        echo "\">客服中心</a></li>
                    </ul>
                </dd>
            </dl>
        </div>
    </div>
</div>
<script type=\"text/javascript\">
    \$(function(){
        \$(\".quick-menu dl\").hover(function() {
                    \$(this).addClass(\"hover\");
                },
                function() {
                    \$(this).removeClass(\"hover\");
                });

    });
</script>
<!-- PublicHeadLayout Begin -->
</p>
<div class=\"header-wrap\">
    <header class=\"public-head-layout wrapper\">
        <h1 class=\"site-logo\"><a href=\"";
        // line 188
        echo twig_escape_filter($this->env, $this->env->getExtension('Web_html_twig')->getPath(), "html", null, true);
        echo "\"><img src=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('Web_html_twig')->getCAttache("logo.png"), "html", null, true);
        echo "\" class=\"pngFix\"></a></h1>
        <div class=\"head-search-bar\">
            <form action=\"";
        // line 190
        echo twig_escape_filter($this->env, $this->env->getExtension('Web_html_twig')->getPath(), "html", null, true);
        echo "\" method=\"get\" class=\"search-form\">
                <input name=\"m\" id=\"search_act\" value=\"search\" type=\"hidden\">
                <input name=\"keyword\" id=\"keyword\" type=\"text\" class=\"input-text\" value=\"\" maxlength=\"60\" x-webkit-speech lang=\"zh-CN\" onwebkitspeechchange=\"foo()\" placeholder=\"请输入您要搜索的商品关键字\" x-webkit-grammar=\"builtin:search\" />
                <input type=\"submit\" id=\"button\" value=\"搜索\" class=\"input-submit\">
            </form>
            <div class=\"keyword\">热门搜索：        <ul>
                    <li><a href=\"";
        // line 196
        echo twig_escape_filter($this->env, $this->env->getExtension('Web_html_twig')->getPath("search/index", array("keyword" => "周大福")), "html", null, true);
        echo "\">周大福</a></li>
                    <li><a href=\"";
        // line 197
        echo twig_escape_filter($this->env, $this->env->getExtension('Web_html_twig')->getPath("search/index", array("keyword" => "内衣")), "html", null, true);
        echo "\">内衣</a></li>
                    <li><a href=\"";
        // line 198
        echo twig_escape_filter($this->env, $this->env->getExtension('Web_html_twig')->getPath("search/index", array("keyword" => "金史密斯")), "html", null, true);
        echo "\">金史密斯</a></li>
                    <li><a href=\"";
        // line 199
        echo twig_escape_filter($this->env, $this->env->getExtension('Web_html_twig')->getPath("search/index", array("keyword" => "手机")), "html", null, true);
        echo "\">手机</a></li>
                </ul>
            </div>
        </div>
        <div class=\"head-user-menu\">
            <dl class=\"my-mall\">
                <dt><span class=\"ico\"></span>我的商城<i class=\"arrow\"></i></dt>
                <dd>
                    <div class=\"sub-title\">
                        <h4></h4>
                        <a href=\"";
        // line 209
        echo twig_escape_filter($this->env, $this->env->getExtension('Web_html_twig')->getPath("member/sns/index"), "html", null, true);
        echo "\" class=\"arrow\">我的用户中心<i></i></a></div>
                    <div class=\"user-centent-menu\">
                        <ul>
                            <li><a href=\"";
        // line 212
        echo twig_escape_filter($this->env, $this->env->getExtension('Web_html_twig')->getPath("member/home/message"), "html", null, true);
        echo "\">站内消息(<span>0</span>)</a></li>
                            <li><a href=\"";
        // line 213
        echo twig_escape_filter($this->env, $this->env->getExtension('Web_html_twig')->getPath("order/memberOrder"), "html", null, true);
        echo "\" class=\"arrow\">我的订单<i></i></a></li>
                            <li><a href=\"";
        // line 214
        echo twig_escape_filter($this->env, $this->env->getExtension('Web_html_twig')->getPath("member/consult/my_consult"), "html", null, true);
        echo "\">咨询回复(<span id=\"member_consult\">0</span>)</a></li>
                            <li><a href=\"";
        // line 215
        echo twig_escape_filter($this->env, $this->env->getExtension('Web_html_twig')->getPath("member/favorites/fglist"), "html", null, true);
        echo "\" class=\"arrow\">我的收藏<i></i></a></li>
                            <li><a href=\"";
        // line 216
        echo twig_escape_filter($this->env, $this->env->getExtension('Web_html_twig')->getPath("member/voucher"), "html", null, true);
        echo "\">代金券(<span id=\"member_voucher\">0</span>)</a></li>
                            <li><a href=\"";
        // line 217
        echo twig_escape_filter($this->env, $this->env->getExtension('Web_html_twig')->getPath("member/points"), "html", null, true);
        echo "\" class=\"arrow\">我的积分<i></i></a></li>
                        </ul>
                    </div>
                    <div class=\"browse-history\">
                        <div class=\"part-title\">
                            <h4>最近浏览的商品</h4>
                        </div>
                        <ul>
                            <li class=\"no-goods\"><img class=\"loading\" src=\"";
        // line 225
        echo twig_escape_filter($this->env, $this->env->getExtension('Web_html_twig')->getAssets("style/default/images/loading.gif"), "html", null, true);
        echo "\" /></li>
                        </ul>
                    </div>
                </dd>
            </dl>
            <dl class=\"my-cart\">
                <dt><span class=\"ico\"></span>购物车结算<i class=\"arrow\"></i></dt>
                <dd>
                    <div class=\"sub-title\">
                        <h4>最新加入的商品</h4>
                    </div>
                    <div class=\"incart-goods-box\">
                        <div class=\"incart-goods\"> <img class=\"loading\" src=\"";
        // line 237
        echo twig_escape_filter($this->env, $this->env->getExtension('Web_html_twig')->getAssets("style/default/images/loading.gif"), "html", null, true);
        echo "\" /> </div>
                    </div>
                    <div class=\"checkout\"> <span class=\"total-price\">共<i>0</i>种商品</span><a href=\"";
        // line 239
        echo twig_escape_filter($this->env, $this->env->getExtension('Web_html_twig')->getPath("order/cart"), "html", null, true);
        echo "\" class=\"btn-cart\">结算购物车中的商品</a> </div>
                </dd>
            </dl>
        </div>
    </header>
</div>
<!-- PublicHeadLayout End -->
<!-- publicNavLayout Begin -->
<nav class=\"public-nav-layout\">
  <div class=\"wrapper\">
    <div class=\"all-category\">
\t\t";
        // line 250
        echo call_user_func_array($this->env->getFunction('freeRender')->getCallable(), array("index/index/categoryTree"));
        echo "
     </div>
    <ul class=\"site-menu\">
      <li><a href=\"http://127.0.0.1:71/shopnc/shop\" class=\"current\">首页</a></li>
            <li><a href=\"http://127.0.0.1:71/shopnc/shop/index.php?act=show_groupbuy&op=index\" > 团购</a></li>
            <li><a href=\"http://127.0.0.1:71/shopnc/shop/index.php?act=brand&op=index\" > 品牌</a></li>
            <li><a href=\"http://127.0.0.1:71/shopnc/shop/index.php?act=pointprod&op=index\" > 积分中心</a></li>
                                                                              <li><a
         target=\"_blank\" href=\"http://www.shopjl.com/yanshi/2/cms\">门户</a></li>
                        <li><a
         target=\"_blank\" href=\"http://www.shopjl.com/yanshi/2/circle\">圈子</a></li>
                        <li><a
         target=\"_blank\" href=\"http://www.shopjl.com/yanshi/2/microshop\">微商城</a></li>
                      </ul>
  </div>
</nav>
<!-- PublicNavLayout End-->
";
        // line 267
        $this->displayBlock('content', $context, $blocks);
        // line 268
        echo "
<div id=\"faq\">
  <div class=\"wrapper\">
    <ul>
           <li> <dl class=\"s1\">
      <dt>
        帮助中心      </dt>
                  <dd><i></i><a href=\"http://127.0.0.1:71/shopnc/shop/index.php?act=article&op=show&article_id=40\" title=\"积分兑换说明\"> 积分兑换说明 </a></dd>
            <dd><i></i><a href=\"http://127.0.0.1:71/shopnc/shop/index.php?act=article&op=show&article_id=9\" title=\"我要买\"> 我要买 </a></dd>
            <dd><i></i><a href=\"http://127.0.0.1:71/shopnc/shop/index.php?act=article&op=show&article_id=6\" title=\"如何注册成为会员\"> 如何注册成为会员 </a></dd>
            <dd><i></i><a href=\"http://127.0.0.1:71/shopnc/shop/index.php?act=article&op=show&article_id=39\" title=\"积分细则\"> 积分细则 </a></dd>
            <dd><i></i><a href=\"http://127.0.0.1:71/shopnc/shop/index.php?act=article&op=show&article_id=8\" title=\"忘记密码\"> 忘记密码 </a></dd>
                </dl></li>
               <li> <dl class=\"s2\">
      <dt>
        店主之家      </dt>
                  <dd><i></i><a href=\"http://127.0.0.1:71/shopnc/shop/index.php?act=article&op=show&article_id=15\" title=\"如何申请开店\"> 如何申请开店 </a></dd>
            <dd><i></i><a href=\"http://127.0.0.1:71/shopnc/shop/index.php?act=article&op=show&article_id=12\" title=\"查看售出商品\"> 查看售出商品 </a></dd>
            <dd><i></i><a href=\"http://127.0.0.1:71/shopnc/shop/index.php?act=article&op=show&article_id=14\" title=\"商城商品推荐\"> 商城商品推荐 </a></dd>
            <dd><i></i><a href=\"http://127.0.0.1:71/shopnc/shop/index.php?act=article&op=show&article_id=11\" title=\"如何管理店铺\"> 如何管理店铺 </a></dd>
            <dd><i></i><a href=\"http://127.0.0.1:71/shopnc/shop/index.php?act=article&op=show&article_id=13\" title=\"如何发货\"> 如何发货 </a></dd>
                </dl></li>
               <li> <dl class=\"s3\">
      <dt>
        支付方式      </dt>
                  <dd><i></i><a href=\"http://127.0.0.1:71/shopnc/shop/index.php?act=article&op=show&article_id=28\" title=\"分期付款\"> 分期付款 </a></dd>
            <dd><i></i><a href=\"http://127.0.0.1:71/shopnc/shop/index.php?act=article&op=show&article_id=30\" title=\"公司转账\"> 公司转账 </a></dd>
            <dd><i></i><a href=\"http://127.0.0.1:71/shopnc/shop/index.php?act=article&op=show&article_id=17\" title=\"在线支付\"> 在线支付 </a></dd>
            <dd><i></i><a href=\"http://127.0.0.1:71/shopnc/shop/index.php?act=article&op=show&article_id=29\" title=\"邮局汇款\"> 邮局汇款 </a></dd>
            <dd><i></i><a href=\"http://127.0.0.1:71/shopnc/shop/index.php?act=article&op=show&article_id=16\" title=\"如何注册支付宝\"> 如何注册支付宝 </a></dd>
                </dl></li>
               <li> <dl class=\"s4\">
      <dt>
        售后服务      </dt>
                  <dd><i></i><a href=\"http://127.0.0.1:71/shopnc/shop/index.php?act=article&op=show&article_id=32\" title=\"退换货流程\"> 退换货流程 </a></dd>
            <dd><i></i><a href=\"http://127.0.0.1:71/shopnc/shop/index.php?act=article&op=show&article_id=34\" title=\"退款申请\"> 退款申请 </a></dd>
            <dd><i></i><a href=\"http://127.0.0.1:71/shopnc/shop/index.php?act=article&op=show&article_id=31\" title=\"退换货政策\"> 退换货政策 </a></dd>
            <dd><i></i><a href=\"http://127.0.0.1:71/shopnc/shop/index.php?act=article&op=show&article_id=33\" title=\"返修/退换货\"> 返修/退换货 </a></dd>
            <dd><i></i><a href=\"http://127.0.0.1:71/shopnc/shop/index.php?act=article&op=show&article_id=26\" title=\"联系卖家\"> 联系卖家 </a></dd>
                </dl></li>
               <li> <dl class=\"s5\">
      <dt>
        客服中心      </dt>
                  <dd><i></i><a href=\"http://127.0.0.1:71/shopnc/shop/index.php?act=article&op=show&article_id=18\" title=\"会员修改密码\"> 会员修改密码 </a></dd>
            <dd><i></i><a href=\"http://127.0.0.1:71/shopnc/shop/index.php?act=article&op=show&article_id=20\" title=\"商品发布\"> 商品发布 </a></dd>
            <dd><i></i><a href=\"http://127.0.0.1:71/shopnc/shop/index.php?act=article&op=show&article_id=19\" title=\"会员修改个人资料\"> 会员修改个人资料 </a></dd>
            <dd><i></i><a href=\"http://127.0.0.1:71/shopnc/shop/index.php?act=article&op=show&article_id=21\" title=\"修改收货地址\"> 修改收货地址 </a></dd>
                </dl></li>
               <li> <dl class=\"s6\">
      <dt>
        关于我们      </dt>
                  <dd><i></i><a href=\"http://127.0.0.1:71/shopnc/shop/index.php?act=article&op=show&article_id=23\" title=\"联系我们\"> 联系我们 </a></dd>
            <dd><i></i><a href=\"http://127.0.0.1:71/shopnc/shop/index.php?act=article&op=show&article_id=25\" title=\"合作及洽谈\"> 合作及洽谈 </a></dd>
            <dd><i></i><a href=\"http://127.0.0.1:71/shopnc/shop/index.php?act=article&op=show&article_id=22\" title=\"关于ShopNC\"> 关于ShopNC </a></dd>
            <dd><i></i><a href=\"http://127.0.0.1:71/shopnc/shop/index.php?act=article&op=show&article_id=24\" title=\"招聘英才\"> 招聘英才 </a></dd>
                </dl></li>
        </ul>
      </div>
</div>
<div id=\"footer\" class=\"wrapper\">
  <p><a href=\"http://127.0.0.1:71/shopnc/shop\">首页</a>
                | <a  href=\"http://www.shopjl.com/yanshi/2/shop/index.php?act=article&article_id=24\">招聘英才</a>
                | <a  href=\"http://www.shopjl.com/yanshi/2/shop/index.php?act=article&article_id=25\">合作及洽谈</a>
                | <a  href=\"http://www.shopjl.com/yanshi/2/shop/index.php?act=article&article_id=23\">联系我们</a>
                | <a  href=\"http://www.shopjl.com/yanshi/2/shop/index.php?act=article&article_id=22\">关于ShopNC</a>
                                      </p>
  Copyright 2007-2014 ShopNC Inc.,All rights reserved.<br />
  Powered by <span class=\"vol\"><font class=\"b\">Shop</font><font class=\"o\">NC</font></span> <br />
   </div>
<script type=\"text/javascript\" src=\"";
        // line 337
        echo twig_escape_filter($this->env, $this->env->getExtension('Web_html_twig')->getAssets("data/resource/js/jquery.cookie.js"), "html", null, true);
        echo "\"></script>
<script type=\"text/javascript\" src=\"";
        // line 338
        echo twig_escape_filter($this->env, $this->env->getExtension('Web_html_twig')->getAssets("data/resource/js/perfect-scrollbar.min.js"), "html", null, true);
        echo "\"></script>
<script type=\"text/javascript\" src=\"";
        // line 339
        echo twig_escape_filter($this->env, $this->env->getExtension('Web_html_twig')->getAssets("data/resource/js/jquery.mousewheel.js"), "html", null, true);
        echo "\"></script>
<script language=\"javascript\">
\$(function(){
\t// Membership card
\t\$('[nctype=\"mcard\"]').membershipCard({type:'shop'});
});
</script>
</body>
</html>
 ";
    }

    // line 10
    public function block_title($context, array $blocks = array())
    {
        echo " ";
        echo twig_escape_filter($this->env, $this->env->getExtension('Web_html_twig')->getSetting("site.name", "多用户商城"), "html", null, true);
        echo " - ";
        if ($this->env->getExtension('Web_html_twig')->getSetting("site.slogan")) {
            echo twig_escape_filter($this->env, $this->env->getExtension('Web_html_twig')->getSetting("site.slogan"), "html", null, true);
            echo " -";
        }
        echo " Powered by US";
    }

    // line 11
    public function block_keywords($context, array $blocks = array())
    {
    }

    // line 12
    public function block_description($context, array $blocks = array())
    {
    }

    // line 267
    public function block_content($context, array $blocks = array())
    {
    }

    public function getTemplateName()
    {
        return "layout-webfront.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  576 => 267,  571 => 12,  566 => 11,  553 => 10,  539 => 339,  535 => 338,  531 => 337,  460 => 268,  458 => 267,  438 => 250,  424 => 239,  419 => 237,  404 => 225,  393 => 217,  389 => 216,  385 => 215,  381 => 214,  377 => 213,  373 => 212,  367 => 209,  354 => 199,  350 => 198,  346 => 197,  342 => 196,  333 => 190,  326 => 188,  301 => 166,  297 => 165,  293 => 164,  282 => 156,  278 => 155,  272 => 152,  264 => 147,  260 => 146,  256 => 145,  250 => 142,  243 => 138,  239 => 137,  235 => 136,  231 => 135,  153 => 60,  149 => 59,  145 => 58,  141 => 57,  137 => 56,  133 => 55,  128 => 53,  124 => 52,  120 => 51,  116 => 50,  112 => 49,  92 => 32,  86 => 29,  75 => 24,  70 => 22,  66 => 21,  62 => 20,  52 => 16,  46 => 13,  42 => 12,  38 => 11,  34 => 10,  23 => 1,  96 => 40,  90 => 38,  82 => 28,  80 => 35,  73 => 32,  69 => 30,  65 => 28,  63 => 27,  58 => 19,  54 => 24,  31 => 3,  28 => 2,);
    }
}
