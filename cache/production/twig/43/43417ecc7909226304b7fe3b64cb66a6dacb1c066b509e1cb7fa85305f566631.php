<?php

/* ucp_groups_membership.html */
class __TwigTemplate_fe85e85a3b037733e5cde3c3fef94963d4212a3a9af250e2ff3453abc4b26058 extends Twig_Template
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
        $location = "ucp_header.html";
        $namespace = false;
        if (strpos($location, '@') === 0) {
            $namespace = substr($location, 1, strpos($location, '/') - 1);
            $previous_look_up_order = $this->env->getNamespaceLookUpOrder();
            $this->env->setNamespaceLookUpOrder(array($namespace, '__main__'));
        }
        $this->loadTemplate("ucp_header.html", "ucp_groups_membership.html", 1)->display($context);
        if ($namespace) {
            $this->env->setNamespaceLookUpOrder($previous_look_up_order);
        }
        // line 2
        echo "
<h2>";
        // line 3
        echo $this->env->getExtension('phpbb\template\twig\extension')->lang("USERGROUPS");
        echo "</h2>

<form id=\"ucp\" method=\"post\" action=\"";
        // line 5
        echo (isset($context["S_UCP_ACTION"]) ? $context["S_UCP_ACTION"] : null);
        echo "\"";
        echo (isset($context["S_FORM_ENCTYPE"]) ? $context["S_FORM_ENCTYPE"] : null);
        echo ">

<div class=\"panel\">
\t<div class=\"inner\">

\t<p>";
        // line 10
        echo $this->env->getExtension('phpbb\template\twig\extension')->lang("GROUPS_EXPLAIN");
        echo "</p>
\t";
        // line 11
        $value = 0;
        $context['definition']->set('SHOW_BUTTONS', $value);
        // line 12
        echo "\t";
        if (twig_length_filter($this->env, $this->getAttribute((isset($context["loops"]) ? $context["loops"] : null), "leader", array()))) {
            // line 13
            echo "\t\t<ul class=\"topiclist two-columns\">
\t\t\t<li class=\"header\">
\t\t\t\t<dl>
\t\t\t\t\t<dt><div class=\"list-inner\">";
            // line 16
            echo $this->env->getExtension('phpbb\template\twig\extension')->lang("GROUP_LEADER");
            echo "</div></dt>
\t\t\t\t\t<dd class=\"mark\">";
            // line 17
            echo $this->env->getExtension('phpbb\template\twig\extension')->lang("SELECT");
            echo "</dd>
\t\t\t\t</dl>
\t\t\t</li>
\t\t</ul>
\t\t<ul class=\"topiclist cplist two-columns\">

\t\t";
            // line 23
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["loops"]) ? $context["loops"] : null), "leader", array()));
            foreach ($context['_seq'] as $context["_key"] => $context["leader"]) {
                // line 24
                echo "\t\t";
                if ( !$this->getAttribute($context["leader"], "GROUP_SPECIAL", array())) {
                    // line 25
                    echo "\t\t\t";
                    $value = 1;
                    $context['definition']->set('SHOW_BUTTONS', $value);
                    // line 26
                    echo "\t\t";
                }
                // line 27
                echo "\t\t<li class=\"row";
                if (($this->getAttribute($context["leader"], "S_ROW_COUNT", array()) % 2 == 1)) {
                    echo " bg1";
                } else {
                    echo " bg2";
                }
                echo "\">
\t\t\t<dl>
\t\t\t\t<dt>
\t\t\t\t\t<div class=\"list-inner\">
\t\t\t\t\t\t";
                // line 31
                if ((isset($context["S_CHANGE_DEFAULT"]) ? $context["S_CHANGE_DEFAULT"] : null)) {
                    echo "<input title=\"";
                    echo $this->env->getExtension('phpbb\template\twig\extension')->lang("CHANGE_DEFAULT_GROUP");
                    echo "\" type=\"radio\" name=\"default\"";
                    if ($this->getAttribute($context["leader"], "S_GROUP_DEFAULT", array())) {
                        echo " checked=\"checked\"";
                    }
                    echo " value=\"";
                    echo $this->getAttribute($context["leader"], "GROUP_ID", array());
                    echo "\" /> ";
                }
                // line 32
                echo "\t\t\t\t\t\t<a href=\"";
                echo $this->getAttribute($context["leader"], "U_VIEW_GROUP", array());
                echo "\" class=\"forumtitle\"";
                if ($this->getAttribute($context["leader"], "GROUP_COLOUR", array())) {
                    echo " style=\"color:#";
                    echo $this->getAttribute($context["leader"], "GROUP_COLOUR", array());
                    echo "\"";
                }
                echo ">";
                echo $this->getAttribute($context["leader"], "GROUP_NAME", array());
                echo "</a>
\t\t\t\t\t\t";
                // line 33
                if ($this->getAttribute($context["leader"], "GROUP_DESC", array())) {
                    echo "<br />";
                    echo $this->getAttribute($context["leader"], "GROUP_DESC", array());
                }
                // line 34
                echo "\t\t\t\t\t\t";
                if ( !$this->getAttribute($context["leader"], "GROUP_SPECIAL", array())) {
                    echo "<br /><i>";
                    echo $this->getAttribute($context["leader"], "GROUP_STATUS", array());
                    echo "</i>";
                }
                // line 35
                echo "\t\t\t\t\t</div>
\t\t\t\t</dt>
\t\t\t\t<dd class=\"mark\"><input type=\"radio\" name=\"selected\" value=\"";
                // line 37
                echo $this->getAttribute($context["leader"], "GROUP_ID", array());
                echo "\" ";
                if ($this->getAttribute($context["leader"], "GROUP_SPECIAL", array())) {
                    echo "disabled=\"disabled\"";
                }
                echo " /></dd>
\t\t\t</dl>
\t\t</li>
\t\t";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['leader'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 41
            echo "\t\t</ul>
\t";
        }
        // line 43
        echo "
\t";
        // line 44
        if (twig_length_filter($this->env, $this->getAttribute((isset($context["loops"]) ? $context["loops"] : null), "member", array()))) {
            // line 45
            echo "\t\t<ul class=\"topiclist two-columns\">
\t\t\t<li class=\"header\">
\t\t\t\t<dl>
\t\t\t\t\t<dt><div class=\"list-inner\">";
            // line 48
            echo $this->env->getExtension('phpbb\template\twig\extension')->lang("GROUP_MEMBER");
            echo "</div></dt>
\t\t\t\t\t<dd class=\"mark\">";
            // line 49
            echo $this->env->getExtension('phpbb\template\twig\extension')->lang("SELECT");
            echo "</dd>
\t\t\t\t</dl>
\t\t\t</li>
\t\t</ul>
\t\t<ul class=\"topiclist cplist two-columns\">

\t\t";
            // line 55
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["loops"]) ? $context["loops"] : null), "member", array()));
            foreach ($context['_seq'] as $context["_key"] => $context["member"]) {
                // line 56
                echo "\t\t";
                if ( !$this->getAttribute($context["member"], "GROUP_SPECIAL", array())) {
                    // line 57
                    echo "\t\t\t";
                    $value = 1;
                    $context['definition']->set('SHOW_BUTTONS', $value);
                    // line 58
                    echo "\t\t";
                }
                // line 59
                echo "\t\t<li class=\"row";
                if (($this->getAttribute($context["member"], "S_ROW_COUNT", array()) % 2 == 1)) {
                    echo " bg1";
                } else {
                    echo " bg2";
                }
                echo "\">
\t\t\t<dl>
\t\t\t\t<dt>
\t\t\t\t\t<div class=\"list-inner\">
\t\t\t\t\t\t";
                // line 63
                if ((isset($context["S_CHANGE_DEFAULT"]) ? $context["S_CHANGE_DEFAULT"] : null)) {
                    echo "<input title=\"";
                    echo $this->env->getExtension('phpbb\template\twig\extension')->lang("CHANGE_DEFAULT_GROUP");
                    echo "\" type=\"radio\" name=\"default\"";
                    if ($this->getAttribute($context["member"], "S_GROUP_DEFAULT", array())) {
                        echo " checked=\"checked\"";
                    }
                    echo " value=\"";
                    echo $this->getAttribute($context["member"], "GROUP_ID", array());
                    echo "\" /> ";
                }
                // line 64
                echo "\t\t\t\t\t\t<a href=\"";
                echo $this->getAttribute($context["member"], "U_VIEW_GROUP", array());
                echo "\" class=\"forumtitle\"";
                if ($this->getAttribute($context["member"], "GROUP_COLOUR", array())) {
                    echo " style=\"color:#";
                    echo $this->getAttribute($context["member"], "GROUP_COLOUR", array());
                    echo "\"";
                }
                echo ">";
                echo $this->getAttribute($context["member"], "GROUP_NAME", array());
                echo "</a>
\t\t\t\t\t\t";
                // line 65
                if ($this->getAttribute($context["member"], "GROUP_DESC", array())) {
                    echo "<br />";
                    echo $this->getAttribute($context["member"], "GROUP_DESC", array());
                }
                // line 66
                echo "\t\t\t\t\t\t";
                if ( !$this->getAttribute($context["member"], "GROUP_SPECIAL", array())) {
                    echo "<br /><i>";
                    echo $this->getAttribute($context["member"], "GROUP_STATUS", array());
                    echo "</i>";
                }
                // line 67
                echo "\t\t\t\t\t</div>
\t\t\t\t</dt>
\t\t\t\t<dd class=\"mark\"><input type=\"radio\" name=\"selected\" value=\"";
                // line 69
                echo $this->getAttribute($context["member"], "GROUP_ID", array());
                echo "\" ";
                if ($this->getAttribute($context["member"], "GROUP_SPECIAL", array())) {
                    echo "disabled=\"disabled\"";
                }
                echo " /></dd>
\t\t\t</dl>
\t\t</li>
\t\t";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['member'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 73
            echo "\t\t</ul>
\t";
        }
        // line 75
        echo "\t</div>
</div>

";
        // line 78
        if (twig_length_filter($this->env, $this->getAttribute((isset($context["loops"]) ? $context["loops"] : null), "pending", array()))) {
            // line 79
            echo "<div class=\"panel\">
\t<div class=\"inner\">
\t\t<ul class=\"topiclist two-columns\">
\t\t\t<li class=\"header\">
\t\t\t\t<dl>
\t\t\t\t\t<dt><div class=\"list-inner\">";
            // line 84
            echo $this->env->getExtension('phpbb\template\twig\extension')->lang("GROUP_PENDING");
            echo "</div></dt>
\t\t\t\t\t<dd class=\"mark\">";
            // line 85
            echo $this->env->getExtension('phpbb\template\twig\extension')->lang("SELECT");
            echo "</dd>
\t\t\t\t</dl>
\t\t\t</li>
\t\t</ul>
\t\t<ul class=\"topiclist cplist two-columns\">

\t\t";
            // line 91
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["loops"]) ? $context["loops"] : null), "pending", array()));
            foreach ($context['_seq'] as $context["_key"] => $context["pending"]) {
                // line 92
                echo "\t\t";
                if ( !$this->getAttribute($context["pending"], "GROUP_SPECIAL", array())) {
                    // line 93
                    echo "\t\t\t";
                    $value = 1;
                    $context['definition']->set('SHOW_BUTTONS', $value);
                    // line 94
                    echo "\t\t";
                }
                // line 95
                echo "\t\t<li class=\"row";
                if (($this->getAttribute($context["pending"], "S_ROW_COUNT", array()) % 2 == 1)) {
                    echo " bg1";
                } else {
                    echo " bg2";
                }
                echo "\">
\t\t\t<dl>
\t\t\t\t<dt>
\t\t\t\t\t<div class=\"list-inner\">
\t\t\t\t\t\t<a href=\"";
                // line 99
                echo $this->getAttribute($context["pending"], "U_VIEW_GROUP", array());
                echo "\" class=\"forumtitle\"";
                if ($this->getAttribute($context["pending"], "GROUP_COLOUR", array())) {
                    echo " style=\"color:#";
                    echo $this->getAttribute($context["pending"], "GROUP_COLOUR", array());
                    echo "\"";
                }
                echo ">";
                echo $this->getAttribute($context["pending"], "GROUP_NAME", array());
                echo "</a>
\t\t\t\t\t\t";
                // line 100
                if ($this->getAttribute($context["pending"], "GROUP_DESC", array())) {
                    echo "<br />";
                    echo $this->getAttribute($context["pending"], "GROUP_DESC", array());
                }
                // line 101
                echo "\t\t\t\t\t\t";
                if ( !$this->getAttribute($context["pending"], "GROUP_SPECIAL", array())) {
                    echo "<br /><i>";
                    echo $this->getAttribute($context["pending"], "GROUP_STATUS", array());
                    echo "</i>";
                }
                // line 102
                echo "\t\t\t\t\t</div>
\t\t\t\t</dt>
\t\t\t\t<dd class=\"mark\"><input type=\"radio\" name=\"selected\" value=\"";
                // line 104
                echo $this->getAttribute($context["pending"], "GROUP_ID", array());
                echo "\" ";
                if ($this->getAttribute($context["pending"], "GROUP_SPECIAL", array())) {
                    echo "disabled=\"disabled\"";
                }
                echo " /></dd>
\t\t\t</dl>
\t\t</li>
\t\t";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['pending'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 108
            echo "\t\t</ul>
\t</div>
</div>
";
        }
        // line 112
        if (twig_length_filter($this->env, $this->getAttribute((isset($context["loops"]) ? $context["loops"] : null), "nonmember", array()))) {
            // line 113
            echo "<div class=\"panel\">
\t<div class=\"inner\">
\t\t<ul class=\"topiclist two-columns\">
\t\t\t<li class=\"header\">
\t\t\t\t<dl>
\t\t\t\t\t<dt><div class=\"list-inner\">";
            // line 118
            echo $this->env->getExtension('phpbb\template\twig\extension')->lang("GROUP_NONMEMBER");
            echo "</div></dt>
\t\t\t\t\t<dd class=\"mark\">";
            // line 119
            echo $this->env->getExtension('phpbb\template\twig\extension')->lang("SELECT");
            echo "</dd>
\t\t\t\t</dl>
\t\t\t</li>
\t\t</ul>
\t\t<ul class=\"topiclist cplist two-columns\">

\t\t";
            // line 125
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["loops"]) ? $context["loops"] : null), "nonmember", array()));
            foreach ($context['_seq'] as $context["_key"] => $context["nonmember"]) {
                // line 126
                echo "\t\t";
                if ($this->getAttribute($context["nonmember"], "S_CAN_JOIN", array())) {
                    // line 127
                    echo "\t\t\t";
                    $value = 1;
                    $context['definition']->set('SHOW_BUTTONS', $value);
                    // line 128
                    echo "\t\t";
                }
                // line 129
                echo "\t\t<li class=\"row";
                if (($this->getAttribute($context["nonmember"], "S_ROW_COUNT", array()) % 2 == 1)) {
                    echo " bg1";
                } else {
                    echo " bg2";
                }
                echo "\">
\t\t\t<dl>
\t\t\t\t<dt>
\t\t\t\t\t<div class=\"list-inner\">
\t\t\t\t\t\t<a href=\"";
                // line 133
                echo $this->getAttribute($context["nonmember"], "U_VIEW_GROUP", array());
                echo "\" class=\"forumtitle\"";
                if ($this->getAttribute($context["nonmember"], "GROUP_COLOUR", array())) {
                    echo " style=\"color:#";
                    echo $this->getAttribute($context["nonmember"], "GROUP_COLOUR", array());
                    echo "\"";
                }
                echo ">";
                echo $this->getAttribute($context["nonmember"], "GROUP_NAME", array());
                echo "</a>
\t\t\t\t\t\t";
                // line 134
                if ($this->getAttribute($context["nonmember"], "GROUP_DESC", array())) {
                    echo "<br />";
                    echo $this->getAttribute($context["nonmember"], "GROUP_DESC", array());
                }
                // line 135
                echo "\t\t\t\t\t\t";
                if ( !$this->getAttribute($context["nonmember"], "GROUP_SPECIAL", array())) {
                    echo "<br /><i>";
                    echo $this->getAttribute($context["nonmember"], "GROUP_STATUS", array());
                    echo "</i>";
                }
                // line 136
                echo "\t\t\t\t\t</div>
\t\t\t\t</dt>
\t\t\t\t<dd class=\"mark\"><input type=\"radio\" name=\"selected\" value=\"";
                // line 138
                echo $this->getAttribute($context["nonmember"], "GROUP_ID", array());
                echo "\" ";
                if ( !$this->getAttribute($context["nonmember"], "S_CAN_JOIN", array())) {
                    echo "disabled=\"disabled\"";
                }
                echo " /></dd>
\t\t\t</dl>
\t\t</li>
\t\t";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['nonmember'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 142
            echo "\t\t</ul>
\t\t</div>
\t</div>
";
        }
        // line 146
        echo "

\t";
        // line 148
        if (((isset($context["S_CHANGE_DEFAULT"]) ? $context["S_CHANGE_DEFAULT"] : null) || ($this->getAttribute((isset($context["definition"]) ? $context["definition"] : null), "SHOW_BUTTONS", array()) == 1))) {
            // line 149
            echo "\t<fieldset>
\t\t";
            // line 150
            if ((isset($context["S_CHANGE_DEFAULT"]) ? $context["S_CHANGE_DEFAULT"] : null)) {
                // line 151
                echo "\t\t<div class=\"left-box\">
\t\t\t<input class=\"button2\" type=\"submit\" name=\"change_default\" value=\"";
                // line 152
                echo $this->env->getExtension('phpbb\template\twig\extension')->lang("CHANGE_DEFAULT_GROUP");
                echo "\" />
\t\t\t";
                // line 153
                echo (isset($context["S_FORM_TOKEN"]) ? $context["S_FORM_TOKEN"] : null);
                echo "
\t\t</div>
\t\t";
            }
            // line 156
            echo "
\t\t";
            // line 157
            if (($this->getAttribute((isset($context["definition"]) ? $context["definition"] : null), "SHOW_BUTTONS", array()) == 1)) {
                // line 158
                echo "\t\t<div class=\"right-box\">
\t\t\t<label for=\"action\">";
                // line 159
                echo $this->env->getExtension('phpbb\template\twig\extension')->lang("SELECT");
                echo $this->env->getExtension('phpbb\template\twig\extension')->lang("COLON");
                echo "</label>
\t\t\t<select name=\"action\" id=\"action\">
\t\t\t\t<option value=\"join\">";
                // line 161
                echo $this->env->getExtension('phpbb\template\twig\extension')->lang("JOIN_SELECTED");
                echo "</option>
\t\t\t\t<option value=\"resign\">";
                // line 162
                echo $this->env->getExtension('phpbb\template\twig\extension')->lang("RESIGN_SELECTED");
                echo "</option>
\t\t\t\t<option value=\"demote\">";
                // line 163
                echo $this->env->getExtension('phpbb\template\twig\extension')->lang("DEMOTE_SELECTED");
                echo "</option>
\t\t\t</select>&nbsp;
\t\t\t<input class=\"button2\" type=\"submit\" name=\"submit\" value=\"";
                // line 165
                echo $this->env->getExtension('phpbb\template\twig\extension')->lang("SUBMIT");
                echo "\" />
\t\t\t";
                // line 166
                echo (isset($context["S_FORM_TOKEN"]) ? $context["S_FORM_TOKEN"] : null);
                echo "
\t\t</div>
\t\t";
            }
            // line 169
            echo "\t</fieldset>
\t";
        }
        // line 171
        echo "
</form>

";
        // line 174
        $location = "ucp_footer.html";
        $namespace = false;
        if (strpos($location, '@') === 0) {
            $namespace = substr($location, 1, strpos($location, '/') - 1);
            $previous_look_up_order = $this->env->getNamespaceLookUpOrder();
            $this->env->setNamespaceLookUpOrder(array($namespace, '__main__'));
        }
        $this->loadTemplate("ucp_footer.html", "ucp_groups_membership.html", 174)->display($context);
        if ($namespace) {
            $this->env->setNamespaceLookUpOrder($previous_look_up_order);
        }
    }

    public function getTemplateName()
    {
        return "ucp_groups_membership.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  537 => 174,  532 => 171,  528 => 169,  522 => 166,  518 => 165,  513 => 163,  509 => 162,  505 => 161,  499 => 159,  496 => 158,  494 => 157,  491 => 156,  485 => 153,  481 => 152,  478 => 151,  476 => 150,  473 => 149,  471 => 148,  467 => 146,  461 => 142,  447 => 138,  443 => 136,  436 => 135,  431 => 134,  419 => 133,  407 => 129,  404 => 128,  400 => 127,  397 => 126,  393 => 125,  384 => 119,  380 => 118,  373 => 113,  371 => 112,  365 => 108,  351 => 104,  347 => 102,  340 => 101,  335 => 100,  323 => 99,  311 => 95,  308 => 94,  304 => 93,  301 => 92,  297 => 91,  288 => 85,  284 => 84,  277 => 79,  275 => 78,  270 => 75,  266 => 73,  252 => 69,  248 => 67,  241 => 66,  236 => 65,  223 => 64,  211 => 63,  199 => 59,  196 => 58,  192 => 57,  189 => 56,  185 => 55,  176 => 49,  172 => 48,  167 => 45,  165 => 44,  162 => 43,  158 => 41,  144 => 37,  140 => 35,  133 => 34,  128 => 33,  115 => 32,  103 => 31,  91 => 27,  88 => 26,  84 => 25,  81 => 24,  77 => 23,  68 => 17,  64 => 16,  59 => 13,  56 => 12,  53 => 11,  49 => 10,  39 => 5,  34 => 3,  31 => 2,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "ucp_groups_membership.html", "");
    }
}
