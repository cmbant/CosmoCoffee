<?php

/* viewtopic_body.html */
class __TwigTemplate_959222016c912871d99b9fd2c939e865666b0fd1fa553ac0996d360c0c65a6ab extends Twig_Template
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
        $this->loadTemplate("overall_header.html", "viewtopic_body.html", 1)->display($context);
        if ($namespace) {
            $this->env->setNamespaceLookUpOrder($previous_look_up_order);
        }
        // line 2
        echo "
";
        // line 3
        // line 4
        echo "<h2 class=\"topic-title\">";
        echo (isset($context["TOPIC_TITLE_COSMOCOFFEE"]) ? $context["TOPIC_TITLE_COSMOCOFFEE"] : null);
        echo "</h2>

<!-- CosmoCoffee -->
";
        // line 7
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["loops"]) ? $context["loops"] : null), "paper", array()));
        foreach ($context['_seq'] as $context["_key"] => $context["paper"]) {
            // line 8
            echo "<table class=\"postbody2\" width=\"100%\">      
    <tr>
        <td align=\"right\" valign=\"top\"><b>Authors:&nbsp;</b></td>
        <td>";
            // line 11
            echo $this->getAttribute($context["paper"], "PAPER_AUTHORS", array());
            echo "</td>
    </tr>
    <tr>
        <td class=\"abstract\" align=\"right\" valign=\"top\"><b>Abstract:&nbsp;</b></td>
        <td class =\"abstract\">";
            // line 15
            echo $this->getAttribute($context["paper"], "PAPER_ABSTRACT", array());
            echo "</td>
    </tr>
    <tr>
        <td></td>
        <td>
            <b>
                [<a target=\"_blank\" href=\"/arxivref.php?file=pdf/";
            // line 21
            echo $this->getAttribute($context["paper"], "PAPER_ARXIV_TAG", array());
            echo "\">PDF</a>]&nbsp; 
                [<a href=\"/arxivref.php?file=ps/";
            // line 22
            echo $this->getAttribute($context["paper"], "PAPER_ARXIV_TAG", array());
            echo "\">PS</a>]&nbsp;
                [<a href=\"/bibtex.php?arxiv=";
            // line 23
            echo $this->getAttribute($context["paper"], "PAPER_ARXIV_TAG", array());
            echo "\">BibTex</A>]&nbsp; 
                [<a href=\"/bookmark.php?add=";
            // line 24
            echo $this->getAttribute($context["paper"], "PAPER_ARXIV_TAG", array());
            echo "\">Bookmark</A>]
            </b>
        </td>
    </tr> 
</table>
<br/>
";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['paper'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 31
        echo "<!-- /CosmoCoffee -->

";
        // line 33
        // line 34
        echo "<!-- NOTE: remove the style=\"display: none\" when you want to have the forum description on the topic body -->
";
        // line 35
        if ((isset($context["FORUM_DESC"]) ? $context["FORUM_DESC"] : null)) {
            echo "<div style=\"display: none !important;\">";
            echo (isset($context["FORUM_DESC"]) ? $context["FORUM_DESC"] : null);
            echo "<br /></div>";
        }
        // line 36
        echo "
";
        // line 37
        if ((isset($context["MODERATORS"]) ? $context["MODERATORS"] : null)) {
            // line 38
            echo "<p>
    <strong>";
            // line 39
            if ((isset($context["S_SINGLE_MODERATOR"]) ? $context["S_SINGLE_MODERATOR"] : null)) {
                echo $this->env->getExtension('phpbb\template\twig\extension')->lang("MODERATOR");
            } else {
                echo $this->env->getExtension('phpbb\template\twig\extension')->lang("MODERATORS");
            }
            echo $this->env->getExtension('phpbb\template\twig\extension')->lang("COLON");
            echo "</strong> ";
            echo (isset($context["MODERATORS"]) ? $context["MODERATORS"] : null);
            echo "
</p>
";
        }
        // line 42
        echo "
";
        // line 43
        if ((isset($context["S_FORUM_RULES"]) ? $context["S_FORUM_RULES"] : null)) {
            // line 44
            echo "<div class=\"rules";
            if ((isset($context["U_FORUM_RULES"]) ? $context["U_FORUM_RULES"] : null)) {
                echo " rules-link";
            }
            echo "\">
    <div class=\"inner\">

        ";
            // line 47
            if ((isset($context["U_FORUM_RULES"]) ? $context["U_FORUM_RULES"] : null)) {
                // line 48
                echo "        <a href=\"";
                echo (isset($context["U_FORUM_RULES"]) ? $context["U_FORUM_RULES"] : null);
                echo "\">";
                echo $this->env->getExtension('phpbb\template\twig\extension')->lang("FORUM_RULES");
                echo "</a>
        ";
            } else {
                // line 50
                echo "        <strong>";
                echo $this->env->getExtension('phpbb\template\twig\extension')->lang("FORUM_RULES");
                echo "</strong><br />
        ";
                // line 51
                echo (isset($context["FORUM_RULES"]) ? $context["FORUM_RULES"] : null);
                echo "
        ";
            }
            // line 53
            echo "
    </div>
</div>
";
        }
        // line 57
        echo "
<div class=\"action-bar bar-top\">
    ";
        // line 59
        // line 60
        echo "
    ";
        // line 61
        if (( !(isset($context["S_IS_BOT"]) ? $context["S_IS_BOT"] : null) && (isset($context["S_DISPLAY_REPLY_INFO"]) ? $context["S_DISPLAY_REPLY_INFO"] : null))) {
            // line 62
            echo "    <a href=\"";
            echo (isset($context["U_POST_REPLY_TOPIC"]) ? $context["U_POST_REPLY_TOPIC"] : null);
            echo "\" class=\"button\" title=\"";
            if ((isset($context["S_IS_LOCKED"]) ? $context["S_IS_LOCKED"] : null)) {
                echo $this->env->getExtension('phpbb\template\twig\extension')->lang("TOPIC_LOCKED");
            } else {
                echo $this->env->getExtension('phpbb\template\twig\extension')->lang("POST_REPLY");
            }
            echo "\">
        ";
            // line 63
            if ((isset($context["S_IS_LOCKED"]) ? $context["S_IS_LOCKED"] : null)) {
                // line 64
                echo "        <span>";
                echo $this->env->getExtension('phpbb\template\twig\extension')->lang("BUTTON_TOPIC_LOCKED");
                echo "</span> <i class=\"icon fa-lock fa-fw\" aria-hidden=\"true\"></i>
        ";
            } else {
                // line 66
                echo "        <span>";
                echo $this->env->getExtension('phpbb\template\twig\extension')->lang("BUTTON_POST_REPLY");
                echo "</span> <i class=\"icon fa-reply fa-fw\" aria-hidden=\"true\"></i>
        ";
            }
            // line 68
            echo "    </a>
    ";
        }
        // line 70
        echo "
    ";
        // line 71
        // line 72
        echo "    ";
        $location = "viewtopic_topic_tools.html";
        $namespace = false;
        if (strpos($location, '@') === 0) {
            $namespace = substr($location, 1, strpos($location, '/') - 1);
            $previous_look_up_order = $this->env->getNamespaceLookUpOrder();
            $this->env->setNamespaceLookUpOrder(array($namespace, '__main__'));
        }
        $this->loadTemplate("viewtopic_topic_tools.html", "viewtopic_body.html", 72)->display($context);
        if ($namespace) {
            $this->env->setNamespaceLookUpOrder($previous_look_up_order);
        }
        // line 73
        echo "    ";
        // line 74
        echo "
    ";
        // line 75
        if ((isset($context["S_DISPLAY_SEARCHBOX"]) ? $context["S_DISPLAY_SEARCHBOX"] : null)) {
            // line 76
            echo "    <div class=\"search-box\" role=\"search\">
        <form method=\"get\" id=\"topic-search\" action=\"";
            // line 77
            echo (isset($context["S_SEARCHBOX_ACTION"]) ? $context["S_SEARCHBOX_ACTION"] : null);
            echo "\">
            <fieldset>
                <input class=\"inputbox search tiny\"  type=\"search\" name=\"keywords\" id=\"search_keywords\" size=\"20\" placeholder=\"";
            // line 79
            echo $this->env->getExtension('phpbb\template\twig\extension')->lang("SEARCH_TOPIC");
            echo "\" />
                <button class=\"button button-search\" type=\"submit\" title=\"";
            // line 80
            echo $this->env->getExtension('phpbb\template\twig\extension')->lang("SEARCH");
            echo "\">
                    <i class=\"icon fa-search fa-fw\" aria-hidden=\"true\"></i><span class=\"sr-only\">";
            // line 81
            echo $this->env->getExtension('phpbb\template\twig\extension')->lang("SEARCH");
            echo "</span>
                </button>
                <a href=\"";
            // line 83
            echo (isset($context["U_SEARCH"]) ? $context["U_SEARCH"] : null);
            echo "\" class=\"button button-search-end\" title=\"";
            echo $this->env->getExtension('phpbb\template\twig\extension')->lang("SEARCH_ADV");
            echo "\">
                    <i class=\"icon fa-cog fa-fw\" aria-hidden=\"true\"></i><span class=\"sr-only\">";
            // line 84
            echo $this->env->getExtension('phpbb\template\twig\extension')->lang("SEARCH_ADV");
            echo "</span>
                </a>
                ";
            // line 86
            echo (isset($context["S_SEARCH_LOCAL_HIDDEN_FIELDS"]) ? $context["S_SEARCH_LOCAL_HIDDEN_FIELDS"] : null);
            echo "
            </fieldset>
        </form>
    </div>
    ";
        }
        // line 91
        echo "
    ";
        // line 92
        if ((twig_length_filter($this->env, $this->getAttribute((isset($context["loops"]) ? $context["loops"] : null), "pagination", array())) || (isset($context["TOTAL_POSTS"]) ? $context["TOTAL_POSTS"] : null))) {
            // line 93
            echo "    <div class=\"pagination\">
        ";
            // line 94
            if (((isset($context["U_VIEW_UNREAD_POST"]) ? $context["U_VIEW_UNREAD_POST"] : null) &&  !(isset($context["S_IS_BOT"]) ? $context["S_IS_BOT"] : null))) {
                echo "<a href=\"";
                echo (isset($context["U_VIEW_UNREAD_POST"]) ? $context["U_VIEW_UNREAD_POST"] : null);
                echo "\" class=\"mark\">";
                echo $this->env->getExtension('phpbb\template\twig\extension')->lang("VIEW_UNREAD_POST");
                echo "</a> &bull; ";
            }
            echo (isset($context["TOTAL_POSTS"]) ? $context["TOTAL_POSTS"] : null);
            echo "
        ";
            // line 95
            if (twig_length_filter($this->env, $this->getAttribute((isset($context["loops"]) ? $context["loops"] : null), "pagination", array()))) {
                // line 96
                echo "        ";
                $location = "pagination.html";
                $namespace = false;
                if (strpos($location, '@') === 0) {
                    $namespace = substr($location, 1, strpos($location, '/') - 1);
                    $previous_look_up_order = $this->env->getNamespaceLookUpOrder();
                    $this->env->setNamespaceLookUpOrder(array($namespace, '__main__'));
                }
                $this->loadTemplate("pagination.html", "viewtopic_body.html", 96)->display($context);
                if ($namespace) {
                    $this->env->setNamespaceLookUpOrder($previous_look_up_order);
                }
                // line 97
                echo "        ";
            } else {
                // line 98
                echo "        &bull; ";
                echo (isset($context["PAGE_NUMBER"]) ? $context["PAGE_NUMBER"] : null);
                echo "
        ";
            }
            // line 100
            echo "    </div>
    ";
        }
        // line 102
        echo "    ";
        // line 103
        echo "</div>

";
        // line 105
        // line 106
        echo "
";
        // line 107
        if ((isset($context["S_HAS_POLL"]) ? $context["S_HAS_POLL"] : null)) {
            // line 108
            echo "<form method=\"post\" action=\"";
            echo (isset($context["S_POLL_ACTION"]) ? $context["S_POLL_ACTION"] : null);
            echo "\" data-ajax=\"vote_poll\" class=\"topic_poll\">

    <div class=\"panel\">
        <div class=\"inner\">

            <div class=\"content\">
                <h2 class=\"poll-title\">";
            // line 114
            echo (isset($context["POLL_QUESTION"]) ? $context["POLL_QUESTION"] : null);
            echo "</h2>
                <p class=\"author\">";
            // line 115
            echo $this->env->getExtension('phpbb\template\twig\extension')->lang("POLL_LENGTH");
            if (((isset($context["S_CAN_VOTE"]) ? $context["S_CAN_VOTE"] : null) && (isset($context["L_POLL_LENGTH"]) ? $context["L_POLL_LENGTH"] : null))) {
                echo "<br />";
            }
            if ((isset($context["S_CAN_VOTE"]) ? $context["S_CAN_VOTE"] : null)) {
                echo "<span class=\"poll_max_votes\">";
                echo $this->env->getExtension('phpbb\template\twig\extension')->lang("MAX_VOTES");
                echo "</span>";
            }
            echo "</p>

                <fieldset class=\"polls\">
                    ";
            // line 118
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["loops"]) ? $context["loops"] : null), "poll_option", array()));
            foreach ($context['_seq'] as $context["_key"] => $context["poll_option"]) {
                // line 119
                echo "                    ";
                // line 120
                echo "                    <dl class=\"";
                if ($this->getAttribute($context["poll_option"], "POLL_OPTION_VOTED", array())) {
                    echo "voted";
                }
                if ($this->getAttribute($context["poll_option"], "POLL_OPTION_MOST_VOTES", array())) {
                    echo " most-votes";
                }
                echo "\"";
                if ($this->getAttribute($context["poll_option"], "POLL_OPTION_VOTED", array())) {
                    echo " title=\"";
                    echo $this->env->getExtension('phpbb\template\twig\extension')->lang("POLL_VOTED_OPTION");
                    echo "\"";
                }
                echo " data-alt-text=\"";
                echo $this->env->getExtension('phpbb\template\twig\extension')->lang("POLL_VOTED_OPTION");
                echo "\" data-poll-option-id=\"";
                echo $this->getAttribute($context["poll_option"], "POLL_OPTION_ID", array());
                echo "\">
                        <dt>";
                // line 121
                if ((isset($context["S_CAN_VOTE"]) ? $context["S_CAN_VOTE"] : null)) {
                    echo "<label for=\"vote_";
                    echo $this->getAttribute($context["poll_option"], "POLL_OPTION_ID", array());
                    echo "\">";
                    echo $this->getAttribute($context["poll_option"], "POLL_OPTION_CAPTION", array());
                    echo "</label>";
                } else {
                    echo $this->getAttribute($context["poll_option"], "POLL_OPTION_CAPTION", array());
                }
                echo "</dt>
                        ";
                // line 122
                if ((isset($context["S_CAN_VOTE"]) ? $context["S_CAN_VOTE"] : null)) {
                    echo "<dd style=\"width: auto;\" class=\"poll_option_select\">";
                    if ((isset($context["S_IS_MULTI_CHOICE"]) ? $context["S_IS_MULTI_CHOICE"] : null)) {
                        echo "<input type=\"checkbox\" name=\"vote_id[]\" id=\"vote_";
                        echo $this->getAttribute($context["poll_option"], "POLL_OPTION_ID", array());
                        echo "\" value=\"";
                        echo $this->getAttribute($context["poll_option"], "POLL_OPTION_ID", array());
                        echo "\"";
                        if ($this->getAttribute($context["poll_option"], "POLL_OPTION_VOTED", array())) {
                            echo " checked=\"checked\"";
                        }
                        echo " />";
                    } else {
                        echo "<input type=\"radio\" name=\"vote_id[]\" id=\"vote_";
                        echo $this->getAttribute($context["poll_option"], "POLL_OPTION_ID", array());
                        echo "\" value=\"";
                        echo $this->getAttribute($context["poll_option"], "POLL_OPTION_ID", array());
                        echo "\"";
                        if ($this->getAttribute($context["poll_option"], "POLL_OPTION_VOTED", array())) {
                            echo " checked=\"checked\"";
                        }
                        echo " />";
                    }
                    echo "</dd>";
                }
                // line 123
                echo "                        <dd class=\"resultbar";
                if ( !(isset($context["S_DISPLAY_RESULTS"]) ? $context["S_DISPLAY_RESULTS"] : null)) {
                    echo " hidden";
                }
                echo "\"><div class=\"";
                if (($this->getAttribute($context["poll_option"], "POLL_OPTION_PCT", array()) < 20)) {
                    echo "pollbar1";
                } elseif (($this->getAttribute($context["poll_option"], "POLL_OPTION_PCT", array()) < 40)) {
                    echo "pollbar2";
                } elseif (($this->getAttribute($context["poll_option"], "POLL_OPTION_PCT", array()) < 60)) {
                    echo "pollbar3";
                } elseif (($this->getAttribute($context["poll_option"], "POLL_OPTION_PCT", array()) < 80)) {
                    echo "pollbar4";
                } else {
                    echo "pollbar5";
                }
                echo "\" style=\"width:";
                echo $this->getAttribute($context["poll_option"], "POLL_OPTION_PERCENT_REL", array());
                echo ";\">";
                echo $this->getAttribute($context["poll_option"], "POLL_OPTION_RESULT", array());
                echo "</div></dd>
                        <dd class=\"poll_option_percent";
                // line 124
                if ( !(isset($context["S_DISPLAY_RESULTS"]) ? $context["S_DISPLAY_RESULTS"] : null)) {
                    echo " hidden";
                }
                echo "\">";
                if (($this->getAttribute($context["poll_option"], "POLL_OPTION_RESULT", array()) == 0)) {
                    echo $this->env->getExtension('phpbb\template\twig\extension')->lang("NO_VOTES");
                } else {
                    echo $this->getAttribute($context["poll_option"], "POLL_OPTION_PERCENT", array());
                }
                echo "</dd>
                    </dl>
                    ";
                // line 126
                // line 127
                echo "                    ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['poll_option'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 128
            echo "
                    <dl class=\"poll_total_votes";
            // line 129
            if ( !(isset($context["S_DISPLAY_RESULTS"]) ? $context["S_DISPLAY_RESULTS"] : null)) {
                echo " hidden";
            }
            echo "\">
                        <dt>&nbsp;</dt>
                        <dd class=\"resultbar\">";
            // line 131
            echo $this->env->getExtension('phpbb\template\twig\extension')->lang("TOTAL_VOTES");
            echo $this->env->getExtension('phpbb\template\twig\extension')->lang("COLON");
            echo " <span class=\"poll_total_vote_cnt\">";
            echo (isset($context["TOTAL_VOTES"]) ? $context["TOTAL_VOTES"] : null);
            echo "</span></dd>
                    </dl>

                    ";
            // line 134
            if ((isset($context["S_CAN_VOTE"]) ? $context["S_CAN_VOTE"] : null)) {
                // line 135
                echo "                    <dl style=\"border-top: none;\" class=\"poll_vote\">
                        <dt>&nbsp;</dt>
                        <dd class=\"resultbar\"><input type=\"submit\" name=\"update\" value=\"";
                // line 137
                echo $this->env->getExtension('phpbb\template\twig\extension')->lang("SUBMIT_VOTE");
                echo "\" class=\"button1\" /></dd>
                    </dl>
                    ";
            }
            // line 140
            echo "
                    ";
            // line 141
            if ( !(isset($context["S_DISPLAY_RESULTS"]) ? $context["S_DISPLAY_RESULTS"] : null)) {
                // line 142
                echo "                    <dl style=\"border-top: none;\" class=\"poll_view_results\">
                        <dt>&nbsp;</dt>
                        <dd class=\"resultbar\"><a href=\"";
                // line 144
                echo (isset($context["U_VIEW_RESULTS"]) ? $context["U_VIEW_RESULTS"] : null);
                echo "\">";
                echo $this->env->getExtension('phpbb\template\twig\extension')->lang("VIEW_RESULTS");
                echo "</a></dd>
                    </dl>
                    ";
            }
            // line 147
            echo "                </fieldset>
                <div class=\"vote-submitted hidden\">";
            // line 148
            echo $this->env->getExtension('phpbb\template\twig\extension')->lang("VOTE_SUBMITTED");
            echo "</div>
            </div>

        </div>
        ";
            // line 152
            echo (isset($context["S_FORM_TOKEN"]) ? $context["S_FORM_TOKEN"] : null);
            echo "
        ";
            // line 153
            echo (isset($context["S_HIDDEN_FIELDS"]) ? $context["S_HIDDEN_FIELDS"] : null);
            echo "
    </div>

</form>
<hr />
";
        }
        // line 159
        echo "
";
        // line 160
        // line 161
        echo "
";
        // line 162
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["loops"]) ? $context["loops"] : null), "postrow", array()));
        foreach ($context['_seq'] as $context["_key"] => $context["postrow"]) {
            // line 163
            // line 164
            if ($this->getAttribute($context["postrow"], "S_FIRST_UNREAD", array())) {
                // line 165
                echo "<a id=\"unread\" class=\"anchor\"";
                if ((isset($context["S_UNREAD_VIEW"]) ? $context["S_UNREAD_VIEW"] : null)) {
                    echo " data-url=\"";
                    echo $this->getAttribute($context["postrow"], "U_MINI_POST", array());
                    echo "\"";
                }
                echo "></a>
";
            }
            // line 167
            echo "<div id=\"p";
            echo $this->getAttribute($context["postrow"], "POST_ID", array());
            echo "\" class=\"post has-profile ";
            if (($this->getAttribute($context["postrow"], "S_ROW_COUNT", array()) % 2 == 1)) {
                echo "bg1";
            } else {
                echo "bg2";
            }
            if ($this->getAttribute($context["postrow"], "S_UNREAD_POST", array())) {
                echo " unreadpost";
            }
            if ($this->getAttribute($context["postrow"], "S_POST_REPORTED", array())) {
                echo " reported";
            }
            if ($this->getAttribute($context["postrow"], "S_POST_DELETED", array())) {
                echo " deleted";
            }
            if (($this->getAttribute($context["postrow"], "S_ONLINE", array()) &&  !$this->getAttribute($context["postrow"], "S_POST_HIDDEN", array()))) {
                echo " online";
            }
            if ($this->getAttribute($context["postrow"], "POSTER_WARNINGS", array())) {
                echo " warned";
            }
            echo "\">
    <div class=\"inner\">

        <dl class=\"postprofile\" id=\"profile";
            // line 170
            echo $this->getAttribute($context["postrow"], "POST_ID", array());
            echo "\"";
            if ($this->getAttribute($context["postrow"], "S_POST_HIDDEN", array())) {
                echo " style=\"display: none;\"";
            }
            echo ">
            <dt class=\"";
            // line 171
            if (($this->getAttribute($context["postrow"], "RANK_TITLE", array()) || $this->getAttribute($context["postrow"], "RANK_IMG", array()))) {
                echo "has-profile-rank";
            } else {
                echo "no-profile-rank";
            }
            echo " ";
            if ($this->getAttribute($context["postrow"], "POSTER_AVATAR", array())) {
                echo "has-avatar";
            } else {
                echo "no-avatar";
            }
            echo "\">
                <div class=\"avatar-container\">
                    ";
            // line 173
            // line 174
            echo "                    ";
            if ($this->getAttribute($context["postrow"], "POSTER_AVATAR", array())) {
                // line 175
                echo "                    ";
                if ($this->getAttribute($context["postrow"], "U_POST_AUTHOR", array())) {
                    echo "<a href=\"";
                    echo $this->getAttribute($context["postrow"], "U_POST_AUTHOR", array());
                    echo "\" class=\"avatar\">";
                    echo $this->getAttribute($context["postrow"], "POSTER_AVATAR", array());
                    echo "</a>";
                } else {
                    echo "<span class=\"avatar\">";
                    echo $this->getAttribute($context["postrow"], "POSTER_AVATAR", array());
                    echo "</span>";
                }
                // line 176
                echo "                    ";
            }
            // line 177
            echo "                    ";
            // line 178
            echo "                </div>
                ";
            // line 179
            // line 180
            echo "                ";
            if ( !$this->getAttribute($context["postrow"], "U_POST_AUTHOR", array())) {
                echo "<strong>";
                echo $this->getAttribute($context["postrow"], "POST_AUTHOR_FULL", array());
                echo "</strong>";
            } else {
                echo $this->getAttribute($context["postrow"], "POST_AUTHOR_FULL", array());
            }
            // line 181
            echo "                ";
            // line 182
            echo "            </dt>

            ";
            // line 184
            // line 185
            echo "            ";
            if (($this->getAttribute($context["postrow"], "RANK_TITLE", array()) || $this->getAttribute($context["postrow"], "RANK_IMG", array()))) {
                echo "<dd class=\"profile-rank\">";
                echo $this->getAttribute($context["postrow"], "RANK_TITLE", array());
                if (($this->getAttribute($context["postrow"], "RANK_TITLE", array()) && $this->getAttribute($context["postrow"], "RANK_IMG", array()))) {
                    echo "<br />";
                }
                echo $this->getAttribute($context["postrow"], "RANK_IMG", array());
                echo "</dd>";
            }
            // line 186
            echo "            ";
            // line 187
            echo "
            ";
            // line 188
            if (($this->getAttribute($context["postrow"], "POSTER_POSTS", array()) != "")) {
                echo "<dd class=\"profile-posts\"><strong>";
                echo $this->env->getExtension('phpbb\template\twig\extension')->lang("POSTS");
                echo $this->env->getExtension('phpbb\template\twig\extension')->lang("COLON");
                echo "</strong> ";
                if (($this->getAttribute($context["postrow"], "U_SEARCH", array()) !== "")) {
                    echo "<a href=\"";
                    echo $this->getAttribute($context["postrow"], "U_SEARCH", array());
                    echo "\">";
                }
                echo $this->getAttribute($context["postrow"], "POSTER_POSTS", array());
                if (($this->getAttribute($context["postrow"], "U_SEARCH", array()) !== "")) {
                    echo "</a>";
                }
                echo "</dd>";
            }
            // line 189
            echo "            ";
            if ($this->getAttribute($context["postrow"], "POSTER_JOINED", array())) {
                echo "<dd class=\"profile-joined\"><strong>";
                echo $this->env->getExtension('phpbb\template\twig\extension')->lang("JOINED");
                echo $this->env->getExtension('phpbb\template\twig\extension')->lang("COLON");
                echo "</strong> ";
                echo $this->getAttribute($context["postrow"], "POSTER_JOINED", array());
                echo "</dd>";
            }
            // line 190
            echo "            ";
            if ($this->getAttribute($context["postrow"], "POSTER_WARNINGS", array())) {
                echo "<dd class=\"profile-warnings\"><strong>";
                echo $this->env->getExtension('phpbb\template\twig\extension')->lang("WARNINGS");
                echo $this->env->getExtension('phpbb\template\twig\extension')->lang("COLON");
                echo "</strong> ";
                echo $this->getAttribute($context["postrow"], "POSTER_WARNINGS", array());
                echo "</dd>";
            }
            // line 191
            echo "
            ";
            // line 192
            if ($this->getAttribute($context["postrow"], "S_PROFILE_FIELD1", array())) {
                // line 193
                echo "            <!-- Use a construct like this to include admin defined profile fields. Replace FIELD1 with the name of your field. -->
            <dd><strong>";
                // line 194
                echo $this->getAttribute($context["postrow"], "PROFILE_FIELD1_NAME", array());
                echo $this->env->getExtension('phpbb\template\twig\extension')->lang("COLON");
                echo "</strong> ";
                echo $this->getAttribute($context["postrow"], "PROFILE_FIELD1_VALUE", array());
                echo "</dd>
            ";
            }
            // line 196
            echo "
            ";
            // line 197
            // line 198
            echo "            ";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute($context["postrow"], "custom_fields", array()));
            foreach ($context['_seq'] as $context["_key"] => $context["custom_fields"]) {
                // line 199
                echo "            ";
                if ( !$this->getAttribute($context["custom_fields"], "S_PROFILE_CONTACT", array())) {
                    // line 200
                    echo "            <dd class=\"profile-custom-field profile-";
                    echo $this->getAttribute($context["custom_fields"], "PROFILE_FIELD_IDENT", array());
                    echo "\"><strong>";
                    echo $this->getAttribute($context["custom_fields"], "PROFILE_FIELD_NAME", array());
                    echo $this->env->getExtension('phpbb\template\twig\extension')->lang("COLON");
                    echo "</strong> ";
                    echo $this->getAttribute($context["custom_fields"], "PROFILE_FIELD_VALUE", array());
                    echo "</dd>
            ";
                }
                // line 202
                echo "            ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['custom_fields'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 203
            echo "            ";
            // line 204
            echo "
            ";
            // line 205
            // line 206
            echo "            ";
            if (( !(isset($context["S_IS_BOT"]) ? $context["S_IS_BOT"] : null) && twig_length_filter($this->env, $this->getAttribute($context["postrow"], "contact", array())))) {
                // line 207
                echo "            <dd class=\"profile-contact\">
                <strong>";
                // line 208
                echo $this->env->getExtension('phpbb\template\twig\extension')->lang("CONTACT");
                echo $this->env->getExtension('phpbb\template\twig\extension')->lang("COLON");
                echo "</strong>
                <div class=\"dropdown-container dropdown-left\">
                    <a href=\"#\" class=\"dropdown-trigger\" title=\"";
                // line 210
                echo $this->getAttribute($context["postrow"], "CONTACT_USER", array());
                echo "\">
                        <i class=\"icon fa-commenting-o fa-fw icon-lg\" aria-hidden=\"true\"></i><span class=\"sr-only\">";
                // line 211
                echo $this->getAttribute($context["postrow"], "CONTACT_USER", array());
                echo "</span>
                    </a>
                    <div class=\"dropdown\">
                        <div class=\"pointer\"><div class=\"pointer-inner\"></div></div>
                        <div class=\"dropdown-contents contact-icons\">
                            ";
                // line 216
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable($this->getAttribute($context["postrow"], "contact", array()));
                foreach ($context['_seq'] as $context["_key"] => $context["contact"]) {
                    // line 217
                    echo "                            ";
                    $context["REMAINDER"] = ($this->getAttribute($context["contact"], "S_ROW_COUNT", array()) % 4);
                    // line 218
                    echo "                            ";
                    $value = (((isset($context["REMAINDER"]) ? $context["REMAINDER"] : null) == 3) || ($this->getAttribute($context["contact"], "S_LAST_ROW", array()) && ($this->getAttribute($context["contact"], "S_NUM_ROWS", array()) < 4)));
                    $context['definition']->set('S_LAST_CELL', $value);
                    // line 219
                    echo "                            ";
                    if (((isset($context["REMAINDER"]) ? $context["REMAINDER"] : null) == 0)) {
                        // line 220
                        echo "                            <div>
                                ";
                    }
                    // line 222
                    echo "                                <a href=\"";
                    if ($this->getAttribute($context["contact"], "U_CONTACT", array())) {
                        echo $this->getAttribute($context["contact"], "U_CONTACT", array());
                    } else {
                        echo $this->getAttribute($context["postrow"], "U_POST_AUTHOR", array());
                    }
                    echo "\" title=\"";
                    echo $this->getAttribute($context["contact"], "NAME", array());
                    echo "\"";
                    if ($this->getAttribute((isset($context["definition"]) ? $context["definition"] : null), "S_LAST_CELL", array())) {
                        echo " class=\"last-cell\"";
                    }
                    if (($this->getAttribute($context["contact"], "ID", array()) == "jabber")) {
                        echo " onclick=\"popup(this.href, 750, 320); return false;\"";
                    }
                    echo ">
                                   <span class=\"contact-icon ";
                    // line 223
                    echo $this->getAttribute($context["contact"], "ID", array());
                    echo "-icon\">";
                    echo $this->getAttribute($context["contact"], "NAME", array());
                    echo "</span>
                                </a>
                                ";
                    // line 225
                    if ((((isset($context["REMAINDER"]) ? $context["REMAINDER"] : null) == 3) || $this->getAttribute($context["contact"], "S_LAST_ROW", array()))) {
                        // line 226
                        echo "                            </div>
                            ";
                    }
                    // line 228
                    echo "                            ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['contact'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 229
                echo "                        </div>
                    </div>
                </div>
            </dd>
            ";
            }
            // line 234
            echo "            ";
            // line 235
            echo "
        </dl>

        <div class=\"postbody\">
            ";
            // line 239
            if ($this->getAttribute($context["postrow"], "S_POST_HIDDEN", array())) {
                // line 240
                echo "            ";
                if ($this->getAttribute($context["postrow"], "S_POST_DELETED", array())) {
                    // line 241
                    echo "            <div class=\"ignore\" id=\"post_hidden";
                    echo $this->getAttribute($context["postrow"], "POST_ID", array());
                    echo "\">
                ";
                    // line 242
                    echo $this->getAttribute($context["postrow"], "L_POST_DELETED_MESSAGE", array());
                    echo "<br />
                ";
                    // line 243
                    echo $this->getAttribute($context["postrow"], "L_POST_DISPLAY", array());
                    echo "
            </div>
            ";
                } elseif ($this->getAttribute(                // line 245
$context["postrow"], "S_IGNORE_POST", array())) {
                    // line 246
                    echo "            <div class=\"ignore\" id=\"post_hidden";
                    echo $this->getAttribute($context["postrow"], "POST_ID", array());
                    echo "\">
                ";
                    // line 247
                    echo $this->getAttribute($context["postrow"], "L_IGNORE_POST", array());
                    echo "<br />
                ";
                    // line 248
                    echo $this->getAttribute($context["postrow"], "L_POST_DISPLAY", array());
                    echo "
            </div>
            ";
                }
                // line 251
                echo "            ";
            }
            // line 252
            echo "            <div id=\"post_content";
            echo $this->getAttribute($context["postrow"], "POST_ID", array());
            echo "\"";
            if ($this->getAttribute($context["postrow"], "S_POST_HIDDEN", array())) {
                echo " style=\"display: none;\"";
            }
            echo ">

                 ";
            // line 254
            // line 255
            echo "                 <h3 ";
            if ($this->getAttribute($context["postrow"], "S_FIRST_ROW", array())) {
                echo "class=\"first\"";
            }
            echo ">";
            if ($this->getAttribute($context["postrow"], "POST_ICON_IMG", array())) {
                echo "<img src=\"";
                echo (isset($context["T_ICONS_PATH"]) ? $context["T_ICONS_PATH"] : null);
                echo $this->getAttribute($context["postrow"], "POST_ICON_IMG", array());
                echo "\" width=\"";
                echo $this->getAttribute($context["postrow"], "POST_ICON_IMG_WIDTH", array());
                echo "\" height=\"";
                echo $this->getAttribute($context["postrow"], "POST_ICON_IMG_HEIGHT", array());
                echo "\" alt=\"";
                echo $this->getAttribute($context["postrow"], "POST_ICON_IMG_ALT", array());
                echo "\" title=\"";
                echo $this->getAttribute($context["postrow"], "POST_ICON_IMG_ALT", array());
                echo "\" /> ";
            }
            echo "<a href=\"#p";
            echo $this->getAttribute($context["postrow"], "POST_ID", array());
            echo "\">";
            echo $this->getAttribute($context["postrow"], "POST_SUBJECT", array());
            echo "</a></h3>

                ";
            // line 257
            $value = ((((($this->getAttribute($context["postrow"], "U_EDIT", array()) || $this->getAttribute($context["postrow"], "U_DELETE", array())) || $this->getAttribute($context["postrow"], "U_REPORT", array())) || $this->getAttribute($context["postrow"], "U_WARN", array())) || $this->getAttribute($context["postrow"], "U_INFO", array())) || $this->getAttribute($context["postrow"], "U_QUOTE", array()));
            $context['definition']->set('SHOW_POST_BUTTONS', $value);
            // line 258
            echo "                ";
            // line 259
            echo "                ";
            if ( !(isset($context["S_IS_BOT"]) ? $context["S_IS_BOT"] : null)) {
                // line 260
                echo "                ";
                if ($this->getAttribute((isset($context["definition"]) ? $context["definition"] : null), "SHOW_POST_BUTTONS", array())) {
                    // line 261
                    echo "                <ul class=\"post-buttons\">
                    ";
                    // line 262
                    // line 263
                    echo "                    ";
                    if ($this->getAttribute($context["postrow"], "U_EDIT", array())) {
                        // line 264
                        echo "                    <li>
                        <a href=\"";
                        // line 265
                        echo $this->getAttribute($context["postrow"], "U_EDIT", array());
                        echo "\" title=\"";
                        echo $this->env->getExtension('phpbb\template\twig\extension')->lang("EDIT_POST");
                        echo "\" class=\"button button-icon-only\">
                            <i class=\"icon fa-pencil fa-fw\" aria-hidden=\"true\"></i><span class=\"sr-only\">";
                        // line 266
                        echo $this->env->getExtension('phpbb\template\twig\extension')->lang("BUTTON_EDIT");
                        echo "</span>
                        </a>
                    </li>
                    ";
                    }
                    // line 270
                    echo "                    ";
                    if ($this->getAttribute($context["postrow"], "U_DELETE", array())) {
                        // line 271
                        echo "                    <li>
                        <a href=\"";
                        // line 272
                        echo $this->getAttribute($context["postrow"], "U_DELETE", array());
                        echo "\" title=\"";
                        echo $this->env->getExtension('phpbb\template\twig\extension')->lang("DELETE_POST");
                        echo "\" class=\"button button-icon-only\">
                            <i class=\"icon fa-times fa-fw\" aria-hidden=\"true\"></i><span class=\"sr-only\">";
                        // line 273
                        echo $this->env->getExtension('phpbb\template\twig\extension')->lang("DELETE_POST");
                        echo "</span>
                        </a>
                    </li>
                    ";
                    }
                    // line 277
                    echo "                    ";
                    if ($this->getAttribute($context["postrow"], "U_REPORT", array())) {
                        // line 278
                        echo "                    <li>
                        <a href=\"";
                        // line 279
                        echo $this->getAttribute($context["postrow"], "U_REPORT", array());
                        echo "\" title=\"";
                        echo $this->env->getExtension('phpbb\template\twig\extension')->lang("REPORT_POST");
                        echo "\" class=\"button button-icon-only\">
                            <i class=\"icon fa-exclamation fa-fw\" aria-hidden=\"true\"></i><span class=\"sr-only\">";
                        // line 280
                        echo $this->env->getExtension('phpbb\template\twig\extension')->lang("REPORT_POST");
                        echo "</span>
                        </a>
                    </li>
                    ";
                    }
                    // line 284
                    echo "                    ";
                    if ($this->getAttribute($context["postrow"], "U_WARN", array())) {
                        // line 285
                        echo "                    <li>
                        <a href=\"";
                        // line 286
                        echo $this->getAttribute($context["postrow"], "U_WARN", array());
                        echo "\" title=\"";
                        echo $this->env->getExtension('phpbb\template\twig\extension')->lang("WARN_USER");
                        echo "\" class=\"button button-icon-only\">
                            <i class=\"icon fa-exclamation-triangle fa-fw\" aria-hidden=\"true\"></i><span class=\"sr-only\">";
                        // line 287
                        echo $this->env->getExtension('phpbb\template\twig\extension')->lang("WARN_USER");
                        echo "</span>
                        </a>
                    </li>
                    ";
                    }
                    // line 291
                    echo "                    ";
                    if ($this->getAttribute($context["postrow"], "U_INFO", array())) {
                        // line 292
                        echo "                    <li>
                        <a href=\"";
                        // line 293
                        echo $this->getAttribute($context["postrow"], "U_INFO", array());
                        echo "\" title=\"";
                        echo $this->env->getExtension('phpbb\template\twig\extension')->lang("INFORMATION");
                        echo "\" class=\"button button-icon-only\">
                            <i class=\"icon fa-info fa-fw\" aria-hidden=\"true\"></i><span class=\"sr-only\">";
                        // line 294
                        echo $this->env->getExtension('phpbb\template\twig\extension')->lang("INFORMATION");
                        echo "</span>
                        </a>
                    </li>
                    ";
                    }
                    // line 298
                    echo "                    ";
                    if ($this->getAttribute($context["postrow"], "U_QUOTE", array())) {
                        // line 299
                        echo "                    <li>
                        <a href=\"";
                        // line 300
                        echo $this->getAttribute($context["postrow"], "U_QUOTE", array());
                        echo "\" title=\"";
                        echo $this->env->getExtension('phpbb\template\twig\extension')->lang("REPLY_WITH_QUOTE");
                        echo "\" class=\"button button-icon-only\">
                            <i class=\"icon fa-quote-left fa-fw\" aria-hidden=\"true\"></i><span class=\"sr-only\">";
                        // line 301
                        echo $this->env->getExtension('phpbb\template\twig\extension')->lang("QUOTE");
                        echo "</span>
                        </a>
                    </li>
                    ";
                    }
                    // line 305
                    echo "                    ";
                    // line 306
                    echo "                </ul>
                ";
                }
                // line 308
                echo "                ";
            }
            // line 309
            echo "                ";
            // line 310
            echo "
                ";
            // line 311
            // line 312
            echo "                <p class=\"author\">
                    ";
            // line 313
            if ((isset($context["S_IS_BOT"]) ? $context["S_IS_BOT"] : null)) {
                // line 314
                echo "                    <span><i class=\"icon fa-file fa-fw ";
                if ($this->getAttribute($context["postrow"], "S_UNREAD_POST", array())) {
                    echo "icon-red";
                } else {
                    echo "icon-lightgray";
                }
                echo " icon-md\" aria-hidden=\"true\"></i><span class=\"sr-only\">";
                echo $this->getAttribute($context["postrow"], "MINI_POST", array());
                echo "</span></span>
                    ";
            } else {
                // line 316
                echo "                    <a class=\"unread\" href=\"";
                echo $this->getAttribute($context["postrow"], "U_MINI_POST", array());
                echo "\" title=\"";
                echo $this->getAttribute($context["postrow"], "MINI_POST", array());
                echo "\">
                        <i class=\"icon fa-file fa-fw ";
                // line 317
                if ($this->getAttribute($context["postrow"], "S_UNREAD_POST", array())) {
                    echo "icon-red";
                } else {
                    echo "icon-lightgray";
                }
                echo " icon-md\" aria-hidden=\"true\"></i><span class=\"sr-only\">";
                echo $this->getAttribute($context["postrow"], "MINI_POST", array());
                echo "</span>
                    </a>
                    ";
            }
            // line 320
            echo "                    <span class=\"responsive-hide\">";
            echo $this->env->getExtension('phpbb\template\twig\extension')->lang("POST_BY_AUTHOR");
            echo " <strong>";
            echo $this->getAttribute($context["postrow"], "POST_AUTHOR_FULL", array());
            echo "</strong> &raquo; </span>";
            echo $this->getAttribute($context["postrow"], "POST_DATE", array());
            echo "
                </p>
                ";
            // line 322
            // line 323
            echo "
                ";
            // line 324
            if ($this->getAttribute($context["postrow"], "S_POST_UNAPPROVED", array())) {
                // line 325
                echo "                <form method=\"post\" class=\"mcp_approve\" action=\"";
                echo $this->getAttribute($context["postrow"], "U_APPROVE_ACTION", array());
                echo "\">
                    <p class=\"post-notice unapproved\">
                        <span><i class=\"icon fa-question icon-red fa-fw\" aria-hidden=\"true\"></i></span>
                        <strong>";
                // line 328
                echo $this->env->getExtension('phpbb\template\twig\extension')->lang("POST_UNAPPROVED_ACTION");
                echo "</strong>
                        <input class=\"button2\" type=\"submit\" value=\"";
                // line 329
                echo $this->env->getExtension('phpbb\template\twig\extension')->lang("DISAPPROVE");
                echo "\" name=\"action[disapprove]\" />
                        <input class=\"button1\" type=\"submit\" value=\"";
                // line 330
                echo $this->env->getExtension('phpbb\template\twig\extension')->lang("APPROVE");
                echo "\" name=\"action[approve]\" />
                        <input type=\"hidden\" name=\"post_id_list[]\" value=\"";
                // line 331
                echo $this->getAttribute($context["postrow"], "POST_ID", array());
                echo "\" />
                        ";
                // line 332
                echo (isset($context["S_FORM_TOKEN"]) ? $context["S_FORM_TOKEN"] : null);
                echo "
                    </p>
                </form>
                ";
            } elseif ($this->getAttribute(            // line 335
$context["postrow"], "S_POST_DELETED", array())) {
                // line 336
                echo "                <form method=\"post\" class=\"mcp_approve\" action=\"";
                echo $this->getAttribute($context["postrow"], "U_APPROVE_ACTION", array());
                echo "\">
                    <p class=\"post-notice deleted\">
                        <strong>";
                // line 338
                echo $this->env->getExtension('phpbb\template\twig\extension')->lang("POST_DELETED_ACTION");
                echo "</strong>
                        ";
                // line 339
                if ($this->getAttribute($context["postrow"], "S_DELETE_PERMANENT", array())) {
                    // line 340
                    echo "                        <input class=\"button2\" type=\"submit\" value=\"";
                    echo $this->env->getExtension('phpbb\template\twig\extension')->lang("DELETE");
                    echo "\" name=\"action[delete]\" />
                        ";
                }
                // line 342
                echo "                        <input class=\"button1\" type=\"submit\" value=\"";
                echo $this->env->getExtension('phpbb\template\twig\extension')->lang("RESTORE");
                echo "\" name=\"action[restore]\" />
                        <input type=\"hidden\" name=\"post_id_list[]\" value=\"";
                // line 343
                echo $this->getAttribute($context["postrow"], "POST_ID", array());
                echo "\" />
                        ";
                // line 344
                echo (isset($context["S_FORM_TOKEN"]) ? $context["S_FORM_TOKEN"] : null);
                echo "
                    </p>
                </form>
                ";
            }
            // line 348
            echo "
                ";
            // line 349
            if ($this->getAttribute($context["postrow"], "S_POST_REPORTED", array())) {
                // line 350
                echo "                <p class=\"post-notice reported\">
                    <a href=\"";
                // line 351
                echo $this->getAttribute($context["postrow"], "U_MCP_REPORT", array());
                echo "\"><i class=\"icon fa-exclamation fa-fw icon-red\" aria-hidden=\"true\"></i><strong>";
                echo $this->env->getExtension('phpbb\template\twig\extension')->lang("POST_REPORTED");
                echo "</strong></a>
                </p>
                ";
            }
            // line 354
            echo "
                <div class=\"content\">";
            // line 355
            echo $this->getAttribute($context["postrow"], "MESSAGE", array());
            echo "</div>

                ";
            // line 357
            if ($this->getAttribute($context["postrow"], "S_HAS_ATTACHMENTS", array())) {
                // line 358
                echo "                <dl class=\"attachbox\">
                    <dt>
                        ";
                // line 360
                echo $this->env->getExtension('phpbb\template\twig\extension')->lang("ATTACHMENTS");
                echo "
                    </dt>
                    ";
                // line 362
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable($this->getAttribute($context["postrow"], "attachment", array()));
                foreach ($context['_seq'] as $context["_key"] => $context["attachment"]) {
                    // line 363
                    echo "                    <dd>";
                    echo $this->getAttribute($context["attachment"], "DISPLAY_ATTACHMENT", array());
                    echo "</dd>
                    ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['attachment'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 365
                echo "                </dl>
                ";
            }
            // line 367
            echo "
                ";
            // line 368
            // line 369
            echo "                ";
            if ($this->getAttribute($context["postrow"], "S_DISPLAY_NOTICE", array())) {
                echo "<div class=\"rules\">";
                echo $this->env->getExtension('phpbb\template\twig\extension')->lang("DOWNLOAD_NOTICE");
                echo "</div>";
            }
            // line 370
            echo "                ";
            if (($this->getAttribute($context["postrow"], "DELETED_MESSAGE", array()) || $this->getAttribute($context["postrow"], "DELETE_REASON", array()))) {
                // line 371
                echo "                <div class=\"notice post_deleted_msg\">
                    ";
                // line 372
                echo $this->getAttribute($context["postrow"], "DELETED_MESSAGE", array());
                echo "
                    ";
                // line 373
                if ($this->getAttribute($context["postrow"], "DELETE_REASON", array())) {
                    echo "<br /><strong>";
                    echo $this->env->getExtension('phpbb\template\twig\extension')->lang("REASON");
                    echo $this->env->getExtension('phpbb\template\twig\extension')->lang("COLON");
                    echo "</strong> <em>";
                    echo $this->getAttribute($context["postrow"], "DELETE_REASON", array());
                    echo "</em>";
                }
                // line 374
                echo "                </div>
                ";
            } elseif (($this->getAttribute(            // line 375
$context["postrow"], "EDITED_MESSAGE", array()) || $this->getAttribute($context["postrow"], "EDIT_REASON", array()))) {
                // line 376
                echo "                <div class=\"notice\">
                    ";
                // line 377
                echo $this->getAttribute($context["postrow"], "EDITED_MESSAGE", array());
                echo "
                    ";
                // line 378
                if ($this->getAttribute($context["postrow"], "EDIT_REASON", array())) {
                    echo "<br /><strong>";
                    echo $this->env->getExtension('phpbb\template\twig\extension')->lang("REASON");
                    echo $this->env->getExtension('phpbb\template\twig\extension')->lang("COLON");
                    echo "</strong> <em>";
                    echo $this->getAttribute($context["postrow"], "EDIT_REASON", array());
                    echo "</em>";
                }
                // line 379
                echo "                </div>
                ";
            }
            // line 381
            echo "
                ";
            // line 382
            if ($this->getAttribute($context["postrow"], "BUMPED_MESSAGE", array())) {
                echo "<div class=\"notice\"><br /><br />";
                echo $this->getAttribute($context["postrow"], "BUMPED_MESSAGE", array());
                echo "</div>";
            }
            // line 383
            echo "                ";
            // line 384
            echo "                ";
            if ($this->getAttribute($context["postrow"], "SIGNATURE", array())) {
                echo "<div id=\"sig";
                echo $this->getAttribute($context["postrow"], "POST_ID", array());
                echo "\" class=\"signature\">";
                echo $this->getAttribute($context["postrow"], "SIGNATURE", array());
                echo "</div>";
            }
            // line 385
            echo "
                ";
            // line 386
            // line 387
            echo "            </div>

        </div>

        ";
            // line 391
            // line 392
            echo "        <div class=\"back2top\">
            ";
            // line 393
            // line 394
            echo "            <a href=\"#top\" class=\"top\" title=\"";
            echo $this->env->getExtension('phpbb\template\twig\extension')->lang("BACK_TO_TOP");
            echo "\">
                <i class=\"icon fa-chevron-circle-up fa-fw icon-gray\" aria-hidden=\"true\"></i>
                <span class=\"sr-only\">";
            // line 396
            echo $this->env->getExtension('phpbb\template\twig\extension')->lang("BACK_TO_TOP");
            echo "</span>
            </a>
            ";
            // line 398
            // line 399
            echo "        </div>
        ";
            // line 400
            // line 401
            echo "
    </div>
</div>

<hr class=\"divider\" />
";
            // line 406
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['postrow'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 408
        echo "
";
        // line 409
        if ((isset($context["S_QUICK_REPLY"]) ? $context["S_QUICK_REPLY"] : null)) {
            // line 410
            $location = "quickreply_editor.html";
            $namespace = false;
            if (strpos($location, '@') === 0) {
                $namespace = substr($location, 1, strpos($location, '/') - 1);
                $previous_look_up_order = $this->env->getNamespaceLookUpOrder();
                $this->env->setNamespaceLookUpOrder(array($namespace, '__main__'));
            }
            $this->loadTemplate("quickreply_editor.html", "viewtopic_body.html", 410)->display($context);
            if ($namespace) {
                $this->env->setNamespaceLookUpOrder($previous_look_up_order);
            }
        }
        // line 412
        echo "
";
        // line 413
        // line 414
        echo "<div class=\"action-bar bar-bottom\">
    ";
        // line 415
        // line 416
        echo "
    ";
        // line 417
        if (( !(isset($context["S_IS_BOT"]) ? $context["S_IS_BOT"] : null) && (isset($context["S_DISPLAY_REPLY_INFO"]) ? $context["S_DISPLAY_REPLY_INFO"] : null))) {
            // line 418
            echo "    <a href=\"";
            echo (isset($context["U_POST_REPLY_TOPIC"]) ? $context["U_POST_REPLY_TOPIC"] : null);
            echo "\" class=\"button\" title=\"";
            if ((isset($context["S_IS_LOCKED"]) ? $context["S_IS_LOCKED"] : null)) {
                echo $this->env->getExtension('phpbb\template\twig\extension')->lang("TOPIC_LOCKED");
            } else {
                echo $this->env->getExtension('phpbb\template\twig\extension')->lang("POST_REPLY");
            }
            echo "\">
        ";
            // line 419
            if ((isset($context["S_IS_LOCKED"]) ? $context["S_IS_LOCKED"] : null)) {
                // line 420
                echo "        <span>";
                echo $this->env->getExtension('phpbb\template\twig\extension')->lang("BUTTON_TOPIC_LOCKED");
                echo "</span> <i class=\"icon fa-lock fa-fw\" aria-hidden=\"true\"></i>
        ";
            } else {
                // line 422
                echo "        <span>";
                echo $this->env->getExtension('phpbb\template\twig\extension')->lang("BUTTON_POST_REPLY");
                echo "</span> <i class=\"icon fa-reply fa-fw\" aria-hidden=\"true\"></i>
        ";
            }
            // line 424
            echo "    </a>
    ";
        }
        // line 426
        echo "    ";
        // line 427
        echo "
    ";
        // line 428
        $location = "viewtopic_topic_tools.html";
        $namespace = false;
        if (strpos($location, '@') === 0) {
            $namespace = substr($location, 1, strpos($location, '/') - 1);
            $previous_look_up_order = $this->env->getNamespaceLookUpOrder();
            $this->env->setNamespaceLookUpOrder(array($namespace, '__main__'));
        }
        $this->loadTemplate("viewtopic_topic_tools.html", "viewtopic_body.html", 428)->display($context);
        if ($namespace) {
            $this->env->setNamespaceLookUpOrder($previous_look_up_order);
        }
        // line 429
        echo "
    ";
        // line 430
        if (((((isset($context["S_NUM_POSTS"]) ? $context["S_NUM_POSTS"] : null) > 1) || twig_length_filter($this->env, $this->getAttribute((isset($context["loops"]) ? $context["loops"] : null), "pagination", array()))) &&  !(isset($context["S_IS_BOT"]) ? $context["S_IS_BOT"] : null))) {
            // line 431
            echo "    <form method=\"post\" action=\"";
            echo (isset($context["S_TOPIC_ACTION"]) ? $context["S_TOPIC_ACTION"] : null);
            echo "\">
        ";
            // line 432
            $location = "display_options.html";
            $namespace = false;
            if (strpos($location, '@') === 0) {
                $namespace = substr($location, 1, strpos($location, '/') - 1);
                $previous_look_up_order = $this->env->getNamespaceLookUpOrder();
                $this->env->setNamespaceLookUpOrder(array($namespace, '__main__'));
            }
            $this->loadTemplate("display_options.html", "viewtopic_body.html", 432)->display($context);
            if ($namespace) {
                $this->env->setNamespaceLookUpOrder($previous_look_up_order);
            }
            // line 433
            echo "    </form>
    ";
        }
        // line 435
        echo "
    ";
        // line 436
        if (twig_length_filter($this->env, $this->getAttribute((isset($context["loops"]) ? $context["loops"] : null), "quickmod", array()))) {
            // line 437
            echo "    <div class=\"quickmod dropdown-container dropdown-container-left dropdown-up dropdown-";
            echo (isset($context["S_CONTENT_FLOW_END"]) ? $context["S_CONTENT_FLOW_END"] : null);
            echo " dropdown-button-control\" id=\"quickmod\">
        <span title=\"";
            // line 438
            echo $this->env->getExtension('phpbb\template\twig\extension')->lang("QUICK_MOD");
            echo "\" class=\"button button-secondary dropdown-trigger dropdown-select\">
            <i class=\"icon fa-gavel fa-fw\" aria-hidden=\"true\"></i><span class=\"sr-only\">";
            // line 439
            echo $this->env->getExtension('phpbb\template\twig\extension')->lang("QUICK_MOD");
            echo "</span>
            <span class=\"caret\"><i class=\"icon fa-sort-down fa-fw\" aria-hidden=\"true\"></i></span>
        </span>
        <div class=\"dropdown\">
            <div class=\"pointer\"><div class=\"pointer-inner\"></div></div>
            <ul class=\"dropdown-contents\">
                ";
            // line 445
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["loops"]) ? $context["loops"] : null), "quickmod", array()));
            foreach ($context['_seq'] as $context["_key"] => $context["quickmod"]) {
                // line 446
                echo "                ";
                $value = twig_in_filter($this->getAttribute($context["quickmod"], "VALUE", array()), array(0 => "lock", 1 => "unlock", 2 => "delete_topic", 3 => "restore_topic", 4 => "make_normal", 5 => "make_sticky", 6 => "make_announce", 7 => "make_global"));
                $context['definition']->set('QUICKMOD_AJAX', $value);
                // line 447
                echo "                <li><a href=\"";
                echo $this->getAttribute($context["quickmod"], "LINK", array());
                echo "\"";
                if ($this->getAttribute((isset($context["definition"]) ? $context["definition"] : null), "QUICKMOD_AJAX", array())) {
                    echo " data-ajax=\"true\" data-refresh=\"true\"";
                }
                echo ">";
                echo $this->getAttribute($context["quickmod"], "TITLE", array());
                echo "</a></li>
                ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['quickmod'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 449
            echo "            </ul>
        </div>
    </div>
    ";
        }
        // line 453
        echo "
    ";
        // line 454
        // line 455
        echo "
    ";
        // line 456
        if ((twig_length_filter($this->env, $this->getAttribute((isset($context["loops"]) ? $context["loops"] : null), "pagination", array())) || (isset($context["TOTAL_POSTS"]) ? $context["TOTAL_POSTS"] : null))) {
            // line 457
            echo "    <div class=\"pagination\">
        ";
            // line 458
            echo (isset($context["TOTAL_POSTS"]) ? $context["TOTAL_POSTS"] : null);
            echo "
        ";
            // line 459
            if (twig_length_filter($this->env, $this->getAttribute((isset($context["loops"]) ? $context["loops"] : null), "pagination", array()))) {
                // line 460
                echo "        ";
                $location = "pagination.html";
                $namespace = false;
                if (strpos($location, '@') === 0) {
                    $namespace = substr($location, 1, strpos($location, '/') - 1);
                    $previous_look_up_order = $this->env->getNamespaceLookUpOrder();
                    $this->env->setNamespaceLookUpOrder(array($namespace, '__main__'));
                }
                $this->loadTemplate("pagination.html", "viewtopic_body.html", 460)->display($context);
                if ($namespace) {
                    $this->env->setNamespaceLookUpOrder($previous_look_up_order);
                }
                // line 461
                echo "        ";
            } else {
                // line 462
                echo "        &bull; ";
                echo (isset($context["PAGE_NUMBER"]) ? $context["PAGE_NUMBER"] : null);
                echo "
        ";
            }
            // line 464
            echo "    </div>
    ";
        }
        // line 466
        echo "</div>

";
        // line 468
        // line 469
        $location = "jumpbox.html";
        $namespace = false;
        if (strpos($location, '@') === 0) {
            $namespace = substr($location, 1, strpos($location, '/') - 1);
            $previous_look_up_order = $this->env->getNamespaceLookUpOrder();
            $this->env->setNamespaceLookUpOrder(array($namespace, '__main__'));
        }
        $this->loadTemplate("jumpbox.html", "viewtopic_body.html", 469)->display($context);
        if ($namespace) {
            $this->env->setNamespaceLookUpOrder($previous_look_up_order);
        }
        // line 470
        echo "
";
        // line 471
        if (((isset($context["S_DISPLAY_ONLINE_LIST"]) ? $context["S_DISPLAY_ONLINE_LIST"] : null) && (isset($context["U_VIEWONLINE"]) ? $context["U_VIEWONLINE"] : null))) {
            // line 472
            echo "<div class=\"stat-block online-list\">
    <h3><a href=\"";
            // line 473
            echo (isset($context["U_VIEWONLINE"]) ? $context["U_VIEWONLINE"] : null);
            echo "\">";
            echo $this->env->getExtension('phpbb\template\twig\extension')->lang("WHO_IS_ONLINE");
            echo "</a></h3>
    <p>";
            // line 474
            echo (isset($context["LOGGED_IN_USER_LIST"]) ? $context["LOGGED_IN_USER_LIST"] : null);
            echo "</p>
</div>
";
        }
        // line 477
        echo "
";
        // line 478
        $location = "overall_footer.html";
        $namespace = false;
        if (strpos($location, '@') === 0) {
            $namespace = substr($location, 1, strpos($location, '/') - 1);
            $previous_look_up_order = $this->env->getNamespaceLookUpOrder();
            $this->env->setNamespaceLookUpOrder(array($namespace, '__main__'));
        }
        $this->loadTemplate("overall_footer.html", "viewtopic_body.html", 478)->display($context);
        if ($namespace) {
            $this->env->setNamespaceLookUpOrder($previous_look_up_order);
        }
    }

    public function getTemplateName()
    {
        return "viewtopic_body.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  1597 => 478,  1594 => 477,  1588 => 474,  1582 => 473,  1579 => 472,  1577 => 471,  1574 => 470,  1562 => 469,  1561 => 468,  1557 => 466,  1553 => 464,  1547 => 462,  1544 => 461,  1531 => 460,  1529 => 459,  1525 => 458,  1522 => 457,  1520 => 456,  1517 => 455,  1516 => 454,  1513 => 453,  1507 => 449,  1492 => 447,  1488 => 446,  1484 => 445,  1475 => 439,  1471 => 438,  1466 => 437,  1464 => 436,  1461 => 435,  1457 => 433,  1445 => 432,  1440 => 431,  1438 => 430,  1435 => 429,  1423 => 428,  1420 => 427,  1418 => 426,  1414 => 424,  1408 => 422,  1402 => 420,  1400 => 419,  1389 => 418,  1387 => 417,  1384 => 416,  1383 => 415,  1380 => 414,  1379 => 413,  1376 => 412,  1363 => 410,  1361 => 409,  1358 => 408,  1353 => 406,  1346 => 401,  1345 => 400,  1342 => 399,  1341 => 398,  1336 => 396,  1330 => 394,  1329 => 393,  1326 => 392,  1325 => 391,  1319 => 387,  1318 => 386,  1315 => 385,  1306 => 384,  1304 => 383,  1298 => 382,  1295 => 381,  1291 => 379,  1282 => 378,  1278 => 377,  1275 => 376,  1273 => 375,  1270 => 374,  1261 => 373,  1257 => 372,  1254 => 371,  1251 => 370,  1244 => 369,  1243 => 368,  1240 => 367,  1236 => 365,  1227 => 363,  1223 => 362,  1218 => 360,  1214 => 358,  1212 => 357,  1207 => 355,  1204 => 354,  1196 => 351,  1193 => 350,  1191 => 349,  1188 => 348,  1181 => 344,  1177 => 343,  1172 => 342,  1166 => 340,  1164 => 339,  1160 => 338,  1154 => 336,  1152 => 335,  1146 => 332,  1142 => 331,  1138 => 330,  1134 => 329,  1130 => 328,  1123 => 325,  1121 => 324,  1118 => 323,  1117 => 322,  1107 => 320,  1095 => 317,  1088 => 316,  1076 => 314,  1074 => 313,  1071 => 312,  1070 => 311,  1067 => 310,  1065 => 309,  1062 => 308,  1058 => 306,  1056 => 305,  1049 => 301,  1043 => 300,  1040 => 299,  1037 => 298,  1030 => 294,  1024 => 293,  1021 => 292,  1018 => 291,  1011 => 287,  1005 => 286,  1002 => 285,  999 => 284,  992 => 280,  986 => 279,  983 => 278,  980 => 277,  973 => 273,  967 => 272,  964 => 271,  961 => 270,  954 => 266,  948 => 265,  945 => 264,  942 => 263,  941 => 262,  938 => 261,  935 => 260,  932 => 259,  930 => 258,  927 => 257,  900 => 255,  899 => 254,  889 => 252,  886 => 251,  880 => 248,  876 => 247,  871 => 246,  869 => 245,  864 => 243,  860 => 242,  855 => 241,  852 => 240,  850 => 239,  844 => 235,  842 => 234,  835 => 229,  829 => 228,  825 => 226,  823 => 225,  816 => 223,  798 => 222,  794 => 220,  791 => 219,  787 => 218,  784 => 217,  780 => 216,  772 => 211,  768 => 210,  762 => 208,  759 => 207,  756 => 206,  755 => 205,  752 => 204,  750 => 203,  744 => 202,  733 => 200,  730 => 199,  725 => 198,  724 => 197,  721 => 196,  713 => 194,  710 => 193,  708 => 192,  705 => 191,  695 => 190,  685 => 189,  668 => 188,  665 => 187,  663 => 186,  652 => 185,  651 => 184,  647 => 182,  645 => 181,  636 => 180,  635 => 179,  632 => 178,  630 => 177,  627 => 176,  614 => 175,  611 => 174,  610 => 173,  595 => 171,  587 => 170,  559 => 167,  549 => 165,  547 => 164,  546 => 163,  542 => 162,  539 => 161,  538 => 160,  535 => 159,  526 => 153,  522 => 152,  515 => 148,  512 => 147,  504 => 144,  500 => 142,  498 => 141,  495 => 140,  489 => 137,  485 => 135,  483 => 134,  474 => 131,  467 => 129,  464 => 128,  458 => 127,  457 => 126,  444 => 124,  421 => 123,  395 => 122,  383 => 121,  363 => 120,  361 => 119,  357 => 118,  343 => 115,  339 => 114,  329 => 108,  327 => 107,  324 => 106,  323 => 105,  319 => 103,  317 => 102,  313 => 100,  307 => 98,  304 => 97,  291 => 96,  289 => 95,  278 => 94,  275 => 93,  273 => 92,  270 => 91,  262 => 86,  257 => 84,  251 => 83,  246 => 81,  242 => 80,  238 => 79,  233 => 77,  230 => 76,  228 => 75,  225 => 74,  223 => 73,  210 => 72,  209 => 71,  206 => 70,  202 => 68,  196 => 66,  190 => 64,  188 => 63,  177 => 62,  175 => 61,  172 => 60,  171 => 59,  167 => 57,  161 => 53,  156 => 51,  151 => 50,  143 => 48,  141 => 47,  132 => 44,  130 => 43,  127 => 42,  114 => 39,  111 => 38,  109 => 37,  106 => 36,  100 => 35,  97 => 34,  96 => 33,  92 => 31,  79 => 24,  75 => 23,  71 => 22,  67 => 21,  58 => 15,  51 => 11,  46 => 8,  42 => 7,  35 => 4,  34 => 3,  31 => 2,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "viewtopic_body.html", "");
    }
}
