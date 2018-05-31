<?php

/* captcha_qa_acp_demo.html */
class __TwigTemplate_a83b9a739fc55298a374871833a79d7b7aa6929f859bf5b4392157513b8e1147 extends Twig_Template
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
\t<dt><label for=\"answer\">";
        // line 2
        if ((isset($context["QA_CONFIRM_QUESTION"]) ? $context["QA_CONFIRM_QUESTION"] : null)) {
            echo " ";
            echo (isset($context["QA_CONFIRM_QUESTION"]) ? $context["QA_CONFIRM_QUESTION"] : null);
            echo " ";
        } else {
            echo " ";
            echo $this->env->getExtension('phpbb\template\twig\extension')->lang("CONFIRM_QUESTION");
            echo " ";
        }
        echo $this->env->getExtension('phpbb\template\twig\extension')->lang("COLON");
        echo "</label><br /><span>";
        echo $this->env->getExtension('phpbb\template\twig\extension')->lang("CONFIRM_QUESTION_EXPLAIN");
        echo "</span></dt>

\t<dd>
\t\t<input type=\"text\" tabindex=\"10\" name=\"answer\" id=\"answer\" size=\"45\" class=\"inputbox autowidth\" title=\"";
        // line 5
        echo $this->env->getExtension('phpbb\template\twig\extension')->lang("ANSWER");
        echo "\"  />
\t</dd>
</dl>
";
    }

    public function getTemplateName()
    {
        return "captcha_qa_acp_demo.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  39 => 5,  22 => 2,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "captcha_qa_acp_demo.html", "");
    }
}
