<?php

/* captcha_qa.html */
class __TwigTemplate_ad41ffb22a80f8a9acb742eedc30ad65486373693e77473b63b343d3f4e40f9e extends Twig_Template
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
        if (((isset($context["S_TYPE"]) ? $context["S_TYPE"] : null) == 1)) {
            // line 2
            echo "<div class=\"panel captcha-panel\">
\t<div class=\"inner\">

\t<h3 class=\"captcha-title\">";
            // line 5
            echo $this->env->getExtension('phpbb\template\twig\extension')->lang("CONFIRMATION");
            echo "</h3>
\t<fieldset class=\"fields2\">
";
        }
        // line 8
        echo "
\t<dl>
\t<dt><label>";
        // line 10
        echo (isset($context["QA_CONFIRM_QUESTION"]) ? $context["QA_CONFIRM_QUESTION"] : null);
        echo $this->env->getExtension('phpbb\template\twig\extension')->lang("COLON");
        echo "</label><br /><span>";
        echo $this->env->getExtension('phpbb\template\twig\extension')->lang("CONFIRM_QUESTION_EXPLAIN");
        echo "</span></dt>
\t<dd class=\"captcha\">
\t\t<input type=\"text\" tabindex=\"";
        // line 12
        echo $this->getAttribute((isset($context["definition"]) ? $context["definition"] : null), "CAPTCHA_TAB_INDEX", array());
        echo "\" name=\"qa_answer\" id=\"answer\" size=\"45\"  class=\"inputbox autowidth\" title=\"";
        echo $this->env->getExtension('phpbb\template\twig\extension')->lang("ANSWER");
        echo "\" />
\t\t<input type=\"hidden\" name=\"qa_confirm_id\" id=\"qa_confirm_id\" value=\"";
        // line 13
        echo (isset($context["QA_CONFIRM_ID"]) ? $context["QA_CONFIRM_ID"] : null);
        echo "\" />
\t</dd>
\t</dl>

";
        // line 17
        if (((isset($context["S_TYPE"]) ? $context["S_TYPE"] : null) == 1)) {
            // line 18
            echo "\t</fieldset>
\t</div>
</div>
";
        }
    }

    public function getTemplateName()
    {
        return "captcha_qa.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  59 => 18,  57 => 17,  50 => 13,  44 => 12,  36 => 10,  32 => 8,  26 => 5,  21 => 2,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "captcha_qa.html", "");
    }
}
