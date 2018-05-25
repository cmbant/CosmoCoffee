<?php

/* acp_mathjax.html */
class __TwigTemplate_dd239990bb8ef194bc51466bcb16a986681249fec71ca4e2244909c689b106a7 extends Twig_Template
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
        $this->loadTemplate("overall_header.html", "acp_mathjax.html", 1)->display($context);
        if ($namespace) {
            $this->env->setNamespaceLookUpOrder($previous_look_up_order);
        }
        // line 2
        echo "
<a name=\"maincontent\"></a>

<h1>";
        // line 5
        echo $this->env->getExtension('phpbb\template\twig\extension')->lang("TITLE");
        echo "</h1>

<p>";
        // line 7
        echo $this->env->getExtension('phpbb\template\twig\extension')->lang("TITLE_EXPLAIN");
        echo "</p>

";
        // line 9
        if ((isset($context["S_ERROR"]) ? $context["S_ERROR"] : null)) {
            // line 10
            echo "\t<div class=\"errorbox\">
\t\t<h3>";
            // line 11
            echo $this->env->getExtension('phpbb\template\twig\extension')->lang("WARNING");
            echo "</h3>
\t\t<p>";
            // line 12
            echo (isset($context["ERROR_MSG"]) ? $context["ERROR_MSG"] : null);
            echo "</p>
\t</div>
";
        }
        // line 15
        echo "
<form id=\"acp_mathjax\" method=\"post\" action=\"";
        // line 16
        echo (isset($context["U_ACTION"]) ? $context["U_ACTION"] : null);
        echo "\">
";
        // line 17
        if ( !(isset($context["S_LIST_BBCODE"]) ? $context["S_LIST_BBCODE"] : null)) {
            // line 18
            echo "\t";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["loops"]) ? $context["loops"] : null), "options", array()));
            foreach ($context['_seq'] as $context["_key"] => $context["options"]) {
                // line 19
                echo "\t\t";
                if ($this->getAttribute($context["options"], "S_LEGEND", array())) {
                    // line 20
                    echo "\t\t\t";
                    if ( !$this->getAttribute($context["options"], "S_FIRST_ROW", array())) {
                        // line 21
                        echo "\t\t\t</fieldset>
\t\t\t";
                    }
                    // line 23
                    echo "\t\t<fieldset>
\t\t\t<legend>";
                    // line 24
                    echo $this->getAttribute($context["options"], "LEGEND", array());
                    echo "</legend>
\t\t";
                } else {
                    // line 26
                    echo "
\t\t<dl>
\t\t\t<dt><label for=\"";
                    // line 28
                    echo $this->getAttribute($context["options"], "KEY", array());
                    echo "\">";
                    echo $this->getAttribute($context["options"], "TITLE", array());
                    echo ":</label>";
                    if ($this->getAttribute($context["options"], "S_EXPLAIN", array())) {
                        echo "<br /><span>";
                        echo $this->getAttribute($context["options"], "TITLE_EXPLAIN", array());
                        echo "</span>";
                    }
                    echo "</dt>
\t\t\t<dd>";
                    // line 29
                    echo $this->getAttribute($context["options"], "CONTENT", array());
                    echo "</dd>
\t\t</dl>
\t\t";
                }
                // line 32
                echo "\t";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['options'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
        } else {
            // line 34
            echo "\t<fieldset class=\"tabulated\">
\t\t<legend>";
            // line 35
            echo $this->env->getExtension('phpbb\template\twig\extension')->lang("ACP_BBCODES");
            echo "</legend>
\t
\t\t<table cellspacing=\"1\" id=\"down\">
\t\t<thead>
\t\t<tr>
\t\t\t<th>";
            // line 40
            echo $this->env->getExtension('phpbb\template\twig\extension')->lang("BBCODE_TAG");
            echo "</th>
\t\t\t<th>";
            // line 41
            echo $this->env->getExtension('phpbb\template\twig\extension')->lang("ACTION");
            echo "</th>
\t\t</tr>
\t\t</thead>
\t\t<tbody>
\t";
            // line 45
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["loops"]) ? $context["loops"] : null), "bbcodes", array()));
            $context['_iterated'] = false;
            foreach ($context['_seq'] as $context["_key"] => $context["bbcodes"]) {
                // line 46
                echo "\t\t";
                if (($this->getAttribute($context["bbcodes"], "S_ROW_COUNT", array()) % 2 == 0)) {
                    echo "<tr class=\"row1\">";
                } else {
                    echo "<tr class=\"row2\">";
                }
                // line 47
                echo "\t\t\t<td style=\"text-align: center;\">";
                echo $this->getAttribute($context["bbcodes"], "BBCODE_TAG", array());
                echo "</td>
\t\t\t<td style=\"text-align: center; width: 40px;\"><a href=\"";
                // line 48
                echo $this->getAttribute($context["bbcodes"], "U_EDIT", array());
                echo "\">";
                echo (isset($context["ICON_EDIT"]) ? $context["ICON_EDIT"] : null);
                echo "</a> <a href=\"";
                echo $this->getAttribute($context["bbcodes"], "U_DELETE", array());
                echo "\">";
                echo (isset($context["ICON_DELETE"]) ? $context["ICON_DELETE"] : null);
                echo "</a></td>
\t\t</tr>
\t";
                $context['_iterated'] = true;
            }
            if (!$context['_iterated']) {
                // line 51
                echo "\t\t<tr class=\"row3\">
\t\t\t<td>";
                // line 52
                echo $this->env->getExtension('phpbb\template\twig\extension')->lang("ACP_NO_ITEMS");
                echo "</td>
\t\t\t<td style=\"text-align: center; width: 40px;\">";
                // line 53
                echo (isset($context["ICON_EDIT_DISABLED"]) ? $context["ICON_EDIT_DISABLED"] : null);
                echo " ";
                echo (isset($context["ICON_DELETE_DISABLED"]) ? $context["ICON_DELETE_DISABLED"] : null);
                echo "</td>
\t\t</tr>
\t";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['bbcodes'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 56
            echo "\t</tbody>
\t</table>
\t</p>
\t</fieldset>
";
        }
        // line 61
        echo "
";
        // line 62
        if ( !(isset($context["S_LIST_BBCODE"]) ? $context["S_LIST_BBCODE"] : null)) {
            // line 63
            echo "\t<p class=\"submit-buttons\">
\t\t<input class=\"button1\" type=\"submit\" id=\"submit\" name=\"submit\" value=\"";
            // line 64
            echo $this->env->getExtension('phpbb\template\twig\extension')->lang("SUBMIT");
            echo "\" />&nbsp;
\t\t<input class=\"button2\" type=\"reset\" id=\"reset\" name=\"reset\" value=\"";
            // line 65
            echo $this->env->getExtension('phpbb\template\twig\extension')->lang("RESET");
            echo "\" />
\t</p>
\t";
            // line 67
            echo (isset($context["S_FORM_TOKEN"]) ? $context["S_FORM_TOKEN"] : null);
            echo "
\t</fieldset>
";
        } else {
            // line 70
            echo "\t<p class=\"quick\">
\t\t<input class=\"button2\" name=\"submit\" type=\"submit\" value=\"";
            // line 71
            echo $this->env->getExtension('phpbb\template\twig\extension')->lang("ADD_BBCODE");
            echo "\" />
\t";
            // line 72
            echo (isset($context["S_FORM_TOKEN"]) ? $context["S_FORM_TOKEN"] : null);
            echo "
\t</p>
";
        }
        // line 75
        echo "</form>
";
        // line 76
        $location = "overall_footer.html";
        $namespace = false;
        if (strpos($location, '@') === 0) {
            $namespace = substr($location, 1, strpos($location, '/') - 1);
            $previous_look_up_order = $this->env->getNamespaceLookUpOrder();
            $this->env->setNamespaceLookUpOrder(array($namespace, '__main__'));
        }
        $this->loadTemplate("overall_footer.html", "acp_mathjax.html", 76)->display($context);
        if ($namespace) {
            $this->env->setNamespaceLookUpOrder($previous_look_up_order);
        }
    }

    public function getTemplateName()
    {
        return "acp_mathjax.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  239 => 76,  236 => 75,  230 => 72,  226 => 71,  223 => 70,  217 => 67,  212 => 65,  208 => 64,  205 => 63,  203 => 62,  200 => 61,  193 => 56,  182 => 53,  178 => 52,  175 => 51,  161 => 48,  156 => 47,  149 => 46,  144 => 45,  137 => 41,  133 => 40,  125 => 35,  122 => 34,  115 => 32,  109 => 29,  97 => 28,  93 => 26,  88 => 24,  85 => 23,  81 => 21,  78 => 20,  75 => 19,  70 => 18,  68 => 17,  64 => 16,  61 => 15,  55 => 12,  51 => 11,  48 => 10,  46 => 9,  41 => 7,  36 => 5,  31 => 2,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "acp_mathjax.html", "");
    }
}
