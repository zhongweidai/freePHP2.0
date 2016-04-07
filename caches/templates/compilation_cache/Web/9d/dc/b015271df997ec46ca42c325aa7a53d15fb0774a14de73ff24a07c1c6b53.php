<?php

/* Index/index_init.html */
class __TwigTemplate_9ddcb015271df997ec46ca42c325aa7a53d15fb0774a14de73ff24a07c1c6b53 extends Twig_Template
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
        echo "<!DOCTYPE html>
<html>
<head>
    <title>test</title>
</head>
<body>
    <h1>test 11</h1>
   <li> ";
        // line 8
        echo twig_escape_filter($this->env, (isset($context["a"]) ? $context["a"] : null), "html", null, true);
        echo "</li>
    <li> ";
        // line 9
        echo twig_escape_filter($this->env, (isset($context["b"]) ? $context["b"] : null), "html", null, true);
        echo "</li>

<li>";
        // line 11
        echo twig_escape_filter($this->env, $this->env->getExtension('Web_html_twig')->getPath("test"), "html", null, true);
        echo "</li>
<li>";
        // line 12
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["app"]) ? $context["app"] : null), "routeA", array()), "html", null, true);
        echo "</li>
<li>";
        // line 13
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "config", array()), "system", array()), "charset", array()), "html", null, true);
        echo "</li>
    <li>";
        // line 14
        echo $this->env->getExtension('Web_data_twig')->getData("User", array("id" => 1));
        echo "</li>
</body>
</html>";
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
        return array (  49 => 14,  45 => 13,  41 => 12,  37 => 11,  32 => 9,  28 => 8,  19 => 1,);
    }
}
