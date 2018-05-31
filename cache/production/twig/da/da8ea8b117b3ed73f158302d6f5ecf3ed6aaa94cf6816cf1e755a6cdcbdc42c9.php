<?php

/* acp_jabber.html */
class __TwigTemplate_ffaa698c0113e1054a5df5631e6e17acd02d14ffb6fe4c367dd9679dbd8195f5 extends Twig_Template
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
        $this->loadTemplate("overall_header.html", "acp_jabber.html", 1)->display($context);
        if ($namespace) {
            $this->env->setNamespaceLookUpOrder($previous_look_up_order);
        }
        // line 2
        echo "
<a id=\"maincontent\"></a>

<h1>";
        // line 5
        echo $this->env->getExtension('phpbb\template\twig\extension')->lang("ACP_JABBER_SETTINGS");
        echo "</h1>

<p>";
        // line 7
        echo $this->env->getExtension('phpbb\template\twig\extension')->lang("ACP_JABBER_SETTINGS_EXPLAIN");
        echo "</p>

";
        // line 9
        if ((isset($context["S_WARNING"]) ? $context["S_WARNING"] : null)) {
            // line 10
            echo "\t<div class=\"errorbox\">
\t\t<h3>";
            // line 11
            echo $this->env->getExtension('phpbb\template\twig\extension')->lang("WARNING");
            echo "</h3>
\t\t<p>";
            // line 12
            echo (isset($context["WARNING_MSG"]) ? $context["WARNING_MSG"] : null);
            echo "</p>
\t</div>
";
        }
        // line 15
        echo "
<form id=\"acp_jabber\" method=\"post\" action=\"";
        // line 16
        echo (isset($context["U_ACTION"]) ? $context["U_ACTION"] : null);
        echo "\">

<fieldset>
\t<legend>";
        // line 19
        echo $this->env->getExtension('phpbb\template\twig\extension')->lang("ACP_JABBER_SETTINGS");
        echo "</legend>
";
        // line 20
        if ((isset($context["S_GTALK_NOTE"]) ? $context["S_GTALK_NOTE"] : null)) {
            // line 21
            echo "\t<p>";
            echo $this->env->getExtension('phpbb\template\twig\extension')->lang("JAB_GTALK_NOTE");
            echo "</p>
";
        }
        // line 23
        echo "<dl>
\t<dt><label for=\"jab_enable\">";
        // line 24
        echo $this->env->getExtension('phpbb\template\twig\extension')->lang("JAB_ENABLE");
        echo $this->env->getExtension('phpbb\template\twig\extension')->lang("COLON");
        echo "</label><br /><span>";
        echo $this->env->getExtension('phpbb\template\twig\extension')->lang("JAB_ENABLE_EXPLAIN");
        echo "</span></dt>
\t<dd><label><input type=\"radio\" class=\"radio\" id=\"jab_enable\" name=\"jab_enable\" value=\"1\"";
        // line 25
        if ((isset($context["JAB_ENABLE"]) ? $context["JAB_ENABLE"] : null)) {
            echo " checked=\"checked\"";
        }
        echo " /> ";
        echo $this->env->getExtension('phpbb\template\twig\extension')->lang("ENABLED");
        echo "</label>
\t\t<label><input type=\"radio\" class=\"radio\" name=\"jab_enable\" value=\"0\"";
        // line 26
        if ( !(isset($context["JAB_ENABLE"]) ? $context["JAB_ENABLE"] : null)) {
            echo " checked=\"checked\"";
        }
        echo " /> ";
        echo $this->env->getExtension('phpbb\template\twig\extension')->lang("DISABLED");
        echo "</label></dd>
</dl>
<dl>
\t<dt><label for=\"jab_host\">";
        // line 29
        echo $this->env->getExtension('phpbb\template\twig\extension')->lang("JAB_SERVER");
        echo $this->env->getExtension('phpbb\template\twig\extension')->lang("COLON");
        echo "</label><br /><span>";
        echo $this->env->getExtension('phpbb\template\twig\extension')->lang("JAB_SERVER_EXPLAIN");
        echo "</span></dt>
\t<dd><input type=\"text\" id=\"jab_host\" name=\"jab_host\" value=\"";
        // line 30
        echo (isset($context["JAB_HOST"]) ? $context["JAB_HOST"] : null);
        echo "\" /></dd>
</dl>
<dl>
\t<dt><label for=\"jab_port\">";
        // line 33
        echo $this->env->getExtension('phpbb\template\twig\extension')->lang("JAB_PORT");
        echo $this->env->getExtension('phpbb\template\twig\extension')->lang("COLON");
        echo "</label><br /><span>";
        echo $this->env->getExtension('phpbb\template\twig\extension')->lang("JAB_PORT_EXPLAIN");
        echo "</span></dt>
\t<dd><input type=\"number\" id=\"jab_port\" name=\"jab_port\" value=\"";
        // line 34
        echo (isset($context["JAB_PORT"]) ? $context["JAB_PORT"] : null);
        echo "\" min=\"0\" max=\"99999\" /></dd>
</dl>
<dl>
\t<dt><label for=\"jab_username\">";
        // line 37
        echo $this->env->getExtension('phpbb\template\twig\extension')->lang("JAB_USERNAME");
        echo $this->env->getExtension('phpbb\template\twig\extension')->lang("COLON");
        echo "</label><br /><span>";
        echo $this->env->getExtension('phpbb\template\twig\extension')->lang("JAB_USERNAME_EXPLAIN");
        echo "</span></dt>
\t<dd><input type=\"text\" id=\"jab_username\" name=\"jab_username\" value=\"";
        // line 38
        echo (isset($context["JAB_USERNAME"]) ? $context["JAB_USERNAME"] : null);
        echo "\" /></dd>
</dl>
<dl>
\t<dt><label for=\"jab_password\">";
        // line 41
        echo $this->env->getExtension('phpbb\template\twig\extension')->lang("JAB_PASSWORD");
        echo $this->env->getExtension('phpbb\template\twig\extension')->lang("COLON");
        echo "</label><br /><span>";
        echo $this->env->getExtension('phpbb\template\twig\extension')->lang("JAB_PASSWORD_EXPLAIN");
        echo "</span></dt>
\t<dd><input type=\"password\" id=\"jab_password\" name=\"jab_password\" value=\"";
        // line 42
        echo (isset($context["JAB_PASSWORD"]) ? $context["JAB_PASSWORD"] : null);
        echo "\" autocomplete=\"off\" /></dd>
</dl>
";
        // line 44
        if ((isset($context["S_CAN_USE_SSL"]) ? $context["S_CAN_USE_SSL"] : null)) {
            // line 45
            echo "<dl>
\t<dt><label for=\"jab_use_ssl\">";
            // line 46
            echo $this->env->getExtension('phpbb\template\twig\extension')->lang("JAB_USE_SSL");
            echo $this->env->getExtension('phpbb\template\twig\extension')->lang("COLON");
            echo "</label><br /><span>";
            echo $this->env->getExtension('phpbb\template\twig\extension')->lang("JAB_USE_SSL_EXPLAIN");
            echo "</span></dt>
\t<dd><label><input type=\"radio\" class=\"radio\" id=\"jab_use_ssl\" name=\"jab_use_ssl\" value=\"1\"";
            // line 47
            if ((isset($context["JAB_USE_SSL"]) ? $context["JAB_USE_SSL"] : null)) {
                echo " checked=\"checked\"";
            }
            echo " /> ";
            echo $this->env->getExtension('phpbb\template\twig\extension')->lang("YES");
            echo "</label>
\t\t<label><input type=\"radio\" class=\"radio\" name=\"jab_use_ssl\" value=\"0\"";
            // line 48
            if ( !(isset($context["JAB_USE_SSL"]) ? $context["JAB_USE_SSL"] : null)) {
                echo " checked=\"checked\"";
            }
            echo " /> ";
            echo $this->env->getExtension('phpbb\template\twig\extension')->lang("NO");
            echo "</label></dd>
</dl>
<dl>
\t<dt><label for=\"jab_verify_peer\">";
            // line 51
            echo $this->env->getExtension('phpbb\template\twig\extension')->lang("JAB_VERIFY_PEER");
            echo $this->env->getExtension('phpbb\template\twig\extension')->lang("COLON");
            echo "</label><br /><span>";
            echo $this->env->getExtension('phpbb\template\twig\extension')->lang("JAB_VERIFY_PEER_EXPLAIN");
            echo "</span></dt>
\t<dd><label><input type=\"radio\" class=\"radio\" id=\"jab_verify_peer\" name=\"jab_verify_peer\" value=\"1\"";
            // line 52
            if ((isset($context["JAB_VERIFY_PEER"]) ? $context["JAB_VERIFY_PEER"] : null)) {
                echo " checked=\"checked\"";
            }
            echo " /> ";
            echo $this->env->getExtension('phpbb\template\twig\extension')->lang("YES");
            echo "</label>
\t\t<label><input type=\"radio\" class=\"radio\" name=\"jab_verify_peer\" value=\"0\"";
            // line 53
            if ( !(isset($context["JAB_VERIFY_PEER"]) ? $context["JAB_VERIFY_PEER"] : null)) {
                echo " checked=\"checked\"";
            }
            echo " /> ";
            echo $this->env->getExtension('phpbb\template\twig\extension')->lang("NO");
            echo "</label></dd>
</dl>
<dl>
\t<dt><label for=\"jab_verify_peer_name\">";
            // line 56
            echo $this->env->getExtension('phpbb\template\twig\extension')->lang("JAB_VERIFY_PEER_NAME");
            echo $this->env->getExtension('phpbb\template\twig\extension')->lang("COLON");
            echo "</label><br /><span>";
            echo $this->env->getExtension('phpbb\template\twig\extension')->lang("JAB_VERIFY_PEER_NAME_EXPLAIN");
            echo "</span></dt>
\t<dd><label><input type=\"radio\" class=\"radio\" id=\"jab_verify_peer_name\" name=\"jab_verify_peer_name\" value=\"1\"";
            // line 57
            if ((isset($context["JAB_VERIFY_PEER_NAME"]) ? $context["JAB_VERIFY_PEER_NAME"] : null)) {
                echo " checked=\"checked\"";
            }
            echo " /> ";
            echo $this->env->getExtension('phpbb\template\twig\extension')->lang("YES");
            echo "</label>
\t\t<label><input type=\"radio\" class=\"radio\" name=\"jab_verify_peer_name\" value=\"0\"";
            // line 58
            if ( !(isset($context["JAB_VERIFY_PEER_NAME"]) ? $context["JAB_VERIFY_PEER_NAME"] : null)) {
                echo " checked=\"checked\"";
            }
            echo " /> ";
            echo $this->env->getExtension('phpbb\template\twig\extension')->lang("NO");
            echo "</label></dd>
</dl>
<dl>
\t<dt><label for=\"jab_allow_self_signed\">";
            // line 61
            echo $this->env->getExtension('phpbb\template\twig\extension')->lang("JAB_ALLOW_SELF_SIGNED");
            echo $this->env->getExtension('phpbb\template\twig\extension')->lang("COLON");
            echo "</label><br /><span>";
            echo $this->env->getExtension('phpbb\template\twig\extension')->lang("JAB_ALLOW_SELF_SIGNED_EXPLAIN");
            echo "</span></dt>
\t<dd><label><input type=\"radio\" class=\"radio\" id=\"jab_allow_self_signed\" name=\"jab_allow_self_signed\" value=\"1\"";
            // line 62
            if ((isset($context["JAB_ALLOW_SELF_SIGNED"]) ? $context["JAB_ALLOW_SELF_SIGNED"] : null)) {
                echo " checked=\"checked\"";
            }
            echo " /> ";
            echo $this->env->getExtension('phpbb\template\twig\extension')->lang("YES");
            echo "</label>
\t\t<label><input type=\"radio\" class=\"radio\" name=\"jab_allow_self_signed\" value=\"0\"";
            // line 63
            if ( !(isset($context["JAB_ALLOW_SELF_SIGNED"]) ? $context["JAB_ALLOW_SELF_SIGNED"] : null)) {
                echo " checked=\"checked\"";
            }
            echo " /> ";
            echo $this->env->getExtension('phpbb\template\twig\extension')->lang("NO");
            echo "</label></dd>
</dl>
";
        }
        // line 66
        echo "<dl>
\t<dt><label for=\"jab_package_size\">";
        // line 67
        echo $this->env->getExtension('phpbb\template\twig\extension')->lang("JAB_PACKAGE_SIZE");
        echo $this->env->getExtension('phpbb\template\twig\extension')->lang("COLON");
        echo "</label><br /><span>";
        echo $this->env->getExtension('phpbb\template\twig\extension')->lang("JAB_PACKAGE_SIZE_EXPLAIN");
        echo "</span></dt>
\t<dd><input type=\"number\" id=\"jab_package_size\" name=\"jab_package_size\" value=\"";
        // line 68
        echo (isset($context["JAB_PACKAGE_SIZE"]) ? $context["JAB_PACKAGE_SIZE"] : null);
        echo "\" min=\"0\" max=\"99999\" /></dd>
</dl>

</fieldset>

<fieldset class=\"submit-buttons\">
\t<input class=\"button1\" type=\"submit\" id=\"submit\" name=\"submit\" value=\"";
        // line 74
        echo $this->env->getExtension('phpbb\template\twig\extension')->lang("SUBMIT");
        echo "\" />&nbsp;
\t<input class=\"button2\" type=\"reset\" id=\"reset\" name=\"reset\" value=\"";
        // line 75
        echo $this->env->getExtension('phpbb\template\twig\extension')->lang("RESET");
        echo "\" />
\t";
        // line 76
        echo (isset($context["S_FORM_TOKEN"]) ? $context["S_FORM_TOKEN"] : null);
        echo "
</fieldset>
</form>

";
        // line 80
        $location = "overall_footer.html";
        $namespace = false;
        if (strpos($location, '@') === 0) {
            $namespace = substr($location, 1, strpos($location, '/') - 1);
            $previous_look_up_order = $this->env->getNamespaceLookUpOrder();
            $this->env->setNamespaceLookUpOrder(array($namespace, '__main__'));
        }
        $this->loadTemplate("overall_footer.html", "acp_jabber.html", 80)->display($context);
        if ($namespace) {
            $this->env->setNamespaceLookUpOrder($previous_look_up_order);
        }
    }

    public function getTemplateName()
    {
        return "acp_jabber.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  300 => 80,  293 => 76,  289 => 75,  285 => 74,  276 => 68,  269 => 67,  266 => 66,  256 => 63,  248 => 62,  241 => 61,  231 => 58,  223 => 57,  216 => 56,  206 => 53,  198 => 52,  191 => 51,  181 => 48,  173 => 47,  166 => 46,  163 => 45,  161 => 44,  156 => 42,  149 => 41,  143 => 38,  136 => 37,  130 => 34,  123 => 33,  117 => 30,  110 => 29,  100 => 26,  92 => 25,  85 => 24,  82 => 23,  76 => 21,  74 => 20,  70 => 19,  64 => 16,  61 => 15,  55 => 12,  51 => 11,  48 => 10,  46 => 9,  41 => 7,  36 => 5,  31 => 2,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "acp_jabber.html", "");
    }
}
