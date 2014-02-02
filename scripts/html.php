<?php
include_once('l10n.php');
function html5_admin_null()
{
    return null;
}
function html5_user_null()
{
    return null;
}
//les erreurs
function html5_db_error($lang)
{
    global $text_cont;
    $html_var = '<p class="error">' . $text_cont[23][$lang] . '</p>';
    return $html_var;
}
function html5_reset_password($lang)
{
    global $text_cont;
    return '<p class="info">' . $text_cont[24][$lang] . '</p>';
}
function html5_notmail($lang)
{
    global $text_cont;
    return '<p class="error">' . $text_cont[12][$lang] . '</p>';
}
function html5_userexist($lang)
{
    global $text_cont;
    return '<p class="error">' . $text_cont[13][$lang] . '</p>';
}
function html5_passchanged($lang)
{
    global $text_cont;
    return '<p class="info">' . $text_cont[20][$lang] . '</p>';
}
function html5_log_error($lang)
{
    global $text_cont;
    return '<p class="error">' . $text_cont[4][$lang] . '</p>';
}
function html5_attack($lang)
{
    global $text_cont;
    return '<p class="error">' . $text_cont[32][$lang] . '</p>';
}
function html5_toolarge($lang)
{
    global $text_cont;
    return '<p class="error">' . $text_cont[33][$lang] . '</p>';
}
function html5_mail_changed($lang)
{
    global $text_cont;
    return '<p class="info">' . $text_cont[36][$lang] . '</p>';
}
function html5_mailvalid($lang)
{
    global $text_cont;
    return '<p class="info">' . $text_cont[38][$lang] . '</p>';
}
function html5_uservalid($lang)
{
    global $text_cont;
    return '<p class="info">' . $text_cont[37][$lang] . '</p>';
}
function html5_mailvaliduservalid($lang)
{
    global $text_cont;
    return '<p class="info">' . $text_cont[39][$lang] . '</p>';
}
function html5_mailused($lang)
{
    global $text_cont;
    return '<p class="error">' . $text_cont[40][$lang] . '</p>';
}
function html5_notsamepass($lang)
{
    global $text_cont;
    return '<p class="error">' . $text_cont[41][$lang] . '</p>';
}
function html5_wrongpass($lang)
{
    global $text_cont;
    return '<p class="error">' . $text_cont[42][$lang] . '</p>';
}
function html5_projectexist($lang)
{
    global $text_cont;
    return '<p class="error">' . $text_cont[50][$lang] . '</p>';
}
function html5_desctoolarge($lang)
{
    global $text_cont;
    return '<p class="error">' . $text_cont[51][$lang] . '</p>';
}
function html5_projectadded($lang)
{
    global $text_cont;
    return '<p class="info">' . $text_cont[52][$lang] . '</p>';
}
function html5_fileexist($lang)
{
    global $text_cont;
    return '<p class="error">' . $text_cont[59][$lang] . '</p>';
}
function html5_fieldmissing($lang)
{
    global $text_cont;
    return '<p class="error">' . $text_cont[64][$lang] . '</p>';
}
function html5_fileadded($lang)
{
    global $text_cont;
    return '<p class="info">' . $text_cont[65][$lang] . '</p>';
}
function html5_nofile($lang)
{
    global $text_cont;
    return '<p class="error">' . $text_cont[66][$lang] . '</p>';
}
function html5_filedeleted($lang)
{
    global $text_cont;
    return '<p class="info">' . $text_cont[69][$lang] . '</p>';
}
function html5_useradded($lang)
{
    global $text_cont;
    return '<p class="info">' . $text_cont[71][$lang] . '</p>';
}
function html5_dataupdated($lang)
{
    global $text_cont;
    return '<p class="info">' . $text_cont[77][$lang] . '</p>';
}
function html5_bugreported($lang)
{
    global $text_cont;
    return '<p class="info">' . $text_cont[86][$lang] . '</p>';
}
function html5_bugforbid($lang)
{
    global $text_cont;
    return '<p class="error">' . $text_cont[93][$lang] . '</p>';
}
function html5_projectforbid($lang)
{
    global $text_cont;
    return '<p class="error">' . $text_cont[94][$lang] . '</p>';
}
function html5_bugerror($lang)
{
    global $text_cont;
    return '<p class="error">' . $text_cont[87][$lang] . '</p>';
}
function html5_commentadded($lang)
{
    global $text_cont;
    return '<p class="info">' . $text_cont[97][$lang] . '</p>';
}
function html5_fieldcheck($lang)
{
    global $text_cont;
    return '<p class="error">' . $text_cont[99][$lang] . '</p>';
}
function html5_logged($lang)
{
    global $text_cont;
    return '<p class="info">' . $text_cont[98][$lang] . '</p>';
}
function html5_statuschanged($lang)
{
    global $text_cont;
    return '<p class="info">' . $text_cont[98][$lang] . '</p>';
}
function html5_nomail($lang)
{
    global $text_cont;
    return '<p class="error">' . $text_cont[103][$lang] . '</p>';
}
function html5_error($lang)
{
    global $text_cont;
    return '<p class="error">' . $text_cont[108][$lang] . '</p>';
}
function redirect($lang, $url)
{
    global $text_cont;
    $html_var = '<script language="javascript" type="text/javascript">redirect("' . $url . '");</script>
<noscript><a href="' . $url . '">' . $text_cont[90][$lang] . '</a></noscript>';
    return $html_var;
}
//alias redirect
function html5_user_redirect($lang, $url)
{
    return redirect($lang, $url);
}
function html5_admin_redirect($lang, $url)
{
    //var_dump($url);
    return redirect($lang, $url);
}
//fonctions de traitement d'affichage
function list_project_download($lang, $array, $id)
{
    global $text_cont;
    $html_var = '<h1>' . $text_cont[104][$lang] . '</h1>';
    if ($_SESSION['db_data']['lvl'] == 'admin')
    {
        $html_var .= '<p><a href="?action=addfile&id=' . $id . '">' . $text_cont[63][$lang] . '</a></p>';
    }
    if ($array == null)
    {
        return '<p>' . $text_cont[54][$lang] . '</p>';
    }
    //var_dump($array);
    krsort($array);
    //var_dump($array);
    $i = 1;
    foreach ($array as $key => $value)
    {
        $days = round(((time() - $key) / (60 * 60 * 24)), 0, PHP_ROUND_HALF_DOWN);
        if ($i === 1)
        {
            $html_var .= '<p>' . $text_cont[55][$lang] . '</p><div id="lastrelease"><div id="inner">';
            //    <p class="link_file"><a href="?action=getfile&id='.$id.'&key='.$key.'&file='.$value['sha1'].'">'.html($value['version']).'</a></p>';
        }
        else
        {
            $html_var .= '<div class="release"><div id="inner">';
            //    <p class="version"><a href=?action=getfile&id='.$id.'&key='.$key.'&file='.$value['sha1'].'">'.html($value['version']).'</a></p>';
        }
        $html_var .= '<div class="version"><span>' . html($value['version']) . '</span> - ';
        if ($days == 0)
        {
            $html_var .= $text_cont[57][$lang];
        }
        elseif ($days == 1)
        {
            $html_var .= $text_cont[58][$lang];
        }
        else
        {
            $html_var .= sprintf($text_cont[56][$lang], $days);
        }
        if ($_SESSION['db_data']['lvl'] == 'admin')
        {
            $html_var .= ' <a class="confirm" href="?action=deletefile&id=' . $id . '&key=' . $key . '">' . $text_cont[68][$lang] . '</a>';
        }
        $html_var .= '</div><div class=downblock><ul class="download">';
        ksort($value['files']);
        foreach ($value['files'] as $os => $valos)
        {
            ksort($valos);
            foreach ($valos as $arch => $valarch)
            {
                $html_var .= '<li><a href="?action=getfile&id=' . $id . '&key=' . $key . '&file=' . $valarch['sha1'] . '&os=' . urlencode(base64_encode($os)) . '&arch=' . urlencode(base64_encode($arch)) . '">' . $os . ' ' . $arch . '</a></li>';
            }
        }
        $html_var .= '</ul></div>';
        $html_var .= '<div class="changelog"><p>' . $text_cont[61][$lang] . ':</p><div>' . nl2br(html($value['changelog'])) . '</div></div></div></div>';
        $i++;
    }
    $html_var .= '</div>';
    return $html_var;
}
//lister les projets pour la modification utilisateur
function list_project_edituser($lang, $array = array(), $switch = 'user')
{
    global $text_cont;
    $projects = list_projects();
    if ($projects == null || $switch !== 'user')
    {
        return null;
    }
    $html_var = '<h6>' . $text_cont[70][$lang] . '</h6>';
    foreach ($projects as $key => $value)
    {
        if (in_array($key, $array))
        {
            $checked = 'checked="checked"';
        }
        else
        {
            $checked = null;
        }
        $html_var .= '<p><input type="checkbox" name="project[]" value="' . $key . '" ' . $checked . ' />' . html($value['name']) . '</p>';
    }
    return $html_var;
}
function html5_footer()
{
    $html_var = '<div id="footer_bar">
<span>Build by <a href="http://www.goldenfish.info"> Goldy</a>\'s hands</span>
</div>';
    return $html_var;
}
function list_users_project_html($id, $lang)
{
    global $text_cont;
    $userlist = list_suscribed_users($id);
    $html_var = '<div id="project_users"><h6>' . $text_cont[72][$lang] . '</h6><p>';
    foreach ($userlist as $key => $value)
    {
        $users = true;
        $html_var .= '<a href="?action=edituser&user_id=' . $key . '">' . html($value['user']) . '</a>, ';
    }
    if (isset($users))
    {
        $html_var = substr($html_var, 0, strlen($html_var) - 2) . '</p></div>';
    }
    else
    {
        $html_var = $html_var . $text_cont[73][$lang] . '</p></div>';
    }
    return $html_var;
}
//header html5
//$scripts doit être un array avec des locations de fichiers
function html5_header($title, $scripts, $lang, $style = 'style.css')
{
    $script_var = null;
    if (is_array($scripts))
    {
        foreach ($scripts as $file)
        {
            $script_var .= '<script src="' . $file . '"></script>';
        }
    }
    $html_var = <<<ILOVEU
<!doctype html>
<html lang="$lang">
<head>
  <meta charset="utf-8">
  <title>$title</title>
  <link rel="stylesheet" href="styles/normalize.css">
  <link rel="stylesheet" href="$style">
  $script_var
</head>
ILOVEU;
    return $html_var;
}
function html5_retrievepass($lang)
{
    global $text_cont;
    $html_var = '<div id="black"><div id="retrievepass">
<div id="closebox"><span>' . $text_cont[30][$lang] . '</span></div>
<cd  id="resetpass" action="?action=resetpassmail" method="post">
<input type="email" name="usr_email" size="25" placeholder="' . $text_cont[0][$lang] . '"  />
<input type="submit" id="sub_button" value="' . $text_cont[60][$lang] . '"  />
</form>
</div></div>';
    return $html_var;
}
function html5_login($lang, $action = 'index.php')
{
    global $text_cont;
    $html_var = '<form id="login" action="' . $action . '" method="post">
<input type="email" name="usr_email" size="15" placeholder="' . $text_cont[0][$lang] . '"  />
<input type="password" name="password" size="15" placeholder="' . $text_cont[1][$lang] . '"  /><br />
<input type="submit" id="sub_button" value="' . $text_cont[2][$lang] . '"  />
<div id=remember_me><div id=remember_me_text>' . $text_cont[3][$lang] . '</div><div id=remember_me_checkbox><input type="checkbox" name="remember_me" /></div></div>
</form>
';
    return $html_var;
}
function html5_user($user, $lang, $mod = null)
{
    global $text_cont;
    $html_var = '
<div id="userbar">
  <div id="userbar_left"><span class="text-align"><a href="index.php">' . html($user) . '</a></span></div>
  <div id="userbar_right"><span class="text-align">' . $text_cont[29][$lang] . '</span></div>
</div>
<div id="float_menu">' . html5_user_menu($lang) . '
  <p>' . html5_deco($lang) . '</p>
</div>';
    return $html_var;
}
function html5_admin($user, $lang, $mod = null)
{
    global $text_cont;
    $html_var = '<div id="userbar">
  <div id="userbar_left"><span class="text-align"><a href="index.php">' . html($user) . '</a></span></div>
  <div id="userbar_right"><span class="text-align">' . $text_cont[29][$lang] . '</span></div>
</div>
<div id="float_menu">' . html5_admin_menu($lang) . '
  <p>' . html5_deco($lang) . '</p>
</div>';
    return $html_var;
}
function html5_deco($lang)
{
    global $text_cont;
    $html_var = '<a href="?action=deco">' . $text_cont[15][$lang] . '</a>';
    return $html_var;
}
function html5_return($lang)
{
    global $text_cont;
    $html_var = '<a href="index.php">' . $text_cont[29][$lang] . '</a>';
    return $html_var;
}
function html5_admin_menu($lang, $mod = null)
{
    global $text_cont;
    $html_var = '<p><a href="?action=adduser">' . $text_cont[7][$lang] . '</a></p>
<p><a href="?action=addproject">' . $text_cont[44][$lang] . '</a></p>
<p><a href="?action=listusers">' . $text_cont[16][$lang] . '</a></p>
<p><a href="?action=modpass">' . $text_cont[28][$lang] . '</a></p>
<p><a href="?action=edituser&user_id=' . $_SESSION['db_data']['_id'] . '">' . $text_cont[43][$lang] . '</a></p>
<p><a href="mongo/moadmin.php">' . $text_cont[112][$lang] . '</a></p>';
    return $html_var;
}
function html5_user_menu($lang, $mod = null)
{
    global $text_cont;
    $html_var = '<p><a href="?action=modpass">' . $text_cont[28][$lang] . '</a></p>
<p><a href="?action=edituser&user_id=' . $_SESSION['db_data']['_id'] . '">' . $text_cont[43][$lang] . '</a></p>
<p><a href="?action=usersetting&user_id=' . $_SESSION['db_data']['_id'] . '">' . $text_cont[74][$lang] . '</a></p>';
    return $html_var;
}
function html5_user_changepass($lang, $mod = null)
{
    global $text_cont;
    if ($mod)
    {
        $cb  = 'html5_' . $mod;
        $mod = $cb($lang);
    }
    $html_var = '
<div id="message">' . $mod . '</div><div id="usersettings"><h1>' . $text_cont[28][$lang] . '</h1><form id="login" action="?action=modpass" method="post">
<input type="password" name="oldpass" size="20" placeholder="' . $text_cont[25][$lang] . '"  /><br />
<input type="password" name="password1" size="20" placeholder="' . $text_cont[26][$lang] . '"  /><br />
<input type="password" name="password2" size="20" placeholder="' . $text_cont[27][$lang] . '"  /><br />

<input type="submit" id="sub_button" value="' . $text_cont[18][$lang] . '"  />
</form></div>';
    return $html_var;
}
function html5_admin_changepass($lang, $mod = null)
{
    return html5_user_changepass($lang, $mod);
}
function html5_user_setting($lang, $mod = null, $conf = 'configurations')
{
    $conf = $conf();
    global $text_cont;
    if ($mod)
    {
        $cb  = 'html5_' . $mod;
        $mod = $cb($lang);
    }
    if ($_SESSION['db_data']['notification'])
    {
        $checked = 'checked="checked"';
    }
    else
    {
        $checked = null;
    }
    $html_var = '<div id="message">' . $mod . '</div><div id="usersettings">
<form id="setting" action="?action=usersetting&user_id=' . $_SESSION['db_data']['_id'] . '" method="post">
<h3>' . $text_cont[75][$lang] . '</h3>
<p><input type="checkbox" name="notification" ' . $checked . ' />' . $text_cont[76][$lang] . '</p>
<p><input type="hidden" name="switch" />
<h3>' . $text_cont[79][$lang] . '</h3>
<div id="lang_select"><select name="lang">';
    foreach ($conf['lang_available'] as $key => $value)
    {
        if ($key == $conf['lang'])
        {
            $select = 'selected="selected"';
        }
        else
        {
            $select = null;
        }
        $html_var .= '<option value="' . $key . '" ' . $select . ' >' . $value . '</option>';
    }
    $html_var .= '</select></div>
<input type="submit" id="sub_button" value="' . $text_cont[18][$lang] . '"  />
</form></div>';
    return $html_var;
}
function html5_list_bugs($lang, $lvl, $id)
{
    global $text_cont;
    $html_var    = '<div id="project_bug"><h1>' . $text_cont[106][$lang] . '</h1>';
    $link_submit = '<a id="submit_bug_link" href="?action=submitbug&id=' . $id . '">' . $text_cont[81][$lang] . '</a>';
    $bugs        = list_bugs(array(
        'projectid' => $id
    ));
    $project     = check_projects(array(
        '_id' => new MongoId($id)
    ));
    if (count($project['files']) === 0)
    {
        return null;
    }
    if ($bugs->count() === 0)
    {
        return $html_var . '<p>' . $text_cont[80][$lang] . '</p>' . $link_submit . '</div>';
    }
    $bugs->sort(array(
        'sort' => -1
    ));
    $html_var .= $link_submit . '<table><thead>
 <tr>

   <th id="id">#id</th>
   <th id="status">' . $text_cont[84][$lang] . '</th>
   <th id="title">' . $text_cont[83][$lang] . '</th>
   <th id="date">' . $text_cont[82][$lang] . '</th>
   <th id="version">' . $text_cont[49][$lang] . '</th>
</tr></thead><tbody>';
    foreach ($bugs as $key => $value)
    {
        $html_var .= '<tr class="' . $value['status'] . ' tr_link">
   <td><a href="?action=bug&id=' . $key . '">#' . $value['#'] . '</td>
   <td>' . $value['status'] . '</td>
   <td>' . html($value['title']) . '</td>
   <td>' . date('d M Y', $value['date']->sec) . '</td>
   <td>' . html($value['version']) . '</td>
</tr>';
    }
    $html_var .= '</tbody></table></div>';
    return $html_var;
}
function html5_admin_listusers($lang, $mod = null)
{
    global $text_cont;
    $html_var = '<table>
 <tr>
  <thead>
   <th>' . $text_cont[8][$lang] . '</th>
   <th>' . $text_cont[0][$lang] . '</th>
   <th>' . $text_cont[17][$lang] . '</th>
   <th>' . $text_cont[18][$lang] . '</th>
  </thead>
</tr>';
    if (is_object($mod))
    {
        foreach ($mod as $key => $value)
        {
            $html_var .= '<tr><td>' . html($value['user']) . '</td><td>' . $value['email'] . '</td><td>' . $value['lvl'] . '</td><td><a href="?action=edituser&user_id=' . $key . '">' . $text_cont[18][$lang] . '</td></tr>';
        }
        $html_var .= '</table>';
    }
    else
    {
        $html_var .= '<tr><td colspan="4">' . $text_cont[15][$lang] . '</td></tr></table>';
    }
    return $html_var;
}
function html5_user_project($lang, $mod = null)
{
    global $text_cont;
    $id = $_SESSION['currentprojet'];
    if (is_array($mod))
    {
        return redirect($lang, '?action=' . $mod[0] . $mod[1] . '&mod=' . $mod[2]);
    }
    elseif (is_string($mod))
    {
        $cb  = 'html5_' . $mod;
        $mod = $cb($lang);
    }
    $project = check_projects(array(
        '_id' => new MongoID($id)
    ));
    if (!$project)
    {
        return '<p>' . $text_cont[32][$lang] . '</p>';
    }
    $html_var = '<div id="message">' . $mod . '</div>
<div id="project"><div id="project_name">
<h1>' . nl2br(html($project['name'])) . '</h1>' . admin(' <a href="?action=editproject&id=' . $id . '">' . $text_cont[107][$lang] . '</a>') . '
<p>' . nl2br($project['descript']) . '</p></div>
<div id="project_block"><div id="project_download">' . list_project_download($lang, $project['files'], $id) . html5_list_bugs($lang, $_SESSION['db_data']['lvl'], $id) . '</div></div>';
    return $html_var;
}
function html5_admin_project($lang, $mod = null)
{
    global $text_cont;
    $id       = $_SESSION['currentprojet'];
    $html_var = html5_user_project($lang, $mod) . list_users_project_html($id, $lang);
    return $html_var;
}
function html5_admin_edit_project($lang, $mod = null)
{
    global $text_cont;
    if (is_array($mod))
    {
        return redirect($lang, '?action=' . $mod[0] . $mod[1] . '&mod=' . $mod[2]);
    }
    elseif (is_string($mod))
    {
        $cb  = 'html5_' . $mod;
        $mod = $cb($lang);
    }
    $project  = $_SESSION['projectedit'];
    $html_var = '<div id="message">' . $mod . '</div><div id="submitbug"><form id="addproject" action="?action=editproject&id=' . $project['_id'] . '" method="post">

<p><input type="text" placeholder="' . $text_cont[45][$lang] . '" name="projectname" size="25" value="' . $project['name'] . '"/>*</p>
<p><textarea placeholder="' . $text_cont[46][$lang] . '" name="projectdescript" id="bug_description">' . $project['descript'] . '</textarea></p>
<p><input type="submit" id="sub_button" value="' . $text_cont[18][$lang] . '"  /></div>
';
    return $html_var;
}
function html5_user_listprojects($lang, $mod = null)
{
    global $text_cont;
    trigger_error($mod);
    if (is_string($mod))
    {
        $cb  = 'html5_' . $mod;
        $mod = $cb($lang);
    }
    $list     = list_projects();
    $count    = 0;
    $html_var = '<div id="message">' . $mod . '</div><div id="project_list">';
    if (isset($list))
    {
        foreach ($list as $key => $value)
        {
            if (in_array($key, $_SESSION['db_data']['projects']) || admin(true) || vip(true))
            {
                $html_var .= '<div class="project"><a href="?action=project&project_id=' . $key . '">' . html($value['name']) . '</a></div>';
                $count++;
            }
        }
    }
    if (!$count)
    {
        $html_var .= '<div class="project">' . $text_cont[53][$lang] . '</div>';
    }
    $html_var .= '</div>';
    return $html_var;
}
function html5_admin_listprojects($lang, $mod = null)
{
    global $text_cont;
    return html5_user_listprojects($lang, $mod);
}
function html5_admin_add_project($lang, $mod = null)
{
    global $text_cont;
    if ($mod)
    {
        $cb  = 'html5_' . $mod;
        $mod = $cb($lang);
    }
    $html_var = '<div id="message">' . $mod . '</div>
<form id="addproject" action="?action=addproject" method="post">
<p><input type="text" placeholder="' . $text_cont[45][$lang] . '" name="projectname" size="25" />*</p>
<p><textarea placeholder="' . $text_cont[46][$lang] . '" name="projectdescript"></textarea></p>
<input type="text" placeholder="' . $text_cont[49][$lang] . '" name="projectversion" size="5" /></p>
<p><textarea placeholder="' . $text_cont[61][$lang] . '" name="changelog" id="changelog"></textarea></p>
' . list_upload_dir() . '
<p><input type="submit" id="sub_button" value="' . $text_cont[11][$lang] . '"  />
';
    return $html_var;
}
function html5_admin_add_file($lang, $mod = null)
{
    if ($mod)
    {
        $cb  = 'html5_' . $mod;
        $mod = $cb($lang);
    }
    global $text_cont;
    $project = check_projects(array(
        '_id' => new MongoID(myfilter($_GET['id'], '_id'))
    ));
    if (!$project)
    {
        return '<p>' . $text_cont[32][$lang] . '</p>';
    }
    $html_var = '<form id="addproject" action="?action=addfile&id=' . myfilter($_GET['id'], '_id') . '" method="post">
<div id="mess">' . $mod . '</div>
<p>' . $text_cont[62][$lang] . ' ' . nl2br(html($project['name'])) . '</p>
<input type="text" placeholder="' . $text_cont[49][$lang] . '" name="projectversion" size="5" /></p>
<p><textarea placeholder="' . $text_cont[61][$lang] . '" name="changelog" id="changelog"></textarea></p>
' . list_upload_dir() . '
<p><input type="submit" id="sub_button" value="' . $text_cont[11][$lang] . '"  />
';
    return $html_var;
}
function html5_user_edit_user($lang, $mod = null)
{
    global $text_cont;
    if ($mod)
    {
        $cb  = 'html5_' . $mod;
        $mod = $cb($lang);
    }
    $update   = $_SESSION['edit_user'] = check_user(array(
        '_id' => new MongoID(myfilter($_GET['user_id'], '_id'))
    ));
    $html_var = '<div id="message">' . $mod . '</div><div id="usersettings">
<form id="edituser" action="?action=edituser&user_id=' . $_SESSION['edit_user']['_id'] . '" method="post">
<p>' . $text_cont[8][$lang] . ': <input type="text" name="username" value="' . html($update['user']) . '" size="25" /></p>
<p>' . $text_cont[0][$lang] . ': <input type="email" name="usr_email" value="' . html($update['email']) . '" size="25" /></p>
<!--tag1-->
<input type="submit" id="sub_button" value="' . $text_cont[18][$lang] . '"  />
<p><a href="index.php">' . $text_cont[30][$lang] . '</a></p>
<!--tag2--></div>';
    return $html_var;
}
function html5_admin_edit_user($lang, $mod = null)
{
    global $text_cont;
    $html_var              = html5_user_edit_user($lang, $mod);
    $_SESSION['edit_user'] = check_user(array(
        '_id' => new MongoId($_SESSION['edit_user']['_id'])
    ));
    if ($_SESSION['edit_user']['vip'] && $_SESSION['edit_user']['lvl'] === 'user')
    {
        $_SESSION['edit_user']['lvl'] = 'vip';
    }
    $add      = array(
        '<p>' . $text_cont[17][$lang] . ': ' . $_SESSION['edit_user']['lvl'] . '</p>' . list_project_edituser($lang, $_SESSION['edit_user']['projects'], $_SESSION['edit_user']['lvl']),
        '?action=listusers',
        '<p><a class="confirm" href="?action=deluser&user_id=' . $_SESSION['edit_user']['_id'] . '">' . $text_cont[31][$lang] . '</a></p><p><a class="confirm" href="?action=resetpass&user_id=' . $_SESSION['edit_user']['_id'] . '">' . $text_cont[60][$lang] . '</a></p>'
    );
    $motif    = array(
        '<!--tag1-->',
        'index.php',
        '<!--tag2-->'
    );
    $html_var = str_replace($motif, $add, $html_var);
    return $html_var;
}
function html5_admin_adduser($lang, $mod = null, $action = 'index.php')
{
    global $text_cont;
    if ($mod)
    {
        $cb  = 'html5_' . $mod;
        $mod = $cb($lang);
    }
    $html_var = '<div id="adduser"><h2>' . $text_cont[7][$lang] . '</h2>
<form id="login" action="' . $action . '?action=adduser" method="post">
<div id="error_log">' . $mod . '</div>
<input type="email" name="usr_email" size="15" placeholder="' . $text_cont[0][$lang] . '"  />
<input type="text" name="username" size="15" placeholder="' . $text_cont[8][$lang] . '"  />
<select name="lvl">
  <option value="user">User</option>
  <option value="vip">VIP</option>
  <option value="admin">Admin</option>
</select><br />' . list_project_edituser($lang) . '
<input type="submit" id="sub_button" value="' . $text_cont[11][$lang] . '"  />
</form>
</div>';
    return $html_var;
}
function html5_user_submitbug($lang, $mod = null)
{
    global $text_cont;
    $conf = configurations();
    if (is_array($mod))
    {
        return redirect($lang, '?action=bug&id=' . $mod[1] . '&mod=' . $mod[0]);
    }
    if ($mod)
    {
        $cb  = 'html5_' . $mod;
        $mod = $cb($lang);
    }
    $project = check_projects(array(
        '_id' => new MongoID($_SESSION['idbug'])
    ));
    $files   = $project['files'];
    krsort($files);
    $html_var = '<div id="message">' . $mod . '</div><div id="submitbug"><h2>' . $text_cont[81][$lang] . ' ' . $text_cont[105][$lang] . ' ' . $project['name'] . '</h2>
<form id="login" action="?action=submitbug&id=' . $_SESSION['idbug'] . '" method="post">

<input id="bug_title" type="text" placeholder="' . $text_cont[83][$lang] . '" name="title" size="5" value="' . post('title') . '"/>
<div id="bugoption"><select name="version"><option value="false">' . $text_cont[49][$lang] . '</option>';
    $i        = 1;
    //versions
    foreach ($files as $key => $value)
    {
        $html_var .= '<option value="' . $key . '!!!!' . base64_encode($value['version']) . '">' . $value['version'] . '</option>';
        if ($i == 3)
        {
            break;
        }
        $i++;
    }
    $html_var .= '</select><select name="osarch"><option value="false">' . $text_cont[100][$lang] . '</option>';
    //os et arch
    foreach ($conf['os'] as $os)
    {
        foreach ($conf['arch'] as $arch)
        {
            $html_var .= '<option value="' . $os . '!!!!' . $arch . '">' . $os . ' ' . $arch . '</option>';
        }
    }
    $html_var .= '</select>
</div><textarea placeholder="' . $text_cont[85][$lang] . '" name="bugdescription" id="bug_description">' . post('bugdescription') . '</textarea>
<input type="submit" id="sub_button" value="' . $text_cont[11][$lang] . '"  />
<a href="?action=project&project_id=' . $project['_id'] . '">' . $text_cont[30][$lang] . '</a></div>';
    unset($_SESSION['post']);
    return $html_var;
}
function html5_admin_submitbug($lang, $mod = null)
{
    return html5_user_submitbug($lang, $mod);
}
function list_bugs_comments($lang, $comments)
{
    global $text_cont;
    if (!count($comments))
    {
        return '<div id="bug_comments"><p>' . $text_cont[109][$lang] . '</p>';
    }
    ksort($comments);
    $html_var = '<div id="bug_comments"><h2>' . $text_cont[110][$lang] . '</h2>';
    foreach ($comments as $key => $value)
    {
        $author = getvalue(check_user(array(
            '_id' => new MongoId($value['userid'])
        )), 'user');
        if (is_null($author))
        {
            $author = 'Anonymous';
        }
        $html_var .= '<div class="bug_comments_content"><div class="num">' . $text_cont[95][$lang] . ' #' . $key . '</div>
  <div class="bug_comments_date">' . date('d M Y', $value['date']->sec) . '</div>
  <div class="bug_comments_author">' . $text_cont[89][$lang] . ' ' . html($author) . '</div>
  <div class="bug_comments_comment">' . nl2br(html($value['content'])) . '</div></div>';
    }
    return $html_var;
}
function html5_user_bug($lang, $mod = null)
{
    global $text_cont;
    if (is_array($mod))
    {
        return redirect($lang, '?action=' . $mod[0] . $mod[1] . '&mod=' . $mod[2]);
    }
    elseif (is_string($mod))
    {
        $cb  = 'html5_' . $mod;
        $mod = $cb($lang);
    }
    $id  = myfilter($_GET['id'], '_id');
    $bug = list_bugs(array(
        '_id' => new MongoId($id)
    ), true);
    if (is_null($bug))
    {
        $cb = 'html5_' . $_SESSION['db_data']['lvl'] . '_project';
        return $cb($lang, 'bugerror');
    }
    $author = getvalue(check_user(array(
        '_id' => new MongoId($bug['userid'])
    )), 'user');
    if (is_null($author))
    {
        $author = 'Anonymous';
    }
    $project = getvalue(check_projects(array(
        '_id' => new MongoId($bug['projectid'])
    )), 'name');
    if (is_null($project))
    {
        $project = $text_cont[92][$lang];
    }
    $html_var = '<div id="message">' . $mod . '</div><div id="bug"><h2>' . $text_cont[88][$lang] . ' #' . $bug['#'] . ' - ' . html($bug['title']) . '</h2>

<div id="bug_date">' . date('d M Y', $bug['date']->sec) . '</div>
<div id="bug_sender">' . $text_cont[89][$lang] . ' ' . html($author) . '</div>
<div id="bug_project"><a href="?action=project&project_id=' . $bug['projectid'] . '">' . html($project) . '</a></div>
<div id="bug_status">' . $text_cont[84][$lang] . ': <span class="status ' . $bug['status'] . '">' . $bug['status'] . '</span></div>
<div id="bug_version">' . $text_cont[49][$lang] . ': ' . html($bug['version']) . ' - ' . $text_cont[100][$lang] . ' ' . $bug['os'] . ' ' . $bug['arch'] . '</div>
<div id="bug_content">' . nl2br(html($bug['descript'])) . '</div></div>';
    //comments
    $html_var .= list_bugs_comments($lang, $bug['comments']) . '<div id="bug_comments_box"><form id="comment" action="?action=bug&id=' . $id . '" method="post">
<textarea placeholder="' . $text_cont[95][$lang] . '" name="comment_bug"></textarea>
<input type="submit" id="sub_button" value="' . $text_cont[96][$lang] . '" /></form></div></div>';
    return $html_var;
}
function html5_admin_bug($lang, $mod = null)
{
    $conf = configurations();
    global $text_cont;
    $id = myfilter($_GET['id'], '_id');
    if (is_array($mod))
    {
        return redirect($lang, '?action=' . $mod[0] . $mod[1] . '&mod=' . $mod[2]);
    }
    $content    = html5_user_bug($lang, $mod);
    $status     = getvalue(explode('">', getvalue(explode('<span class="status ', $content), 1)), 0);
    $content    = explode('<span class="status ', $content);
    $content[1] = getvalue(explode($status . '</span>', $content[1]), 1);
    $html_var   = '<form action="?action=editbug&id=' . $id . '" method="post"><select name="status">';
    foreach ($conf['bugs'] as $key => $value)
    {
        foreach ($value as $svalue)
        {
            if ($status === $svalue)
            {
                $def = 'selected="selected"';
            }
            else
            {
                $def = null;
            }
            $html_var .= '<option value="' . $svalue . '" ' . $def . '>' . $key . '/' . $svalue . '</option>';
        }
    }
    $html_var .= '</select><input type="submit" value="' . $text_cont[18][$lang] . '"  /></form>';
    return $content[0] . $html_var . $content[1];
}
?>
