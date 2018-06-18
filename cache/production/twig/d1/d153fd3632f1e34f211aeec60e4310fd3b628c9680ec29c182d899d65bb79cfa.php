<?php

/* ucp_attachments.html */
class __TwigTemplate_53c9c03449371232577aa886b3f1faa9b6d675db86164ea79f13a59da840de7f extends Twig_Template
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
        $this->loadTemplate("ucp_header.html", "ucp_attachments.html", 1)->display($context);
        if ($namespace) {
            $this->env->setNamespaceLookUpOrder($previous_look_up_order);
        }
        // line 2
        echo "
<form id=\"ucp\" method=\"post\" action=\"";
        // line 3
        echo (isset($context["S_UCP_ACTION"]) ? $context["S_UCP_ACTION"] : null);
        echo "\"";
        echo (isset($context["S_FORM_ENCTYPE"]) ? $context["S_FORM_ENCTYPE"] : null);
        echo ">

<h2>";
        // line 5
        echo $this->env->getExtension('phpbb\template\twig\extension')->lang("TITLE");
        echo "</h2>

<div class=\"panel\">
\t<div class=\"inner\">

\t<p>";
        // line 10
        echo $this->env->getExtension('phpbb\template\twig\extension')->lang("ATTACHMENTS_EXPLAIN");
        echo "</p>

\t";
        // line 12
        if (twig_length_filter($this->env, $this->getAttribute((isset($context["loops"]) ? $context["loops"] : null), "attachrow", array()))) {
            // line 13
            echo "\t\t<div class=\"action-bar top\">
\t\t\t<div class=\"pagination\">
\t\t\t\t";
            // line 15
            echo (isset($context["NUM_ATTACHMENTS"]) ? $context["NUM_ATTACHMENTS"] : null);
            echo "
\t\t\t\t";
            // line 16
            if (twig_length_filter($this->env, $this->getAttribute((isset($context["loops"]) ? $context["loops"] : null), "pagination", array()))) {
                // line 17
                echo "\t\t\t\t\t";
                $location = "pagination.html";
                $namespace = false;
                if (strpos($location, '@') === 0) {
                    $namespace = substr($location, 1, strpos($location, '/') - 1);
                    $previous_look_up_order = $this->env->getNamespaceLookUpOrder();
                    $this->env->setNamespaceLookUpOrder(array($namespace, '__main__'));
                }
                $this->loadTemplate("pagination.html", "ucp_attachments.html", 17)->display($context);
                if ($namespace) {
                    $this->env->setNamespaceLookUpOrder($previous_look_up_order);
                }
                // line 18
                echo "\t\t\t\t";
            } else {
                // line 19
                echo "\t\t\t\t\t &bull; ";
                echo (isset($context["PAGE_NUMBER"]) ? $context["PAGE_NUMBER"] : null);
                echo "
\t\t\t\t";
            }
            // line 21
            echo "\t\t\t</div>
\t\t</div>

\t\t<ul class=\"topiclist\">
\t\t\t<li class=\"header\">
\t\t\t\t<dl>
\t\t\t\t\t<dt><div class=\"list-inner\"><a href=\"";
            // line 27
            echo (isset($context["U_SORT_FILENAME"]) ? $context["U_SORT_FILENAME"] : null);
            echo "\">";
            echo $this->env->getExtension('phpbb\template\twig\extension')->lang("FILENAME");
            echo "</a></div></dt>
\t\t\t\t\t<dd class=\"extra\"><a href=\"";
            // line 28
            echo (isset($context["U_SORT_DOWNLOADS"]) ? $context["U_SORT_DOWNLOADS"] : null);
            echo "\">";
            echo $this->env->getExtension('phpbb\template\twig\extension')->lang("DOWNLOADS");
            echo "</a></dd>
\t\t\t\t\t<dd class=\"time\"><span><a href=\"";
            // line 29
            echo (isset($context["U_SORT_POST_TIME"]) ? $context["U_SORT_POST_TIME"] : null);
            echo "\">";
            echo $this->env->getExtension('phpbb\template\twig\extension')->lang("POST_TIME");
            echo "</a></span></dd>
\t\t\t\t\t<dd class=\"mark\">";
            // line 30
            echo $this->env->getExtension('phpbb\template\twig\extension')->lang("MARK");
            echo "</dd>
\t\t\t\t</dl>
\t\t\t</li>
\t\t</ul>
\t\t<ul class=\"topiclist cplist responsive-show-columns\">

\t\t";
            // line 36
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["loops"]) ? $context["loops"] : null), "attachrow", array()));
            foreach ($context['_seq'] as $context["_key"] => $context["attachrow"]) {
                // line 37
                echo "\t\t<li class=\"row";
                if (($this->getAttribute($context["attachrow"], "S_ROW_COUNT", array()) % 2 == 1)) {
                    echo " bg1";
                } else {
                    echo " bg2";
                }
                echo "\">
\t\t\t<dl>
\t\t\t\t<dt>
\t\t\t\t\t<div class=\"list-inner\">
\t\t\t\t\t\t<a href=\"";
                // line 41
                echo $this->getAttribute($context["attachrow"], "U_VIEW_ATTACHMENT", array());
                echo "\" class=\"topictitle attachment-filename ellipsis-text\" title=\"";
                echo $this->getAttribute($context["attachrow"], "FILENAME", array());
                echo "\">";
                echo $this->getAttribute($context["attachrow"], "FILENAME", array());
                echo "</a> (";
                echo $this->getAttribute($context["attachrow"], "SIZE", array());
                echo ")<br />
\t\t\t\t\t\t";
                // line 42
                if ($this->getAttribute($context["attachrow"], "S_IN_MESSAGE", array())) {
                    echo $this->env->getExtension('phpbb\template\twig\extension')->lang("PM");
                    echo $this->env->getExtension('phpbb\template\twig\extension')->lang("COLON");
                    echo " ";
                } else {
                    echo $this->env->getExtension('phpbb\template\twig\extension')->lang("TOPIC");
                    echo $this->env->getExtension('phpbb\template\twig\extension')->lang("COLON");
                    echo " ";
                }
                echo "<a href=\"";
                echo $this->getAttribute($context["attachrow"], "U_VIEW_TOPIC", array());
                echo "\">";
                echo $this->getAttribute($context["attachrow"], "TOPIC_TITLE", array());
                echo "</a>
\t\t\t\t\t</div>
\t\t\t\t</dt>
\t\t\t\t<dd class=\"extra\">";
                // line 45
                echo $this->getAttribute($context["attachrow"], "DOWNLOAD_COUNT", array());
                echo "</dd>
\t\t\t\t<dd class=\"time\"><span>";
                // line 46
                echo $this->getAttribute($context["attachrow"], "POST_TIME", array());
                echo "</span></dd>
\t\t\t\t<dd class=\"mark\"><input type=\"checkbox\" name=\"attachment[";
                // line 47
                echo $this->getAttribute($context["attachrow"], "ATTACH_ID", array());
                echo "]\" value=\"1\" /></dd>
\t\t\t</dl>
\t\t</li>
\t\t";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['attachrow'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 51
            echo "\t\t</ul>

\t\t<div class=\"action-bar bottom\">
\t\t\t";
            // line 54
            $location = "display_options.html";
            $namespace = false;
            if (strpos($location, '@') === 0) {
                $namespace = substr($location, 1, strpos($location, '/') - 1);
                $previous_look_up_order = $this->env->getNamespaceLookUpOrder();
                $this->env->setNamespaceLookUpOrder(array($namespace, '__main__'));
            }
            $this->loadTemplate("display_options.html", "ucp_attachments.html", 54)->display($context);
            if ($namespace) {
                $this->env->setNamespaceLookUpOrder($previous_look_up_order);
            }
            // line 55
            echo "\t\t\t";
            echo (isset($context["S_FORM_TOKEN"]) ? $context["S_FORM_TOKEN"] : null);
            echo "

\t\t\t<div class=\"pagination\">
\t\t\t\t";
            // line 58
            echo (isset($context["TOTAL_ATTACHMENTS"]) ? $context["TOTAL_ATTACHMENTS"] : null);
            echo " ";
            echo $this->env->getExtension('phpbb\template\twig\extension')->lang("TITLE");
            echo "
\t\t\t\t";
            // line 59
            if (twig_length_filter($this->env, $this->getAttribute((isset($context["loops"]) ? $context["loops"] : null), "pagination", array()))) {
                // line 60
                echo "\t\t\t\t\t";
                $location = "pagination.html";
                $namespace = false;
                if (strpos($location, '@') === 0) {
                    $namespace = substr($location, 1, strpos($location, '/') - 1);
                    $previous_look_up_order = $this->env->getNamespaceLookUpOrder();
                    $this->env->setNamespaceLookUpOrder(array($namespace, '__main__'));
                }
                $this->loadTemplate("pagination.html", "ucp_attachments.html", 60)->display($context);
                if ($namespace) {
                    $this->env->setNamespaceLookUpOrder($previous_look_up_order);
                }
                // line 61
                echo "\t\t\t\t";
            } else {
                // line 62
                echo "\t\t\t\t\t &bull; ";
                echo (isset($context["PAGE_NUMBER"]) ? $context["PAGE_NUMBER"] : null);
                echo "
\t\t\t\t";
            }
            // line 64
            echo "\t\t\t</div>
\t\t</div>

\t";
        } else {
            // line 68
            echo "\t\t<p><strong>";
            echo $this->env->getExtension('phpbb\template\twig\extension')->lang("UCP_NO_ATTACHMENTS");
            echo "</strong></p>
\t";
        }
        // line 70
        echo "
\t</div>
</div>

";
        // line 74
        if ((isset($context["S_ATTACHMENT_ROWS"]) ? $context["S_ATTACHMENT_ROWS"] : null)) {
            // line 75
            echo "\t<fieldset class=\"display-actions\">
\t\t<input class=\"button2\" type=\"submit\" name=\"delete\" value=\"";
            // line 76
            echo $this->env->getExtension('phpbb\template\twig\extension')->lang("DELETE_MARKED");
            echo "\" />
\t\t<div><a href=\"#\" onclick=\"marklist('ucp', 'attachment', true); return false;\">";
            // line 77
            echo $this->env->getExtension('phpbb\template\twig\extension')->lang("MARK_ALL");
            echo "</a> &bull; <a href=\"#\" onclick=\"marklist('ucp', 'attachment', false); return false;\">";
            echo $this->env->getExtension('phpbb\template\twig\extension')->lang("UNMARK_ALL");
            echo "</a></div>
\t\t";
            // line 78
            echo (isset($context["S_FORM_TOKEN"]) ? $context["S_FORM_TOKEN"] : null);
            echo "
\t</fieldset>
";
        }
        // line 81
        echo "</form>

";
        // line 83
        $location = "ucp_footer.html";
        $namespace = false;
        if (strpos($location, '@') === 0) {
            $namespace = substr($location, 1, strpos($location, '/') - 1);
            $previous_look_up_order = $this->env->getNamespaceLookUpOrder();
            $this->env->setNamespaceLookUpOrder(array($namespace, '__main__'));
        }
        $this->loadTemplate("ucp_footer.html", "ucp_attachments.html", 83)->display($context);
        if ($namespace) {
            $this->env->setNamespaceLookUpOrder($previous_look_up_order);
        }
    }

    public function getTemplateName()
    {
        return "ucp_attachments.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  282 => 83,  278 => 81,  272 => 78,  266 => 77,  262 => 76,  259 => 75,  257 => 74,  251 => 70,  245 => 68,  239 => 64,  233 => 62,  230 => 61,  217 => 60,  215 => 59,  209 => 58,  202 => 55,  190 => 54,  185 => 51,  175 => 47,  171 => 46,  167 => 45,  149 => 42,  139 => 41,  127 => 37,  123 => 36,  114 => 30,  108 => 29,  102 => 28,  96 => 27,  88 => 21,  82 => 19,  79 => 18,  66 => 17,  64 => 16,  60 => 15,  56 => 13,  54 => 12,  49 => 10,  41 => 5,  34 => 3,  31 => 2,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "ucp_attachments.html", "");
    }
}
