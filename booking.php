<?php

define('IN_PHPBB', true);

$phpbb_root_path = (defined('PHPBB_ROOT_PATH')) ? PHPBB_ROOT_PATH : './';
$phpEx = substr(strrchr(__FILE__, '.'), 1);
include($phpbb_root_path . 'common.' . $phpEx);

anti_hack($phpEx);

$user->session_begin();
$auth->acl($user->data);
$user->setup();
$user->get_profile_fields($user->data['user_id']);

$user_id = $user->data['user_id'];
$username = $user->data['username'];

$page_title = 'Room booking';
$inner_page_title = 'Room booking';



page_header($page_title);
$template->set_filenames(array(
    'body' => 'message_body.html',
));

$text=<<<EOT
<ins class="bookingaff" data-aid="1589953" data-target_aid="1589953" data-prod="nsb" data-width="100%" data-height="auto" data-lang="en" data-df_num_properties="3">
    <!-- Anything inside will go away once widget is loaded. -->
    <a href="//www.booking.com?aid=1589953">Booking.com</a>
</ins>
<script type="text/javascript">
    (function(d, sc, u) {
      var s = d.createElement(sc), p = d.getElementsByTagName(sc)[0];
      s.type = 'text/javascript';
      s.async = true;
      s.src = u + '?v=' + (+new Date());
      p.parentNode.insertBefore(s,p);
      })(document, 'script', '//aff.bstatic.com/static/affiliate_base/js/flexiproduct.js');
</script>
<script type="text/javascript">
    (function(d, sc, u) {
      var s = d.createElement(sc), p = d.getElementsByTagName(sc)[0];
      s.type = 'text/javascript';
      s.async = true;
      s.src = u + '?v=' + (+new Date());
      p.parentNode.insertBefore(s,p);
      })(document, 'script', '//aff.bstatic.com/static/affiliate_base/js/flexiproduct.js');
</script>
<H2>Specific locations</H2>
<p>
<A HREF="http://www.booking.com/searchresults.html?city=-2590884&aid=379309&label=brighton">Brighton, UK</A> (hotel near station try <A HREF="http://www.booking.com/hotel/gb/jurys-inn-brighton.html?aid=379309&label=brighton">Jurys Inn</A> or try a <A HREF="https://www.booking.com/searchresults.en.html?city=-2590884&nflt=ht_id%253D216%253Bht_id%253D208%253Breview_score%253D90%253Breview_score%253D80%253Breview_score%253D70&aid=379309&no_rooms=1&group_adults=1&room1=A&label=brighton">B&B</A>)
</p>
<p>
<A hREF="https://www.booking.com/searchresults.xu.html?city=-2591658&nflt=ht_id%253D204%253Bht_id%253D218%253Bht_id%253D201%253Bht_id%253D220%253Bht_id%253D221%253Bht_id%253D216%253Bht_id%253D208&aid=379309&no_rooms=1&group_adults=1&room1=A&label=cambridge">
Cambridge, UK
</A>
</p>
<p>
<A href="https://www.booking.com/searchresults.xu.html?city=20011602&nflt=ht_id%253D204%253Bht_id%253D218%253Bht_id%253D201%253Bht_id%253D220%253Bht_id%253D221%253Bht_id%253D216%253Bht_id%253D208&aid=379309&no_rooms=1&group_adults=1&room1=A&label=berkely">
Berkeley, CA</A>
</p>
<p><A hREF="https://www.booking.com/searchresults.xu.html?city=20015107&nflt=ht_id%253D204%253Bht_id%253D218%253Bht_id%253D201%253Bht_id%253D220%253Bht_id%253D221%253Bht_id%253D216%253Bht_id%253D208&aid=379309&no_rooms=1&group_adults=1&room1=A&label=caltech">Caltech, CA</A>
</p>
<p>
<A HREF="https://www.booking.com/searchresults.xu.html?city=20082259&nflt=ht_id%253D204%253Bht_id%253D218%253Bht_id%253D201%253Bht_id%253D220%253Bht_id%253D221%253Bht_id%253D216%253Bht_id%253D208&aid=379309&no_rooms=1&group_adults=1&room1=A&label=princeton">Princeton, NJ</A>
</p>
<p>
<A HREF="http://www.booking.com/searchresults.html?landmark=9951&aid=379309&radius=1">IAP, Paris</A>
</p>
<p>
<a href="https://www.booking.com/searchresults.xu.html?city=-1774108&nflt=ht_id%253D204%253Bht_id%253D206%253Bht_id%253D218%253Bht_id%253D201%253Bht_id%253D220%253Bht_id%253D221%253Bht_id%253D216%253Bht_id%253D208%253Bht_id%253D223&aid=379309&no_rooms=1&group_adults=1&room1=A&label=benasque
">Garching, Munich</a>
</p>

<p>
<A hREF="https://www.booking.com/searchresults.xu.html?city=-373168&nflt=ht_id%253D204%253Bht_id%253D206%253Bht_id%253D218%253Bht_id%253D201%253Bht_id%253D220%253Bht_id%253D221%253Bht_id%253D216%253Bht_id%253D208%253Bht_id%253D223&aid=379309&no_rooms=1&group_adults=1&room1=A&label=benasque">
Benasque, Spain</A>
</p>

<p>
<A HREF="https://www.booking.com/searchresults.en.html?city=-129626&nflt=ht_id%253D204%253Bht_id%253D206%253Bht_id%253D218%253Bht_id%253D201%253Bht_id%253D220%253Bht_id%253D221%253Bht_id%253D216%253Bht_id%253D208&aid=379309&no_rooms=1&group_adults=1">
    Sesto, Italy</A> (for <A HREF="http://www.sexten-cfa.eu/">Sexten centre for astrophysics</A>).
</p><p>
<A HREF="http://www.booking.com/index.html?aid=379309">Booking.com search home</A>
</p>

EOT;

$template->assign_vars(array(
    'MESSAGE_TEXT'	=> $text,
    'MESSAGE_TITLE'	=> $inner_page_title
));

make_jumpbox(append_sid("{$phpbb_root_path}viewforum.$phpEx"));
page_footer();

