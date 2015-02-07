<?php

/* Search/index_init.html */
class __TwigTemplate_65caa816c14fe0cd89ab13d77e8f61f7ee4742516f0ffc026dc321f34d26221a extends Twig_Template
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

    // line 2
    public function block_content($context, array $blocks = array())
    {
        // line 3
        echo "<!-- publicNavLayout Begin -->
<nav class=\"public-nav-layout\">
  <div class=\"wrapper\">
    <div class=\"all-category\">
\t\t";
        // line 7
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
<script src=\"";
        // line 24
        echo twig_escape_filter($this->env, $this->env->getExtension('Web_html_twig')->getAssets("resource/js/search_goods.js"), "html", null, true);
        echo "\"></script>
<script src=\"";
        // line 25
        echo twig_escape_filter($this->env, $this->env->getExtension('Web_html_twig')->getAssets("data/resource/js/class_area_array.js"), "html", null, true);
        echo "\"></script>
<link href=\"";
        // line 26
        echo twig_escape_filter($this->env, $this->env->getExtension('Web_html_twig')->getAssets("style/default/css/layout.css"), "html", null, true);
        echo "\" rel=\"stylesheet\" type=\"text/css\">
<style type=\"text/css\">
body {
_behavior: url(";
        // line 29
        echo twig_escape_filter($this->env, $this->env->getExtension('Web_html_twig')->getAssets("style/default/css/csshover.htc"), "html", null, true);
        echo ");
}
</style>
<div class=\"nch-container wrapper\" >
  <div class=\"left\">
    ";
        // line 34
        if ((isset($context["goods_class_array"]) ? $context["goods_class_array"] : null)) {
            // line 35
            echo "    <div class=\"nch-module nch-module-style02\">
      <div class=\"title\">
        <h3>分类筛选</h3>
      </div>
      <div class=\"content\">
        <ul id=\"files\" class=\"tree\">
          ";
            // line 41
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable((isset($context["goods_class_array"]) ? $context["goods_class_array"] : null));
            foreach ($context['_seq'] as $context["_key"] => $context["value"]) {
                // line 42
                echo "          <li><i class=\"tree-parent tree-parent-collapsed\"></i>
          <a href=\"";
                // line 43
                echo twig_escape_filter($this->env, $this->env->getExtension('Web_html_twig')->getPath("search/index/init", array("cate_id" => $this->getAttribute((isset($context["value"]) ? $context["value"] : null), "gc_id", array()))), "html", null, true);
                echo "\" ";
                if (($this->getAttribute((isset($context["value"]) ? $context["value"] : null), "gc_id", array()) == $this->getAttribute((isset($context["get"]) ? $context["get"] : null), "cate_id", array()))) {
                    echo " class=\"selected\" ";
                }
                echo ">";
                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["value"]) ? $context["value"] : null), "gc_name", array()), "html", null, true);
                echo "</a>
            ";
                // line 44
                if ($this->getAttribute((isset($context["value"]) ? $context["value"] : null), "class2", array())) {
                    // line 45
                    echo "            <ul>
              ";
                    // line 46
                    $context['_parent'] = (array) $context;
                    $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["value"]) ? $context["value"] : null), "class2", array()));
                    foreach ($context['_seq'] as $context["_key"] => $context["val"]) {
                        // line 47
                        echo "              <li><i class=\"tree-parent tree-parent-collapsed\"></i>
              <a href=\"";
                        // line 48
                        echo twig_escape_filter($this->env, $this->env->getExtension('Web_html_twig')->getPath("search/index/init", array("cate_id" => $this->getAttribute((isset($context["val"]) ? $context["val"] : null), "gc_id", array()))), "html", null, true);
                        echo "\" ";
                        if (($this->getAttribute((isset($context["val"]) ? $context["val"] : null), "gc_id", array()) == $this->getAttribute((isset($context["get"]) ? $context["get"] : null), "cate_id", array()))) {
                            echo " class=\"selected\" ";
                        }
                        echo ">";
                        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["val"]) ? $context["val"] : null), "gc_name", array()), "html", null, true);
                        echo "</a>
                ";
                        // line 49
                        if ($this->getAttribute((isset($context["val"]) ? $context["val"] : null), "class3", array())) {
                            // line 50
                            echo "                <ul>
                  ";
                            // line 51
                            $context['_parent'] = (array) $context;
                            $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["val"]) ? $context["val"] : null), "class3", array()));
                            foreach ($context['_seq'] as $context["_key"] => $context["v"]) {
                                // line 52
                                echo "                  <li class=\"tree-parent tree-parent-collapsed\"><i></i><a href=\"";
                                echo twig_escape_filter($this->env, $this->env->getExtension('Web_html_twig')->getPath("search/index/init", array("cate_id" => $this->getAttribute((isset($context["v"]) ? $context["v"] : null), "gc_id", array()))), "html", null, true);
                                echo "\" ";
                                if (($this->getAttribute((isset($context["v"]) ? $context["v"] : null), "gc_id", array()) == $this->getAttribute((isset($context["get"]) ? $context["get"] : null), "cate_id", array()))) {
                                    echo " class=\"selected\" ";
                                }
                                echo ">";
                                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["v"]) ? $context["v"] : null), "gc_name", array()), "html", null, true);
                                echo "</a></li>
                  ";
                            }
                            $_parent = $context['_parent'];
                            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['v'], $context['_parent'], $context['loop']);
                            $context = array_intersect_key($context, $_parent) + $_parent;
                            // line 54
                            echo "                </ul>
                ";
                        }
                        // line 56
                        echo "              </li>
              ";
                    }
                    $_parent = $context['_parent'];
                    unset($context['_seq'], $context['_iterated'], $context['_key'], $context['val'], $context['_parent'], $context['loop']);
                    $context = array_intersect_key($context, $_parent) + $_parent;
                    // line 58
                    echo "            </ul>
            ";
                }
                // line 60
                echo "          </li>
          ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['value'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 62
            echo "        </ul>
      </div>
    </div>
    ";
        }
        // line 66
        echo "    <!-- S 推荐展位 -->
    <div nctype=\"booth_goods\" class=\"nch-module\" style=\"display:none;\"> </div>
    <!-- E 推荐展位 -->
    <div class=\"nch-module-sidebar\"> ";
        // line 69
        echo $this->env->getExtension('Web_data_twig')->getData("Adv", array("ap_id" => 37, "type" => "html"));
        echo "
      <div class=\"clear\"></div>
    </div>
    <div class=\"nch-module nch-module-style03\">
      <div class=\"title\">
        <h3>";
        // line 74
        echo twig_escape_filter($this->env, $this->env->getExtension('Web_html_twig')->getLang("goods:class_viewed_goods"), "html", null, true);
        echo "</h3>
      </div>
      <div class=\"content\">
        ";
        // line 77
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["viewed_goods"]) ? $context["viewed_goods"] : null));
        foreach ($context['_seq'] as $context["_key"] => $context["v"]) {
            // line 78
            echo "        <dl class=\"nch-sidebar-bowers\">
          <dt class=\"goods-name\"><a href=\"";
            // line 79
            echo twig_escape_filter($this->env, $this->env->getExtension('Web_html_twig')->getPath("goods/index/init", array("goods_id" => $this->getAttribute((isset($context["v"]) ? $context["v"] : null), "goods_id", array()))), "html", null, true);
            echo "\">";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["v"]) ? $context["v"] : null), "goods_name", array()), "html", null, true);
            echo "</a></dt>
          <dd class=\"goods-pic\"><a href=\"";
            // line 80
            echo twig_escape_filter($this->env, $this->env->getExtension('Web_html_twig')->getPath("goods/index/init", array("goods_id" => $this->getAttribute((isset($context["v"]) ? $context["v"] : null), "goods_id", array()))), "html", null, true);
            echo "\"><img src=\"";
            echo twig_escape_filter($this->env, $this->env->getExtension('Web_html_twig')->getThumb((isset($context["v"]) ? $context["v"] : null), 60), "html", null, true);
            echo "\" title=\"";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["v"]) ? $context["v"] : null), "goods_name", array()), "html", null, true);
            echo "\" alt=\"";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["v"]) ? $context["v"] : null), "goods_name", array()), "html", null, true);
            echo "\" ></a></dd>
          <dd class=\"goods-price\">";
            // line 81
            echo twig_escape_filter($this->env, $this->env->getExtension('Web_html_twig')->getLang("common:currency"), "html", null, true);
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["v"]) ? $context["v"] : null), "goods_price", array()), "html", null, true);
            echo "</dd>
        </dl>
        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['v'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 84
        echo "      </div>
    </div>
  </div>
  <div class=\"right\">
  \t";
        // line 88
        if ($this->getAttribute((isset($context["goods_class_array"]) ? $context["goods_class_array"] : null), "child", array())) {
            // line 89
            echo "    ";
            $context["dl"] = 1;
            // line 90
            echo "    \t";
            if (((isset($context["brand_array"]) ? $context["brand_array"] : null) || (isset($context["attr_array"]) ? $context["attr_array"] : null))) {
                // line 91
                echo "    <div class=\"nch-module nch-module-style01\">
      <div class=\"title\">
        <h3>
          ";
                // line 94
                if ((isset($context["class_name"]) ? $context["class_name"] : null)) {
                    // line 95
                    echo "          <em>";
                    echo twig_escape_filter($this->env, (isset($context["class_name"]) ? $context["class_name"] : null), "html", null, true);
                    echo "</em> -
          ";
                }
                // line 97
                echo "          商品筛选</h3>
      </div>
      <div class=\"content\">
        <div class=\"nch-module-filter\">
          ";
                // line 101
                if (((isset($context["checked_brand"]) ? $context["checked_brand"] : null) || (isset($context["checked_attr"]) ? $context["checked_attr"] : null))) {
                    // line 102
                    echo "          <dl nc_type=\"ul_filter\">
            <dt>";
                    // line 103
                    echo twig_escape_filter($this->env, $this->env->getExtension('Web_html_twig')->getLang("goods:class_index_selected"), "html", null, true);
                    echo twig_escape_filter($this->env, $this->env->getExtension('Web_html_twig')->getLang("common:nc_colon"), "html", null, true);
                    echo "</dt>
            <dd class=\"list\">
              ";
                    // line 105
                    if ((isset($context["checked_brand"]) ? $context["checked_brand"] : null)) {
                        // line 106
                        echo "              ";
                        $context['_parent'] = (array) $context;
                        $context['_seq'] = twig_ensure_traversable((isset($context["checked_brand"]) ? $context["checked_brand"] : null));
                        foreach ($context['_seq'] as $context["_key"] => $context["val"]) {
                            // line 107
                            echo "              <span class=\"selected\" nctype=\"span_filter\">";
                            echo twig_escape_filter($this->env, $this->env->getExtension('Web_html_twig')->getLang("goods:class_index_brand"), "html", null, true);
                            echo ":<em>";
                            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["val"]) ? $context["val"] : null), "brand_name", array()), "html", null, true);
                            echo "</em><i data-uri=\"";
                            echo twig_escape_filter($this->env, $this->env->getExtension('Web_html_twig')->getPath("", array("b_id" => (isset($context["key"]) ? $context["key"] : null))), "html", null, true);
                            echo "\">X</i></span>
              ";
                        }
                        $_parent = $context['_parent'];
                        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['val'], $context['_parent'], $context['loop']);
                        $context = array_intersect_key($context, $_parent) + $_parent;
                        // line 109
                        echo "              ";
                    }
                    // line 110
                    echo "              ";
                    if ((isset($context["check_attr"]) ? $context["check_attr"] : null)) {
                        // line 111
                        echo "              ";
                        $context['_parent'] = (array) $context;
                        $context['_seq'] = twig_ensure_traversable((isset($context["checked_attr"]) ? $context["checked_attr"] : null));
                        foreach ($context['_seq'] as $context["_key"] => $context["val"]) {
                            // line 112
                            echo "              <span class=\"selected\" nctype=\"span_filter\">";
                            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["val"]) ? $context["val"] : null), "attr_name", array()), "html", null, true);
                            echo "<em>";
                            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["val"]) ? $context["val"] : null), "attr_value_name", array()), "html", null, true);
                            echo "</em><i data-uri=\"";
                            echo twig_escape_filter($this->env, $this->env->getExtension('Web_html_twig')->getPath("", array("b_id" => (isset($context["key"]) ? $context["key"] : null))), "html", null, true);
                            echo "\">X</i></span>
              ";
                        }
                        $_parent = $context['_parent'];
                        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['val'], $context['_parent'], $context['loop']);
                        $context = array_intersect_key($context, $_parent) + $_parent;
                        // line 114
                        echo "              ";
                    }
                    // line 115
                    echo "            </dd>
          </dl>
          ";
                }
                // line 118
                echo "          ";
                if ((isset($context["checked_brand"]) ? $context["checked_brand"] : null)) {
                    // line 119
                    echo "          \t";
                    if ((isset($context["brand_array"]) ? $context["brand_array"] : null)) {
                        // line 120
                        echo "          <dl ";
                        if (((isset($context["dl"]) ? $context["dl"] : null) > 3)) {
                            echo "class=\"dl_hide\"";
                        }
                        echo ">
            <dt>";
                        // line 121
                        echo twig_escape_filter($this->env, $this->env->getExtension('Web_html_twig')->getLang("goods:class_index_brand"), "html", null, true);
                        echo twig_escape_filter($this->env, $this->env->getExtension('Web_html_twig')->getLang("common:nc_colon"), "html", null, true);
                        echo "</dt>
            <dd class=\"list\">
              <ul>
              \t";
                        // line 124
                        $context["i"] = 0;
                        // line 125
                        echo "              \t";
                        $context['_parent'] = (array) $context;
                        $context['_seq'] = twig_ensure_traversable((isset($context["brand_array"]) ? $context["brand_array"] : null));
                        $context['loop'] = array(
                          'parent' => $context['_parent'],
                          'index0' => 0,
                          'index'  => 1,
                          'first'  => true,
                        );
                        if (is_array($context['_seq']) || (is_object($context['_seq']) && $context['_seq'] instanceof Countable)) {
                            $length = count($context['_seq']);
                            $context['loop']['revindex0'] = $length - 1;
                            $context['loop']['revindex'] = $length;
                            $context['loop']['length'] = $length;
                            $context['loop']['last'] = 1 === $length;
                        }
                        foreach ($context['_seq'] as $context["_key"] => $context["v"]) {
                            // line 126
                            echo "              \t";
                            $context["i"] = ((isset($context["i"]) ? $context["i"] : null) + 1);
                            // line 127
                            echo "              \t";
                            $context["b_id"] = (($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "request", array()), "get", array()), "b_id", array())) ? ((($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "request", array()), "get", array()), "b_id", array()) + "_") + $this->getAttribute((isset($context["loop"]) ? $context["loop"] : null), "index", array()))) : ($this->getAttribute((isset($context["loop"]) ? $context["loop"] : null), "index", array())));
                            // line 128
                            echo "                <li ";
                            if (((isset($context["i"]) ? $context["i"] : null) > 10)) {
                                echo "style=\"display:none\" nc_type=\"none\" ";
                            }
                            echo "><a href=\"";
                            echo twig_escape_filter($this->env, $this->env->getExtension('Web_html_twig')->getPath("", array("b_id" => (isset($context["b_id"]) ? $context["b_id"] : null))), "html", null, true);
                            echo "\">";
                            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["v"]) ? $context["v"] : null), "brand_name", array()), "html", null, true);
                            echo "</a></li>
                ";
                            ++$context['loop']['index0'];
                            ++$context['loop']['index'];
                            $context['loop']['first'] = false;
                            if (isset($context['loop']['length'])) {
                                --$context['loop']['revindex0'];
                                --$context['loop']['revindex'];
                                $context['loop']['last'] = 0 === $context['loop']['revindex0'];
                            }
                        }
                        $_parent = $context['_parent'];
                        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['v'], $context['_parent'], $context['loop']);
                        $context = array_intersect_key($context, $_parent) + $_parent;
                        // line 130
                        echo "              </ul>
            </dd>
            ";
                        // line 132
                        if (twig_length_filter($this->env, (isset($context["brand_array"]) ? $context["brand_array"] : null))) {
                            // line 133
                            echo "            <dd class=\"all\"><span nc_type=\"show\"><i class=\"icon-angle-down\"></i><?php echo lang['goods:class_index_more'];?></span></dd>
            ";
                        }
                        // line 135
                        echo "          </dl>
          ";
                        // line 136
                        $context["dl"] = ((isset($context["dl"]) ? $context["dl"] : null) + 1);
                        // line 137
                        echo "           ";
                    }
                    // line 138
                    echo "            ";
                }
                // line 139
                echo "
\t\t ";
                // line 140
                if ((isset($context["cate_array"]) ? $context["cate_array"] : null)) {
                    // line 141
                    echo "          <dl ";
                    if (((isset($context["dl"]) ? $context["dl"] : null) > 3)) {
                        echo "class=\"dl_hide\"";
                    }
                    echo ">
            <dt>";
                    // line 142
                    echo twig_escape_filter($this->env, $this->env->getExtension('Web_html_twig')->getLang("goods:class_index_goods_class"), "html", null, true);
                    echo twig_escape_filter($this->env, $this->env->getExtension('Web_html_twig')->getLang("nc_colon"), "html", null, true);
                    echo "</dt>
            <dd class=\"list\">
              <ul>
              \t";
                    // line 145
                    $context["i"] = 0;
                    // line 146
                    echo "              \t";
                    $context['_parent'] = (array) $context;
                    $context['_seq'] = twig_ensure_traversable((isset($context["cate_array"]) ? $context["cate_array"] : null));
                    $context['loop'] = array(
                      'parent' => $context['_parent'],
                      'index0' => 0,
                      'index'  => 1,
                      'first'  => true,
                    );
                    if (is_array($context['_seq']) || (is_object($context['_seq']) && $context['_seq'] instanceof Countable)) {
                        $length = count($context['_seq']);
                        $context['loop']['revindex0'] = $length - 1;
                        $context['loop']['revindex'] = $length;
                        $context['loop']['length'] = $length;
                        $context['loop']['last'] = 1 === $length;
                    }
                    foreach ($context['_seq'] as $context["_key"] => $context["v"]) {
                        // line 147
                        echo "              \t";
                        $context["i"] = ((isset($context["i"]) ? $context["i"] : null) + 1);
                        // line 148
                        echo "              \t";
                        $context["b_id"] = (($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "request", array()), "get", array()), "b_id", array())) ? ((($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "request", array()), "get", array()), "b_id", array()) + "_") + $this->getAttribute((isset($context["loop"]) ? $context["loop"] : null), "index", array()))) : ($this->getAttribute((isset($context["loop"]) ? $context["loop"] : null), "index", array())));
                        // line 149
                        echo "                
                <li ";
                        // line 150
                        if (((isset($context["i"]) ? $context["i"] : null) > 10)) {
                            echo " style=\"display:none\" nc_type=\"none\"";
                        }
                        echo "><a href=\"";
                        echo twig_escape_filter($this->env, $this->env->getExtension('Web_html_twig')->getPath("", array("b_id" => (isset($context["b_id"]) ? $context["b_id"] : null))), "html", null, true);
                        echo "\">";
                        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["v"]) ? $context["v"] : null), "gc_name", array()), "html", null, true);
                        echo "</a></li>
                 ";
                        ++$context['loop']['index0'];
                        ++$context['loop']['index'];
                        $context['loop']['first'] = false;
                        if (isset($context['loop']['length'])) {
                            --$context['loop']['revindex0'];
                            --$context['loop']['revindex'];
                            $context['loop']['last'] = 0 === $context['loop']['revindex0'];
                        }
                    }
                    $_parent = $context['_parent'];
                    unset($context['_seq'], $context['_iterated'], $context['_key'], $context['v'], $context['_parent'], $context['loop']);
                    $context = array_intersect_key($context, $_parent) + $_parent;
                    // line 152
                    echo "              </ul>
            </dd>
            ";
                    // line 154
                    if ((twig_length_filter($this->env, (isset($context["brand_array"]) ? $context["brand_array"] : null)) > 10)) {
                        // line 155
                        echo "            <dd class=\"all\"><span nc_type=\"show\"><i class=\"icon-angle-down\"></i>";
                        echo twig_escape_filter($this->env, $this->env->getExtension('Web_html_twig')->getLang("goods:class_index_more"), "html", null, true);
                        echo "</span></dd>
            ";
                    }
                    // line 157
                    echo "          </dl>
             ";
                    // line 158
                    $context["dl"] = ((isset($context["dl"]) ? $context["dl"] : null) + 1);
                    // line 159
                    echo "         ";
                }
                // line 160
                echo "
\t\t ";
                // line 161
                if ((isset($context["attr_array"]) ? $context["attr_array"] : null)) {
                    // line 162
                    echo "\t\t\t";
                    $context["j"] = 0;
                    // line 163
                    echo "\t\t\t";
                    $context['_parent'] = (array) $context;
                    $context['_seq'] = twig_ensure_traversable((isset($context["attr_array"]) ? $context["attr_array"] : null));
                    foreach ($context['_seq'] as $context["_key"] => $context["val"]) {
                        // line 164
                        echo "\t\t\t";
                        $context["j"] = ((isset($context["j"]) ? $context["j"] : null) + 1);
                        // line 165
                        echo "\t\t\t";
                        if (($this->getAttribute($this->getAttribute((isset($context["checked"]) ? $context["checked"] : null), "loop", array()), "index", array()) && $this->getAttribute((isset($context["val"]) ? $context["val"] : null), "value", array()))) {
                            // line 166
                            echo "          <dl>
            <dt>";
                            // line 167
                            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["val"]) ? $context["val"] : null), "name", array()), "html", null, true);
                            echo twig_escape_filter($this->env, $this->env->getExtension('Web_html_twig')->getLang("nc_colon"), "html", null, true);
                            echo "</dt>
            <dd class=\"list\">
              <ul>
\t\t\t ";
                            // line 170
                            $context["i"] = 0;
                            // line 171
                            echo "\t\t\t";
                            $context['_parent'] = (array) $context;
                            $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["val"]) ? $context["val"] : null), "value", array()));
                            $context['loop'] = array(
                              'parent' => $context['_parent'],
                              'index0' => 0,
                              'index'  => 1,
                              'first'  => true,
                            );
                            if (is_array($context['_seq']) || (is_object($context['_seq']) && $context['_seq'] instanceof Countable)) {
                                $length = count($context['_seq']);
                                $context['loop']['revindex0'] = $length - 1;
                                $context['loop']['revindex'] = $length;
                                $context['loop']['length'] = $length;
                                $context['loop']['last'] = 1 === $length;
                            }
                            foreach ($context['_seq'] as $context["_key"] => $context["v"]) {
                                // line 172
                                echo "\t\t\t";
                                $context["i"] = ((isset($context["i"]) ? $context["i"] : null) + 1);
                                // line 173
                                echo "\t\t\t";
                                $context["a_id"] = (($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "request", array()), "getGet", array(0 => "a_id"), "method")) ? ((($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "request", array()), "getGet", array(0 => "a_id"), "method") + "_") + $this->getAttribute((isset($context["loop"]) ? $context["loop"] : null), "index", array()))) : ($this->getAttribute((isset($context["loop"]) ? $context["loop"] : null), "index", array())));
                                // line 174
                                echo "                
                <li ";
                                // line 175
                                if (((isset($context["i"]) ? $context["i"] : null) > 10)) {
                                    echo "style=\"display:none\" nc_type=\"none\"";
                                }
                                echo "><a href=\"#\">";
                                echo twig_escape_filter($this->env, $this->getAttribute((isset($context["v"]) ? $context["v"] : null), "attr_value_name", array()), "html", null, true);
                                echo "</a></li>
                ";
                                ++$context['loop']['index0'];
                                ++$context['loop']['index'];
                                $context['loop']['first'] = false;
                                if (isset($context['loop']['length'])) {
                                    --$context['loop']['revindex0'];
                                    --$context['loop']['revindex'];
                                    $context['loop']['last'] = 0 === $context['loop']['revindex0'];
                                }
                            }
                            $_parent = $context['_parent'];
                            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['v'], $context['_parent'], $context['loop']);
                            $context = array_intersect_key($context, $_parent) + $_parent;
                            // line 177
                            echo "              </ul>
            </dd>
            ";
                            // line 179
                            if ((twig_length_filter($this->env, $this->getAttribute((isset($context["val"]) ? $context["val"] : null), "value", array())) > 10)) {
                                // line 180
                                echo "            <dd class=\"all\"><span nc_type=\"show\"><i class=\"icon-angle-down\"></i>";
                                echo twig_escape_filter($this->env, $this->env->getExtension('Web_html_twig')->getLang("goods:class_index_more"), "html", null, true);
                                echo "</span></dd>
             ";
                            }
                            // line 182
                            echo "          </dl>
          ";
                        }
                        // line 184
                        echo "          ";
                        $context["dl"] = ((isset($context["dl"]) ? $context["dl"] : null) + 1);
                        // line 185
                        echo "          ";
                    }
                    $_parent = $context['_parent'];
                    unset($context['_seq'], $context['_iterated'], $context['_key'], $context['val'], $context['_parent'], $context['loop']);
                    $context = array_intersect_key($context, $_parent) + $_parent;
                    echo "    
 \t\t";
                }
                // line 187
                echo "        </div>
      </div>
    </div>
    ";
            }
            // line 191
            echo "    ";
        }
        // line 192
        echo "    <div class=\"shop_con_list\" id=\"main-nav-holder\">
      <nav class=\"sort-bar\" id=\"main-nav\">
      <div class=\"pagination\">";
        // line 194
        echo twig_escape_filter($this->env, (isset($context["show_page1"]) ? $context["show_page1"] : null), "html", null, true);
        echo " </div>
      <div class=\"nch-all-category\">
        <div class=\"all-category\">
        ";
        // line 197
        echo call_user_func_array($this->env->getFunction('freeRender')->getCallable(), array("index/index/categoryTree"));
        echo "
         ";
        // line 199
        echo "        </div>
      </div>
     \t<div class=\"nch-sortbar-array\"> 排序方式：
          <ul>
            <li ";
        // line 203
        if ($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "request", array()), "getGet", array(0 => "key"), "method")) {
            echo "class=\"selected\"";
        }
        echo "><a href=";
        echo twig_escape_filter($this->env, $this->env->getExtension('Web_html_twig')->getDropParam(array(0 => "order", 1 => "key")), "html", null, true);
        echo "  title=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('Web_html_twig')->getLang("goods:class_index_default_sort"), "html", null, true);
        echo "\">";
        echo twig_escape_filter($this->env, $this->env->getExtension('Web_html_twig')->getLang("goods:class_index_default_sort"), "html", null, true);
        echo "</a></li>
            <li ";
        // line 204
        if (($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "request", array()), "getGet", array(0 => "key"), "method") == "1")) {
            echo "class=\"selected\"";
        }
        echo "><a href=\"";
        if ((($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "request", array()), "getGet", array(0 => "order"), "method") == "2") && ($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "request", array()), "getGet", array(0 => "key"), "method") == "1"))) {
            echo twig_escape_filter($this->env, $this->env->getExtension('Web_html_twig')->getReplaceParam(array("key" => "1", "order" => "1")), "html", null, true);
        } else {
            echo twig_escape_filter($this->env, $this->env->getExtension('Web_html_twig')->getReplaceParam(array("key" => "1", "order" => "2")), "html", null, true);
        }
        echo "\" ";
        if (($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "request", array()), "getGet", array(0 => "key"), "method") == "1")) {
            echo "class=\"";
            if (($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "request", array()), "getGet", array(0 => "order"), "method") == 1)) {
                echo "asc";
            } else {
                echo "desc";
            }
            echo "\"";
        }
        echo " title=\"";
        if ((($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "request", array()), "getGet", array(0 => "order"), "method") == "2") && ($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "request", array()), "getGet", array(0 => "key"), "method") == "1"))) {
            echo twig_escape_filter($this->env, $this->env->getExtension('Web_html_twig')->getLang("goods:class_index_sold_asc"), "html", null, true);
            echo twig_escape_filter($this->env, $this->env->getExtension('Web_html_twig')->getLang("goods:class_index_sold_desc"), "html", null, true);
        }
        echo "\">";
        echo twig_escape_filter($this->env, $this->env->getExtension('Web_html_twig')->getLang("goods:class_index_sold"), "html", null, true);
        echo "<i></i></a></li>
            <li ";
        // line 205
        if (($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "request", array()), "getGet", array(0 => "key"), "method") == "2")) {
            echo "class=\"selected\"";
        }
        echo "><a href=\"";
        if ((($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "request", array()), "getGet", array(0 => "order"), "method") == "2") && ($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "request", array()), "getGet", array(0 => "key"), "method") == "2"))) {
            echo twig_escape_filter($this->env, $this->env->getExtension('Web_html_twig')->getReplaceParam(array("key" => "2", "order" => "1")), "html", null, true);
        } else {
            echo twig_escape_filter($this->env, $this->env->getExtension('Web_html_twig')->getReplaceParam(array("key" => "2", "order" => "2")), "html", null, true);
        }
        echo "\" ";
        if (($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "request", array()), "getGet", array(0 => "key"), "method") == "2")) {
            echo "class=\"";
            if (($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "request", array()), "getGet", array(0 => "order"), "method") == 1)) {
                echo "asc";
            } else {
                echo "desc";
            }
            echo "\"";
        }
        echo " title=\"";
        if ((($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "request", array()), "getGet", array(0 => "order"), "method") == "2") && ($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "request", array()), "getGet", array(0 => "key"), "method") == "2"))) {
            echo twig_escape_filter($this->env, $this->env->getExtension('Web_html_twig')->getLang("goods:class_index_click_asc"), "html", null, true);
            echo twig_escape_filter($this->env, $this->env->getExtension('Web_html_twig')->getLang("goods:class_index_click_desc"), "html", null, true);
        }
        echo "\">";
        echo twig_escape_filter($this->env, $this->env->getExtension('Web_html_twig')->getLang("goods:class_index_click"), "html", null, true);
        echo "<i></i></a></li>
            <li ";
        // line 206
        if (($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "request", array()), "getGet", array(0 => "key"), "method") == "3")) {
            echo "class=\"selected\"";
        }
        echo "><a href=\"";
        if ((($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "request", array()), "getGet", array(0 => "order"), "method") == "2") && ($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "request", array()), "getGet", array(0 => "key"), "method") == "3"))) {
            echo twig_escape_filter($this->env, $this->env->getExtension('Web_html_twig')->getReplaceParam(array("key" => "1", "order" => "1")), "html", null, true);
        } else {
            echo twig_escape_filter($this->env, $this->env->getExtension('Web_html_twig')->getReplaceParam(array("key" => "3", "order" => "2")), "html", null, true);
        }
        echo "\" ";
        if (($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "request", array()), "getGet", array(0 => "key"), "method") == "3")) {
            echo "class=\"";
            if (($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "request", array()), "getGet", array(0 => "order"), "method") == 1)) {
                echo "asc";
            } else {
                echo "desc";
            }
            echo "\"";
        }
        echo " title=\"";
        if ((($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "request", array()), "getGet", array(0 => "order"), "method") == "2") && ($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "request", array()), "getGet", array(0 => "key"), "method") == "3"))) {
            echo twig_escape_filter($this->env, $this->env->getExtension('Web_html_twig')->getLang("goods:class_index_price_asc"), "html", null, true);
            echo twig_escape_filter($this->env, $this->env->getExtension('Web_html_twig')->getLang("goods:class_index_price_desc"), "html", null, true);
        }
        echo "\">";
        echo twig_escape_filter($this->env, $this->env->getExtension('Web_html_twig')->getLang("goods:class_index_price"), "html", null, true);
        echo "<i></i></a></li>
            
           </ul>
        </div>
        <div class=\"nch-sortbar-owner\">商品类型：<span><a href=\"#\"><i></i>全部</a></span> 
        \t<span><a href=\"#\" ";
        // line 211
        if (($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "request", array()), "getGet", array(0 => "type"), "method") == 1)) {
            echo "class=\"selected\"";
        }
        echo "><i></i>商城自营</a></span>
         \t<span><a href=\"#\" ";
        // line 212
        if (($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "request", array()), "getGet", array(0 => "type"), "method") == 2)) {
            echo "class=\"selected\"";
        }
        echo "><i></i>商家加盟</a></span> 
         </div>
        <div class=\"nch-sortbar-location\">商品所在地：
          <div class=\"select-layer\">
            <div class=\"holder\"><em nc_type=\"area_name\">";
        // line 216
        echo twig_escape_filter($this->env, $this->env->getExtension('Web_html_twig')->getLang("goods:class_index_area"), "html", null, true);
        echo "<!-- ���ڵ� --></em></div>
            <div class=\"selected\"><a nc_type=\"area_name\">";
        // line 217
        echo twig_escape_filter($this->env, $this->env->getExtension('Web_html_twig')->getLang("goods:class_index_area"), "html", null, true);
        echo "<!-- ���ڵ� --></a></div>
            <i class=\"direction\"></i>
            <ul class=\"options\">
              
            </ul>
          </div>
        </div>

      </nav>
      <!-- 商品列表循环  -->

      <div>
      \t";
        // line 229
        $this->env->loadTemplate("goods/goods_squares.html")->display($context);
        // line 230
        echo "      </div>
      <div class=\"tc mt20 mb20\">
        <div class=\"pagination\">";
        // line 232
        echo twig_escape_filter($this->env, (isset($context["show_page"]) ? $context["show_page"] : null), "html", null, true);
        echo " </div>
      </div>
    </div>
  </div>
</div>
<script src=\"";
        // line 237
        echo twig_escape_filter($this->env, $this->env->getExtension('Web_html_twig')->getAssets("/data/resource/js/waypoints.js"), "html", null, true);
        echo "\"></script>
<script src=\"";
        // line 238
        echo twig_escape_filter($this->env, $this->env->getExtension('Web_html_twig')->getAssets("/resource/js/search_category_menu.js"), "html", null, true);
        echo "\"></script>
<script type=\"text/javascript\">
var defaultSmallGoodsImage = '";
        // line 240
        echo twig_escape_filter($this->env, $this->env->getExtension('Web_html_twig')->getDefaultGoodsImage(240), "html", null, true);
        echo "';
var defaultTinyGoodsImage = '";
        // line 241
        echo twig_escape_filter($this->env, $this->env->getExtension('Web_html_twig')->getDefaultGoodsImage(60), "html", null, true);
        echo "';

\$(function(){
    \$('#files').tree({
        expanded: 'li:lt(2)'
    });

    //浮动导航  waypoints.js
    \$('#main-nav-holder').waypoint(function(event, direction) {
        \$(this).parent().toggleClass('sticky', direction === \"down\");
        event.stopPropagation();
    });
\t// 单行显示更多
\t\$('span[nc_type=\"show\"]').click(function(){
\t\ts = \$(this).parents('dd').prev().find('li[nc_type=\"none\"]');
\t\tif(s.css('display') == 'none'){
\t\t\ts.show();
\t\t\t\$(this).html('<i class=\"icon-angle-up\"></i>";
        // line 258
        echo twig_escape_filter($this->env, $this->env->getExtension('Web_html_twig')->getLang("goods:class_index_retract"), "html", null, true);
        echo "');
\t\t}else{
\t\t\ts.hide();
\t\t\t\$(this).html('<i class=\"icon-angle-down\"></i>";
        // line 261
        echo twig_escape_filter($this->env, $this->env->getExtension('Web_html_twig')->getLang("goods:class_index_more"), "html", null, true);
        echo "');
\t\t}
\t});

\t";
        // line 265
        if (($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "request", array()), "getGet", array(0 => "area_id"), "method") > 0)) {
            // line 266
            echo "\t// 选择地区后的地区显示
\t\$('[nc_type=\"area_name\"]').html(nc_class_a[";
            // line 267
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "request", array()), "getGet", array(0 => "area_id"), "method"), "html", null, true);
            echo "]);
\t";
        }
        // line 269
        echo "
\t";
        // line 270
        if (($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "request", array()), "getGet", array(0 => "cate_id"), "method") > 0)) {
            // line 271
            echo "\t// 推荐商品异步显示
    \$('div[nctype=\"booth_goods\"]').load(\"";
            // line 272
            echo $this->env->getExtension('Web_html_twig')->getPath("search/index/getBoothGoods", array("cate_id" => $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "request", array()), "getGet", array(0 => "cate_id"), "method")));
            echo "\", function(){
        \$(this).show();
    });
    ";
        }
        // line 276
        echo "});
</script>
";
    }

    public function getTemplateName()
    {
        return "Search/index_init.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  865 => 276,  858 => 272,  855 => 271,  853 => 270,  850 => 269,  845 => 267,  842 => 266,  840 => 265,  833 => 261,  827 => 258,  807 => 241,  803 => 240,  798 => 238,  794 => 237,  786 => 232,  782 => 230,  780 => 229,  765 => 217,  761 => 216,  752 => 212,  746 => 211,  713 => 206,  684 => 205,  655 => 204,  643 => 203,  637 => 199,  633 => 197,  627 => 194,  623 => 192,  620 => 191,  614 => 187,  605 => 185,  602 => 184,  598 => 182,  592 => 180,  590 => 179,  586 => 177,  566 => 175,  563 => 174,  560 => 173,  557 => 172,  539 => 171,  537 => 170,  530 => 167,  527 => 166,  524 => 165,  521 => 164,  516 => 163,  513 => 162,  511 => 161,  508 => 160,  505 => 159,  503 => 158,  500 => 157,  494 => 155,  492 => 154,  488 => 152,  466 => 150,  463 => 149,  460 => 148,  457 => 147,  439 => 146,  437 => 145,  430 => 142,  423 => 141,  421 => 140,  418 => 139,  415 => 138,  412 => 137,  410 => 136,  407 => 135,  403 => 133,  401 => 132,  397 => 130,  374 => 128,  371 => 127,  368 => 126,  350 => 125,  348 => 124,  341 => 121,  334 => 120,  331 => 119,  328 => 118,  323 => 115,  320 => 114,  307 => 112,  302 => 111,  299 => 110,  296 => 109,  283 => 107,  278 => 106,  276 => 105,  270 => 103,  267 => 102,  265 => 101,  259 => 97,  253 => 95,  251 => 94,  246 => 91,  243 => 90,  240 => 89,  238 => 88,  232 => 84,  222 => 81,  212 => 80,  206 => 79,  203 => 78,  199 => 77,  193 => 74,  185 => 69,  180 => 66,  174 => 62,  167 => 60,  163 => 58,  156 => 56,  152 => 54,  137 => 52,  133 => 51,  130 => 50,  128 => 49,  118 => 48,  115 => 47,  111 => 46,  108 => 45,  106 => 44,  96 => 43,  93 => 42,  89 => 41,  81 => 35,  79 => 34,  71 => 29,  65 => 26,  61 => 25,  57 => 24,  37 => 7,  31 => 3,  28 => 2,);
    }
}
