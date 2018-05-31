<?php

/* captcha_qa_acp.html */
class __TwigTemplate_a9a5642dab030289953503ae26a9250786b341ae4a207bca5dd75a57671efbdd extends Twig_Template
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
        $this->loadTemplate("overall_header.html", "captcha_qa_acp.html", 1)->display($context);
        if ($namespace) {
            $this->env->setNamespaceLookUpOrder($previous_look_up_order);
        }
        // line 2
        echo "
<a id=\"maincontent\"></a>


\t<a href=\"";
        // line 6
        if ((isset($context["U_LIST"]) ? $context["U_LIST"] : null)) {
            echo (isset($context["U_LIST"]) ? $context["U_LIST"] : null);
        } else {
            echo (isset($context["U_ACTION"]) ? $context["U_ACTION"] : null);
        }
        echo "\" style=\"float: ";
        echo (isset($context["S_CONTENT_FLOW_END"]) ? $context["S_CONTENT_FLOW_END"] : null);
        echo ";\">&laquo; ";
        echo $this->env->getExtension('phpbb\template\twig\extension')->lang("BACK");
        echo "</a>

\t<h1>";
        // line 8
        echo $this->env->getExtension('phpbb\template\twig\extension')->lang("QUESTIONS");
        echo "</h1>

\t<p>";
        // line 10
        echo $this->env->getExtension('phpbb\template\twig\extension')->lang("QUESTIONS_EXPLAIN");
        echo "</p>
";
        // line 11
        if ((isset($context["S_LIST"]) ? $context["S_LIST"] : null)) {
            // line 12
            echo "\t<form id=\"captcha_qa\" method=\"post\" action=\"";
            echo (isset($context["U_ACTION"]) ? $context["U_ACTION"] : null);
            echo "\">

\t<fieldset class=\"tabulated\">
\t<legend>";
            // line 15
            echo $this->env->getExtension('phpbb\template\twig\extension')->lang("QUESTIONS");
            echo "</legend>

\t<table class=\"table1 zebra-table\">
\t<thead>
\t<tr>
\t\t<th colspan=\"3\">";
            // line 20
            echo $this->env->getExtension('phpbb\template\twig\extension')->lang("QUESTIONS");
            echo "</th>
\t</tr>
\t<tr class=\"row3\">
\t\t<td style=\"text-align: center;\">";
            // line 23
            echo $this->env->getExtension('phpbb\template\twig\extension')->lang("QUESTION_TEXT");
            echo "</td>
\t\t<td style=\"width: 5%; text-align: center;\">";
            // line 24
            echo $this->env->getExtension('phpbb\template\twig\extension')->lang("QUESTION_LANG");
            echo "</td>
\t\t<td style=\"vertical-align: top; width: 50px; text-align: center; white-space: nowrap;\">";
            // line 25
            echo $this->env->getExtension('phpbb\template\twig\extension')->lang("ACTION");
            echo "</td>
\t</tr>
\t</thead>
\t<tbody>
\t";
            // line 29
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["loops"]) ? $context["loops"] : null), "questions", array()));
            foreach ($context['_seq'] as $context["_key"] => $context["questions"]) {
                // line 30
                echo "\t<tr>
\t\t<td style=\"text-align: left;\">";
                // line 31
                echo $this->getAttribute($context["questions"], "QUESTION_TEXT", array());
                echo "</td>
\t\t<td style=\"text-align: center;\">";
                // line 32
                echo $this->getAttribute($context["questions"], "QUESTION_LANG", array());
                echo "</td>
\t\t<td style=\"text-align: center;\"><a href=\"";
                // line 33
                echo $this->getAttribute($context["questions"], "U_EDIT", array());
                echo "\">";
                echo (isset($context["ICON_EDIT"]) ? $context["ICON_EDIT"] : null);
                echo "</a>&nbsp;<a href=\"";
                echo $this->getAttribute($context["questions"], "U_DELETE", array());
                echo "\">";
                echo (isset($context["ICON_DELETE"]) ? $context["ICON_DELETE"] : null);
                echo "</a></td>
\t</tr>
\t";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['questions'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 36
            echo "\t</tbody>
\t</table>
\t<fieldset class=\"quick\">
\t\t<input class=\"button1\" type=\"submit\" name=\"add\" value=\"";
            // line 39
            echo $this->env->getExtension('phpbb\template\twig\extension')->lang("ADD");
            echo "\" />
\t\t<input  type=\"hidden\" name=\"action\" value=\"add\" />
\t\t<input  type=\"hidden\" name=\"configure\" value=\"1\" />
\t\t<input  type=\"hidden\" name=\"select_captcha\" value=\"";
            // line 42
            echo (isset($context["CLASS"]) ? $context["CLASS"] : null);
            echo "\" />

\t\t";
            // line 44
            echo (isset($context["S_FORM_TOKEN"]) ? $context["S_FORM_TOKEN"] : null);
            echo "
\t</fieldset>
\t";
            // line 46
            echo (isset($context["S_FORM_TOKEN"]) ? $context["S_FORM_TOKEN"] : null);
            echo "
\t</fieldset>
\t</form>
";
        } else {
            // line 50
            echo "\t";
            if ((isset($context["S_ERROR"]) ? $context["S_ERROR"] : null)) {
                // line 51
                echo "\t\t<div class=\"errorbox\">
\t\t\t<h3>";
                // line 52
                echo $this->env->getExtension('phpbb\template\twig\extension')->lang("WARNING");
                echo "</h3>
\t\t\t<p>";
                // line 53
                echo $this->env->getExtension('phpbb\template\twig\extension')->lang("QA_ERROR_MSG");
                echo "</p>
\t\t</div>
\t";
            }
            // line 56
            echo "\t<form id=\"captcha_qa\" method=\"post\" action=\"";
            echo (isset($context["U_ACTION"]) ? $context["U_ACTION"] : null);
            echo "\">
\t<fieldset>
\t\t<legend>";
            // line 58
            echo $this->env->getExtension('phpbb\template\twig\extension')->lang("EDIT_QUESTION");
            echo "</legend>
\t<dl>
\t\t<dt><label for=\"strict\">";
            // line 60
            echo $this->env->getExtension('phpbb\template\twig\extension')->lang("QUESTION_STRICT");
            echo $this->env->getExtension('phpbb\template\twig\extension')->lang("COLON");
            echo "</label><br /><span>";
            echo $this->env->getExtension('phpbb\template\twig\extension')->lang("QUESTION_STRICT_EXPLAIN");
            echo "</span></dt>
\t\t<dd><label><input type=\"radio\" class=\"radio\" name=\"strict\" value=\"1\"";
            // line 61
            if ((isset($context["STRICT"]) ? $context["STRICT"] : null)) {
                echo " id=\"strict\" checked=\"checked\"";
            }
            echo " /> ";
            echo $this->env->getExtension('phpbb\template\twig\extension')->lang("YES");
            echo "</label>
\t\t\t<label><input type=\"radio\" class=\"radio\" name=\"strict\" value=\"0\"";
            // line 62
            if ( !(isset($context["STRICT"]) ? $context["STRICT"] : null)) {
                echo " id=\"strict\" checked=\"checked\"";
            }
            echo " /> ";
            echo $this->env->getExtension('phpbb\template\twig\extension')->lang("NO");
            echo "</label></dd>
\t</dl>

\t<dl>
\t\t<dt><label for=\"lang_iso\">";
            // line 66
            echo $this->env->getExtension('phpbb\template\twig\extension')->lang("QUESTION_LANG");
            echo "</label><br /><span>";
            echo $this->env->getExtension('phpbb\template\twig\extension')->lang("QUESTION_LANG_EXPLAIN");
            echo "</span></dt>
\t\t<dd><select id=\"lang_iso\" name=\"lang_iso\">";
            // line 67
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["loops"]) ? $context["loops"] : null), "langs", array()));
            foreach ($context['_seq'] as $context["_key"] => $context["langs"]) {
                echo "<option value=\"";
                echo $this->getAttribute($context["langs"], "ISO", array());
                echo "\" ";
                if (($this->getAttribute($context["langs"], "ISO", array()) == (isset($context["LANG_ISO"]) ? $context["LANG_ISO"] : null))) {
                    echo " selected=\"selected\" ";
                }
                echo ">";
                echo $this->getAttribute($context["langs"], "NAME", array());
                echo "</option>";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['langs'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            echo "</select></dd>
\t</dl>
\t<dl>
\t\t<dt><label for=\"question_text\">";
            // line 70
            echo $this->env->getExtension('phpbb\template\twig\extension')->lang("QUESTION_TEXT");
            echo "</label><br /><span>";
            echo $this->env->getExtension('phpbb\template\twig\extension')->lang("QUESTION_TEXT_EXPLAIN");
            echo "</span></dt>
\t\t<dd><input id=\"question_text\" maxlength=\"255\" size=\"60\" name=\"question_text\" type=\"text\" value=\"";
            // line 71
            echo (isset($context["QUESTION_TEXT"]) ? $context["QUESTION_TEXT"] : null);
            echo "\" /></dd>
\t</dl>
\t<dl>
\t\t<dt><label for=\"answers\">";
            // line 74
            echo $this->env->getExtension('phpbb\template\twig\extension')->lang("QUESTION_ANSWERS");
            echo "</label><br /><span>";
            echo $this->env->getExtension('phpbb\template\twig\extension')->lang("ANSWERS_EXPLAIN");
            echo "</span></dt>
\t\t<dd><textarea id=\"answers\" style=\"word-wrap: normal; overflow-x: scroll;\" name=\"answers\" rows=\"15\" cols=\"800\" >";
            // line 75
            echo (isset($context["ANSWERS"]) ? $context["ANSWERS"] : null);
            echo "</textarea></dd>
\t</dl>
\t</fieldset>
\t<fieldset class=\"quick\">
\t\t<input class=\"button1\" type=\"submit\" name=\"submit\" value=\"";
            // line 79
            echo $this->env->getExtension('phpbb\template\twig\extension')->lang("SUBMIT");
            echo "\" />
\t\t<input type=\"hidden\" name=\"question_id\" value=\"";
            // line 80
            echo (isset($context["QUESTION_ID"]) ? $context["QUESTION_ID"] : null);
            echo "\" />
\t\t<input type=\"hidden\" name=\"action\" value=\"add\" />
\t\t<input  type=\"hidden\" name=\"configure\" value=\"1\" />
\t\t<input  type=\"hidden\" name=\"select_captcha\" value=\"";
            // line 83
            echo (isset($context["CLASS"]) ? $context["CLASS"] : null);
            echo "\" />

\t\t";
            // line 85
            echo (isset($context["S_FORM_TOKEN"]) ? $context["S_FORM_TOKEN"] : null);
            echo "
\t</fieldset>
\t</form>
";
        }
        // line 89
        echo "
";
        // line 90
        $location = "overall_footer.html";
        $namespace = false;
        if (strpos($location, '@') === 0) {
            $namespace = substr($location, 1, strpos($location, '/') - 1);
            $previous_look_up_order = $this->env->getNamespaceLookUpOrder();
            $this->env->setNamespaceLookUpOrder(array($namespace, '__main__'));
        }
        $this->loadTemplate("overall_footer.html", "captcha_qa_acp.html", 90)->display($context);
        if ($namespace) {
            $this->env->setNamespaceLookUpOrder($previous_look_up_order);
        }
    }

    public function getTemplateName()
    {
        return "captcha_qa_acp.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  285 => 90,  282 => 89,  275 => 85,  270 => 83,  264 => 80,  260 => 79,  253 => 75,  247 => 74,  241 => 71,  235 => 70,  214 => 67,  208 => 66,  197 => 62,  189 => 61,  182 => 60,  177 => 58,  171 => 56,  165 => 53,  161 => 52,  158 => 51,  155 => 50,  148 => 46,  143 => 44,  138 => 42,  132 => 39,  127 => 36,  112 => 33,  108 => 32,  104 => 31,  101 => 30,  97 => 29,  90 => 25,  86 => 24,  82 => 23,  76 => 20,  68 => 15,  61 => 12,  59 => 11,  55 => 10,  50 => 8,  37 => 6,  31 => 2,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "captcha_qa_acp.html", "");
    }
}
