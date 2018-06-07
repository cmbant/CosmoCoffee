<?php

define('IN_PHPBB', true);

$phpbb_root_path = (defined('PHPBB_ROOT_PATH')) ? PHPBB_ROOT_PATH : './';
$phpEx = substr(strrchr(__FILE__, '.'), 1);
include($phpbb_root_path . 'common.' . $phpEx);

include($phpbb_root_path . 'includes/bbcode.' . $phpEx); //////////////////////////////////////////////

anti_hack($phpEx);

$user->session_begin();
$auth->acl($user->data);
$user->setup();
$user->get_profile_fields($user->data['user_id']);

$inner_page_title = null;
$text = '';
$bibtex = '';
$bib = '';
$ads_fields = array();
$joint = 0;

$arxiv = $request->variable('arxiv', '');
//$arxiv = 'astro-ph/0412276';


$text .= get_BibTex_form_html();

if (!empty($arxiv)) {    
    $inner_page_title = "BibTex for $arxiv";
    
    $SPIRES_url = 'http://inspirehep.net/search?action_search=Search&of=hx&p=FIND+EPRINT+' . $arxiv;
    $html = get_url($SPIRES_url);

    if (preg_match('#<pre>(.*?)</pre>#s', $html, $txt)) {
        $bibtex = $txt[1];
    }

    $ads_url = 'http://adsabs.harvard.edu/cgi-bin/bib_query?arXiv:' . $arxiv;
    $html = get_url($ads_url);

    if (preg_match('#(http:.*?nph\-bib_query.bibcode.*?)\"#', $html, $key)) {
        
        $url2 = str_replace('&amp;', '&', $key[1]);
        $html = get_url($url2);

        if (preg_match('#(\@[a-zA-Z]*)(.*)#s', $html, $ads_bib)) {
            $ads_tag = $ads_bib[1];
            $ads_bib = $ads_bib[0];
        } else
            $ads_bib = '';
        
        $match_count = preg_match_all("#([a-z]+?) = (.*?)(,\n|\n)#is", $html, $matches);

        for ($i = 0; $i < $match_count; $i++) {
            $ads_fields[$matches[1][$i]] = $matches[2][$i];
        }
    }

    $bib = $bibtex;    

    if (!preg_match('#ArXiv#s', $ads_bib) && !preg_match('#journal#s', $bibtex)) {

        if (preg_match('#(\@[a-zA-Z]*)(.*?author.*?=.*?title.*?=.*?,).*?(     eprint.*?=..*?,.*?SLACcitation.*?=.*?\".*?\")#s', $bibtex, $t)) {
            $joint = 1;
            $bib = $ads_tag . $t[2] . "\n";
            $bib .= add_field('booktitle', $ads_fields);
            $bib .= add_field('journal', $ads_fields);
            $bib .= add_field('year', $ads_fields);
            $bib .= add_field('month', $ads_fields);
            $bib .= add_field('volume', $ads_fields);
            $bib .= add_field('pages', $ads_fields);
            $bib .= add_field('doi', $ads_fields);
            $bib .= $t[3] . "\n}";
        }
    }

    if ($joint) {
        $text .= '<span class="gen">BEST: <pre>' . $bib . '</pre></span>';
    }
    
    $text .= '<hr>';
    $text .= '<span class="gen"><A HREF="' . $SPIRES_url . '">inSPIRE</A>: <pre>' . $bibtex . '</pre></span>';
    $text .= '<span class="gen"><A HREF="' . $ads_url . '">ADS</A>: <pre>' . $ads_bib . '</pre></span>';
}

$text .= '<hr><p align="center" class="gen">Modified BibTex files for including arxiv eprint references in many paper styles are available <A HREF="http://arxiv.org/hypertex/bibstyles">here</A>; see also <A HREf="/viewtopic.php?t=304">this post</A>.</p>';


page_header('Arxiv BibTex');
$template->set_filenames(array(
    'body' => 'message_body.html',
));

$template->assign_vars(array(
    'MESSAGE_TEXT'	=> $text,
    'MESSAGE_TITLE'	=> $inner_page_title
));

make_jumpbox(append_sid("{$phpbb_root_path}viewforum.$phpEx"));
page_footer();


function get_BibTex_form_html() {
    global $request;
    return '<center>
                <form method="get" action="' . $request->server('SCRIPT_NAME') . '" TARGET="_top">
                    <span class="gen">Get BibTex for Arxiv ref: </span>
                    <input class="post" type="text" name="arxiv" size="18" maxlength="40" value="">  
                    <input type="submit" value="Go" class="button">
                </form>
            </center>';    
}

function add_field($name, $ads_fields) {
    $field = '';
    
    if (!empty($ads_fields[$name])) {
        $field = '     ' . sprintf('%-9s', $name) . " = " . $ads_fields[$name] . ",\n";
    }    
    
    return $field;
}

