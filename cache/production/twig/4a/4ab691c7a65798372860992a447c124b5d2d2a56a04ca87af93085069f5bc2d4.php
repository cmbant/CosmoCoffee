<?php

/* acp_captcha.html */
class __TwigTemplate_61998c20f951b344727dc68d0791a30b96755eb52e9e87bd644942a27248014b extends Twig_Template
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
        $this->loadTemplate("overall_header.html", "acp_captcha.html", 1)->display($context);
        if ($namespace) {
            $this->env->setNamespaceLookUpOrder($previous_look_up_order);
        }
        // line 2
        echo "
<a id=\"maincontent\"></a>

<h1>";
        // line 5
        echo $this->env->getExtension('phpbb\template\twig\extension')->lang("ACP_VC_SETTINGS");
        echo "</h1>

<p>";
        // line 7
        echo $this->env->getExtension('phpbb\template\twig\extension')->lang("ACP_VC_SETTINGS_EXPLAIN");
        echo "</p>

<p>";
        // line 9
        echo $this->env->getExtension('phpbb\template\twig\extension')->lang("ACP_VC_EXT_GET_MORE");
        echo "</p>

";
        // line 11
        if ((isset($context["ERROR_MSG"]) ? $context["ERROR_MSG"] : null)) {
            // line 12
            echo "<div class=\"errorbox\">
\t<h3>";
            // line 13
            echo $this->env->getExtension('phpbb\template\twig\extension')->lang("WARNING");
            echo "</h3>
\t<p>";
            // line 14
            echo (isset($context["ERROR_MSG"]) ? $context["ERROR_MSG"] : null);
            echo "</p>
</div>
";
        }
        // line 17
        echo "
<form id=\"acp_captcha\" method=\"post\" action=\"";
        // line 18
        echo (isset($context["U_ACTION"]) ? $context["U_ACTION"] : null);
        echo "\">

<fieldset>
<legend>";
        // line 21
        echo $this->env->getExtension('phpbb\template\twig\extension')->lang("GENERAL_OPTIONS");
        echo "</legend>

<dl>
\t<dt><label for=\"enable_confirm\">";
        // line 24
        echo $this->env->getExtension('phpbb\template\twig\extension')->lang("VISUAL_CONFIRM_REG");
        echo $this->env->getExtension('phpbb\template\twig\extension')->lang("COLON");
        echo "</label><br /><span>";
        echo $this->env->getExtension('phpbb\template\twig\extension')->lang("VISUAL_CONFIRM_REG_EXPLAIN");
        echo "</span></dt>
\t<dd><label><input type=\"radio\" class=\"radio\" id=\"enable_confirm\" name=\"enable_confirm\" value=\"1\"";
        // line 25
        if ((isset($context["REG_ENABLE"]) ? $context["REG_ENABLE"] : null)) {
            echo " checked=\"checked\"";
        }
        echo " /> ";
        echo $this->env->getExtension('phpbb\template\twig\extension')->lang("ENABLED");
        echo "</label>
\t\t<label><input type=\"radio\" class=\"radio\" name=\"enable_confirm\" value=\"0\"";
        // line 26
        if ( !(isset($context["REG_ENABLE"]) ? $context["REG_ENABLE"] : null)) {
            echo " checked=\"checked\"";
        }
        echo " /> ";
        echo $this->env->getExtension('phpbb\template\twig\extension')->lang("DISABLED");
        echo "</label></dd>
</dl>
<dl>
\t<dt><label for=\"max_reg_attempts\">";
        // line 29
        echo $this->env->getExtension('phpbb\template\twig\extension')->lang("REG_LIMIT");
        echo $this->env->getExtension('phpbb\template\twig\extension')->lang("COLON");
        echo "</label><br /><span>";
        echo $this->env->getExtension('phpbb\template\twig\extension')->lang("REG_LIMIT_EXPLAIN");
        echo "</span></dt>
\t<dd><input id=\"max_reg_attempts\" type=\"number\" min=\"0\" max=\"9999\" name=\"max_reg_attempts\" value=\"";
        // line 30
        echo (isset($context["REG_LIMIT"]) ? $context["REG_LIMIT"] : null);
        echo "\" /></dd>
</dl>
<dl>
\t<dt><label for=\"max_login_attempts\">";
        // line 33
        echo $this->env->getExtension('phpbb\template\twig\extension')->lang("MAX_LOGIN_ATTEMPTS");
        echo $this->env->getExtension('phpbb\template\twig\extension')->lang("COLON");
        echo "</label><br /><span>";
        echo $this->env->getExtension('phpbb\template\twig\extension')->lang("MAX_LOGIN_ATTEMPTS_EXPLAIN");
        echo "</span></dt>
\t<dd><input id=\"max_login_attempts\" type=\"number\" min=\"0\" max=\"9999\" name=\"max_login_attempts\" value=\"";
        // line 34
        echo (isset($context["MAX_LOGIN_ATTEMPTS"]) ? $context["MAX_LOGIN_ATTEMPTS"] : null);
        echo "\" /></dd>
</dl>
<dl>
\t<dt><label for=\"enable_post_confirm\">";
        // line 37
        echo $this->env->getExtension('phpbb\template\twig\extension')->lang("VISUAL_CONFIRM_POST");
        echo $this->env->getExtension('phpbb\template\twig\extension')->lang("COLON");
        echo "</label><br /><span>";
        echo $this->env->getExtension('phpbb\template\twig\extension')->lang("VISUAL_CONFIRM_POST_EXPLAIN");
        echo "</span></dt>
\t<dd><label><input type=\"radio\" class=\"radio\" id=\"enable_post_confirm\" name=\"enable_post_confirm\" value=\"1\"";
        // line 38
        if ((isset($context["POST_ENABLE"]) ? $context["POST_ENABLE"] : null)) {
            echo " checked=\"checked\"";
        }
        echo " /> ";
        echo $this->env->getExtension('phpbb\template\twig\extension')->lang("ENABLED");
        echo "</label>
\t\t<label><input type=\"radio\" class=\"radio\" name=\"enable_post_confirm\" value=\"0\"";
        // line 39
        if ( !(isset($context["POST_ENABLE"]) ? $context["POST_ENABLE"] : null)) {
            echo " checked=\"checked\"";
        }
        echo " /> ";
        echo $this->env->getExtension('phpbb\template\twig\extension')->lang("DISABLED");
        echo "</label></dd>
</dl>
<dl>
\t<dt><label for=\"confirm_refresh\">";
        // line 42
        echo $this->env->getExtension('phpbb\template\twig\extension')->lang("VISUAL_CONFIRM_REFRESH");
        echo $this->env->getExtension('phpbb\template\twig\extension')->lang("COLON");
        echo "</label><br /><span>";
        echo $this->env->getExtension('phpbb\template\twig\extension')->lang("VISUAL_CONFIRM_REFRESH_EXPLAIN");
        echo "</span></dt>
\t<dd><label><input type=\"radio\" class=\"radio\" id=\"confirm_refresh\" name=\"confirm_refresh\" value=\"1\"";
        // line 43
        if ((isset($context["CONFIRM_REFRESH"]) ? $context["CONFIRM_REFRESH"] : null)) {
            echo " checked=\"checked\"";
        }
        echo " /> ";
        echo $this->env->getExtension('phpbb\template\twig\extension')->lang("ENABLED");
        echo "</label>
\t\t<label><input type=\"radio\" class=\"radio\" name=\"confirm_refresh\" value=\"0\"";
        // line 44
        if ( !(isset($context["CONFIRM_REFRESH"]) ? $context["CONFIRM_REFRESH"] : null)) {
            echo " checked=\"checked\"";
        }
        echo " /> ";
        echo $this->env->getExtension('phpbb\template\twig\extension')->lang("DISABLED");
        echo "</label></dd>
</dl>
</fieldset>

<fieldset>
<legend>";
        // line 49
        echo $this->env->getExtension('phpbb\template\twig\extension')->lang("AVAILABLE_CAPTCHAS");
        echo "</legend>
<dl>
\t<dt><label for=\"captcha_select\">";
        // line 51
        echo $this->env->getExtension('phpbb\template\twig\extension')->lang("CAPTCHA_SELECT");
        echo $this->env->getExtension('phpbb\template\twig\extension')->lang("COLON");
        echo "</label><br /><span>";
        echo $this->env->getExtension('phpbb\template\twig\extension')->lang("CAPTCHA_SELECT_EXPLAIN");
        echo "</span></dt>
\t<dd><select id=\"captcha_select\" name=\"select_captcha\" onchange=\"(document.getElementById('acp_captcha')).submit()\" >";
        // line 52
        echo (isset($context["CAPTCHA_SELECT"]) ? $context["CAPTCHA_SELECT"] : null);
        echo "</select></dd>
</dl>
 ";
        // line 54
        if ((isset($context["S_CAPTCHA_HAS_CONFIG"]) ? $context["S_CAPTCHA_HAS_CONFIG"] : null)) {
            // line 55
            echo "<dl>
\t<dt><label for=\"configure\">";
            // line 56
            echo $this->env->getExtension('phpbb\template\twig\extension')->lang("CAPTCHA_CONFIGURE");
            echo $this->env->getExtension('phpbb\template\twig\extension')->lang("COLON");
            echo "</label><br /><span>";
            echo $this->env->getExtension('phpbb\template\twig\extension')->lang("CAPTCHA_CONFIGURE_EXPLAIN");
            echo "</span></dt>
\t<dd><input class=\"button2\" type=\"submit\" id=\"configure\" name=\"configure\" value=\"";
            // line 57
            echo $this->env->getExtension('phpbb\template\twig\extension')->lang("CONFIGURE");
            echo "\" /></dd>
</dl>
";
        }
        // line 60
        echo "</fieldset>

";
        // line 62
        if ((isset($context["CAPTCHA_PREVIEW_TPL"]) ? $context["CAPTCHA_PREVIEW_TPL"] : null)) {
            // line 63
            echo "<fieldset>
\t<legend>";
            // line 64
            echo $this->env->getExtension('phpbb\template\twig\extension')->lang("PREVIEW");
            echo "</legend>
";
            // line 65
            $location = (("" . (isset($context["CAPTCHA_PREVIEW_TPL"]) ? $context["CAPTCHA_PREVIEW_TPL"] : null)) . "");
            $namespace = false;
            if (strpos($location, '@') === 0) {
                $namespace = substr($location, 1, strpos($location, '/') - 1);
                $previous_look_up_order = $this->env->getNamespaceLookUpOrder();
                $this->env->setNamespaceLookUpOrder(array($namespace, '__main__'));
            }
            $this->loadTemplate((("" . (isset($context["CAPTCHA_PREVIEW_TPL"]) ? $context["CAPTCHA_PREVIEW_TPL"] : null)) . ""), "acp_captcha.html", 65)->display($context);
            if ($namespace) {
                $this->env->setNamespaceLookUpOrder($previous_look_up_order);
            }
            // line 66
            echo "</fieldset>
";
        }
        // line 68
        echo "
<fieldset>
\t<legend>";
        // line 70
        echo $this->env->getExtension('phpbb\template\twig\extension')->lang("ACP_SUBMIT_CHANGES");
        echo "</legend>
\t<p class=\"submit-buttons\">
\t\t<input class=\"button1\" type=\"submit\" id=\"main_submit\" name=\"main_submit\" value=\"";
        // line 72
        echo $this->env->getExtension('phpbb\template\twig\extension')->lang("SUBMIT");
        echo "\" />&nbsp;
\t\t<input class=\"button2\" type=\"reset\" id=\"form_reset\" name=\"reset\" value=\"";
        // line 73
        echo $this->env->getExtension('phpbb\template\twig\extension')->lang("RESET");
        echo "\" />&nbsp;
\t</p>
\t";
        // line 75
        echo (isset($context["S_FORM_TOKEN"]) ? $context["S_FORM_TOKEN"] : null);
        echo "
</fieldset>
</form>

";
        // line 79
        $location = "overall_footer.html";
        $namespace = false;
        if (strpos($location, '@') === 0) {
            $namespace = substr($location, 1, strpos($location, '/') - 1);
            $previous_look_up_order = $this->env->getNamespaceLookUpOrder();
            $this->env->setNamespaceLookUpOrder(array($namespace, '__main__'));
        }
        $this->loadTemplate("overall_footer.html", "acp_captcha.html", 79)->display($context);
        if ($namespace) {
            $this->env->setNamespaceLookUpOrder($previous_look_up_order);
        }
    }

    public function getTemplateName()
    {
        return "acp_captcha.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  273 => 79,  266 => 75,  261 => 73,  257 => 72,  252 => 70,  248 => 68,  244 => 66,  232 => 65,  228 => 64,  225 => 63,  223 => 62,  219 => 60,  213 => 57,  206 => 56,  203 => 55,  201 => 54,  196 => 52,  189 => 51,  184 => 49,  172 => 44,  164 => 43,  157 => 42,  147 => 39,  139 => 38,  132 => 37,  126 => 34,  119 => 33,  113 => 30,  106 => 29,  96 => 26,  88 => 25,  81 => 24,  75 => 21,  69 => 18,  66 => 17,  60 => 14,  56 => 13,  53 => 12,  51 => 11,  46 => 9,  41 => 7,  36 => 5,  31 => 2,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "acp_captcha.html", "");
    }
}
