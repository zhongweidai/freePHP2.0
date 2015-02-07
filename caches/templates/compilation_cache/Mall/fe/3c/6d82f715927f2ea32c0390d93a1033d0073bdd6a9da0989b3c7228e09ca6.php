<?php

/* Index/index_init.html */
class __TwigTemplate_fe3c6d82f715927f2ea32c0390d93a1033d0073bdd6a9da0989b3c7228e09ca6 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = $this->env->loadTemplate("layout-webfront.html");

        $this->blocks = array(
            'content' => array($this, 'block_content'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "layout-webfront.html";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_content($context, array $blocks = array())
    {
        // line 4
        echo "<div class=\"nch-breadcrumb-layout\">
  </div>
<link href=\"http://127.0.0.1:71/shopnc/shop/templates/default/css/index.css\" rel=\"stylesheet\" type=\"text/css\">
<!--[if IE 6]>
<script type=\"text/javascript\" src=\"http://127.0.0.1:71/shopnc/data/resource/js/ie6.js\" charset=\"utf-8\"></script>
<![endif]-->
<style type=\"text/css\">
.category { display: block !important;}
</style>
  <div class=\"clear\"></div>

<!-- HomeFocusLayout Begin-->
<div class=\"home-focus-layout\">
    
  <ul id=\"fullScreenSlides\" class=\"full-screen-slides\">
                                        <li style=\"background: #2D080F url('http://127.0.0.1:71/shopnc/data/upload/shop/editor/web-101-101-1.jpg?454') no-repeat center top\">
            <a href=\"\" target=\"_blank\" title=\"冬季名品-大牌季节日\">&nbsp;</a></li>
                                        <li style=\"background: #F6BB3D url('http://127.0.0.1:71/shopnc/data/upload/shop/editor/web-101-101-5.jpg?166') no-repeat center top\">
            <a href=\"\" target=\"_blank\" title=\"全套茶具专场-年终盛典\">&nbsp;</a></li>
                                        <li style=\"background: #36142C url('http://127.0.0.1:71/shopnc/data/upload/shop/editor/web-101-101-2.jpg?331') no-repeat center top\">
            <a href=\"\" target=\"_blank\" title=\"女人再忙也要留一天为自己疯抢\">&nbsp;</a></li>
                                        <li style=\"background: #f2f2f2 url('http://127.0.0.1:71/shopnc/data/upload/shop/editor/web-101-101-3.jpg?249') no-repeat center top\">
            <a href=\"\" target=\"_blank\" title=\"全年爆款-年底清仓\">&nbsp;</a></li>
                                        <li style=\"background: #ECBCB0 url('http://127.0.0.1:71/shopnc/data/upload/shop/editor/web-101-101-4.jpg?250') no-repeat center top\">
            <a href=\"\" target=\"_blank\" title=\"清仓年末特优-满99元包邮\">&nbsp;</a></li>
                                  
  </ul>
  <div class=\"jfocus-trigeminy\">
    <ul>
                              <li>
                                        <a href=\"\" target=\"_blank\" title=\"佳节大献礼-茶满中秋\"><img src=\"http://127.0.0.1:71/shopnc/data/upload/shop/editor/web-101-102-1-1.jpg?842\" alt=\"佳节大献礼-茶满中秋\"></a>
                          <a href=\"\" target=\"_blank\" title=\"孩子喜欢-遥控悍马\"><img src=\"http://127.0.0.1:71/shopnc/data/upload/shop/editor/web-101-102-1-2.jpg?143\" alt=\"孩子喜欢-遥控悍马\"></a>
                          <a href=\"\" target=\"_blank\" title=\"天气凉了-情侣家居服\"><img src=\"http://127.0.0.1:71/shopnc/data/upload/shop/editor/web-101-102-1-3.jpg?114\" alt=\"天气凉了-情侣家居服\"></a>
                                      </li>
                    <li>
                                        <a href=\"\" target=\"_blank\" title=\"越中国越时尚-水晶中国风\"><img src=\"http://127.0.0.1:71/shopnc/data/upload/shop/editor/web-101-102-2-1.jpg?824\" alt=\"越中国越时尚-水晶中国风\"></a>
                          <a href=\"\" target=\"_blank\" title=\"领先全球首创-CoolTec冰爽剃须\"><img src=\"http://127.0.0.1:71/shopnc/data/upload/shop/editor/web-101-102-2-2.jpg?851\" alt=\"领先全球首创-CoolTec冰爽剃须\"></a>
                          <a href=\"\" target=\"_blank\" title=\"健康中的专家-欧姆龙血压计\"><img src=\"http://127.0.0.1:71/shopnc/data/upload/shop/editor/web-101-102-2-3.jpg?734\" alt=\"健康中的专家-欧姆龙血压计\"></a>
                                      </li>
                    <li>
                                        <a href=\"\" target=\"_blank\" title=\"TOPTO秋季格调-衬衫促销季\"><img src=\"http://127.0.0.1:71/shopnc/data/upload/shop/editor/web-101-102-3-1.jpg?191\" alt=\"TOPTO秋季格调-衬衫促销季\"></a>
                          <a href=\"\" target=\"_blank\" title=\"骆驼早秋新品尝试-热销款推荐\"><img src=\"http://127.0.0.1:71/shopnc/data/upload/shop/editor/web-101-102-3-2.jpg?628\" alt=\"骆驼早秋新品尝试-热销款推荐\"></a>
                          <a href=\"\" target=\"_blank\" title=\"识得女人香-冰希利娇真我系列\"><img src=\"http://127.0.0.1:71/shopnc/data/upload/shop/editor/web-101-102-3-3.jpg?851\" alt=\"识得女人香-冰希利娇真我系列\"></a>
                                      </li>
                        </ul>
  </div>  
  <div class=\"right-sidebar\">

    <div class=\"policy\">
      <ul>
        <li class=\"b1\">七天包退</li>
        <li class=\"b2\">正品保障</li>
        <li class=\"b3\">闪电发货</li>
      </ul>
    </div>
        <div class=\"groupbuy\">
      <div class=\"title\"><i>团</i>近期团购</div>
      <ul>
\t  ";
        // line 62
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["group_list"]) ? $context["group_list"] : null));
        foreach ($context['_seq'] as $context["_key"] => $context["group"]) {
            // line 63
            echo "                <li>
          <dl style=\" background-image:url(";
            // line 64
            echo twig_escape_filter($this->env, $this->env->getExtension('Web_html_twig')->getGthumb($this->getAttribute((isset($context["group"]) ? $context["group"] : null), "groupbuy_image1", array())), "html", null, true);
            echo ")\">
            <dt>";
            // line 65
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["group"]) ? $context["group"] : null), "groupbuy_name", array()), "html", null, true);
            echo "</dt>
            <dd class=\"price\"><span class=\"groupbuy-price\">";
            // line 66
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["group"]) ? $context["group"] : null), "groupbuy_price", array()), "html", null, true);
            echo "</span><span class=\"buy-button\"><a href=\"";
            echo twig_escape_filter($this->env, $this->env->getExtension('Web_html_twig')->getPath("groupbuy/show/detail", array("group_id" => 2)), "html", null, true);
            echo "\">立即团</a></span></dd>
            <dd class=\"time\"><span class=\"sell\">已售<em>";
            // line 67
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["group"]) ? $context["group"] : null), "buy_quantity", array()), "html", null, true);
            echo "</em></span>
\t\t\t";
            // line 68
            $context["stime"] = $this->getAttribute((isset($context["group"]) ? $context["group"] : null), "end_time", array());
            // line 69
            echo "                <span class=\"time-remain\" count_down=\"";
            echo twig_escape_filter($this->env, ((isset($context["stime"]) ? $context["stime"] : null) - (isset($context["TIMESTAMP"]) ? $context["TIMESTAMP"] : null)), "html", null, true);
            echo "\"> <em time_id=\"d\">0</em>天<em time_id=\"h\">0</em>小时                    <em time_id=\"m\">0</em>分<em time_id=\"s\">0</em>秒 </span></dd>
          </dl>
        </li>
\t\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['group'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 73
        echo "               
              </ul>
    </div>
    <div class=\"proclamation\">
    ";
        // line 77
        $context["show_article"] = $this->env->getExtension('Web_data_twig')->getData("Article", array("name" => "scgg"));
        // line 78
        echo "      <ul class=\"tabs-nav\">
        <li class=\"tabs-selected\">
          <h3>";
        // line 80
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["show_article"]) ? $context["show_article"] : null), "notice", array()), "ac_name", array()), "html", null, true);
        echo "</h3>
        </li>
        <li>
          <h3>招商入驻</h3>
        </li>
      </ul>
      <div class=\"tabs-panel\">
        <ul class=\"mall-news\">
        ";
        // line 88
        if ($this->getAttribute($this->getAttribute((isset($context["show_article"]) ? $context["show_article"] : null), "notice", array()), "list", array())) {
            // line 89
            echo "        ";
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute($this->getAttribute((isset($context["show_article"]) ? $context["show_article"] : null), "notice", array()), "list", array()));
            foreach ($context['_seq'] as $context["_key"] => $context["notice"]) {
                // line 90
                echo "                                <li><i></i><a target=\"_blank\" href=\"";
                echo twig_escape_filter($this->env, $this->env->getExtension('Web_html_twig')->getPath("index", array("article_id" => $this->getAttribute((isset($context["notice"]) ? $context["notice"] : null), "article_id", array()))), "html", null, true);
                echo "\" title=\"";
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["notice"]) ? $context["notice"] : null), "article_title", array()), "html", null, true);
                echo "\">";
                echo twig_escape_filter($this->env, $this->env->getExtension('Web_html_twig')->filterCutStr($this->getAttribute((isset($context["notice"]) ? $context["notice"] : null), "article_title", array()), 24), "html", null, true);
                echo "</a>
            <time>(";
                // line 91
                echo twig_escape_filter($this->env, twig_date_format_filter($this->env, $this->getAttribute((isset($context["notice"]) ? $context["notice"] : null), "article_time", array()), "y-m-d"), "html", null, true);
                echo ")</time> </li>
        ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['notice'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 93
            echo "\t\t";
        }
        echo "      
                            </ul>

      </div>
      <div class=\"tabs-panel tabs-hide\">
        <a href=\"http://127.0.0.1:71/shopnc/shop/index.php?act=store_joinin&op=index\" title=\"申请商家入驻；已提交申请，可查看当前审核状态。\" class=\"store-join-btn\" target=\"_blank\">&nbsp;</a>
        <a href=\"http://127.0.0.1:71/shopnc/shop/index.php?act=document&op=index&code=open_store\" target=\"_blank\" class=\"store-join-help\"><i class=\"icon-question-sign\"></i>查看开店协议</a>

        </div>
    </div>
  </div>
</div>
<!--HomeFocusLayout End-->

";
        // line 107
        echo $this->getAttribute((isset($context["web_html"]) ? $context["web_html"] : null), "index", array());
        echo "

<!--StandardLayout End-->
  <div class=\"wrapper\">
  <div class=\"mt10\"></div>
  </div>
<script type=\"text/javascript\" src=\"http://127.0.0.1:71/shopnc/shop/resource/js/home_index.js\" charset=\"utf-8\"></script>

";
    }

    public function getTemplateName()
    {
        return "Index/index_init.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  194 => 107,  176 => 93,  168 => 91,  159 => 90,  154 => 89,  152 => 88,  141 => 80,  137 => 78,  135 => 77,  129 => 73,  118 => 69,  116 => 68,  112 => 67,  106 => 66,  102 => 65,  98 => 64,  95 => 63,  91 => 62,  31 => 4,  28 => 3,);
    }
}
