<?php

/* acp_profile.html */
class __TwigTemplate_1a0eeaaa6f990f0fa2d23dda72c724ee2fcfe59e3e073ef1c0fd64fa4db55ba7 extends Twig_Template
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
        $this->loadTemplate("overall_header.html", "acp_profile.html", 1)->display($context);
        if ($namespace) {
            $this->env->setNamespaceLookUpOrder($previous_look_up_order);
        }
        // line 2
        echo "
<a id=\"maincontent\"></a>

";
        // line 5
        if ((isset($context["S_EDIT"]) ? $context["S_EDIT"] : null)) {
            // line 6
            echo "
\t<a href=\"";
            // line 7
            echo (isset($context["U_BACK"]) ? $context["U_BACK"] : null);
            echo "\" style=\"float: ";
            echo (isset($context["S_CONTENT_FLOW_END"]) ? $context["S_CONTENT_FLOW_END"] : null);
            echo ";\">&laquo; ";
            echo $this->env->getExtension('phpbb\template\twig\extension')->lang("BACK");
            echo "</a>

\t<h1>";
            // line 9
            echo $this->env->getExtension('phpbb\template\twig\extension')->lang("TITLE");
            echo "</h1>

\t<p>";
            // line 11
            echo $this->env->getExtension('phpbb\template\twig\extension')->lang("EXPLAIN");
            echo "</p>

\t";
            // line 13
            if ((isset($context["ERROR_MSG"]) ? $context["ERROR_MSG"] : null)) {
                // line 14
                echo "\t\t<div class=\"errorbox\">
\t\t\t<h3>";
                // line 15
                echo $this->env->getExtension('phpbb\template\twig\extension')->lang("WARNING");
                echo "</h3>
\t\t\t<p>";
                // line 16
                echo (isset($context["ERROR_MSG"]) ? $context["ERROR_MSG"] : null);
                echo "</p>
\t\t</div>
\t";
            }
            // line 19
            echo "
\t<form id=\"add_profile_field\" method=\"post\" action=\"";
            // line 20
            echo (isset($context["U_ACTION"]) ? $context["U_ACTION"] : null);
            echo "\"";
            echo (isset($context["S_FORM_ENCTYPE"]) ? $context["S_FORM_ENCTYPE"] : null);
            echo ">

\t";
            // line 22
            if ((isset($context["S_STEP_ONE"]) ? $context["S_STEP_ONE"] : null)) {
                // line 23
                echo "
\t\t<fieldset>
\t\t\t<legend>";
                // line 25
                echo $this->env->getExtension('phpbb\template\twig\extension')->lang("TITLE");
                echo "</legend>
\t\t<dl>
\t\t\t<dt><label>";
                // line 27
                echo $this->env->getExtension('phpbb\template\twig\extension')->lang("FIELD_TYPE");
                echo $this->env->getExtension('phpbb\template\twig\extension')->lang("COLON");
                echo "</label><br /><span>";
                echo $this->env->getExtension('phpbb\template\twig\extension')->lang("FIELD_TYPE_EXPLAIN");
                echo "</span></dt>
\t\t\t<dd><strong>";
                // line 28
                echo (isset($context["FIELD_TYPE"]) ? $context["FIELD_TYPE"] : null);
                echo "</strong></dd>
\t\t</dl>
\t\t";
                // line 30
                if ((isset($context["S_EDIT_MODE"]) ? $context["S_EDIT_MODE"] : null)) {
                    // line 31
                    echo "\t\t<dl>
\t\t\t<dt><label>";
                    // line 32
                    echo $this->env->getExtension('phpbb\template\twig\extension')->lang("FIELD_IDENT");
                    echo $this->env->getExtension('phpbb\template\twig\extension')->lang("COLON");
                    echo "</label><br /><span>";
                    echo $this->env->getExtension('phpbb\template\twig\extension')->lang("FIELD_IDENT_EXPLAIN");
                    echo "</span></dt>
\t\t\t<dd><input type=\"hidden\" name=\"field_ident\" value=\"";
                    // line 33
                    echo (isset($context["FIELD_IDENT"]) ? $context["FIELD_IDENT"] : null);
                    echo "\" /><strong>";
                    echo (isset($context["FIELD_IDENT"]) ? $context["FIELD_IDENT"] : null);
                    echo "</strong></dd>
\t\t</dl>
\t\t";
                } else {
                    // line 36
                    echo "\t\t<dl>
\t\t\t<dt><label for=\"field_ident\">";
                    // line 37
                    echo $this->env->getExtension('phpbb\template\twig\extension')->lang("FIELD_IDENT");
                    echo $this->env->getExtension('phpbb\template\twig\extension')->lang("COLON");
                    echo "</label><br /><span>";
                    echo $this->env->getExtension('phpbb\template\twig\extension')->lang("FIELD_IDENT_EXPLAIN");
                    echo "</span></dt>
\t\t\t<dd><input class=\"text medium\" type=\"text\" id=\"field_ident\" name=\"field_ident\" value=\"";
                    // line 38
                    echo (isset($context["FIELD_IDENT"]) ? $context["FIELD_IDENT"] : null);
                    echo "\" /></dd>
\t\t</dl>
\t\t";
                }
                // line 41
                echo "\t\t<dl>
\t\t\t<dt><label for=\"field_no_view\">";
                // line 42
                echo $this->env->getExtension('phpbb\template\twig\extension')->lang("DISPLAY_PROFILE_FIELD");
                echo $this->env->getExtension('phpbb\template\twig\extension')->lang("COLON");
                echo "</label><br /><span>";
                echo $this->env->getExtension('phpbb\template\twig\extension')->lang("DISPLAY_PROFILE_FIELD_EXPLAIN");
                echo "</span></dt>
\t\t\t<dd><label><input type=\"radio\" class=\"radio\" id=\"field_no_view\" name=\"field_no_view\" value=\"0\"";
                // line 43
                if ( !(isset($context["S_FIELD_NO_VIEW"]) ? $context["S_FIELD_NO_VIEW"] : null)) {
                    echo " checked=\"checked\"";
                }
                echo " /> ";
                echo $this->env->getExtension('phpbb\template\twig\extension')->lang("YES");
                echo "</label>
\t\t\t\t<label><input type=\"radio\" class=\"radio\" name=\"field_no_view\" value=\"1\"";
                // line 44
                if ((isset($context["S_FIELD_NO_VIEW"]) ? $context["S_FIELD_NO_VIEW"] : null)) {
                    echo " checked=\"checked\"";
                }
                echo " /> ";
                echo $this->env->getExtension('phpbb\template\twig\extension')->lang("NO");
                echo "</label></dd>
\t\t</dl>
\t\t</fieldset>

\t\t<fieldset>
\t\t\t<legend>";
                // line 49
                echo $this->env->getExtension('phpbb\template\twig\extension')->lang("VISIBILITY_OPTION");
                echo "</legend>
\t\t<dl>
\t\t\t<dt><label for=\"field_show_profile\">";
                // line 51
                echo $this->env->getExtension('phpbb\template\twig\extension')->lang("DISPLAY_AT_PROFILE");
                echo $this->env->getExtension('phpbb\template\twig\extension')->lang("COLON");
                echo "</label><br /><span>";
                echo $this->env->getExtension('phpbb\template\twig\extension')->lang("DISPLAY_AT_PROFILE_EXPLAIN");
                echo "</span></dt>
\t\t\t<dd><input type=\"checkbox\" class=\"radio\" id=\"field_show_profile\" name=\"field_show_profile\" value=\"1\"";
                // line 52
                if ((isset($context["S_SHOW_PROFILE"]) ? $context["S_SHOW_PROFILE"] : null)) {
                    echo " checked=\"checked\"";
                }
                echo " /></dd>
\t\t</dl>
\t\t<dl>
\t\t\t<dt><label for=\"field_show_on_reg\">";
                // line 55
                echo $this->env->getExtension('phpbb\template\twig\extension')->lang("DISPLAY_AT_REGISTER");
                echo $this->env->getExtension('phpbb\template\twig\extension')->lang("COLON");
                echo "</label><br /><span>";
                echo $this->env->getExtension('phpbb\template\twig\extension')->lang("DISPLAY_AT_REGISTER_EXPLAIN");
                echo "</span></dt>
\t\t\t<dd><input type=\"checkbox\" class=\"radio\" id=\"field_show_on_reg\" name=\"field_show_on_reg\" value=\"1\"";
                // line 56
                if ((isset($context["S_SHOW_ON_REG"]) ? $context["S_SHOW_ON_REG"] : null)) {
                    echo " checked=\"checked\"";
                }
                echo " /></dd>
\t\t</dl>
\t\t<dl>
\t\t\t<dt><label for=\"field_show_on_pm\">";
                // line 59
                echo $this->env->getExtension('phpbb\template\twig\extension')->lang("DISPLAY_ON_PM");
                echo $this->env->getExtension('phpbb\template\twig\extension')->lang("COLON");
                echo "</label><br /><span>";
                echo $this->env->getExtension('phpbb\template\twig\extension')->lang("DISPLAY_ON_PM_EXPLAIN");
                echo "</span></dt>
\t\t\t<dd><input type=\"checkbox\" class=\"radio\" id=\"field_show_on_pm\" name=\"field_show_on_pm\" value=\"1\"";
                // line 60
                if ((isset($context["S_SHOW_ON_PM"]) ? $context["S_SHOW_ON_PM"] : null)) {
                    echo " checked=\"checked\"";
                }
                echo " /></dd>
\t\t</dl>
\t\t<dl>
\t\t\t<dt><label for=\"field_show_on_vt\">";
                // line 63
                echo $this->env->getExtension('phpbb\template\twig\extension')->lang("DISPLAY_ON_VT");
                echo $this->env->getExtension('phpbb\template\twig\extension')->lang("COLON");
                echo "</label><br /><span>";
                echo $this->env->getExtension('phpbb\template\twig\extension')->lang("DISPLAY_ON_VT_EXPLAIN");
                echo "</span></dt>
\t\t\t<dd><input type=\"checkbox\" class=\"radio\" id=\"field_show_on_vt\" name=\"field_show_on_vt\" value=\"1\"";
                // line 64
                if ((isset($context["S_SHOW_ON_VT"]) ? $context["S_SHOW_ON_VT"] : null)) {
                    echo " checked=\"checked\"";
                }
                echo " /></dd>
\t\t</dl>
\t\t<dl>
\t\t\t<dt><label for=\"field_show_on_ml\">";
                // line 67
                echo $this->env->getExtension('phpbb\template\twig\extension')->lang("DISPLAY_ON_MEMBERLIST");
                echo $this->env->getExtension('phpbb\template\twig\extension')->lang("COLON");
                echo "</label><br /><span>";
                echo $this->env->getExtension('phpbb\template\twig\extension')->lang("DISPLAY_ON_MEMBERLIST_EXPLAIN");
                echo "</span></dt>
\t\t\t<dd><input type=\"checkbox\" class=\"radio\" id=\"field_show_on_ml\" name=\"field_show_on_ml\" value=\"1\"";
                // line 68
                if ((isset($context["S_SHOW_ON_MEMBERLIST"]) ? $context["S_SHOW_ON_MEMBERLIST"] : null)) {
                    echo " checked=\"checked\"";
                }
                echo " /></dd>
\t\t</dl>
\t\t<dl>
\t\t\t<dt><label for=\"field_required\">";
                // line 71
                echo $this->env->getExtension('phpbb\template\twig\extension')->lang("REQUIRED_FIELD");
                echo $this->env->getExtension('phpbb\template\twig\extension')->lang("COLON");
                echo "</label><br /><span>";
                echo $this->env->getExtension('phpbb\template\twig\extension')->lang("REQUIRED_FIELD_EXPLAIN");
                echo "</span></dt>
\t\t\t<dd><input type=\"checkbox\" class=\"radio\" id=\"field_required\" name=\"field_required\" value=\"1\"";
                // line 72
                if ((isset($context["S_FIELD_REQUIRED"]) ? $context["S_FIELD_REQUIRED"] : null)) {
                    echo " checked=\"checked\"";
                }
                echo " /></dd>
\t\t</dl>
\t\t<dl>
\t\t\t<dt><label for=\"field_show_novalue\">";
                // line 75
                echo $this->env->getExtension('phpbb\template\twig\extension')->lang("SHOW_NOVALUE_FIELD");
                echo $this->env->getExtension('phpbb\template\twig\extension')->lang("COLON");
                echo "</label><br /><span>";
                echo $this->env->getExtension('phpbb\template\twig\extension')->lang("SHOW_NOVALUE_FIELD_EXPLAIN");
                echo "</span></dt>
\t\t\t<dd><input type=\"checkbox\" class=\"radio\" id=\"field_show_novalue\" name=\"field_show_novalue\" value=\"1\"";
                // line 76
                if ((isset($context["S_FIELD_SHOW_NOVALUE"]) ? $context["S_FIELD_SHOW_NOVALUE"] : null)) {
                    echo " checked=\"checked\"";
                }
                echo " /></dd>
\t\t</dl>
\t\t<dl>
\t\t\t<dt><label for=\"field_hide\">";
                // line 79
                echo $this->env->getExtension('phpbb\template\twig\extension')->lang("HIDE_PROFILE_FIELD");
                echo $this->env->getExtension('phpbb\template\twig\extension')->lang("COLON");
                echo "</label><br /><span>";
                echo $this->env->getExtension('phpbb\template\twig\extension')->lang("HIDE_PROFILE_FIELD_EXPLAIN");
                echo "</span></dt>
\t\t\t<dd><input type=\"checkbox\" class=\"radio\" id=\"field_hide\" name=\"field_hide\" value=\"1\"";
                // line 80
                if ((isset($context["S_FIELD_HIDE"]) ? $context["S_FIELD_HIDE"] : null)) {
                    echo " checked=\"checked\"";
                }
                echo " /></dd>
\t\t</dl>
\t\t";
                // line 82
                // line 83
                echo "\t\t<dl>
\t\t\t<dt><label for=\"field_is_contact\">";
                // line 84
                echo $this->env->getExtension('phpbb\template\twig\extension')->lang("FIELD_IS_CONTACT");
                echo $this->env->getExtension('phpbb\template\twig\extension')->lang("COLON");
                echo "</label><br /><span>";
                echo $this->env->getExtension('phpbb\template\twig\extension')->lang("FIELD_IS_CONTACT_EXPLAIN");
                echo "</span></dt>
\t\t\t<dd><input type=\"checkbox\" class=\"radio\" id=\"field_is_contact\" name=\"field_is_contact\" value=\"1\"";
                // line 85
                if ((isset($context["S_FIELD_CONTACT"]) ? $context["S_FIELD_CONTACT"] : null)) {
                    echo " checked=\"checked\"";
                }
                echo " /></dd>
\t\t\t<dd><input class=\"text medium\" type=\"text\" name=\"field_contact_desc\" id=\"field_contact_desc\" value=\"";
                // line 86
                echo (isset($context["FIELD_CONTACT_DESC"]) ? $context["FIELD_CONTACT_DESC"] : null);
                echo "\" /> <label for=\"field_contact_desc\">";
                echo $this->env->getExtension('phpbb\template\twig\extension')->lang("FIELD_CONTACT_DESC");
                echo "</label></dd>
\t\t\t<dd><input class=\"text medium\" type=\"text\" name=\"field_contact_url\" id=\"field_contact_url\" value=\"";
                // line 87
                echo (isset($context["FIELD_CONTACT_URL"]) ? $context["FIELD_CONTACT_URL"] : null);
                echo "\" /> <label for=\"field_contact_url\">";
                echo $this->env->getExtension('phpbb\template\twig\extension')->lang("FIELD_CONTACT_URL");
                echo "</label></dd>
\t\t\t";
                // line 88
                // line 89
                echo "\t\t</dl>
\t\t</fieldset>

\t\t";
                // line 92
                if ((isset($context["S_EDIT_MODE"]) ? $context["S_EDIT_MODE"] : null)) {
                    // line 93
                    echo "\t\t\t<fieldset class=\"quick\">
\t\t\t\t<input class=\"button1\" type=\"submit\" name=\"save\" value=\"";
                    // line 94
                    echo $this->env->getExtension('phpbb\template\twig\extension')->lang("SAVE");
                    echo "\" />
\t\t\t</fieldset>
\t\t";
                }
                // line 97
                echo "
\t\t<fieldset>
\t\t\t<legend>";
                // line 99
                echo $this->env->getExtension('phpbb\template\twig\extension')->lang("LANG_SPECIFIC");
                echo "</legend>
\t\t<dl>
\t\t\t<dt><label for=\"lang_name\">";
                // line 101
                echo $this->env->getExtension('phpbb\template\twig\extension')->lang("USER_FIELD_NAME");
                echo $this->env->getExtension('phpbb\template\twig\extension')->lang("COLON");
                echo "</label></dt>
\t\t\t<dd><input class=\"text medium\" type=\"text\" id=\"lang_name\" name=\"lang_name\" value=\"";
                // line 102
                echo (isset($context["LANG_NAME"]) ? $context["LANG_NAME"] : null);
                echo "\" /></dd>
\t\t</dl>
\t\t<dl>
\t\t\t<dt><label for=\"lang_explain\">";
                // line 105
                echo $this->env->getExtension('phpbb\template\twig\extension')->lang("FIELD_DESCRIPTION");
                echo $this->env->getExtension('phpbb\template\twig\extension')->lang("COLON");
                echo "</label><br /><span>";
                echo $this->env->getExtension('phpbb\template\twig\extension')->lang("FIELD_DESCRIPTION_EXPLAIN");
                echo "</span></dt>
\t\t\t<dd><textarea id=\"lang_explain\" name=\"lang_explain\" rows=\"3\" cols=\"80\">";
                // line 106
                echo (isset($context["LANG_EXPLAIN"]) ? $context["LANG_EXPLAIN"] : null);
                echo "</textarea></dd>
\t\t</dl>
\t\t";
                // line 108
                if (((isset($context["S_TEXT"]) ? $context["S_TEXT"] : null) || (isset($context["S_STRING"]) ? $context["S_STRING"] : null))) {
                    // line 109
                    echo "\t\t\t<dl>
\t\t\t\t<dt><label for=\"lang_default_value\">";
                    // line 110
                    echo $this->env->getExtension('phpbb\template\twig\extension')->lang("DEFAULT_VALUE");
                    echo $this->env->getExtension('phpbb\template\twig\extension')->lang("COLON");
                    echo "</label><br /><span>";
                    echo $this->env->getExtension('phpbb\template\twig\extension')->lang("DEFAULT_VALUE_EXPLAIN");
                    echo "</span></dt>
\t\t\t\t<dd>";
                    // line 111
                    if ((isset($context["S_STRING"]) ? $context["S_STRING"] : null)) {
                        echo "<input class=\"text medium\" type=\"text\" id=\"lang_default_value\" name=\"lang_default_value\" value=\"";
                        echo (isset($context["LANG_DEFAULT_VALUE"]) ? $context["LANG_DEFAULT_VALUE"] : null);
                        echo "\" />";
                    } else {
                        echo "<textarea id=\"lang_default_value\" name=\"lang_default_value\" rows=\"5\" cols=\"80\">";
                        echo (isset($context["LANG_DEFAULT_VALUE"]) ? $context["LANG_DEFAULT_VALUE"] : null);
                        echo "</textarea>";
                    }
                    echo "</dd>
\t\t\t</dl>
\t\t";
                }
                // line 114
                echo "\t\t";
                if (((isset($context["S_BOOL"]) ? $context["S_BOOL"] : null) || (isset($context["S_DROPDOWN"]) ? $context["S_DROPDOWN"] : null))) {
                    // line 115
                    echo "\t\t\t<dl>
\t\t\t\t<dt><label for=\"lang_options\">";
                    // line 116
                    echo $this->env->getExtension('phpbb\template\twig\extension')->lang("ENTRIES");
                    echo $this->env->getExtension('phpbb\template\twig\extension')->lang("COLON");
                    echo "</label>
\t\t\t\t\t";
                    // line 117
                    if (((isset($context["S_EDIT_MODE"]) ? $context["S_EDIT_MODE"] : null) && (isset($context["S_DROPDOWN"]) ? $context["S_DROPDOWN"] : null))) {
                        // line 118
                        echo "\t\t\t\t\t\t<br /><span>";
                        echo $this->env->getExtension('phpbb\template\twig\extension')->lang("EDIT_DROPDOWN_LANG_EXPLAIN");
                        echo "</span>
\t\t\t\t\t";
                    } else {
                        // line 120
                        echo "\t\t\t\t\t\t<br /><span>";
                        echo $this->env->getExtension('phpbb\template\twig\extension')->lang("LANG_OPTIONS_EXPLAIN");
                        echo "</span>
\t\t\t\t\t";
                    }
                    // line 122
                    echo "\t\t\t\t</dt>
\t\t\t";
                    // line 123
                    if ((isset($context["S_DROPDOWN"]) ? $context["S_DROPDOWN"] : null)) {
                        // line 124
                        echo "\t\t\t\t<dd><textarea id=\"lang_options\" name=\"lang_options\" rows=\"5\" cols=\"80\">";
                        echo (isset($context["LANG_OPTIONS"]) ? $context["LANG_OPTIONS"] : null);
                        echo "</textarea></dd>
\t\t\t";
                    } else {
                        // line 126
                        echo "\t\t\t\t<dd><input class=\"medium\" id=\"lang_options\" name=\"lang_options[0]\" value=\"";
                        echo (isset($context["FIRST_LANG_OPTION"]) ? $context["FIRST_LANG_OPTION"] : null);
                        echo "\" /> ";
                        echo $this->env->getExtension('phpbb\template\twig\extension')->lang("FIRST_OPTION");
                        echo "</dd>
\t\t\t\t<dd><input class=\"medium\" name=\"lang_options[1]\" value=\"";
                        // line 127
                        echo (isset($context["SECOND_LANG_OPTION"]) ? $context["SECOND_LANG_OPTION"] : null);
                        echo "\" /> ";
                        echo $this->env->getExtension('phpbb\template\twig\extension')->lang("SECOND_OPTION");
                        echo "</dd>
\t\t\t";
                    }
                    // line 129
                    echo "\t\t\t</dl>
\t\t";
                }
                // line 131
                echo "\t\t";
                // line 132
                echo "\t\t</fieldset>

\t\t<fieldset class=\"quick\">
\t\t\t";
                // line 135
                echo (isset($context["S_HIDDEN_FIELDS"]) ? $context["S_HIDDEN_FIELDS"] : null);
                echo "
\t\t\t";
                // line 136
                echo (isset($context["S_FORM_TOKEN"]) ? $context["S_FORM_TOKEN"] : null);
                echo "
\t\t\t<input class=\"button1\" type=\"submit\" name=\"next\" value=\"";
                // line 137
                echo $this->env->getExtension('phpbb\template\twig\extension')->lang("PROFILE_TYPE_OPTIONS");
                echo "\" />
\t\t</fieldset>

\t";
            } elseif (            // line 140
(isset($context["S_STEP_TWO"]) ? $context["S_STEP_TWO"] : null)) {
                // line 141
                echo "
\t\t<fieldset>
\t\t\t<legend>";
                // line 143
                echo $this->env->getExtension('phpbb\template\twig\extension')->lang("TITLE");
                echo "</legend>
\t\t";
                // line 144
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["loops"]) ? $context["loops"] : null), "option", array()));
                foreach ($context['_seq'] as $context["_key"] => $context["option"]) {
                    // line 145
                    echo "\t\t\t<dl>
\t\t\t\t<dt><label>";
                    // line 146
                    echo $this->getAttribute($context["option"], "TITLE", array());
                    echo $this->env->getExtension('phpbb\template\twig\extension')->lang("COLON");
                    echo "</label>";
                    if ($this->getAttribute($context["option"], "EXPLAIN", array())) {
                        echo "<br /><span>";
                        echo $this->getAttribute($context["option"], "EXPLAIN", array());
                        echo "</span>";
                    }
                    echo "</dt>
\t\t\t\t<dd>";
                    // line 147
                    echo $this->getAttribute($context["option"], "FIELD", array());
                    echo "</dd>
\t\t\t</dl>
\t\t";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['option'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 150
                echo "\t\t</fieldset>

\t\t<fieldset class=\"quick\" style=\"float: ";
                // line 152
                echo (isset($context["S_CONTENT_FLOW_BEGIN"]) ? $context["S_CONTENT_FLOW_BEGIN"] : null);
                echo ";\">
\t\t\t<input class=\"button1\" type=\"submit\" name=\"prev\" value=\"";
                // line 153
                echo $this->env->getExtension('phpbb\template\twig\extension')->lang("PROFILE_BASIC_OPTIONS");
                echo "\" />
\t\t</fieldset>

\t\t<fieldset class=\"quick\" style=\"float: ";
                // line 156
                echo (isset($context["S_CONTENT_FLOW_END"]) ? $context["S_CONTENT_FLOW_END"] : null);
                echo ";\">
\t\t\t";
                // line 157
                echo (isset($context["S_HIDDEN_FIELDS"]) ? $context["S_HIDDEN_FIELDS"] : null);
                echo "
\t\t\t";
                // line 158
                echo (isset($context["S_FORM_TOKEN"]) ? $context["S_FORM_TOKEN"] : null);
                echo "
\t\t\t<input class=\"button1\" type=\"submit\" name=\"next\" value=\"";
                // line 159
                echo $this->env->getExtension('phpbb\template\twig\extension')->lang("NEXT_STEP");
                echo "\" />
\t\t</fieldset>

\t";
            } elseif (            // line 162
(isset($context["S_STEP_THREE"]) ? $context["S_STEP_THREE"] : null)) {
                // line 163
                echo "
\t\t";
                // line 164
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["loops"]) ? $context["loops"] : null), "options", array()));
                foreach ($context['_seq'] as $context["_key"] => $context["options"]) {
                    // line 165
                    echo "\t\t\t<fieldset>
\t\t\t\t<legend>";
                    // line 166
                    echo $this->getAttribute($context["options"], "LANGUAGE", array());
                    echo "</legend>
\t\t\t";
                    // line 167
                    $context['_parent'] = $context;
                    $context['_seq'] = twig_ensure_traversable($this->getAttribute($context["options"], "field", array()));
                    foreach ($context['_seq'] as $context["_key"] => $context["field"]) {
                        // line 168
                        echo "\t\t\t\t<dl>
\t\t\t\t\t<dt><label>";
                        // line 169
                        echo $this->getAttribute($context["field"], "L_TITLE", array());
                        echo $this->env->getExtension('phpbb\template\twig\extension')->lang("COLON");
                        echo "</label>";
                        if ($this->getAttribute($context["field"], "L_EXPLAIN", array())) {
                            echo "<br /><span>";
                            echo $this->getAttribute($context["field"], "L_EXPLAIN", array());
                            echo "</span>";
                        }
                        echo "</dt>
\t\t\t\t\t";
                        // line 170
                        echo $this->getAttribute($context["field"], "FIELD", array());
                        echo "
\t\t\t\t</dl>
\t\t\t";
                    }
                    $_parent = $context['_parent'];
                    unset($context['_seq'], $context['_iterated'], $context['_key'], $context['field'], $context['_parent'], $context['loop']);
                    $context = array_intersect_key($context, $_parent) + $_parent;
                    // line 173
                    echo "\t\t\t</fieldset>
\t\t";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['options'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 175
                echo "
\t\t<fieldset class=\"quick\" style=\"float: ";
                // line 176
                echo (isset($context["S_CONTENT_FLOW_BEGIN"]) ? $context["S_CONTENT_FLOW_BEGIN"] : null);
                echo ";\">
\t\t\t<input class=\"button1\" type=\"submit\" name=\"prev\" value=\"";
                // line 177
                echo $this->env->getExtension('phpbb\template\twig\extension')->lang("PROFILE_TYPE_OPTIONS");
                echo "\" />
\t\t</fieldset>

\t\t<fieldset class=\"quick\" style=\"float: ";
                // line 180
                echo (isset($context["S_CONTENT_FLOW_END"]) ? $context["S_CONTENT_FLOW_END"] : null);
                echo ";\">
\t\t\t";
                // line 181
                echo (isset($context["S_HIDDEN_FIELDS"]) ? $context["S_HIDDEN_FIELDS"] : null);
                echo "
\t\t\t<input class=\"button1\" type=\"submit\" name=\"save\" value=\"";
                // line 182
                echo $this->env->getExtension('phpbb\template\twig\extension')->lang("SAVE");
                echo "\" />
\t\t\t";
                // line 183
                echo (isset($context["S_FORM_TOKEN"]) ? $context["S_FORM_TOKEN"] : null);
                echo "
\t\t</fieldset>

\t";
            }
            // line 187
            echo "
\t</form>

";
        } else {
            // line 191
            echo "
\t<h1>";
            // line 192
            echo $this->env->getExtension('phpbb\template\twig\extension')->lang("ACP_CUSTOM_PROFILE_FIELDS");
            echo "</h1>

\t";
            // line 194
            if ((isset($context["S_NEED_EDIT"]) ? $context["S_NEED_EDIT"] : null)) {
                // line 195
                echo "\t\t<div class=\"errorbox\">
\t\t\t<h3>";
                // line 196
                echo $this->env->getExtension('phpbb\template\twig\extension')->lang("WARNING");
                echo "</h3>
\t\t\t<p>";
                // line 197
                echo $this->env->getExtension('phpbb\template\twig\extension')->lang("CUSTOM_FIELDS_NOT_TRANSLATED");
                echo "</p>
\t\t</div>
\t";
            }
            // line 200
            echo "
\t<table class=\"table1 zebra-table\">
\t<thead>
\t<tr>
\t\t<th>";
            // line 204
            echo $this->env->getExtension('phpbb\template\twig\extension')->lang("FIELD_IDENT");
            echo "</th>
\t\t<th>";
            // line 205
            echo $this->env->getExtension('phpbb\template\twig\extension')->lang("FIELD_TYPE");
            echo "</th>
\t\t<th colspan=\"2\">";
            // line 206
            echo $this->env->getExtension('phpbb\template\twig\extension')->lang("OPTIONS");
            echo "</th>
\t</tr>
\t</thead>
\t<tbody>
\t";
            // line 210
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["loops"]) ? $context["loops"] : null), "fields", array()));
            $context['_iterated'] = false;
            foreach ($context['_seq'] as $context["_key"] => $context["fields"]) {
                // line 211
                echo "\t<tr>
\t\t<td>";
                // line 212
                echo $this->getAttribute($context["fields"], "FIELD_IDENT", array());
                echo "</td>
\t\t<td>";
                // line 213
                echo $this->getAttribute($context["fields"], "FIELD_TYPE", array());
                echo "</td>
\t\t<td style=\"text-align: center;\"><a href=\"";
                // line 214
                echo $this->getAttribute($context["fields"], "U_ACTIVATE_DEACTIVATE", array());
                echo "\" data-ajax=\"activate_deactivate\">";
                echo $this->getAttribute($context["fields"], "L_ACTIVATE_DEACTIVATE", array());
                echo "</a>";
                if ($this->getAttribute($context["fields"], "S_NEED_EDIT", array())) {
                    echo " | <a href=\"";
                    echo $this->getAttribute($context["fields"], "U_TRANSLATE", array());
                    echo "\" style=\"color: red;\">";
                    echo $this->env->getExtension('phpbb\template\twig\extension')->lang("TRANSLATE");
                    echo "</a>";
                }
                echo "</td>

\t\t<td class=\"actions\" style=\"width: 80px;\">
\t\t\t<span class=\"up-disabled\" style=\"display:none;\">";
                // line 217
                echo (isset($context["ICON_MOVE_UP_DISABLED"]) ? $context["ICON_MOVE_UP_DISABLED"] : null);
                echo "</span>
\t\t\t<span class=\"up\"><a href=\"";
                // line 218
                echo $this->getAttribute($context["fields"], "U_MOVE_UP", array());
                echo "\" data-ajax=\"row_up\">";
                echo (isset($context["ICON_MOVE_UP"]) ? $context["ICON_MOVE_UP"] : null);
                echo "</a></span>
\t\t\t<span class=\"down-disabled\" style=\"display:none;\">";
                // line 219
                echo (isset($context["ICON_MOVE_DOWN_DISABLED"]) ? $context["ICON_MOVE_DOWN_DISABLED"] : null);
                echo "</span>
\t\t\t<span class=\"down\"><a href=\"";
                // line 220
                echo $this->getAttribute($context["fields"], "U_MOVE_DOWN", array());
                echo "\" data-ajax=\"row_down\">";
                echo (isset($context["ICON_MOVE_DOWN"]) ? $context["ICON_MOVE_DOWN"] : null);
                echo "</a></span>
\t\t\t";
                // line 221
                if ( !$this->getAttribute($context["fields"], "S_NEED_EDIT", array())) {
                    // line 222
                    echo "\t\t\t\t<a href=\"";
                    echo $this->getAttribute($context["fields"], "U_EDIT", array());
                    echo "\">";
                    echo (isset($context["ICON_EDIT"]) ? $context["ICON_EDIT"] : null);
                    echo "</a>
\t\t\t";
                } else {
                    // line 224
                    echo "\t\t\t\t";
                    echo (isset($context["ICON_EDIT_DISABLED"]) ? $context["ICON_EDIT_DISABLED"] : null);
                    echo "
\t\t\t";
                }
                // line 226
                echo "\t\t\t<a href=\"";
                echo $this->getAttribute($context["fields"], "U_DELETE", array());
                echo "\" data-ajax=\"row_delete\">";
                echo (isset($context["ICON_DELETE"]) ? $context["ICON_DELETE"] : null);
                echo "</a>
\t\t</td>

\t</tr>
\t";
                $context['_iterated'] = true;
            }
            if (!$context['_iterated']) {
                // line 231
                echo "\t<tr class=\"row3\">
\t\t<td colspan=\"4\">";
                // line 232
                echo $this->env->getExtension('phpbb\template\twig\extension')->lang("ACP_NO_ITEMS");
                echo "</td>
\t</tr>
\t";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['fields'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 235
            echo "\t</tbody>
\t</table>

\t<form id=\"profile_fields\" method=\"post\" action=\"";
            // line 238
            echo (isset($context["U_ACTION"]) ? $context["U_ACTION"] : null);
            echo "\">

\t<fieldset class=\"quick\">
\t\t<input class=\"text small\" type=\"text\" name=\"field_ident\" /> <select name=\"field_type\">";
            // line 241
            echo (isset($context["S_TYPE_OPTIONS"]) ? $context["S_TYPE_OPTIONS"] : null);
            echo "</select>
\t\t<input class=\"button1\" type=\"submit\" name=\"submit\" value=\"";
            // line 242
            echo $this->env->getExtension('phpbb\template\twig\extension')->lang("CREATE_NEW_FIELD");
            echo "\" />
\t\t<input type=\"hidden\" name=\"create\" value=\"1\" />
\t\t";
            // line 244
            echo (isset($context["S_FORM_TOKEN"]) ? $context["S_FORM_TOKEN"] : null);
            echo "
\t</fieldset>
\t</form>

";
        }
        // line 249
        echo "
";
        // line 250
        $location = "overall_footer.html";
        $namespace = false;
        if (strpos($location, '@') === 0) {
            $namespace = substr($location, 1, strpos($location, '/') - 1);
            $previous_look_up_order = $this->env->getNamespaceLookUpOrder();
            $this->env->setNamespaceLookUpOrder(array($namespace, '__main__'));
        }
        $this->loadTemplate("overall_footer.html", "acp_profile.html", 250)->display($context);
        if ($namespace) {
            $this->env->setNamespaceLookUpOrder($previous_look_up_order);
        }
    }

    public function getTemplateName()
    {
        return "acp_profile.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  802 => 250,  799 => 249,  791 => 244,  786 => 242,  782 => 241,  776 => 238,  771 => 235,  762 => 232,  759 => 231,  746 => 226,  740 => 224,  732 => 222,  730 => 221,  724 => 220,  720 => 219,  714 => 218,  710 => 217,  694 => 214,  690 => 213,  686 => 212,  683 => 211,  678 => 210,  671 => 206,  667 => 205,  663 => 204,  657 => 200,  651 => 197,  647 => 196,  644 => 195,  642 => 194,  637 => 192,  634 => 191,  628 => 187,  621 => 183,  617 => 182,  613 => 181,  609 => 180,  603 => 177,  599 => 176,  596 => 175,  589 => 173,  580 => 170,  569 => 169,  566 => 168,  562 => 167,  558 => 166,  555 => 165,  551 => 164,  548 => 163,  546 => 162,  540 => 159,  536 => 158,  532 => 157,  528 => 156,  522 => 153,  518 => 152,  514 => 150,  505 => 147,  494 => 146,  491 => 145,  487 => 144,  483 => 143,  479 => 141,  477 => 140,  471 => 137,  467 => 136,  463 => 135,  458 => 132,  456 => 131,  452 => 129,  445 => 127,  438 => 126,  432 => 124,  430 => 123,  427 => 122,  421 => 120,  415 => 118,  413 => 117,  408 => 116,  405 => 115,  402 => 114,  388 => 111,  381 => 110,  378 => 109,  376 => 108,  371 => 106,  364 => 105,  358 => 102,  353 => 101,  348 => 99,  344 => 97,  338 => 94,  335 => 93,  333 => 92,  328 => 89,  327 => 88,  321 => 87,  315 => 86,  309 => 85,  302 => 84,  299 => 83,  298 => 82,  291 => 80,  284 => 79,  276 => 76,  269 => 75,  261 => 72,  254 => 71,  246 => 68,  239 => 67,  231 => 64,  224 => 63,  216 => 60,  209 => 59,  201 => 56,  194 => 55,  186 => 52,  179 => 51,  174 => 49,  162 => 44,  154 => 43,  147 => 42,  144 => 41,  138 => 38,  131 => 37,  128 => 36,  120 => 33,  113 => 32,  110 => 31,  108 => 30,  103 => 28,  96 => 27,  91 => 25,  87 => 23,  85 => 22,  78 => 20,  75 => 19,  69 => 16,  65 => 15,  62 => 14,  60 => 13,  55 => 11,  50 => 9,  41 => 7,  38 => 6,  36 => 5,  31 => 2,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "acp_profile.html", "");
    }
}
