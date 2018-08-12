<?php

define('IN_PHPBB', true);

$phpbb_root_path = (defined('PHPBB_ROOT_PATH')) ? PHPBB_ROOT_PATH : './';
$phpEx = substr(strrchr(__FILE__, '.'), 1);
include($phpbb_root_path . 'common.' . $phpEx);

include($phpbb_root_path . 'includes/bbcode.' . $phpEx); //////////////////////////////////////////////

anti_hack($phpEx);

$inner_page_title = null;
$text = '';
$bibtex = '';
$bib = '';
$ads_fields = array();
$joint = 0;

$arxiv = $request->variable('arxiv', '');
//$arxiv = '1807.06210';

$ads_key='NBqUzF2r6UOleFEdoEypeCFKKuayVj7nsEpgna4V';

function get_data($url) {
  global $ads_key;
         $ch = curl_init();
             $timeout = 5;
              curl_setopt($ch, CURLOPT_URL, $url);
               curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
                        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                            'Authorization: Bearer '.$ads_key
                                ));
       $data = curl_exec($ch);
       curl_close($ch);
return $data;
}


function get_bibtex($bibcode) {
      global $ads_key;
      $ch = curl_init();
      $timeout = 15;
      curl_setopt($ch, CURLOPT_URL, 'https://api.adsabs.harvard.edu/v1/export/bibtex');
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
      curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
      curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
      curl_setopt($ch, CURLOPT_POSTFIELDS, '{"bibcode":["'. $bibcode .'"]}');
      curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                    'Authorization: Bearer '.$ads_key,
                    'Content-Type: application/json'));
       $data = curl_exec($ch);
       curl_close($ch);
       if ($data) {
          $obj = json_decode($data);
           if ($obj->export) {
                return $obj->export;
            }
        }
  return false;
}


$text .= get_BibTex_form_html();

if (!empty($arxiv)) {
    $inner_page_title = "BibTex for $arxiv";

    $SPIRES_url = 'http://inspirehep.net/search?action_search=Search&of=hx&p=FIND+EPRINT+' . $arxiv;
    $html = get_url($SPIRES_url);

    if (preg_match('#<pre>(.*?)</pre>#s', $html, $txt)) {
        $bibtex = $txt[1];
    }

    $result = get_data('https://api.adsabs.harvard.edu/v1/search/query?fl=bibcode&q=arXiv:'.$arxiv);
    if ($result){
       $obj = json_decode($result);
       if ($obj->response) {

          $bibcode = $obj->response->docs[0]->bibcode;
          $html = get_bibtex($bibcode);

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

$user->session_begin();
$auth->acl($user->data);
$user->setup();
$user->get_profile_fields($user->data['user_id']);


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

