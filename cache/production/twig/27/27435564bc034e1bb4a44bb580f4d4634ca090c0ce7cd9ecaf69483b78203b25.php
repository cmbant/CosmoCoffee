<?php

/* acp_prune_users.html */
class __TwigTemplate_c3fc9296238146d3e2a6a1f8ea7b267cd9d5e8f48975b3cbdccb2a2b78b1c76b extends Twig_Template
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
        $this->loadTemplate("overall_header.html", "acp_prune_users.html", 1)->display($context);
        if ($namespace) {
            $this->env->setNamespaceLookUpOrder($previous_look_up_order);
        }
        // line 2
        echo "
<a id=\"maincontent\"></a>

<h1>";
        // line 5
        echo $this->env->getExtension('phpbb\template\twig\extension')->lang("ACP_PRUNE_USERS");
        echo "</h1>

<p>";
        // line 7
        echo $this->env->getExtension('phpbb\template\twig\extension')->lang("ACP_PRUNE_USERS_EXPLAIN");
        echo "</p>

<form id=\"acp_prune\" method=\"post\" action=\"";
        // line 9
        echo (isset($context["U_ACTION"]) ? $context["U_ACTION"] : null);
        echo "\">
\t
<fieldset>
\t<legend>";
        // line 12
        echo $this->env->getExtension('phpbb\template\twig\extension')->lang("CRITERIA");
        echo "</legend>
<dl>
\t<dt><label for=\"username\">";
        // line 14
        echo $this->env->getExtension('phpbb\template\twig\extension')->lang("USERNAME");
        echo $this->env->getExtension('phpbb\template\twig\extension')->lang("COLON");
        echo "</label></dt>
\t<dd><input type=\"text\" id=\"username\" name=\"username\" /></dd>
</dl>
<dl>
\t<dt><label for=\"email\">";
        // line 18
        echo $this->env->getExtension('phpbb\template\twig\extension')->lang("EMAIL");
        echo $this->env->getExtension('phpbb\template\twig\extension')->lang("COLON");
        echo "</label></dt>
\t<dd><input type=\"text\" id=\"email\" name=\"email\" /></dd>
</dl>
<dl>
\t<dt><label for=\"joined_after\">";
        // line 22
        echo $this->env->getExtension('phpbb\template\twig\extension')->lang("JOINED");
        echo $this->env->getExtension('phpbb\template\twig\extension')->lang("COLON");
        echo "</label><br /><span>";
        echo $this->env->getExtension('phpbb\template\twig\extension')->lang("JOINED_EXPLAIN");
        echo "</span></dt>
\t<dd>
\t\t<strong>";
        // line 24
        echo $this->env->getExtension('phpbb\template\twig\extension')->lang("AFTER");
        echo "</strong> <input type=\"text\" id=\"joined_after\" name=\"joined_after\" />
\t\t<br /> <br /> <strong>";
        // line 25
        echo $this->env->getExtension('phpbb\template\twig\extension')->lang("BEFORE");
        echo "</strong> <input type=\"text\" id=\"joined_before\" name=\"joined_before\" />
\t</dd>
</dl>
<dl>
\t<dt><label for=\"active\">";
        // line 29
        echo $this->env->getExtension('phpbb\template\twig\extension')->lang("LAST_ACTIVE");
        echo $this->env->getExtension('phpbb\template\twig\extension')->lang("COLON");
        echo "</label><br /><span>";
        echo $this->env->getExtension('phpbb\template\twig\extension')->lang("LAST_ACTIVE_EXPLAIN");
        echo "</span></dt>
\t<dd><select name=\"active_select\">";
        // line 30
        echo (isset($context["S_ACTIVE_OPTIONS"]) ? $context["S_ACTIVE_OPTIONS"] : null);
        echo "</select> <input type=\"text\" id=\"active\" name=\"active\" /></dd>
</dl>
<dl>
\t<dt><label for=\"count\">";
        // line 33
        echo $this->env->getExtension('phpbb\template\twig\extension')->lang("POSTS");
        echo $this->env->getExtension('phpbb\template\twig\extension')->lang("COLON");
        echo "</label></dt>
\t<dd><select name=\"count_select\">";
        // line 34
        echo (isset($context["S_COUNT_OPTIONS"]) ? $context["S_COUNT_OPTIONS"] : null);
        echo "</select> <input type=\"number\" id=\"count\" name=\"count\" /></dd>
</dl>
<dl>
\t<dt><label for=\"posts_on_queue\">";
        // line 37
        echo $this->env->getExtension('phpbb\template\twig\extension')->lang("POSTS_ON_QUEUE");
        echo $this->env->getExtension('phpbb\template\twig\extension')->lang("COLON");
        echo "</label></dt>
\t<dd><select name=\"queue_select\">";
        // line 38
        echo (isset($context["S_COUNT_OPTIONS"]) ? $context["S_COUNT_OPTIONS"] : null);
        echo "</select> <input type=\"number\" id=\"posts_on_queue\" name=\"posts_on_queue\" /></dd>
</dl>
";
        // line 40
        if ((isset($context["S_GROUP_LIST"]) ? $context["S_GROUP_LIST"] : null)) {
            // line 41
            echo "<dl>
\t<dt><label for=\"group_id\">";
            // line 42
            echo $this->env->getExtension('phpbb\template\twig\extension')->lang("GROUP");
            echo $this->env->getExtension('phpbb\template\twig\extension')->lang("COLON");
            echo "</label><br /><span>";
            echo $this->env->getExtension('phpbb\template\twig\extension')->lang("PRUNE_USERS_GROUP_EXPLAIN");
            echo "</span></dt>
\t<dd><select id=\"group_id\" name=\"group_id\">";
            // line 43
            echo (isset($context["S_GROUP_LIST"]) ? $context["S_GROUP_LIST"] : null);
            echo "</select></dd>
</dl>
";
        }
        // line 46
        echo "</fieldset>

<fieldset>
\t<legend>";
        // line 49
        echo $this->env->getExtension('phpbb\template\twig\extension')->lang("USERNAMES");
        echo "</legend>
<dl>
\t<dt><label for=\"users\">";
        // line 51
        echo $this->env->getExtension('phpbb\template\twig\extension')->lang("ACP_PRUNE_USERS");
        echo $this->env->getExtension('phpbb\template\twig\extension')->lang("COLON");
        echo "</label><br /><span>";
        echo $this->env->getExtension('phpbb\template\twig\extension')->lang("SELECT_USERS_EXPLAIN");
        echo "</span></dt>
\t<dd><textarea id=\"users\" name=\"users\" cols=\"40\" rows=\"5\"></textarea></dd>
\t<dd>";
        // line 53
        echo "[ <a href=\"";
        echo (isset($context["U_FIND_USERNAME"]) ? $context["U_FIND_USERNAME"] : null);
        echo "\" onclick=\"find_username(this.href); return false;\">";
        echo $this->env->getExtension('phpbb\template\twig\extension')->lang("FIND_USERNAME");
        echo "</a> ]";
        echo "</dd>
</dl>
</fieldset>

<fieldset>
\t<legend>";
        // line 58
        echo $this->env->getExtension('phpbb\template\twig\extension')->lang("OPTIONS");
        echo "</legend>
<dl>
\t<dt><label for=\"deleteposts\">";
        // line 60
        echo $this->env->getExtension('phpbb\template\twig\extension')->lang("DELETE_USER_POSTS");
        echo $this->env->getExtension('phpbb\template\twig\extension')->lang("COLON");
        echo "</label><br /><span>";
        echo $this->env->getExtension('phpbb\template\twig\extension')->lang("DELETE_USER_POSTS_EXPLAIN");
        echo "</span></dt>
\t<dd><label><input type=\"radio\" class=\"radio\" name=\"deleteposts\" value=\"1\" /> ";
        // line 61
        echo $this->env->getExtension('phpbb\template\twig\extension')->lang("YES");
        echo "</label>
\t\t<label><input type=\"radio\" class=\"radio\" id=\"deleteposts\" name=\"deleteposts\" value=\"0\" checked=\"checked\" /> ";
        // line 62
        echo $this->env->getExtension('phpbb\template\twig\extension')->lang("NO");
        echo "</label></dd>
</dl>
<dl>
\t<dt><label for=\"deactivate\">";
        // line 65
        echo $this->env->getExtension('phpbb\template\twig\extension')->lang("DEACTIVATE_DELETE");
        echo $this->env->getExtension('phpbb\template\twig\extension')->lang("COLON");
        echo "</label><br /><span>";
        echo $this->env->getExtension('phpbb\template\twig\extension')->lang("DEACTIVATE_DELETE_EXPLAIN");
        echo "</span></dt>
\t<dd><label><input type=\"radio\" class=\"radio\" name=\"action\" value=\"delete\" /> ";
        // line 66
        echo $this->env->getExtension('phpbb\template\twig\extension')->lang("DELETE_USERS");
        echo "</label>
\t\t<label><input type=\"radio\" class=\"radio\" id=\"deactivate\" name=\"action\" value=\"deactivate\" checked=\"checked\" /> ";
        // line 67
        echo $this->env->getExtension('phpbb\template\twig\extension')->lang("DEACTIVATE");
        echo "</label></dd>
</dl>

<p class=\"submit-buttons\">
\t<input type=\"hidden\" name=\"prune\" value=\"1\" />

\t<input class=\"button1\" type=\"submit\" id=\"update\" name=\"update\" value=\"";
        // line 73
        echo $this->env->getExtension('phpbb\template\twig\extension')->lang("SUBMIT");
        echo "\" />&nbsp;
\t<input class=\"button2\" type=\"reset\" id=\"reset\" name=\"reset\" value=\"";
        // line 74
        echo $this->env->getExtension('phpbb\template\twig\extension')->lang("RESET");
        echo "\" />
\t";
        // line 75
        echo (isset($context["S_FORM_TOKEN"]) ? $context["S_FORM_TOKEN"] : null);
        echo "
</p>
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
        $this->loadTemplate("overall_footer.html", "acp_prune_users.html", 80)->display($context);
        if ($namespace) {
            $this->env->setNamespaceLookUpOrder($previous_look_up_order);
        }
    }

    public function getTemplateName()
    {
        return "acp_prune_users.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  232 => 80,  224 => 75,  220 => 74,  216 => 73,  207 => 67,  203 => 66,  196 => 65,  190 => 62,  186 => 61,  179 => 60,  174 => 58,  162 => 53,  154 => 51,  149 => 49,  144 => 46,  138 => 43,  131 => 42,  128 => 41,  126 => 40,  121 => 38,  116 => 37,  110 => 34,  105 => 33,  99 => 30,  92 => 29,  85 => 25,  81 => 24,  73 => 22,  65 => 18,  57 => 14,  52 => 12,  46 => 9,  41 => 7,  36 => 5,  31 => 2,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "acp_prune_users.html", "");
    }
}
