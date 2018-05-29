<?php

/* acp_ext_disable.html */
class __TwigTemplate_26fb4baec77e2558d14d6b972be5ff9603549703e11ef89650cdcb4f20db0933 extends Twig_Template
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
        $location = "overall_header.html";
        $namespace = false;
        if (strpos($location, '@') === 0) {
            $namespace = substr($location, 1, strpos($location, '/') - 1);
            $previous_look_up_order = $this->env->getNamespaceLookUpOrder();
            $this->env->setNamespaceLookUpOrder(array($namespace, '__main__'));
        }
        $this->loadTemplate("overall_header.html", "acp_ext_disable.html", 1)->display($context);
        if ($namespace) {
            $this->env->setNamespaceLookUpOrder($previous_look_up_order);
        }
        // line 2
        echo "
\t<a id=\"maincontent\"></a>

\t<h1>";
        // line 5
        echo $this->env->getExtension('phpbb\template\twig\extension')->lang("EXTENSIONS_ADMIN");
        echo "</h1>

\t<p>";
        // line 7
        echo $this->env->getExtension('phpbb\template\twig\extension')->lang("EXTENSIONS_EXPLAIN");
        echo "</p>
\t<p>";
        // line 8
        echo $this->env->getExtension('phpbb\template\twig\extension')->lang("EXTENSION_DISABLE_EXPLAIN");
        echo "</p>

\t";
        // line 10
        if ((isset($context["PRE"]) ? $context["PRE"] : null)) {
            // line 11
            echo "\t<fieldset>
\t\t<h2>";
            // line 12
            echo $this->env->getExtension('phpbb\template\twig\extension')->lang("CONFIRM");
            echo "</h2>
\t\t<p>";
            // line 13
            echo $this->env->getExtension('phpbb\template\twig\extension')->lang("CONFIRM_MESSAGE");
            echo "</p>
\t</fieldset>

\t<form id=\"acp_extensions\" method=\"post\" action=\"";
            // line 16
            echo (isset($context["U_DISABLE"]) ? $context["U_DISABLE"] : null);
            echo "\">
\t<fieldset class=\"submit-buttons\">
\t\t<input class=\"button1\" type=\"submit\" name=\"disable\" value=\"";
            // line 18
            echo $this->env->getExtension('phpbb\template\twig\extension')->lang("EXTENSION_DISABLE");
            echo "\" />
\t\t<input class=\"button2\" type=\"submit\" name=\"cancel\" value=\"";
            // line 19
            echo $this->env->getExtension('phpbb\template\twig\extension')->lang("CANCEL");
            echo "\" />
\t</fieldset>
\t</form>
\t";
        } elseif (        // line 22
(isset($context["S_NEXT_STEP"]) ? $context["S_NEXT_STEP"] : null)) {
            // line 23
            echo "\t\t<div class=\"successbox notice\">
\t\t\t<p>";
            // line 24
            echo $this->env->getExtension('phpbb\template\twig\extension')->lang("EXTENSION_DISABLE_IN_PROGRESS");
            echo "</p>
\t\t</div>
\t";
        } else {
            // line 27
            echo "\t\t<div class=\"successbox\">
\t\t\t<p>";
            // line 28
            echo $this->env->getExtension('phpbb\template\twig\extension')->lang("EXTENSION_DISABLE_SUCCESS");
            echo "</p>
\t\t\t<br />
\t\t\t<p><a href=\"";
            // line 30
            echo (isset($context["U_RETURN"]) ? $context["U_RETURN"] : null);
            echo "\">";
            echo $this->env->getExtension('phpbb\template\twig\extension')->lang("RETURN_TO_EXTENSION_LIST");
            echo "</a></p>
\t\t</div>
\t";
        }
        // line 33
        echo "
";
        // line 34
        $location = "overall_footer.html";
        $namespace = false;
        if (strpos($location, '@') === 0) {
            $namespace = substr($location, 1, strpos($location, '/') - 1);
            $previous_look_up_order = $this->env->getNamespaceLookUpOrder();
            $this->env->setNamespaceLookUpOrder(array($namespace, '__main__'));
        }
        $this->loadTemplate("overall_footer.html", "acp_ext_disable.html", 34)->display($context);
        if ($namespace) {
            $this->env->setNamespaceLookUpOrder($previous_look_up_order);
        }
    }

    public function getTemplateName()
    {
        return "acp_ext_disable.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  110 => 34,  107 => 33,  99 => 30,  94 => 28,  91 => 27,  85 => 24,  82 => 23,  80 => 22,  74 => 19,  70 => 18,  65 => 16,  59 => 13,  55 => 12,  52 => 11,  50 => 10,  45 => 8,  41 => 7,  36 => 5,  31 => 2,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "acp_ext_disable.html", "");
    }
}
