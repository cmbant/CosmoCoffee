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


$username = $user->data['username'];
$user_id = $user->data['user_id'];

if($request->is_set('test_id')) {
    $user_id = $request->variable('test_id', 0);
}

$fname = 'journalclub.php';
$bookfname = 'bookmark.php';
$inner_page_title = '';

$text = '';
$error = '';
$isManager = array();

$add = $request->variable('add', '');
$action = $request->variable('action', '');
$club_id = $request->variable('club_id', 0);
$in_user_id = $request->variable('user_id', 0);
$shortname = $request->variable('shortname', '');
$clubname = $request->variable('newclub', '');
$description = $request->variable('description', '');


if ($user->data['user_id'] != ANONYMOUS) {

    $text .= get_new_club_called_html();

    //Get valid clubs user can admin
    if ($result = $db->sql_query("select club_id from club_members as c where c.user_id=$user_id and c.manager=1")) {
        while ($row = $db->sql_fetchrow($result)) {
            $isManager[$row['club_id']] = 1;
        }
    }

    //New club
    if ($clubname) {
        if (!($result = $db->sql_query("select * from journal_clubs where name='$clubname'"))) {
            trigger_error('Could not validate club name');
        }

        $rows = $db->sql_fetchrow($result);
        $db->sql_freeresult($result);

        if (empty($rows)) {
            if (($result = $db->sql_query("insert into journal_clubs (name,shortname) values('$clubname','$clubname')"))) {
                $club_id = $db->sql_nextid();
                $db->sql_freeresult($result);

                $db->sql_query("insert into club_members (user_id,club_id,manager) values($user_id,$club_id,1)");
            }
        } else {
            $error = 'A journal club with that name already exists.';
        }
    }

    //Add user to club
    if (!empty($add) && $isManager[$club_id] == 1) {

        $manager = ($request->variable('manager', '') == 'on') ? 1 : 0;

        if ($result = $db->sql_query("select user_id from phpbb_users where username='$add'")) {

            $rows = $db->sql_fetchrowset($result);
            $db->sql_freeresult($result);

            if (empty($rows)) {
                $error = 'No CosmoCoffee profile found for username ' . $add;
            } else {
                foreach($rows as $row) {
                    $in_user_id = $row['user_id'];

                    if ($result = $db->sql_query("select * from club_members where user_id=$in_user_id and club_id=$club_id")) {
                        $rows = $db->sql_fetchrowset($result);
                        $db->sql_freeresult($result);

                        if (empty($rows)) {
                            $db->sql_query("insert into club_members (user_id,club_id,manager) values($in_user_id,$club_id,$manager)");
                        }
                    }
                }
            }
        }
    }

    //remove user from club
    if ($action == 'remove' && ($isManager[$club_id] == 1 || $user_id == $in_user_id)) {
        $db->sql_query("delete from club_members where user_id=$in_user_id and club_id=$club_id");
    }

    //Delete club
    if ($action == 'delete' && $isManager[$club_id] == 1) {
        if ($request->variable('confirm', '') !== '1') {
            $text .= '<p align="center"><a href="' . $fname . '?action=delete&confirm=1&club_id=' . $club_id . '">Click here to confirm if you really want to delete the journal club</a></p><hr>';
        } else {
            $db->sql_query("delete from journal_clubs where club_id = $club_id");
            $db->sql_query("delete from club_members where club_id = $club_id");
            $db->sql_query("delete from club_paper_status where club_id = $club_id");
            $db->sql_query("update bookmarks set club_id=0 where club_id=$club_id");
        }
    }

    //Make user a manager
    if ($action == 'makemanager' && $isManager[$club_id] == 1 && $in_user_id) {
        $db->sql_query("update club_members set manager=1 where club_id=$club_id and user_id=$in_user_id");
    }

    //change description
    if ($action == 'changedesc' && $isManager[$club_id] == 1) {
        $db->sql_query("update journal_clubs set description ='$description', shortname='$shortname' where club_id = $club_id");
    }

    if ($error != '') {
        $text .= '<p align="center"><font color="red">' . $error . '</font></p>';
    }

    $text .= '<p>';


    //List managing clubs
    $managetxt = '';
    $sqlManager = "select
                    j.name, j.shortname, j.club_id, j.description
                from
                    club_members as c,
                    journal_clubs as j
                where
                    c.user_id=$user_id
                and
                    c.club_id=j.club_id
                and
                    c.manager=1";

    if ($result = $db->sql_query($sqlManager)) {
        while ($row = $db->sql_fetchrow($result)) {

            $club_id = $row['club_id'];
            $description = $row['description'];
            $shortname = $row['shortname'];

            $managetxt .= '<h3 style="border: none!important;">';
            $managetxt .= "<a class='maintitle' href='$bookfname?club=$club_id'>{$row['name']}</a>";
            $managetxt .= " [<a href='$fname?action=delete&club_id=$club_id'>delete</a>]";
            $managetxt .= '</h3>';

            $managetxt .= '<p>';
            $managetxt .= '<form class="genmed" method="get" action="/' . $fname . '" TARGET="_top">';
            $managetxt .=   '<input type="hidden" name="club_id" value="' . $club_id . '">';
            $managetxt .=   '<input name="action" type="hidden" value="changedesc">';
            $managetxt .=   'Description:<br />';
            $managetxt .=   '<textarea rows="3" cols="70" name="description">' . $description . '</textarea>';
            $managetxt .=   '<br />Short name: ';
            $managetxt .=   '<input name="shortname" value="' . $shortname . '" class="post" type="text" size="49" maxlength="32"> ';
            $managetxt .=   '<input class="button" value="Update" type="submit">';
            $managetxt .= '</form>';
            $managetxt .= '</p>';

            $sql = "select
                        u.username, u.user_id, c.manager
                    from
                        phpbb_users as u, club_members as c
                    where
                        c.user_id=u.user_id
                    and
                        c.club_id=$club_id
                    and
                        u.user_id<>$user_id
                    order by
                        c.manager DESC,u.username";
            if ($u = $db->sql_query($sql)) {
                $managetxt .= '<ol style="list-style-position: inside;">';
                while ($urow = $db->sql_fetchrow($u)) {
                    $id = $urow['user_id'];
                    $auser = $urow['username'];

                    $managetxt .= "<li>";

                    $managetxt .= "<a href='memberlist.php?mode=viewprofile&u=$id'>$auser</a> ";
                    $managetxt .= " [<a href='$fname?action=remove&user_id=$id&club_id=$club_id'>Remove</a>]";

                    if ($urow['manager'] == 1) {
                        $managetxt .= ' (manager)';
                    } else {
                        $managetxt .= " [<a href='$fname?action=makemanager&user_id=$id&club_id=$club_id'>Make manager</A>]";
                    }
                    $managetxt .= "</li>";
                }
                $managetxt .= '</ol>';
            }
            $managetxt .= '<p>';
            $managetxt .= '<form method="get" action="/' . $fname . '" TARGET="_top">';
            $managetxt .=   '<SPAN class=gen>Add user: </SPAN>';
            $managetxt .=   '<input class="post" type="text" name="add" size="25" maxlength="80" value="">';
            $managetxt .=   '<input type="hidden" name="club_id" value="' . $club_id . '">';
            $managetxt .=   ' as manager';
            $managetxt .=   '<input type="checkbox" name="manager" UNCHECKED>';
            $managetxt .=   '<input type="submit" value="Add" class="button">';
            $managetxt .=   '</form>';
            $managetxt .= '</p>';
        }
    }

    if ($managetxt != '') {
        $text .= '<p class="gen">' . $managetxt . '</p>';
    }

    $membertxt = '';
    $sqlMember = "select
                    j.name, j.club_id, j.description
                from
                    club_members as c ,journal_clubs as j
                where
                    c.user_id=$user_id
                and
                    c.club_id=j.club_id
                and
                    c.manager<>1";

    if ($result = $db->sql_query($sqlMember)) {
        while ($row = $db->sql_fetchrow($result)) {
            $inner_page_title = $row['name'];
            $membertxt .= '<h3 style="border: none!important;">';
            $membertxt .= '<a class="maintitle" href="' . $bookfname . '?club=' . $row['club_id'] . '">' . $row['name'] . '</a>';
            $membertxt .= ' [<a href="' . $fname . '?action=remove&club_id=' . $row['club_id'] . '&user_id=' . $user_id . '">Unsubscribe</a>]';
            $membertxt .= '</h3>';
            $membertxt .= '<p>' . $row['description'] . '</p>';
        }
    }

    if ($membertxt != '') {
        $text .= '<p class="gen">' . $membertxt . '</p>';
    }
} else {
    $text = 'You must be logged in to manage and view journal clubs';
}


page_header('Journal clubs');
$template->set_filenames(array(
    'body' => 'message_body.html',
));

$template->assign_vars(array(
    'MESSAGE_TEXT'	=> $text,
    'MESSAGE_TITLE'	=> $inner_page_title
));

make_jumpbox(append_sid("{$phpbb_root_path}viewforum.$phpEx"));
page_footer();

function get_new_club_called_html() {
    global $request;
    return '<center>
                <form method="get" action="' . $request->server('SCRIPT_NAME') . '" TARGET="_top">
                    <span class="gen">Start new club called: </span>
                    <input class="post" type="text" name="newclub" size="40" maxlength="255" value="">
                    <input type="submit" value="Add" class="button">
                </form>
            </center>
            <hr>';
}
