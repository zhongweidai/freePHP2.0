<?php

/* message.html */
class __TwigTemplate_e61af7bb46c1c82736445276bc44b2b33537f90e298011adb73cc109a9f898cd extends Twig_Template
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
        echo "<style type=\"text/css\">
body,.header-wrap { background-color: #FAFAFA;}
.wrapper { width: 1000px;}
#faq { display: none;}
.msg { font: 100 36px/48px arial,\"microsoft yahei\"; color: #555; background-color: #FFF; text-align: center; width: 100%; border: solid 1px #E6E6E6; margin-bottom: 10px; padding: 120px 0;}
.msg i { font-size: 48px; vertical-align: middle; margin-right: 10px;}
</style>
<script type=\"text/javascript\">
\$(function(){
\t\$(\"#details\").children('ul').children('li').click(function(){
\t\t\$(this).parent().children('li').removeClass(\"current\");
\t\t\$(this).addClass(\"current\");
\t\t\$('#search_act').attr(\"value\",\$(this).attr(\"act\"));
\t});
\tvar search_act = \$(\"#details\").find(\"li[class='current']\").attr(\"act\");
\t\$('#search_act').attr(\"value\",search_act);
\t\$(\"#keyword\").blur();
});
</script>

<div class=\"header-wrap\"><header class=\"public-head-layout wrapper\">
  <h1 class=\"site-logo\"><a href=\"";
        // line 24
        echo twig_escape_filter($this->env, $this->env->getExtension('Web_html_twig')->getPath(), "html", null, true);
        echo "\">
  <img src=\"";
        // line 25
        echo twig_escape_filter($this->env, $this->env->getExtension('Web_html_twig')->getCAttache("logo.png"), "html", null, true);
        echo "\" class=\"pngFix\"></a></h1></header></div>
<div class=\"msg\">
\t";
        // line 27
        if (((isset($context["status"]) ? $context["status"] : null) == 0)) {
            // line 28
            echo "      <i class=\"icon-info-sign\" style=\"color: #D93600;\"></i>
    ";
        } else {
            // line 30
            echo "      <i class=\"icon-ok-sign\" style=\" color: #27AE61;\"></i>
    ";
        }
        // line 32
        echo "        ";
        echo twig_escape_filter($this->env, (isset($context["message"]) ? $context["message"] : null), "html", null, true);
        echo "
</div>
<script type=\"text/javascript\">
";
        // line 35
        if ((isset($context["redirect_url"]) ? $context["redirect_url"] : null)) {
            // line 36
            echo "\twindow.setTimeout(\"javascript:location.href='";
            echo twig_escape_filter($this->env, (isset($context["redirect_url"]) ? $context["redirect_url"] : null), "html", null, true);
            echo "'\", ";
            echo twig_escape_filter($this->env, (isset($context["time"]) ? $context["time"] : null), "html", null, true);
            echo ");
";
        } else {
            // line 38
            echo "\twindow.setTimeout(\"javascript:history.back()\", ";
            echo twig_escape_filter($this->env, (isset($context["time"]) ? $context["time"] : null), "html", null, true);
            echo ");
";
        }
        // line 40
        echo "</script>
";
    }

    public function getTemplateName()
    {
        return "message.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  96 => 40,  90 => 38,  82 => 36,  80 => 35,  73 => 32,  69 => 30,  65 => 28,  63 => 27,  58 => 25,  54 => 24,  31 => 3,  28 => 2,);
    }
}
