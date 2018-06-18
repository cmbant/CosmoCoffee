<?php

/* profile_send_email.txt */
class __TwigTemplate_40a7f11acca02bc76a893b11e1756043ef7d4a1cd1d04f30f24ef6ef0ba96729 extends Twig_Template
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
        echo "
Hello ";
        // line 2
        echo (isset($context["TO_USERNAME"]) ? $context["TO_USERNAME"] : null);
        echo ",

The following is an email sent to you by ";
        // line 4
        echo (isset($context["FROM_USERNAME"]) ? $context["FROM_USERNAME"] : null);
        echo " via your account on \"";
        echo (isset($context["SITENAME"]) ? $context["SITENAME"] : null);
        echo "\". If this message is spam, contains abusive or other comments you find offensive please contact the webmaster of the board at the following address:

";
        // line 6
        echo (isset($context["BOARD_CONTACT"]) ? $context["BOARD_CONTACT"] : null);
        echo "

Include this full email (particularly the headers). Please note that the reply address to this email has been set to that of ";
        // line 8
        echo (isset($context["FROM_USERNAME"]) ? $context["FROM_USERNAME"] : null);
        echo ".

Message sent to you follows
~~~~~~~~~~~~~~~~~~~~~~~~~~~

";
        // line 13
        echo (isset($context["MESSAGE"]) ? $context["MESSAGE"] : null);
        echo "
";
    }

    public function getTemplateName()
    {
        return "profile_send_email.txt";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  47 => 13,  39 => 8,  34 => 6,  27 => 4,  22 => 2,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "profile_send_email.txt", "");
    }
}
