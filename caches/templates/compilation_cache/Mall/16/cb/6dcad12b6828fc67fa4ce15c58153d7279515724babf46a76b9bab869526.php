<?php

/* goods/goods_squares.html */
class __TwigTemplate_16cb6dcad12b6828fc67fa4ce15c58153d7279515724babf46a76b9bab869526 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<style type=\"text/css\">
#box { background: #FFF; width: 238px; height: 410px; margin: -390px 0 0 0; display: block; border: solid 4px #D93600; position: absolute; z-index: 999; opacity: .5}
.shopMenu { position: fixed; z-index:1; right:25%; top: 0;}

</style>
<div class=\"squares\" nc_type=\"current_display_mode\">
  ";
        // line 7
        if ((isset($context["goods_list"]) ? $context["goods_list"] : null)) {
            // line 8
            echo "  <ul class=\"list_pic\">
  \t";
            // line 9
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable((isset($context["goods_list"]) ? $context["goods_list"] : null));
            foreach ($context['_seq'] as $context["_key"] => $context["value"]) {
                // line 10
                echo "    <li class=\"item\">
      <div class=\"goods-content\" nctype_goods=\"";
                // line 11
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["value"]) ? $context["value"] : null), "goods_id", array()), "html", null, true);
                echo "\" nctype_store=\"";
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["value"]) ? $context["value"] : null), "store_id", array()), "html", null, true);
                echo "\">
        <div class=\"goods-pic\"><a href=\"";
                // line 12
                echo twig_escape_filter($this->env, $this->env->getExtension('Web_html_twig')->getPath("goods/index/init", array("goods_id" => $this->getAttribute((isset($context["value"]) ? $context["value"] : null), "goods_id", array()))), "html", null, true);
                echo "\" target=\"_blank\" title=\"";
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["value"]) ? $context["value"] : null), "goods_name", array()), "html", null, true);
                echo "\"><img src=\"";
                echo twig_escape_filter($this->env, $this->env->getExtension('Web_html_twig')->getThumb((isset($context["value"]) ? $context["value"] : null), 240), "html", null, true);
                echo "\" title=\"";
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["value"]) ? $context["value"] : null), "goods_name", array()), "html", null, true);
                echo "\" alt=\"";
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["value"]) ? $context["value"] : null), "goods_name", array()), "html", null, true);
                echo "\" /></a> </div>
        ";
                // line 13
                if ($this->getAttribute((isset($context["value"]) ? $context["value"] : null), "group_flag", array())) {
                    // line 14
                    echo "        <div class=\"goods-promotion\"><span>团购商品</span></div>
        ";
                } elseif ($this->getAttribute((isset($context["value"]) ? $context["value"] : null), "xianshi_flag", array())) {
                    // line 16
                    echo "        <div class=\"goods-promotion\"><span>限时折扣</span></div>
        ";
                }
                // line 18
                echo "        <div class=\"goods-info\">
          <div class=\"goods-pic-scroll-show\">
          \t";
                // line 20
                if ($this->getAttribute((isset($context["value"]) ? $context["value"] : null), "image", array())) {
                    // line 21
                    echo "            <ul>
              ";
                    // line 22
                    $context["i"] = 0;
                    // line 23
                    echo "              ";
                    $context['_parent'] = (array) $context;
                    $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["value"]) ? $context["value"] : null), "image", array()));
                    foreach ($context['_seq'] as $context["_key"] => $context["val"]) {
                        // line 24
                        echo "              ";
                        $context["i"] = ((isset($context["i"]) ? $context["i"] : null) + 1);
                        // line 25
                        echo "              <li";
                        if (((isset($context["i"]) ? $context["i"] : null) == 1)) {
                            echo " class=\"selected\"";
                        }
                        echo "><a href=\"javascript:void(0);\"><img src=\"";
                        echo twig_escape_filter($this->env, $this->env->getExtension('Web_html_twig')->getThumb((isset($context["val"]) ? $context["val"] : null), 60), "html", null, true);
                        echo "\"/></a></li>
              ";
                    }
                    $_parent = $context['_parent'];
                    unset($context['_seq'], $context['_iterated'], $context['_key'], $context['val'], $context['_parent'], $context['loop']);
                    $context = array_intersect_key($context, $_parent) + $_parent;
                    // line 27
                    echo "            </ul>
            ";
                }
                // line 29
                echo "          </div>
          <div class=\"goods-name\">
          \t<a href=\"";
                // line 31
                echo twig_escape_filter($this->env, $this->env->getExtension('Web_html_twig')->getPath("goods/index/init", array("goods_id" => $this->getAttribute((isset($context["value"]) ? $context["value"] : null), "goods_id", array()))), "html", null, true);
                echo "\" target=\"_blank\" title=\"";
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["value"]) ? $context["value"] : null), "goods_jingle", array()), "html", null, true);
                echo "\">";
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["value"]) ? $context["value"] : null), "goods_name", array()), "html", null, true);
                echo "<em>";
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["value"]) ? $context["value"] : null), "goods_jingle", array()), "html", null, true);
                echo "</em></a>
          </div>

          <div class=\"goods-price\">
          <em class=\"sale-price\" title=\"";
                // line 35
                echo twig_escape_filter($this->env, $this->env->getExtension('Web_html_twig')->getLang("goods:class_index_store_price"), "html", null, true);
                echo " ";
                echo $this->env->getExtension('Web_html_twig')->getLang("common:nc_colon");
                echo " ";
                echo $this->env->getExtension('Web_html_twig')->getLang("common:currency");
                echo " ";
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["value"]) ? $context["value"] : null), "goods_price", array()), "html", null, true);
                echo "\">";
                echo $this->env->getExtension('Web_html_twig')->filterNcPriceFormatForList($this->getAttribute((isset($context["value"]) ? $context["value"] : null), "goods_price", array()));
                echo "</em>
          <em class=\"market-price\" title=\"市场价：";
                // line 36
                echo $this->env->getExtension('Web_html_twig')->getLang("common:currency");
                echo " ";
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["value"]) ? $context["value"] : null), "goods_marketprice", array()), "html", null, true);
                echo "\">";
                echo $this->env->getExtension('Web_html_twig')->filterNcPriceFormatForList($this->getAttribute((isset($context["value"]) ? $context["value"] : null), "goods_marketprice", array()));
                echo "</em>
          <span class=\"raty\" data-score=\"";
                // line 37
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["value"]) ? $context["value"] : null), "evaluation_good_star", array()), "html", null, true);
                echo "\"></span>
      </div>
          <div class=\"sell-stat\">
            <ul>
              <li><a href=\"";
                // line 41
                echo twig_escape_filter($this->env, $this->env->getExtension('Web_html_twig')->getPath("goods/index/init", array("goods_id" => $this->getAttribute((isset($context["value"]) ? $context["value"] : null), "goods_id", array()))), "html", null, true);
                echo "#ncGoodsRate\" target=\"_blank\" class=\"status\">";
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["value"]) ? $context["value"] : null), "goods_salenum", array()), "html", null, true);
                echo "</a><p>商品销量</p></li>
              <li><a href=\"";
                // line 42
                echo twig_escape_filter($this->env, $this->env->getExtension('Web_html_twig')->getPath("goods/index/init", array("goods_id" => $this->getAttribute((isset($context["value"]) ? $context["value"] : null), "goods_id", array()))), "html", null, true);
                echo "\" target=\"_blank\">";
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["value"]) ? $context["value"] : null), "evaluation_count", array()), "html", null, true);
                echo "</a><p>用户评论</p></li>
              <li><em member_id=\"";
                // line 43
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["value"]) ? $context["value"] : null), "member_id", array()), "html", null, true);
                echo "\">&nbsp;</em></li>
            </ul>
          </div>
          <div class=\"store\"><a href=\"";
                // line 46
                echo twig_escape_filter($this->env, $this->env->getExtension('Web_html_twig')->getPath("show/store/index", array("store_id" => $this->getAttribute((isset($context["value"]) ? $context["value"] : null), "store_id", array())), "", $this->getAttribute((isset($context["value"]) ? $context["value"] : null), "store_domain", array())), "html", null, true);
                echo "\" title=\"";
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["value"]) ? $context["value"] : null), "store_name", array()), "html", null, true);
                echo "\" class=\"name\">";
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["value"]) ? $context["value"] : null), "store_name", array()), "html", null, true);
                echo "</a></div>
         <div class=\"add-cart\">
          ";
                // line 48
                if ($this->getAttribute((isset($context["value"]) ? $context["value"] : null), "group_flag", array())) {
                    // line 49
                    echo "           <a href=\"javascript:void(0);\" nctype=\"buy_now\" data-param=\"{goods_id:";
                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["value"]) ? $context["value"] : null), "goods_id", array()), "html", null, true);
                    echo " }\"><i class=\"icon-shopping-cart\"></i>立即购买</a>
          ";
                } else {
                    // line 51
                    echo "           <a href=\"javascript:void(0);\" nctype=\"add_cart\" data-param=\"{goods_id:";
                    echo twig_escape_filter($this->env, $this->getAttribute((isset($context["value"]) ? $context["value"] : null), "goods_id", array()), "html", null, true);
                    echo " }\"><i class=\"icon-shopping-cart\"></i>加入购物车</a>
          ";
                }
                // line 53
                echo "         </div>
        </div>
      </div>
    </li>
   ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['value'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 58
            echo "    <div class=\"clear\"></div>
  </ul>
  ";
        } else {
            // line 61
            echo "  <div id=\"no_results\" class=\"no-results\"><i></i>";
            echo twig_escape_filter($this->env, $this->env->getExtension('Web_html_twig')->getLang("index_no_record"), "html", null, true);
            echo "</div>
  ";
        }
        // line 63
        echo "</div>
<form id=\"buynow_form\" method=\"post\" action=\"";
        // line 64
        echo twig_escape_filter($this->env, $this->env->getExtension('Web_html_twig')->getPath(), "html", null, true);
        echo "\" target=\"_blank\">
  <input id=\"act\" name=\"act\" type=\"hidden\" value=\"buy\" />
  <input id=\"op\" name=\"op\" type=\"hidden\" value=\"buy_step1\" />
  <input id=\"goods_id\" name=\"cart_id[]\" type=\"hidden\"/>
</form>
<script type=\"text/javascript\" src=\"";
        // line 69
        echo twig_escape_filter($this->env, $this->env->getExtension('Web_html_twig')->getAssets("data/resource/js/jquery.raty/jquery.raty.min.js"), "html", null, true);
        echo "\"></script>
<script type=\"text/javascript\">
    \$(document).ready(function(){
        \$(\".raty\").raty({
            path: \"";
        // line 73
        echo twig_escape_filter($this->env, $this->env->getExtension('Web_html_twig')->getAssets("data/resource/js/jquery.raty/img"), "html", null, true);
        echo "\",
            readOnly: true,
            width: 80,
            score: function() {
              return \$(this).attr(\"data-score\");
            }
        });
    });
</script>

";
    }

    public function getTemplateName()
    {
        return "goods/goods_squares.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  227 => 73,  220 => 69,  209 => 63,  198 => 58,  188 => 53,  182 => 51,  176 => 49,  165 => 46,  159 => 43,  140 => 37,  132 => 36,  99 => 27,  83 => 24,  78 => 23,  76 => 22,  73 => 21,  63 => 16,  45 => 12,  39 => 11,  36 => 10,  29 => 8,  27 => 7,  211 => 57,  208 => 56,  200 => 53,  197 => 52,  190 => 50,  186 => 48,  172 => 45,  169 => 44,  166 => 43,  162 => 42,  158 => 41,  155 => 40,  150 => 38,  147 => 41,  144 => 36,  126 => 32,  114 => 27,  109 => 26,  107 => 31,  103 => 29,  100 => 23,  97 => 22,  84 => 20,  77 => 18,  67 => 18,  59 => 14,  43 => 11,  40 => 10,  35 => 9,  32 => 9,  30 => 7,  19 => 1,  576 => 267,  571 => 12,  553 => 10,  535 => 338,  531 => 337,  458 => 267,  438 => 250,  424 => 239,  419 => 237,  404 => 225,  393 => 217,  389 => 216,  385 => 215,  381 => 214,  377 => 213,  373 => 212,  367 => 209,  354 => 199,  346 => 197,  342 => 196,  333 => 190,  326 => 188,  301 => 166,  297 => 165,  293 => 164,  282 => 156,  272 => 152,  264 => 147,  260 => 146,  256 => 145,  250 => 142,  239 => 137,  235 => 136,  231 => 135,  153 => 42,  149 => 59,  145 => 58,  141 => 57,  124 => 52,  120 => 35,  116 => 50,  112 => 49,  92 => 32,  86 => 25,  82 => 28,  75 => 24,  70 => 16,  66 => 21,  62 => 20,  58 => 19,  52 => 16,  46 => 13,  42 => 12,  38 => 11,  34 => 10,  23 => 3,  865 => 276,  858 => 272,  855 => 271,  853 => 270,  850 => 269,  845 => 267,  842 => 266,  840 => 265,  833 => 261,  827 => 258,  807 => 241,  803 => 240,  798 => 238,  794 => 237,  786 => 232,  782 => 230,  780 => 229,  765 => 217,  761 => 216,  752 => 212,  746 => 211,  713 => 206,  684 => 205,  655 => 204,  643 => 203,  637 => 199,  633 => 197,  627 => 194,  623 => 192,  620 => 191,  614 => 187,  605 => 185,  602 => 184,  598 => 182,  592 => 180,  590 => 179,  586 => 177,  566 => 11,  563 => 174,  560 => 173,  557 => 172,  539 => 339,  537 => 170,  530 => 167,  527 => 166,  524 => 165,  521 => 164,  516 => 163,  513 => 162,  511 => 161,  508 => 160,  505 => 159,  503 => 158,  500 => 157,  494 => 155,  492 => 154,  488 => 152,  466 => 150,  463 => 149,  460 => 268,  457 => 147,  439 => 146,  437 => 145,  430 => 142,  423 => 141,  421 => 140,  418 => 139,  415 => 138,  412 => 137,  410 => 136,  407 => 135,  403 => 133,  401 => 132,  397 => 130,  374 => 128,  371 => 127,  368 => 126,  350 => 198,  348 => 124,  341 => 121,  334 => 120,  331 => 119,  328 => 118,  323 => 115,  320 => 114,  307 => 112,  302 => 111,  299 => 110,  296 => 109,  283 => 107,  278 => 155,  276 => 105,  270 => 103,  267 => 102,  265 => 101,  259 => 97,  253 => 95,  251 => 94,  246 => 91,  243 => 138,  240 => 89,  238 => 88,  232 => 84,  222 => 81,  212 => 64,  206 => 79,  203 => 61,  199 => 77,  193 => 74,  185 => 69,  180 => 47,  174 => 48,  167 => 60,  163 => 58,  156 => 56,  152 => 39,  137 => 56,  133 => 34,  130 => 50,  128 => 33,  118 => 29,  115 => 47,  111 => 46,  108 => 45,  106 => 44,  96 => 43,  93 => 42,  89 => 41,  81 => 35,  79 => 19,  71 => 20,  65 => 26,  61 => 14,  57 => 13,  37 => 7,  31 => 3,  28 => 2,);
    }
}
