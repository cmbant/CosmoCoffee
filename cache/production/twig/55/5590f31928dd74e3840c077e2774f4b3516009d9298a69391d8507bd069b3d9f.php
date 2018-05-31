<?php

/* captcha_default_acp_demo.html */
class __TwigTemplate_1ca320f2efc8ea9b0bf0e5389bb417450c041943a64454935ff06e3714b0c435 extends Twig_Template
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
        echo "<dl>
\t<dt><label for=\"captcha_preview\">";
        // line 2
        echo $this->env->getExtension('phpbb\template\twig\extension')->lang("PREVIEW");
        echo $this->env->getExtension('phpbb\template\twig\extension')->lang("COLON");
        echo "</label><br /><span>";
        echo $this->env->getExtension('phpbb\template\twig\extension')->lang("CAPTCHA_PREVIEW_EXPLAIN");
        echo "</span></dt>
\t<dd><img src=\"";
        // line 3
        echo (isset($context["CONFIRM_IMAGE"]) ? $context["CONFIRM_IMAGE"] : null);
        echo "\" alt=\"";
        echo $this->env->getExtension('phpbb\template\twig\extension')->lang("PREVIEW");
        echo "\" width=\"360\" height=\"96\" id=\"captcha_preview\" /></dd>
</dl>
";
    }

    public function getTemplateName()
    {
        return "captcha_default_acp_demo.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  29 => 3,  22 => 2,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "captcha_default_acp_demo.html", "");
    }
}
