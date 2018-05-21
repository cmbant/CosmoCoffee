<?php

/* @marcovo_mathjax/event/overall_header_stylesheets_after.html */
class __TwigTemplate_23a5026b9e4b93556c01e9762f35dc54f58d1daa4a7f401ce852e812c4bd5dfb extends Twig_Template
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
        if ((isset($context["S_ENABLE_MATHJAX"]) ? $context["S_ENABLE_MATHJAX"] : null)) {
            // line 2
            echo "
<script type=\"text/javascript\" src=\"";
            // line 3
            echo (isset($context["T_MATHJAX_ASSETS_PATH"]) ? $context["T_MATHJAX_ASSETS_PATH"] : null);
            echo "/javascript/phpbb2jax-combined-min.js\"></script>
<script type=\"text/x-mathjax-config\">
// <![CDATA[
MathJax.Hub.PreProcess.disabled = true;
MathJax.Hub.Config({messageStyle:\"none\"});
ready(function() {phpbb2jax()});
// ]]>
</script>
<script type=\"text/javascript\" src=\"";
            // line 11
            echo (isset($context["U_MATHJAX"]) ? $context["U_MATHJAX"] : null);
            echo "\"></script>
";
            // line 12
            if ((isset($context["S_MATHJAX_HAS_FALLBACK"]) ? $context["S_MATHJAX_HAS_FALLBACK"] : null)) {
                // line 13
                echo "<script type=\"text/javascript\">
// <![CDATA[
\t!window.MathJax && document.write('<script type=\"text\\/javascript\" src=\"";
                // line 15
                echo (isset($context["UA_MATHJAX_FALLBACK"]) ? $context["UA_MATHJAX_FALLBACK"] : null);
                echo "\"><\\/script>');
// ]]>
</script>
";
            }
            // line 19
            echo "
";
        }
    }

    public function getTemplateName()
    {
        return "@marcovo_mathjax/event/overall_header_stylesheets_after.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  52 => 19,  45 => 15,  41 => 13,  39 => 12,  35 => 11,  24 => 3,  21 => 2,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "@marcovo_mathjax/event/overall_header_stylesheets_after.html", "");
    }
}
