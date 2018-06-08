<?php

/* memberlist_view.html */
class __TwigTemplate_2e7b5071479b77454f22e9cd1a746ae6d398d3818aa2d887e34463b4e65d126f extends Twig_Template
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
        $this->loadTemplate("overall_header.html", "memberlist_view.html", 1)->display($context);
        if ($namespace) {
            $this->env->setNamespaceLookUpOrder($previous_look_up_order);
        }
        // line 2
        echo "
<h2 class=\"memberlist-title\">";
        // line 3
        echo (isset($context["PAGE_TITLE"]) ? $context["PAGE_TITLE"] : null);
        echo "</h2>

";
        // line 5
        // line 6
        echo "

<div class=\"panel bg1";
        // line 8
        if ((isset($context["S_ONLINE"]) ? $context["S_ONLINE"] : null)) {
            echo " online";
        }
        echo "\">
\t<div class=\"inner\">
        <div class=\"column1\">
            <form method=\"post\" action=\"";
        // line 11
        echo (isset($context["S_PROFILE_ACTION"]) ? $context["S_PROFILE_ACTION"] : null);
        echo "\" id=\"viewprofile\">
            ";
        // line 12
        if ((isset($context["AVATAR_IMG"]) ? $context["AVATAR_IMG"] : null)) {
            // line 13
            echo "                <dl class=\"left-box\">
                    <dt class=\"profile-avatar\">";
            // line 14
            echo (isset($context["AVATAR_IMG"]) ? $context["AVATAR_IMG"] : null);
            echo "</dt>
                    ";
            // line 15
            // line 16
            echo "                    ";
            if ((isset($context["RANK_TITLE"]) ? $context["RANK_TITLE"] : null)) {
                echo "<dd style=\"text-align: center;\">";
                echo (isset($context["RANK_TITLE"]) ? $context["RANK_TITLE"] : null);
                echo "</dd>";
            }
            // line 17
            echo "                    ";
            if ((isset($context["RANK_IMG"]) ? $context["RANK_IMG"] : null)) {
                echo "<dd style=\"text-align: center;\">";
                echo (isset($context["RANK_IMG"]) ? $context["RANK_IMG"] : null);
                echo "</dd>";
            }
            // line 18
            echo "                    ";
            // line 19
            echo "                </dl>
            ";
        }
        // line 21
        echo "
            ";
        // line 22
        $context["S_ZEBRA"] = 0;
        // line 23
        echo "            ";
        $context["S_GROUP_OPTIONS"] = false;
        // line 24
        echo "                <dl class=\"left-box details profile-details\">
                    <dt>";
        // line 25
        echo $this->env->getExtension('phpbb\template\twig\extension')->lang("USERNAME");
        echo $this->env->getExtension('phpbb\template\twig\extension')->lang("COLON");
        echo "</dt>
                    <dd>
                        ";
        // line 27
        if ((isset($context["USER_COLOR"]) ? $context["USER_COLOR"] : null)) {
            echo "<span style=\"color: ";
            echo (isset($context["USER_COLOR"]) ? $context["USER_COLOR"] : null);
            echo "; font-weight: bold;\">";
        } else {
            echo "<span>";
        }
        echo (isset($context["USERNAME"]) ? $context["USERNAME"] : null);
        echo "</span>
                        ";
        // line 28
        if ((isset($context["U_EDIT_SELF"]) ? $context["U_EDIT_SELF"] : null)) {
            echo " [ <a href=\"";
            echo (isset($context["U_EDIT_SELF"]) ? $context["U_EDIT_SELF"] : null);
            echo "\">";
            echo $this->env->getExtension('phpbb\template\twig\extension')->lang("EDIT_PROFILE");
            echo "</a> ]";
        }
        // line 29
        echo "                        ";
        if ((isset($context["U_USER_ADMIN"]) ? $context["U_USER_ADMIN"] : null)) {
            echo " [ <a href=\"";
            echo (isset($context["U_USER_ADMIN"]) ? $context["U_USER_ADMIN"] : null);
            echo "\">";
            echo $this->env->getExtension('phpbb\template\twig\extension')->lang("USER_ADMIN");
            echo "</a> ]";
        }
        // line 30
        echo "                        ";
        if ((isset($context["U_USER_BAN"]) ? $context["U_USER_BAN"] : null)) {
            echo " [ <a href=\"";
            echo (isset($context["U_USER_BAN"]) ? $context["U_USER_BAN"] : null);
            echo "\">";
            echo $this->env->getExtension('phpbb\template\twig\extension')->lang("USER_BAN");
            echo "</a> ]";
        }
        // line 31
        echo "                        ";
        if ((isset($context["U_SWITCH_PERMISSIONS"]) ? $context["U_SWITCH_PERMISSIONS"] : null)) {
            echo " [ <a href=\"";
            echo (isset($context["U_SWITCH_PERMISSIONS"]) ? $context["U_SWITCH_PERMISSIONS"] : null);
            echo "\">";
            echo $this->env->getExtension('phpbb\template\twig\extension')->lang("USE_PERMISSIONS");
            echo "</a> ]";
        }
        // line 32
        echo "                    </dd>
                    ";
        // line 33
        if ( !(isset($context["AVATAR_IMG"]) ? $context["AVATAR_IMG"] : null)) {
            // line 34
            echo "                        ";
            // line 35
            echo "                        ";
            if ((isset($context["RANK_TITLE"]) ? $context["RANK_TITLE"] : null)) {
                echo "<dt>";
                echo $this->env->getExtension('phpbb\template\twig\extension')->lang("RANK");
                echo $this->env->getExtension('phpbb\template\twig\extension')->lang("COLON");
                echo "</dt> <dd>";
                echo (isset($context["RANK_TITLE"]) ? $context["RANK_TITLE"] : null);
                echo "</dd>";
            }
            // line 36
            echo "                        ";
            if ((isset($context["RANK_IMG"]) ? $context["RANK_IMG"] : null)) {
                echo "<dt>";
                if ((isset($context["RANK_TITLE"]) ? $context["RANK_TITLE"] : null)) {
                    echo "&nbsp;";
                } else {
                    echo $this->env->getExtension('phpbb\template\twig\extension')->lang("RANK");
                    echo $this->env->getExtension('phpbb\template\twig\extension')->lang("COLON");
                }
                echo "</dt> <dd>";
                echo (isset($context["RANK_IMG"]) ? $context["RANK_IMG"] : null);
                echo "</dd>";
            }
            // line 37
            echo "                        ";
            // line 38
            echo "                    ";
        }
        // line 39
        echo "                    ";
        if ((isset($context["S_USER_INACTIVE"]) ? $context["S_USER_INACTIVE"] : null)) {
            echo "<dt>";
            echo $this->env->getExtension('phpbb\template\twig\extension')->lang("USER_IS_INACTIVE");
            echo $this->env->getExtension('phpbb\template\twig\extension')->lang("COLON");
            echo "</dt> <dd>";
            echo (isset($context["USER_INACTIVE_REASON"]) ? $context["USER_INACTIVE_REASON"] : null);
            echo "</dd>";
        }
        // line 40
        echo "                    ";
        if (((isset($context["AGE"]) ? $context["AGE"] : null) !== "")) {
            echo "<dt>";
            echo $this->env->getExtension('phpbb\template\twig\extension')->lang("AGE");
            echo $this->env->getExtension('phpbb\template\twig\extension')->lang("COLON");
            echo "</dt> <dd>";
            echo (isset($context["AGE"]) ? $context["AGE"] : null);
            echo "</dd>";
        }
        // line 41
        echo "                    ";
        if ((isset($context["S_GROUP_OPTIONS"]) ? $context["S_GROUP_OPTIONS"] : null)) {
            echo "<dt>";
            echo $this->env->getExtension('phpbb\template\twig\extension')->lang("USERGROUPS");
            echo $this->env->getExtension('phpbb\template\twig\extension')->lang("COLON");
            echo "</dt> <dd><select name=\"g\">";
            echo (isset($context["S_GROUP_OPTIONS"]) ? $context["S_GROUP_OPTIONS"] : null);
            echo "</select> <input type=\"submit\" name=\"submit\" value=\"";
            echo $this->env->getExtension('phpbb\template\twig\extension')->lang("GO");
            echo "\" class=\"button2\" /></dd>";
        }
        // line 42
        echo "                    ";
        // line 43
        echo "                    ";
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["loops"]) ? $context["loops"] : null), "custom_fields", array()));
        foreach ($context['_seq'] as $context["_key"] => $context["custom_fields"]) {
            // line 44
            echo "                        ";
            if ( !$this->getAttribute($context["custom_fields"], "S_PROFILE_CONTACT", array())) {
                // line 45
                echo "                            <dt>";
                echo $this->getAttribute($context["custom_fields"], "PROFILE_FIELD_NAME", array());
                echo $this->env->getExtension('phpbb\template\twig\extension')->lang("COLON");
                echo "</dt> <dd>";
                echo $this->getAttribute($context["custom_fields"], "PROFILE_FIELD_VALUE", array());
                echo "</dd>
                        ";
            }
            // line 47
            echo "                    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['custom_fields'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 48
        echo "                    ";
        // line 49
        echo "                    ";
        // line 50
        echo "                    ";
        if (((isset($context["S_USER_LOGGED_IN"]) ? $context["S_USER_LOGGED_IN"] : null) && (isset($context["S_ZEBRA"]) ? $context["S_ZEBRA"] : null))) {
            // line 51
            echo "                        ";
            if ((isset($context["U_REMOVE_FRIEND"]) ? $context["U_REMOVE_FRIEND"] : null)) {
                // line 52
                echo "                            <dt>&nbsp;</dt> <dd class=\"zebra\"><a href=\"";
                echo (isset($context["U_REMOVE_FRIEND"]) ? $context["U_REMOVE_FRIEND"] : null);
                echo "\" data-ajax=\"zebra\"><strong>";
                echo $this->env->getExtension('phpbb\template\twig\extension')->lang("REMOVE_FRIEND");
                echo "</strong></a></dd>
                        ";
            } elseif (            // line 53
(isset($context["U_REMOVE_FOE"]) ? $context["U_REMOVE_FOE"] : null)) {
                // line 54
                echo "                            <dt>&nbsp;</dt> <dd class=\"zebra\"><a href=\"";
                echo (isset($context["U_REMOVE_FOE"]) ? $context["U_REMOVE_FOE"] : null);
                echo "\" data-ajax=\"zebra\"><strong>";
                echo $this->env->getExtension('phpbb\template\twig\extension')->lang("REMOVE_FOE");
                echo "</strong></a></dd>
                        ";
            } else {
                // line 56
                echo "                            ";
                if ((isset($context["U_ADD_FRIEND"]) ? $context["U_ADD_FRIEND"] : null)) {
                    // line 57
                    echo "                                <dt>&nbsp;</dt> <dd class=\"zebra\"><a href=\"";
                    echo (isset($context["U_ADD_FRIEND"]) ? $context["U_ADD_FRIEND"] : null);
                    echo "\" data-ajax=\"zebra\"><strong>";
                    echo $this->env->getExtension('phpbb\template\twig\extension')->lang("ADD_FRIEND");
                    echo "</strong></a></dd>
                            ";
                }
                // line 59
                echo "                            ";
                if ((isset($context["U_ADD_FOE"]) ? $context["U_ADD_FOE"] : null)) {
                    // line 60
                    echo "                                <dt>&nbsp;</dt> <dd class=\"zebra\"><a href=\"";
                    echo (isset($context["U_ADD_FOE"]) ? $context["U_ADD_FOE"] : null);
                    echo "\" data-ajax=\"zebra\"><strong>";
                    echo $this->env->getExtension('phpbb\template\twig\extension')->lang("ADD_FOE");
                    echo "</strong></a></dd>
                            ";
                }
                // line 62
                echo "                        ";
            }
            // line 63
            echo "                    ";
        }
        // line 64
        echo "                    ";
        // line 65
        echo "                </dl>
            </form>
        </div>
        
        <div class=\"column2\">
            <h3>Papers</h3>
            <div style=\"text-align: center\">            
                <br>
                <form action=\"http://arxiv.org/find\" name=\"search\" method=\"POST\">
                    <input type=\"hidden\" name=\"group\" value=\"grp_physics\">
                    <input type=\"hidden\" name=\"archive\" value=\"astro-ph\">
                    <input type=\"hidden\" name=\"field_1\" value='au'>
                    <input type=\"hidden\" name=\"query_1\" value=\"";
        // line 77
        echo (isset($context["SEARCHNAME"]) ? $context["SEARCHNAME"] : null);
        echo "\">
                    <input type=\"hidden\" name=\"per_page\" value=100>
                    <input type=\"submit\" value=\"astro-ph papers\">
                </form>

                <br>
                <form action=\"http://arxiv.org/find\" name=\"search\" method=\"POST\">
                    <input type=\"hidden\" name=\"group\" value=\"grp_physics\">
                    <input type=\"hidden\" name=\"archive\" value=\"grp_physics\">
                    <input type=\"hidden\" name=\"field_1\" value='au'>
                    <input type=\"hidden\" name=\"query_1\" value=\"";
        // line 87
        echo (isset($context["SEARCHNAME"]) ? $context["SEARCHNAME"] : null);
        echo "\">
                    <input type=\"hidden\" name=\"per_page\" value=100>
                    <input type=\"submit\" value=\"all physics papers\">
                </form>
                <br>

                <span class=\"gen\">
                    <a href=\"http://www.slac.stanford.edu/spires/find/wwwhepau/wwwscan?rawcmd=fin+";
        // line 94
        echo (isset($context["LAST"]) ? $context["LAST"] : null);
        echo ",+";
        echo (isset($context["FIRST"]) ? $context["FIRST"] : null);
        echo "\">SPIRES</a>
                </span>
                <br>
            </div>
        </div>
\t</div>
</div>

";
        // line 102
        // line 103
        echo "<div class=\"panel bg2\">
\t<div class=\"inner\">

\t<div class=\"column1\">
\t\t<h3>";
        // line 107
        echo $this->env->getExtension('phpbb\template\twig\extension')->lang("CONTACT_USER");
        echo "</h3>

\t\t<dl class=\"details\">
\t\t";
        // line 110
        if ((isset($context["U_EMAIL"]) ? $context["U_EMAIL"] : null)) {
            echo "<dt>";
            echo $this->env->getExtension('phpbb\template\twig\extension')->lang("EMAIL_ADDRESS");
            echo $this->env->getExtension('phpbb\template\twig\extension')->lang("COLON");
            echo "</dt> <dd><a href=\"";
            echo (isset($context["U_EMAIL"]) ? $context["U_EMAIL"] : null);
            echo "\">";
            echo $this->env->getExtension('phpbb\template\twig\extension')->lang("SEND_EMAIL_USER");
            echo "</a></dd>";
        }
        // line 111
        echo "\t\t";
        if ((isset($context["U_PM"]) ? $context["U_PM"] : null)) {
            echo "<dt>";
            echo $this->env->getExtension('phpbb\template\twig\extension')->lang("PM");
            echo $this->env->getExtension('phpbb\template\twig\extension')->lang("COLON");
            echo "</dt> <dd><a href=\"";
            echo (isset($context["U_PM"]) ? $context["U_PM"] : null);
            echo "\">";
            echo $this->env->getExtension('phpbb\template\twig\extension')->lang("SEND_PRIVATE_MESSAGE");
            echo "</a></dd>";
        }
        // line 112
        echo "\t\t";
        if (((isset($context["U_JABBER"]) ? $context["U_JABBER"] : null) && (isset($context["S_JABBER_ENABLED"]) ? $context["S_JABBER_ENABLED"] : null))) {
            echo "<dt>";
            echo $this->env->getExtension('phpbb\template\twig\extension')->lang("JABBER");
            echo $this->env->getExtension('phpbb\template\twig\extension')->lang("COLON");
            echo "</dt> <dd><a href=\"";
            echo (isset($context["U_JABBER"]) ? $context["U_JABBER"] : null);
            echo "\" onclick=\"popup(this.href, 750, 320); return false;\">";
            echo $this->env->getExtension('phpbb\template\twig\extension')->lang("SEND_JABBER_MESSAGE");
            echo "</a></dd>";
        } elseif ((isset($context["USER_JABBER"]) ? $context["USER_JABBER"] : null)) {
            echo "<dt>";
            echo $this->env->getExtension('phpbb\template\twig\extension')->lang("JABBER");
            echo $this->env->getExtension('phpbb\template\twig\extension')->lang("COLON");
            echo "</dt> <dd>";
            echo (isset($context["USER_JABBER"]) ? $context["USER_JABBER"] : null);
            echo "</dd>";
        }
        // line 113
        echo "\t\t";
        // line 114
        echo "\t\t";
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["loops"]) ? $context["loops"] : null), "custom_fields", array()));
        foreach ($context['_seq'] as $context["_key"] => $context["custom_fields"]) {
            // line 115
            echo "\t\t\t";
            if ($this->getAttribute($context["custom_fields"], "S_PROFILE_CONTACT", array())) {
                // line 116
                echo "\t\t\t\t<dt>";
                echo $this->getAttribute($context["custom_fields"], "PROFILE_FIELD_NAME", array());
                echo $this->env->getExtension('phpbb\template\twig\extension')->lang("COLON");
                echo "</dt>
\t\t\t\t";
                // line 117
                if ($this->getAttribute($context["custom_fields"], "PROFILE_FIELD_CONTACT", array())) {
                    // line 118
                    echo "\t\t\t\t\t<dd><a href=\"";
                    echo $this->getAttribute($context["custom_fields"], "PROFILE_FIELD_CONTACT", array());
                    echo "\">";
                    echo $this->getAttribute($context["custom_fields"], "PROFILE_FIELD_DESC", array());
                    echo "</a></dd>
\t\t\t\t";
                } else {
                    // line 120
                    echo "\t\t\t\t\t<dd>";
                    echo $this->getAttribute($context["custom_fields"], "PROFILE_FIELD_VALUE", array());
                    echo "</dd>
\t\t\t\t";
                }
                // line 122
                echo "\t\t\t";
            }
            // line 123
            echo "\t\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['custom_fields'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 124
        echo "\t\t";
        // line 125
        echo "\t\t";
        if ((isset($context["S_PROFILE_FIELD1"]) ? $context["S_PROFILE_FIELD1"] : null)) {
            // line 126
            echo "\t\t\t<!-- NOTE: Use a construct like this to include admin defined profile fields. Replace FIELD1 with the name of your field. -->
\t\t\t<dt>";
            // line 127
            echo (isset($context["PROFILE_FIELD1_NAME"]) ? $context["PROFILE_FIELD1_NAME"] : null);
            echo $this->env->getExtension('phpbb\template\twig\extension')->lang("COLON");
            echo "</dt> <dd>";
            echo (isset($context["PROFILE_FIELD1_VALUE"]) ? $context["PROFILE_FIELD1_VALUE"] : null);
            echo "</dd>
\t\t";
        }
        // line 129
        echo "\t\t</dl>
\t</div>

\t<div class=\"column2\">
\t\t<h3>";
        // line 133
        echo $this->env->getExtension('phpbb\template\twig\extension')->lang("USER_FORUM");
        echo "</h3>
\t\t<dl class=\"details\">
\t\t\t";
        // line 135
        // line 136
        echo "\t\t\t<dt>";
        echo $this->env->getExtension('phpbb\template\twig\extension')->lang("JOINED");
        echo $this->env->getExtension('phpbb\template\twig\extension')->lang("COLON");
        echo "</dt> <dd>";
        echo (isset($context["JOINED"]) ? $context["JOINED"] : null);
        echo "</dd>
\t\t\t<dt>";
        // line 137
        echo $this->env->getExtension('phpbb\template\twig\extension')->lang("LAST_ACTIVE");
        echo $this->env->getExtension('phpbb\template\twig\extension')->lang("COLON");
        echo "</dt> <dd>";
        echo (isset($context["LAST_ACTIVE"]) ? $context["LAST_ACTIVE"] : null);
        echo "</dd>
\t\t\t";
        // line 138
        if ((isset($context["S_WARNINGS"]) ? $context["S_WARNINGS"] : null)) {
            // line 139
            echo "\t\t\t<dt>";
            echo $this->env->getExtension('phpbb\template\twig\extension')->lang("WARNINGS");
            echo $this->env->getExtension('phpbb\template\twig\extension')->lang("COLON");
            echo " </dt>
\t\t\t<dd><strong>";
            // line 140
            echo (isset($context["WARNINGS"]) ? $context["WARNINGS"] : null);
            echo "</strong>";
            if (((isset($context["U_NOTES"]) ? $context["U_NOTES"] : null) || (isset($context["U_WARN"]) ? $context["U_WARN"] : null))) {
                echo " [ ";
                if ((isset($context["U_NOTES"]) ? $context["U_NOTES"] : null)) {
                    echo "<a href=\"";
                    echo (isset($context["U_NOTES"]) ? $context["U_NOTES"] : null);
                    echo "\">";
                    echo $this->env->getExtension('phpbb\template\twig\extension')->lang("VIEW_NOTES");
                    echo "</a>";
                }
                echo " ";
                if ((isset($context["U_WARN"]) ? $context["U_WARN"] : null)) {
                    if ((isset($context["U_NOTES"]) ? $context["U_NOTES"] : null)) {
                        echo " | ";
                    }
                    echo "<a href=\"";
                    echo (isset($context["U_WARN"]) ? $context["U_WARN"] : null);
                    echo "\">";
                    echo $this->env->getExtension('phpbb\template\twig\extension')->lang("WARN_USER");
                    echo "</a>";
                }
                echo " ]";
            }
            echo "</dd>
\t\t\t";
        }
        // line 142
        echo "\t\t\t<dt>";
        echo $this->env->getExtension('phpbb\template\twig\extension')->lang("TOTAL_POSTS");
        echo $this->env->getExtension('phpbb\template\twig\extension')->lang("COLON");
        echo "</dt>
\t\t\t\t<dd>";
        // line 143
        echo (isset($context["POSTS"]) ? $context["POSTS"] : null);
        echo " ";
        if ((isset($context["S_DISPLAY_SEARCH"]) ? $context["S_DISPLAY_SEARCH"] : null)) {
            echo "| <strong><a href=\"";
            echo (isset($context["U_SEARCH_USER"]) ? $context["U_SEARCH_USER"] : null);
            echo "\">";
            echo $this->env->getExtension('phpbb\template\twig\extension')->lang("SEARCH_USER_POSTS");
            echo "</a></strong>";
        }
        // line 144
        echo "\t\t\t\t\t";
        if ((isset($context["POSTS_PCT"]) ? $context["POSTS_PCT"] : null)) {
            echo "<br />(";
            echo (isset($context["POSTS_PCT"]) ? $context["POSTS_PCT"] : null);
            echo " / ";
            echo (isset($context["POSTS_DAY"]) ? $context["POSTS_DAY"] : null);
            echo ")";
        }
        // line 145
        echo "\t\t\t\t\t";
        if (((isset($context["POSTS_IN_QUEUE"]) ? $context["POSTS_IN_QUEUE"] : null) && (isset($context["U_MCP_QUEUE"]) ? $context["U_MCP_QUEUE"] : null))) {
            echo "<br />(<a href=\"";
            echo (isset($context["U_MCP_QUEUE"]) ? $context["U_MCP_QUEUE"] : null);
            echo "\">";
            echo $this->env->getExtension('phpbb\template\twig\extension')->lang("POSTS_IN_QUEUE");
            echo "</a>)";
        } elseif ((isset($context["POSTS_IN_QUEUE"]) ? $context["POSTS_IN_QUEUE"] : null)) {
            echo "<br />(";
            echo $this->env->getExtension('phpbb\template\twig\extension')->lang("POSTS_IN_QUEUE");
            echo ")";
        }
        // line 146
        echo "\t\t\t\t</dd>
\t\t\t";
        // line 147
        if (((isset($context["S_SHOW_ACTIVITY"]) ? $context["S_SHOW_ACTIVITY"] : null) && (isset($context["POSTS"]) ? $context["POSTS"] : null))) {
            // line 148
            echo "\t\t\t\t<dt>";
            echo $this->env->getExtension('phpbb\template\twig\extension')->lang("ACTIVE_IN_FORUM");
            echo $this->env->getExtension('phpbb\template\twig\extension')->lang("COLON");
            echo "</dt> <dd>";
            if (((isset($context["ACTIVE_FORUM"]) ? $context["ACTIVE_FORUM"] : null) != "")) {
                echo "<strong><a href=\"";
                echo (isset($context["U_ACTIVE_FORUM"]) ? $context["U_ACTIVE_FORUM"] : null);
                echo "\">";
                echo (isset($context["ACTIVE_FORUM"]) ? $context["ACTIVE_FORUM"] : null);
                echo "</a></strong><br />(";
                echo (isset($context["ACTIVE_FORUM_POSTS"]) ? $context["ACTIVE_FORUM_POSTS"] : null);
                echo " / ";
                echo (isset($context["ACTIVE_FORUM_PCT"]) ? $context["ACTIVE_FORUM_PCT"] : null);
                echo ")";
            } else {
                echo " - ";
            }
            echo "</dd>
\t\t\t\t<dt>";
            // line 149
            echo $this->env->getExtension('phpbb\template\twig\extension')->lang("ACTIVE_IN_TOPIC");
            echo $this->env->getExtension('phpbb\template\twig\extension')->lang("COLON");
            echo "</dt> <dd>";
            if (((isset($context["ACTIVE_TOPIC"]) ? $context["ACTIVE_TOPIC"] : null) != "")) {
                echo "<strong><a href=\"";
                echo (isset($context["U_ACTIVE_TOPIC"]) ? $context["U_ACTIVE_TOPIC"] : null);
                echo "\">";
                echo (isset($context["ACTIVE_TOPIC"]) ? $context["ACTIVE_TOPIC"] : null);
                echo "</a></strong><br />(";
                echo (isset($context["ACTIVE_TOPIC_POSTS"]) ? $context["ACTIVE_TOPIC_POSTS"] : null);
                echo " / ";
                echo (isset($context["ACTIVE_TOPIC_PCT"]) ? $context["ACTIVE_TOPIC_PCT"] : null);
                echo ")";
            } else {
                echo " - ";
            }
            echo "</dd>
\t\t\t";
        }
        // line 151
        echo "\t\t\t";
        // line 152
        echo "\t\t</dl>
\t</div>

\t</div>
</div>
";
        // line 157
        // line 158
        echo "
";
        // line 159
        if ((isset($context["SIGNATURE"]) ? $context["SIGNATURE"] : null)) {
            // line 160
            echo "<div class=\"panel bg1\">
\t<div class=\"inner\">

\t\t<h3>";
            // line 163
            echo $this->env->getExtension('phpbb\template\twig\extension')->lang("SIGNATURE");
            echo "</h3>

\t\t<div class=\"postbody\"><div class=\"signature standalone\">";
            // line 165
            echo (isset($context["SIGNATURE"]) ? $context["SIGNATURE"] : null);
            echo "</div></div>

\t</div>
</div>
";
        }
        // line 170
        echo "


";
        // line 173
        // line 174
        echo "
";
        // line 175
        $location = "jumpbox.html";
        $namespace = false;
        if (strpos($location, '@') === 0) {
            $namespace = substr($location, 1, strpos($location, '/') - 1);
            $previous_look_up_order = $this->env->getNamespaceLookUpOrder();
            $this->env->setNamespaceLookUpOrder(array($namespace, '__main__'));
        }
        $this->loadTemplate("jumpbox.html", "memberlist_view.html", 175)->display($context);
        if ($namespace) {
            $this->env->setNamespaceLookUpOrder($previous_look_up_order);
        }
        // line 176
        echo "
";
        // line 177
        $location = "overall_footer.html";
        $namespace = false;
        if (strpos($location, '@') === 0) {
            $namespace = substr($location, 1, strpos($location, '/') - 1);
            $previous_look_up_order = $this->env->getNamespaceLookUpOrder();
            $this->env->setNamespaceLookUpOrder(array($namespace, '__main__'));
        }
        $this->loadTemplate("overall_footer.html", "memberlist_view.html", 177)->display($context);
        if ($namespace) {
            $this->env->setNamespaceLookUpOrder($previous_look_up_order);
        }
    }

    public function getTemplateName()
    {
        return "memberlist_view.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  664 => 177,  661 => 176,  649 => 175,  646 => 174,  645 => 173,  640 => 170,  632 => 165,  627 => 163,  622 => 160,  620 => 159,  617 => 158,  616 => 157,  609 => 152,  607 => 151,  587 => 149,  567 => 148,  565 => 147,  562 => 146,  549 => 145,  540 => 144,  530 => 143,  524 => 142,  496 => 140,  490 => 139,  488 => 138,  481 => 137,  473 => 136,  472 => 135,  467 => 133,  461 => 129,  453 => 127,  450 => 126,  447 => 125,  445 => 124,  439 => 123,  436 => 122,  430 => 120,  422 => 118,  420 => 117,  414 => 116,  411 => 115,  406 => 114,  404 => 113,  385 => 112,  373 => 111,  362 => 110,  356 => 107,  350 => 103,  349 => 102,  336 => 94,  326 => 87,  313 => 77,  299 => 65,  297 => 64,  294 => 63,  291 => 62,  283 => 60,  280 => 59,  272 => 57,  269 => 56,  261 => 54,  259 => 53,  252 => 52,  249 => 51,  246 => 50,  244 => 49,  242 => 48,  236 => 47,  227 => 45,  224 => 44,  219 => 43,  217 => 42,  205 => 41,  195 => 40,  185 => 39,  182 => 38,  180 => 37,  166 => 36,  156 => 35,  154 => 34,  152 => 33,  149 => 32,  140 => 31,  131 => 30,  122 => 29,  114 => 28,  103 => 27,  97 => 25,  94 => 24,  91 => 23,  89 => 22,  86 => 21,  82 => 19,  80 => 18,  73 => 17,  66 => 16,  65 => 15,  61 => 14,  58 => 13,  56 => 12,  52 => 11,  44 => 8,  40 => 6,  39 => 5,  34 => 3,  31 => 2,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "memberlist_view.html", "");
    }
}
