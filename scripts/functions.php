<?php
include_once('html.php');
include_once('conf.php');
include_once('l10n.php');
//alias à htmlspecialchars
function html($data)
{
    return htmlspecialchars($data, ENT_QUOTES);
}
//cette fonction ne fait rien, c'est pour les callbacks
function nothing($a = null, $z = null, $e = null, $r = null, $t = null, $y = null)
{
    return null;
}
//ce truc devrait être implémenté de base quand même...
function getvalue($array, $key)
{
    return $array[$key];
}
//pluriel
function s($int = 0)
{
    if ($int > 1)
    {
        return 's';
    }
}
//recursive rm
function rrmdir($dir)
{
    foreach (glob($dir . '/*') as $file)
    {
        if (is_dir($file))
            rrmdir($file);
        else
            unlink($file);
    }
    rmdir($dir);
}
//recupérer le formulaire pour éviter les notices
function post($value)
{
    if (isset($_SESSION['post'][$value]))
    {
        return $_SESSION['post'][$value];
    }
    else
    {
        return null;
    }
}
function user($content)
{
    if ($_SESSION['db_data']['lvl'] === 'user')
    {
        return $content;
    }
    else
    {
        return null;
    }
}
function admin($content)
{
    if ($_SESSION['db_data']['lvl'] === 'admin')
    {
        return $content;
    }
    else
    {
        return null;
    }
}
function vip($content)
{
    if ($_SESSION['db_data']['vip'] === true)
    {
        return $content;
    }
    else
    {
        return null;
    }
}
//liste le fichier upload
function list_upload_dir($conf = 'configurations')
{
    $conf = configurations();
    $dir  = scandir($conf['upload_dir']);
    //files
    foreach ($dir as $key => $value)
    {
        if (is_file($conf['upload_dir'] . '/' . $value))
        {
            $files[$key] = '<option value="' . $conf['upload_dir'] . '/' . $value . '">' . $conf['upload_dir'] . '/' . $value . '</option>';
        }
    }
    //os
    foreach ($conf['os'] as $key => $value)
    {
        $os[$key] = '<option value="' . $value . '">' . $value . '</option>';
    }
    //arch
    foreach ($conf['arch'] as $key => $value)
    {
        $arch[$key] = '<option value="' . $value . '">' . $value . '</option>';
    }
    for ($i = 0; $i < 6; $i++)
    {
        $return[$i] = '<p><select name="projectfile[' . $i . ']"><option></option>' . implode(' ', $files) . '</select>
 <select name="projectos[' . $i . ']"><option>os</option>' . implode(' ', $os) . '</select>
 <select name="projectarch[' . $i . ']"><option>arch</option>' . implode(' ', $arch) . '</select>';
    }
    return implode(' ', $return);
}
function file_name($f)
{
    // a combination of various methods
    // we don't want to convert html entities, or do any url encoding
    // we want to retain the "essence" of the original file name, if possible
    // char replace table found at:
    // http://www.php.net/manual/en/function.strtr.php#98669
    $replace_chars = array(
        'Š' => 'S',
        'š' => 's',
        'Ð' => 'Dj',
        'Ž' => 'Z',
        'ž' => 'z',
        'À' => 'A',
        'Á' => 'A',
        'Â' => 'A',
        'Ã' => 'A',
        'Ä' => 'A',
        'Å' => 'A',
        'Æ' => 'A',
        'Ç' => 'C',
        'È' => 'E',
        'É' => 'E',
        'Ê' => 'E',
        'Ë' => 'E',
        'Ì' => 'I',
        'Í' => 'I',
        'Î' => 'I',
        'Ï' => 'I',
        'Ñ' => 'N',
        'Ò' => 'O',
        'Ó' => 'O',
        'Ô' => 'O',
        'Õ' => 'O',
        'Ö' => 'O',
        'Ø' => 'O',
        'Ù' => 'U',
        'Ú' => 'U',
        'Û' => 'U',
        'Ü' => 'U',
        'Ý' => 'Y',
        'Þ' => 'B',
        'ß' => 'Ss',
        'à' => 'a',
        'á' => 'a',
        'â' => 'a',
        'ã' => 'a',
        'ä' => 'a',
        'å' => 'a',
        'æ' => 'a',
        'ç' => 'c',
        'è' => 'e',
        'é' => 'e',
        'ê' => 'e',
        'ë' => 'e',
        'ì' => 'i',
        'í' => 'i',
        'î' => 'i',
        'ï' => 'i',
        'ð' => 'o',
        'ñ' => 'n',
        'ò' => 'o',
        'ó' => 'o',
        'ô' => 'o',
        'õ' => 'o',
        'ö' => 'o',
        'ø' => 'o',
        'ù' => 'u',
        'ú' => 'u',
        'û' => 'u',
        'ý' => 'y',
        'ý' => 'y',
        'þ' => 'b',
        'ÿ' => 'y',
        'ƒ' => 'f'
    );
    $f             = strtr($f, $replace_chars);
    // convert & to "and", @ to "at", and # to "number"
    $f             = preg_replace(array(
        '/[\&]/',
        '/[\@]/',
        '/[\#]/'
    ), array(
        '',
        '',
        ''
    ), $f);
    $f             = preg_replace('/[^(\x20-\x7F)]*/', '', $f); // removes any special chars we missed
    $f             = str_replace(' ', '_', $f); // convert space to hyphen
    $f             = str_replace('\'', '', $f); // removes apostrophes
    $f             = preg_replace('/[^\w\-\.]+/', '', $f); // remove non-word chars (leaving hyphens and periods)
    $f             = preg_replace('/[\-]+/', '_', $f); // converts groups of hyphens into one
    return strtolower($f);
}
function readfile_chunked($filename, $retbytes = TRUE)
{
    $buffer = '';
    $cnt    = 0;
    // $handle = fopen($filename, 'rb');
    $handle = fopen($filename, 'rb');
    if ($handle === false)
    {
        return false;
    }
    while (!feof($handle))
    {
        $buffer = fread($handle, 1024 * 1024);
        echo $buffer;
        ob_flush();
        flush();
        if ($retbytes)
        {
            $cnt += strlen($buffer);
        }
    }
    $status = fclose($handle);
    if ($retbytes && $status)
    {
        return $cnt; // return num. bytes delivered like readfile() does.
    }
    return $status;
}
//affiche la page de login par défaut
//les trois premiers paramètres sont des callback (ouais ! mes premiers callback :3) dont l'utilisation n'est pas ce qui a de plus pertinent dans le cas présent.
function echo_front_page($badlog = 'nothing', $action = 'index.php', $cb1 = 'html5_header', $cb2 = 'html5_login')
{
    global $text_cont;
    $conf     = configurations();
    $html_var = $cb1($conf['title'], $conf['scripts'], $conf['lang'], $conf['style']) . '<body><div id="global1"><div id="global2">
<div id="log_lvl1"><div id="log_lvl2"><h1>' . $conf['title'] . '</h1></div>
<div id="log_lvl3">
<div id="error_log">' . $badlog($conf['lang']) . '</div>' . $cb2($conf['lang'], $action) . '</div>
<div id="lostpassword">' . $text_cont[102][$conf['lang']] . '</div>

</div></div></div>' . html5_footer() . html5_retrievepass($conf['lang']) . '
</body></html>';
    return $html_var;
}
function down_file($sha1, $key, $os, $arch, $id, $check = null)
{
    $conf = configurations();
    $con  = new Mongo();
    $db   = $con->$conf['base']->$conf['project'];
    $file = $db->findOne(array(
        '_id' => new MongoId($id)
    ));
    if ($check)
    {
        return $file;
    }
    if ($file['files'][$key]['files'][$os][$arch]['sha1'] == $sha1 && is_file($file['files'][$key]['files'][$os][$arch]['path']))
    {
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename=' . $file['files'][$key]['files'][$os][$arch]['filename']);
        header('Content-length: ' . $file['files'][$key]['files'][$os][$arch]['length']);
        header('Content-Transfer-Encoding: binary');
        readfile_chunked($file['files'][$key]['files'][$os][$arch]['path']);
    }
    else
    {
        return user_page_display($_SESSION['db_data']['user'], $_SESSION['db_data']['lvl'], 'project', 'nofile');
    }
}
//fonction de validation de données utilisateur
function myfilter($data, $type)
{
    $conf = configurations();
    if (is_array($data))
    {
        return array(
            false,
            'attack'
        );
    }
    switch ($type)
    {
        case 'user':
        case 'projectname':
        case 'password':
        case 'version':
            if (mb_strlen($data) <= $conf[$type . '_lenght'])
            {
                return $data;
            }
            else
            {
                return array(
                    false,
                    'toolarge'
                );
            }
            break;
        case 'bool':
            return filter_var($data, FILTER_VALIDATE_BOOLEAN);
            break;
        case 'email':
            if (filter_var($data, FILTER_VALIDATE_EMAIL))
            {
                return filter_var($data, FILTER_VALIDATE_EMAIL);
            }
            else
            {
                return array(
                    false,
                    'notmail'
                );
            }
            break;
        case 'lvl':
            if ($data == 'user' || $data == 'admin' || $data == 'vip')
            {
                return $data;
            }
            else
            {
                return array(
                    false,
                    'invalidlvl'
                );
            }
            break;
        case '_id':
            if (strlen($data) == 24)
            {
                return $data;
            }
            else
            {
                return array(
                    false,
                    'notid'
                );
            }
            break;
        case 'descript':
            if (mb_strlen($data) < 25000)
            {
                return $data;
            }
            else
            {
                return array(
                    false,
                    'desctoolarge'
                );
            }
            break;
        case 'sha1':
            if (strlen($data) == 40)
            {
                return $data;
            }
            else
            {
                return array(
                    false,
                    'notsha1'
                );
            }
            break;
        case 'timestamp':
            if (is_numeric($data))
            {
                return $data;
            }
            else
            {
                return array(
                    false,
                    'nottimestamp'
                );
            }
            break;
        case 'changelog':
            if (mb_strlen($data) < 25000)
            {
                return $data;
            }
            else
            {
                return array(
                    false,
                    'chglogtoolarge'
                );
            }
            break;
        case 'lang':
            if (array_key_exists($data, $conf['lang_available']))
            {
                return $data;
            }
            else
            {
                return array(
                    false,
                    'notlang'
                );
            }
            break;
        case 'mod':
            if (in_array($data, modsavailable()))
            {
                return $data;
            }
            else
            {
                return array(
                    false,
                    'notmod'
                );
            }
            break;
    }
}
//configure la langue en fonction du navigateur de l'utilisateur
function set_language()
{
    if (!isset($_SESSION['db_data']['lang']))
    {
        $language = $_SERVER['HTTP_ACCEPT_LANGUAGE'];
        $language = $language{0} . $language{1};
    }
    else
    {
        $language = $_SESSION['db_data']['lang'];
    }
    switch ($language)
    {
        case 'fr':
        case 'en':
            return $language;
            break;
        default:
            return 'en';
            break;
    }
}
//fonction affichant la page utilisateur
function user_page_display($user, $lvl, $action = 'listprojects', $mod = null)
{
    $conf     = configurations();
    $cb_lvl   = 'html5_' . $lvl;
    $action   = 'html5_' . $lvl . '_' . $action;
    $html_var = html5_header($conf['title'], $conf['scripts'], $conf['lang'], $conf['style']) . '<body><div id="global1_2"><div id="global2">' . $cb_lvl($user, $conf['lang']) . $action($conf['lang'], $mod) . '</div></div>' . html5_footer() . '</body></html>';
    return $html_var;
}
function change_user_setting($id)
{
    $conf = configurations();
    if (!strlen($_POST['switch']))
    {
        return null;
    }
    if (!is_array(myfilter($_POST['notification'], 'bool')))
    {
        $query['notification'] = myfilter($_POST['notification'], 'bool');
    }
    if (!is_array(myfilter($_POST['lang'], 'lang')))
    {
        $query['lang'] = myfilter($_POST['lang'], 'lang');
    }
    $con = new Mongo();
    $db  = $con->$conf['base']->$conf['user'];
    try
    {
        $db->update(array(
            '_id' => new MongoID($id)
        ), array(
            '$set' => $query
        ), array(
            'safe' => true,
            'upsert' => true
        ));
    }
    catch (MongoCursorException $e)
    {
        trigger_error('Insert failed ' . $e->getMessage());
        return 'db_error';
    }
    $_SESSION['db_data'] = check_user(array(
        '_id' => $_SESSION['db_data']['_id']
    ));
    return 'dataupdated';
}
//cette fonction vérifie le logging
function check_user($query, $password = null)
{
    $conf   = configurations();
    $con    = new Mongo();
    $db     = $con->$conf['base']->$conf['user'];
    $userdb = $db->findOne($query);
    //pour verifier la présence de l'utilisateur uniquement
    if (is_null($password) && isset($_SESSION['db_data']) && key($query) == 'email')
    {
        return $userdb['email'];
    }
    //pour verifier l'id
    if (is_null($password) && key($query) == '_id')
    {
        return $userdb;
    }
    //pour vérif le cookie
    if (is_null($password) && key($query) == 'password')
    {
        return $userdb;
    }
    if ($userdb['email'])
    {
        if (crypt($password, $userdb['password']) == $userdb['password'])
        {
            return array(
                true,
                $userdb
            );
        }
        else
        {
            return array(
                false,
                'badpass'
            );
        }
    }
    else
    {
        return array(
            false,
            'nouser'
        );
    }
    return array(
        false,
        'other_error'
    );
    ;
}
function check_bug($mod = null)
{
    if ($mod)
    {
        return $mod;
    }
    //vérifie que le bug existe
    $bug = list_bugs(array(
        '_id' => new MongoId(myfilter($_GET['id'], '_id'))
    ), true);
    if (is_null($bug))
    {
        return array(
            'listprojects',
            null,
            'bugerror'
        );
    }
    //vérifie que l'utilisateur est bien abonné au projet
    if (!in_array($bug['projectid'], $_SESSION['db_data']['projects'], true) && user(true) && !vip(true))
    {
        return array(
            'listprojects',
            null,
            'bugforbid'
        );
    }
    //vérifie le post d'un commentaire
    if (strlen($_POST['comment_bug']))
    {
        if (!is_array($_POST['comment_bug']))
        {
            return add_bug_comment($_GET['id'], $_POST['comment_bug']);
        }
    }
    return null;
}
function addfile($id, $new_project = false)
{
    if (!count($_POST))
    {
        return null;
    }
    $conf   = configurations();
    $date   = new MongoDate();
    $tstamp = $date->sec;
    $con    = new Mongo();
    $db     = $con->$conf['base']->$conf['project'];
    if ($new_project)
    {
        $project['name'] = $id;
    }
    else
    {
        $project = $db->findOne(array(
            '_id' => new MongoId($id)
        ));
    }
    if (isset($project['name']))
    {
        $projectname = $project['name'];
    }
    else
    {
        return 'attack';
    }
    if (is_null($_POST['projectfile']) || is_null($_POST['projectversion'] || is_null($_POST['changelog'])))
    {
        return 'fieldmissing';
    }
    if (is_array(myfilter($_POST['projectversion'], 'version')))
    {
        return getvalue(myfilter($_POST['projectversion'], 'version'), 1);
    }
    if (is_array(myfilter($_POST['changelog'], 'changelog')))
    {
        return getvalue(myfilter($_POST['changelog'], 'changelog'), 1);
    }
    if (!is_array($_POST['projectfile']) || !is_array($_POST['projectos']) || !is_array($_POST['projectarch']))
    {
        return 'attack';
    }
    $version = myfilter($_POST['projectversion'], 'version');
    foreach ($_POST['projectfile'] as $key => $value)
    {
        if (!is_null($value) && is_file($value) && getvalue(explode('/', $value), 0) == $conf['upload_dir'])
        {
            if (!in_array($_POST['projectos'][$key], $conf['os']) || !in_array($_POST['projectarch'][$key], $conf['arch']))
            {
                return 'fieldcheck';
            }
            $checkinit = $_POST['projectos'][$key] . $_POST['projectarch'][$key];
            if (isset($checkos) && isset($checkfile))
            {
                if (in_array($checkinit, $checkos, true) || in_array($value, $checkfile, true))
                {
                    return 'fieldcheck';
                }
            }
            $checkos[$key]                                                          = $checkinit;
            $checkfile[$key]                                                        = $value;
            //var_dump($checkfile);
            $sha1                                                                   = sha1_file($value);
            $filename                                                               = file_name($projectname) . '-' . file_name(myfilter($_POST['projectversion'], 'version')) . '-' . file_name($_POST['projectos'][$key]) . '-' . file_name($_POST['projectarch'][$key]) . '.' . getvalue(pathinfo($value), 'extension');
            $path                                                                   = 'files/' . file_name($projectname) . '/' . file_name($version) . '/' . file_name($_POST['projectos'][$key]) . '/' . file_name($_POST['projectarch'][$key]) . '/' . $sha1 . '/' . $filename;
            $length                                                                 = filesize($value);
            $query['files'][$_POST['projectos'][$key]][$_POST['projectarch'][$key]] = array(
                'sha1' => $sha1,
                'filename' => $filename,
                'path' => $path,
                'length' => $length,
                'date' => $date
            );
            $filesmv[$key]                                                          = array(
                'dir' => 'files/' . file_name($projectname) . '/' . file_name($version) . '/' . file_name($_POST['projectos'][$key]) . '/' . file_name($_POST['projectarch'][$key]) . '/' . $sha1,
                'file' => $value,
                'path' => $path
            );
        }
    }
    $query['version']   = $version;
    $query['changelog'] = myfilter($_POST['changelog'], 'changelog');
    $query['date']      = $date;
    //copie des fichiers
    foreach ($filesmv as $value)
    {
        if (!is_file($value['path']))
        {
            if (!is_dir($value['dir']))
            {
                if (!mkdir($value['dir'], 0755, true))
                {
                    trigger_error('mkdirfail');
                    return 'copyfail';
                }
                if (!rename($value['file'], $value['path']))
                {
                    trigger_error('copyfail');
                    return 'copyfail';
                }
            }
        }
    }
    if ($new_project)
    {
        $return[$tstamp] = $query;
        return $return;
    }
    try
    {
        $db->update(array(
            '_id' => new MongoID($id)
        ), array(
            '$set' => array(
                'files.' . $tstamp => $query
            )
        ), array(
            'safe' => true,
            'upsert' => true
        ));
    }
    catch (MongoCursorException $e)
    {
        trigger_error("Insert failed " . $e->getMessage());
        return 'db_error';
    }
    notify_users($id, $projectname, $query['version'], $query['changelog']);
    return 'fileadded';
}
function edit_bug($status)
{
    $conf = configurations();
    if (!isset($status))
    {
        return null;
    }
    $status_array = array_reverse(array_merge($conf['bugs']['Open'], $conf['bugs']['Closed']), false);
    $con          = new Mongo();
    $db           = $con->$conf['base']->$conf['bug'];
    $bug          = list_bugs(array(
        '_id' => new MongoId(myfilter($_GET['id'], '_id'))
    ), true);
    if (!is_array($bug))
    {
        return 'attack';
    }
    //change state
    try
    {
        $db->update(array(
            '_id' => new MongoId($bug['_id'])
        ), array(
            '$set' => array(
                'status' => $status,
                'sort' => (int) (array_search($status, $status_array) + 1) . str_pad($bug['#'], 6, "0", STR_PAD_LEFT)
            )
        ), array(
            'safe' => true
        ));
    }
    catch (MongoCursorException $e)
    {
        trigger_error('Insert failed ' . $e->getMessage());
        return 'db_error';
    }
    //add comment_bug
    add_bug_comment(myfilter($_GET['id'], '_id'), 'Status has been changed from ' . $bug['status'] . ' to ' . $status);
    return 'statuschanged';
}
function add_bug($post, $id)
{
    $conf = configurations();
    if (!count($post))
    {
        return null;
    }
    if (!strlen($post['title']) || !strlen($post['version']) || $post['version'] == 'false' || $post['osarch'] == 'false' || !strlen($post['bugdescription']) || is_array($post['title']) || is_array($post['version']) || is_array($post['bugdescription']))
    {
        $_SESSION['post'] = $_POST;
        return 'fieldmissing';
    }
    $version = explode('!!!!', $post['version']);
    if (is_null(check_projects(array(
        '_id' => new MongoID($id),
        'files.' . $version[0] . '.version' => base64_decode($version[1])
    ))))
    {
        return 'attack';
    }
    $osarch = explode('!!!!', $post['osarch']);
    if (!in_array($osarch[0], $conf['os']) || !in_array($osarch[1], $conf['arch']))
    {
        return 'attack';
    }
    //vérifie si le bug n'aurait pas déjà été posté
    $check = list_bugs(array(
        'project' => $id,
        'title' => $post['title']
    ), true);
    if (!is_null($check))
    {
        return array(
            'bugexist',
            $check['_id']
        );
    }
    //ajoute le bug dans la db
    $status_array = array_reverse(array_merge($conf['bugs']['Open'], $conf['bugs']['Closed']), false);
    $con          = new Mongo();
    $db           = $con->$conf['base']->$conf['bug'];
    $dbinc        = $con->$conf['base']->$conf['inc'];
    try
    {
        if (is_null($dbinc->findOne(array(
            '_id' => $conf['bug']
        ))))
        {
            $dbinc->insert(array(
                '_id' => $conf['bug'],
                '#' => 0
            ));
        }
        $inc     = $con->$conf['base']->command(array(
            'findandmodify' => $conf['inc'],
            'query' => array(
                '_id' => $conf['bug']
            ),
            'update' => array(
                '$inc' => array(
                    '#' => 1
                )
            ),
            'new' => true,
            'upsert' => true
        ));
        $mongoid = new MongoId();
        $db->insert(array(
            '_id' => $mongoid,
            'title' => $post['title'],
            'userid' => $_SESSION['db_data']['_id'],
            'projectid' => $id,
            'version' => base64_decode($version[1]),
            'status' => $conf['bugs']['Open'][0],
            'descript' => $post['bugdescription'],
            'os' => $osarch[0],
            'arch' => $osarch[1],
            'date' => new MongoDate(),
            '#' => $inc['value']['#'],
            'comments_inc' => 0,
            'sort' => (int) (array_search($conf['bugs']['Open'][0], $status_array) + 1) . str_pad($inc['value']['#'], 6, "0", STR_PAD_LEFT)
        ), array(
            'safe' => true,
            'fsync' => true
        ));
    }
    catch (MongoCursorException $e)
    {
        trigger_error('Bug Insert failed ' . $e->getMessage());
        return 'db_error';
    }
    send_bug_mail($mongoid);
    return array(
        'bugreported',
        $mongoid
    );
}
function add_bug_comment($id, $content)
{
    $conf = configurations();
    $con  = new Mongo();
    $db   = $con->$conf['base']->$conf['bug'];
    try
    {
        //incrémente le compteur
        $inc = $con->$conf['base']->command(array(
            'findandmodify' => $conf['bug'],
            'query' => array(
                '_id' => new MongoId($id)
            ),
            'update' => array(
                '$inc' => array(
                    'comments_inc' => 1
                )
            ),
            'new' => true,
            'upsert' => true
        ));
        $db->update(array(
            '_id' => new MongoId($id)
        ), array(
            '$set' => array(
                'comments.' . $inc['value']['comments_inc'] => array(
                    'userid' => $_SESSION['db_data']['_id'],
                    'content' => $content,
                    'date' => new MongoDate()
                )
            )
        ), array(
            'safe' => true,
            'upsert' => true
        ));
    }
    catch (MongoCursorException $e)
    {
        trigger_error('Bug Insert failed ' . $e->getMessage());
        return 'db_error';
    }
    return array(
        'bug',
        '&id=' . $id,
        'commentadded'
    );
}
function notify_users($id, $name, $version, $changelog, $conf = 'configurations')
{
    $conf = configurations();
    global $text_cont;
    $con   = new Mongo();
    $db    = $con->$conf['base']->$conf['user'];
    $users = $db->find(array(
        'projects' => $id,
        'notification' => true
    ));
    foreach ($users as $value)
    {
        if (isset($value['lang']))
        {
            $lang = $value['lang'];
        }
        else
        {
            $lang = $conf['lang'];
        }
        $mail_content = sprintf($text_cont[78][$lang], $name) . '

' . $text_cont[49][$lang] . ': ' . $version . '
' . $text_cont[61][$lang] . ':
' . $changelog . '

' . $conf['url'] . $conf['sub-domaine'] . '.' . $conf['domaine'];
        mail($value['email'], $conf['mailheader'] . ' ' . sprintf($text_cont[78][$lang], $name), $mail_content, 'From: no-reply@' . $conf['domaine'] . "\r\n" . "Content-type: text/plain; charset=UTF-8");
    }
}
function send_bug_mail($id)
{
    $conf = configurations();
    global $text_cont;
    $mail_content = 'A new bug has been submitted

' . $conf['url'] . $conf['sub-domaine'] . '.' . $conf['domaine'] . '/index.php?action=bug&id=' . $id;
    $admin        = list_users(array(
        'lvl' => 'admin'
    ));
    //var_dump(iterator_to_array($admin));
    foreach ($admin as $value)
    {
        mail($value['email'], $conf['mailheader'] . ' New bug', $mail_content, 'From: no-reply@' . $conf['domaine'] . "\r\n" . "Content-type: text/plain; charset=UTF-8");
    }
}
//thank you php.net :p
function random_password($chars = 16)
{
    $letters = 'abcefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
    return substr(str_shuffle($letters), 0, $chars);
}
function addproject()
{
    if ($_SESSION['db_data']['lvl'] !== 'admin' || !strlen($_POST['projectname']))
    {
        return null;
    }
    $conf        = configurations();
    $date        = new MongoDate();
    $time        = time();
    $projectname = myfilter($_POST['projectname'], 'projectname');
    //test le nom du projet
    if (is_array($projectname))
    {
        return $projectname[1];
    }
    if (is_array(check_projects(array(
        'name' => $projectname
    ))))
    {
        return 'projectexist';
    }
    else
    {
        $query['name'] = $projectname;
    }
    //test le résumé
    if (strlen($_POST['projectdescript']))
    {
        if (is_array(myfilter($_POST['projectdescript'], 'descript')))
        {
            return getvalue(myfilter($_POST['projectdescript'], 'descript'), 1);
        }
        else
        {
            $query['descript'] = $_POST['projectdescript'];
        }
    }
    //fichiers
    $query['files'] = addfile($query['name'], true);
    if (!is_array($query['files']))
    {
        return $query['files'];
    }
    $con = new Mongo();
    $db  = $con->$conf['base']->$conf['project'];
    try
    {
        $db->insert($query, array(
            'safe' => true
        ));
    }
    catch (MongoCursorException $e)
    {
        trigger_error("Insert failed " . $e->getMessage());
        return 'db_error';
    }
    return 'projectadded';
}
function edit_project($post)
{
    $conf    = configurations();
    $project = check_projects(array(
        '_id' => new MongoID(myfilter($_GET['id'], '_id'))
    ));
    if (!is_array($project))
    {
        return array(
            'listprojects',
            null,
            'error'
        );
    }
    $_SESSION['projectedit'] = $project;
    if (!count($post))
    {
        return null;
    }
    trigger_error($post['projectname']);
    trigger_error(!strlen($post['projectname']));
    if (!strlen($post['projectname']))
    {
        return 'fieldmissing';
    }
    if (is_array($post['projectname']) || is_array($post['projectdescript']))
    {
        return 'attack';
    }
    $con = new Mongo();
    $db  = $con->$conf['base']->$conf['project'];
    try
    {
        $db->update(array(
            '_id' => $project['_id']
        ), array(
            '$set' => array(
                'name' => $post['projectname'],
                'descript' => $post['projectdescript']
            )
        ), array(
            'safe' => true,
            'upsert' => true
        ));
    }
    catch (MongoCursorException $e)
    {
        trigger_error("Insert failed " . $e->getMessage());
        return html5_db_error($conf['lang']);
    }
    return array(
        'project',
        '&project_id=' . $project['_id'],
        'dataupdated'
    );
}
//cette fonction ajoute un utilisateur
function add_user($email, $user, $lvl, $password = null)
{
    $conf = configurations();
    //verif erreur
    if (is_array($email))
    {
        return 'attack';
    }
    if (is_array($user))
    {
        return 'attack';
    }
    //si l'utilisateur existe
    if (check_user(array(
        'email' => $email
    )))
    {
        return 'userexist';
    }
    if ($lvl == 'vip')
    {
        $lvl = 'user';
        $vip = true;
    }
    else
    {
        $vip = false;
    }
    if (isset($_POST['project']) && is_array($_POST['project']) && $lvl !== 'admin')
    {
        foreach ($_POST['project'] as $value)
        {
            if (!is_array(myfilter($value, '_id')))
            {
                $projects[] = myfilter($value, '_id');
            }
        }
    }
    else
    {
        $projects[] = null;
    }
    if (!$password)
    {
        $password = random_password();
    }
    $hash  = crypt($password);
    $reset = uniqid('', true);
    $con   = new Mongo();
    $db    = $con->$conf['base']->$conf['user'];
    try
    {
        $db->insert(array(
            'email' => $email,
            'user' => $user,
            'password' => $hash,
            'lvl' => $lvl,
            'reset' => $reset,
            'projects' => $projects,
            'vip' => $vip,
            'notification' => true
        ), array(
            'safe' => true
        ));
    }
    catch (MongoCursorException $e)
    {
        trigger_error("Insert failed " . $e->getMessage());
        return 'db_error';
    }
    send_register_mail($email, $user, $password, $conf['lang']);
    return 'useradded';
}
function list_suscribed_users($id)
{
    $conf = configurations();
    $con  = new Mongo();
    $db   = $con->$conf['base']->$conf['user'];
    return $db->find(array(
        'projects' => $id
    ));
}
//fonction qui renvoie la la liste des utilisateurs
function list_users($query)
{
    $conf = configurations();
    $con  = new Mongo();
    $db   = $con->$conf['base']->$conf['user'];
    return $db->find($query);
}
function list_bugs($query, $one = false)
{
    $conf = configurations();
    $con  = new Mongo();
    $db   = $con->$conf['base']->$conf['bug'];
    //$query = array($query);
    if ($one)
    {
        return $db->findOne($query);
    }
    else
    {
        return $db->find($query);
    }
}
function check_projects_mod($mod = null)
{
    if (!in_array($_SESSION['currentprojet'], $_SESSION['db_data']['projects']) && user(true) && !vip(true))
    {
        return array(
            'listprojects',
            null,
            'projectforbid'
        );
    }
    if ($mod)
    {
        return $mod;
    }
    return null;
}
function check_projects($query)
{
    $conf = configurations();
    $con  = new Mongo();
    $db   = $con->$conf['base']->$conf['project'];
    return $db->findOne($query);
}
function list_projects($conf = 'configurations')
{
    $conf       = configurations();
    $con        = new Mongo();
    // $db_user = $con->$conf['base']->$conf['user'];
    $db_project = $con->$conf['base']->$conf['project'];
    // if ($_SESSION['db_data']['lvl'] !== 'admin'){
    //   //$list = $db_user->findOne(array('_id' => new MongoId($_SESSION['db_data']['_id'])));
    //   var_dump($_SESSION['db_data']['projects']);
    //   return $db_project->find(array('$or' => array($_SESSION['db_data']['projects'])));
    // }else{
    return $db_project->find(array(
        null
    ));
    // }
}
function reset_password_mail($mail)
{
    $conf = configurations();
    if (is_array($mail))
    {
        return 'html5_nomail';
    }
    $con  = new Mongo();
    $db   = $con->$conf['base']->$conf['user'];
    $user = $db->findOne(array(
        'email' => $mail
    ));
    if (!isset($user['_id']))
    {
        return 'html5_nomail';
    }
    return 'html5_' . reset_password($user['_id']);
}
//fonction qui réinitialiser le mot de passe d'un utilisateur
function reset_password($id, $code = null)
{
    $conf  = configurations();
    $check = check_user(array(
        '_id' => new MongoID($id)
    ));
    if ($check['reset'] != $code && !is_null($code))
    {
        return echo_front_page();
    }
    $password = random_password();
    $hash     = crypt($password);
    $reset    = uniqid('', true);
    $con      = new Mongo();
    $db       = $con->$conf['base']->$conf['user'];
    try
    {
        $db->update(array(
            '_id' => new MongoID($id)
        ), array(
            '$set' => array(
                'password' => $hash,
                'reset' => $reset
            )
        ), array(
            'safe' => true,
            'upsert' => true
        ));
    }
    catch (MongoCursorException $e)
    {
        trigger_error("Insert failed " . $e->getMessage());
        return html5_db_error($conf['lang']);
    }
    send_password_reset_mail($check['email'], $check['user'], $password, $conf['lang']);
    if ($code == null)
    {
        return 'reset_password';
    }
    return echo_front_page('html5_reset_password');
}
//fonction qui change le password d'un utilisateur
function change_password($id, $passwords)
{
    $conf = configurations();
    if ($passwords[1] != $passwords[2])
    {
        return 'notsamepass';
    }
    $check = check_user(array(
        '_id' => new MongoID($id)
    ), $passwords[0]);
    if (!$check[0])
    {
        return 'wrongpass';
    }
    $hash  = crypt($passwords[1]);
    $reset = uniqid('', true);
    $con   = new Mongo();
    $db    = $con->$conf['base']->$conf['user'];
    try
    {
        $db->update(array(
            '_id' => new MongoID($id)
        ), array(
            '$set' => array(
                'password' => $hash,
                'reset' => $reset
            )
        ), array(
            'safe' => true,
            'upsert' => true
        ));
    }
    catch (MongoCursorException $e)
    {
        return 'db_error';
    }
    send_password_mail($check[1]['email'], $check[1]['user'], $check[1]['_id'], $reset, $conf['lang']);
    return 'passchanged';
}
function change_email_user($query, $id, $mod)
{
    $conf = configurations();
    $con  = new Mongo();
    $db   = $con->$conf['base']->$conf['user'];
    try
    {
        $db->update(array(
            '_id' => new MongoID($id)
        ), array(
            '$set' => $query
        ), array(
            'safe' => true,
            'upsert' => true
        ));
    }
    catch (MongoCursorException $e)
    {
        trigger_error('Insert failed ' . $e->getMessage());
        return 'db_error';
    }
    switch ($mod)
    {
        case 'premail':
            send_valid_mail($query['new_mail'], $id, $query['mail_change_id'], $conf['lang']);
            return 'mailvalid';
            break;
        case 'postmail':
            send_confirm_mail($query['email'], $conf['lang']);
            deconnect();
            return echo_front_page('html5_mail_changed');
            break;
        case 'user':
            return 'uservalid';
            break;
    }
}
function send_update_mail($id, $projects)
{
    global $text_cont;
    $conf = configurations();
    $user = check_user(array(
        '_id' => new MongoId($id)
    ));
    if (isset($user['lang']))
    {
        $lang = $user['lang'];
    }
    else
    {
        $lang = $conf['lang'];
    }
    $mail_projects = null;
    if (!count($projects))
    {
        $mail_projects = '  ' . $text_cont[53][$lang];
    }
    else
    {
        foreach ($projects as $key => $value)
        {
            $project = check_projects(array(
                '_id' => new MongoId($value)
            ));
            $mail_projects .= ' - ' . $project['name'] . '
  ';
        }
    }
    $mail_content = $text_cont[111][$lang] . '

' . $mail_projects . '

' . $conf['url'] . $conf['sub-domaine'] . '.' . $conf['domaine'];
    return mail($user['email'], $conf['mailheader'] . ' ' . $text_cont[111][$lang], $mail_content, 'From: no-reply@' . $conf['domaine'] . "\r\n" . "Content-type: text/plain; charset=UTF-8");
}
function send_valid_mail($mail, $id, $code, $lang)
{
    $conf = configurations();
    global $text_cont;
    $mail_content = $text_cont[34][$lang] . ' ' . $text_cont[35][$lang] . '

' . $conf['url'] . $conf['sub-domaine'] . '.' . $conf['domaine'] . '/index.php?action=changemail&user_id=' . $id . '&code=' . $code;
    return mail($mail, $conf['mailheader'] . ' ' . $text_cont[34][$lang], $mail_content, 'From: no-reply@' . $conf['domaine'] . "\r\n" . "Content-type: text/plain; charset=UTF-8");
}
function send_confirm_mail($mail, $lang)
{
    $conf = configurations();
    global $text_cont;
    $mail_content = $text_cont[36][$lang] . '.


' . $conf['url'] . $conf['sub-domaine'] . '.' . $conf['domaine'];
    return mail($mail, $conf['mailheader'] . ' ' . $text_cont[36][$lang], $mail_content, 'From: no-reply@' . $conf['domaine'] . "\r\n" . "Content-type: text/plain; charset=UTF-8");
}
function send_password_mail($mail, $user, $id, $reset, $lang)
{
    $conf = configurations();
    global $text_cont;
    $mail_content = $text_cont[20][$lang] . ' ' . $text_cont[22][$lang] . ' ' . $conf['title'] . '

' . $text_cont[21][$lang] . '
' . $conf['url'] . $conf['sub-domaine'] . '.' . $conf['domaine'] . '/index.php?action=resetpass&user_id=' . $id . '&resetcode=' . $reset;
    return mail($mail, $conf['mailheader'] . ' ' . $text_cont[20][$lang], $mail_content, 'From: no-reply@' . $conf['domaine'] . "\r\n" . "Content-type: text/plain; charset=UTF-8");
}
function send_password_reset_mail($mail, $user, $password, $lang)
{
    $conf = configurations();
    global $text_cont;
    $mail_content = $text_cont[24][$lang] . '.

  ' . $text_cont[2][$lang] . ' : ' . $mail . '
  ' . $text_cont[1][$lang] . ' : ' . $password . '

' . $conf['url'] . $conf['sub-domaine'] . '.' . $conf['domaine'];
    return mail($mail, $conf['mailheader'] . ' ' . $text_cont[24][$lang] . ' ' . $conf['title'], $mail_content, 'From: no-reply@' . $conf['domaine'] . "\r\n" . "Content-type: text/plain; charset=UTF-8");
}
function send_register_mail($mail, $user, $password, $lang)
{
    $conf = configurations();
    global $text_cont;
    $mail_content = $text_cont[9][$lang] . ' ' . $conf['title'] . '

  ' . $text_cont[2][$lang] . ' : ' . $mail . '
  ' . $text_cont[1][$lang] . ' : ' . $password . '

' . $conf['url'] . $conf['sub-domaine'] . '.' . $conf['domaine'];
    return mail($mail, $conf['mailheader'] . ' ' . $text_cont[10][$lang] . ' ' . $conf['title'], $mail_content, 'From: no-reply@' . $conf['domaine'] . "\r\n" . "Content-type: text/plain; charset=UTF-8");
}
function set_remember_me($array)
{
    $conf = configurations();
    $exp  = time() + 60 * 60 * 24 * $conf['cookie_exp'];
    $dom  = $conf['sub-domaine'] . '.' . $conf['domaine'];
    setcookie("cookie[user]", $array['_id'], $exp, '/', $dom);
    setcookie("cookie[pass]", getvalue(explode('$', crypt($array['password'], $conf['cookie_salt'])), 4), $exp, '/', $dom);
}
function cookie_login($id, $password)
{
    $conf = configurations();
    if (is_array($id) || is_array($password))
    {
        trigger_error($id[1] . ' ' . $password[1]);
        return echo_front_page();
    }
    else
    {
        $db_data = check_user(array(
            '_id' => new MongoId($id)
        ));
        if (getvalue(explode('$', crypt($db_data['password'], $conf['cookie_salt'])), 4) != $password)
        {
            trigger_error($db_data['_id'] . ' == ' . $id);
            return echo_front_page();
        }
        else
        {
            $_SESSION['db_data'] = $db_data;
            return get_parser();
        }
    }
}
//fonction appelé quand l'utilisateur se log
function user_login($user, $password, $checkbox)
{
    if (is_array($user) || is_array($password))
    {
        trigger_error($user[1] . ' ' . $password[1]);
        return echo_front_page('html5_log_error');
    }
    else
    {
        $db_data = check_user(array(
            'email' => $user
        ), $password);
        if ($db_data[0] === false)
        {
            trigger_error($db_data[1]);
            return echo_front_page('html5_log_error');
        }
        else
        {
            if ($checkbox)
            {
                set_remember_me($db_data[1]);
            }
            $_SESSION['db_data'] = $db_data[1];
            $get                 = null;
            if (isset($_SESSION['get']))
            {
                if ($_SESSION['get']['action'] !== 'deco')
                {
                    foreach ($_SESSION['get'] as $key => $value)
                    {
                        $get .= $key . '=' . $value . '&';
                    }
                    unset($_SESSION['get']);
                }
            }
            return user_page_display($db_data[1]['user'], $db_data[1]['lvl'], 'redirect', 'index.php?' . $get);
        }
    }
}
//modification des données utilisateurs
function change_user_data($array)
{
    $conf   = configurations();
    $action = array(
        null,
        null
    );
    if (!strlen($_POST['usr_email']) || !strlen($_POST['username']))
    {
        return null;
    }
    //trigger_error($array['email'].' != '.$_POST['usr_email']);
    if (strlen($_POST['usr_email']))
    {
        if (is_array(myfilter($_POST['usr_email'], 'email')))
        {
            return getvalue(myfilter($_POST['usr_email'], 'email'), 1);
        }
        elseif ($array['email'] != $_POST['usr_email'] && !check_user(array(
            'email' => $_POST['usr_email']
        )))
        {
            $action[0] = change_email_user(array(
                'mail_change_id' => uniqid('', true),
                'new_mail' => myfilter($_POST['usr_email'], 'email')
            ), $array['_id'], 'premail');
        }
        elseif (check_user(array(
            'email' => $_POST['usr_email']
        )) && $array['email'] != $_POST['usr_email'])
        {
            return 'mailused';
        }
    }
    if (strlen($_POST['username']))
    {
        if (is_array(myfilter($_POST['username'], 'user')))
        {
            return getvalue(myfilter($_POST['username'], 'user'), 1);
        }
        elseif ($array['user'] != $_POST['username'])
        {
            trigger_error($array['user'] . ' != ' . $_POST['username']);
            $action[1] = change_email_user(array(
                'user' => myfilter($_POST['username'], 'user')
            ), $array['_id'], 'user');
        }
    }
    if (is_array($_POST['project']) && $array['lvl'] !== 'admin')
    {
        foreach ($_POST['project'] as $value)
        {
            if (!is_array(myfilter($value, '_id')))
            {
                $projects[] = myfilter($value, '_id');
            }
        }
    }
    else
    {
        $projects[] = null;
    }
    //mise à jour des projets
    if ($array['lvl'] === 'user' && !$array['vip'])
    {
        $con = new Mongo();
        $db  = $con->$conf['base']->$conf['user'];
        try
        {
            $db->update(array(
                '_id' => new MongoID($array['_id'])
            ), array(
                '$set' => array(
                    'projects' => $projects
                )
            ), array(
                'safe' => true,
                'upsert' => true
            ));
        }
        catch (MongoCursorException $e)
        {
            trigger_error("Insert failed " . $e->getMessage());
            return html5_db_error($conf['lang']);
        }
        send_update_mail($array['_id'], $projects);
    }
    trigger_error($action[0] . $action[1]);
    return $action[0] . $action[1];
}
function delete_user($id)
{
    $conf = configurations();
    $con  = new Mongo();
    $db   = $con->$conf['base']->$conf['user'];
    trigger_error($id);
    if (getvalue(check_user(array(
        '_id' => new MongoID($id)
    )), 0) !== false)
    {
        try
        {
            $db->remove(array(
                '_id' => new MongoID($id)
            ), array(
                'safe' => true
            ));
        }
        catch (MongoCursorException $e)
        {
            return array(
                false,
                "Remove failed " . $e->getMessage()
            );
        }
        $list_users = list_users(array(
            null
        ));
        return user_page_display($_SESSION['db_data']['user'], $_SESSION['db_data']['lvl'], 'listusers', $list_users);
    }
}
function delete_file($id, $key)
{
    $conf    = configurations();
    $con     = new Mongo();
    $db      = $con->$conf['base']->$conf['project'];
    $project = check_projects(array(
        '_id' => new MongoId($id)
    ));
    if (isset($project['files'][$key]))
    {
        try
        {
            $db->update(array(
                '_id' => new MongoID($id)
            ), array(
                '$unset' => array(
                    'files.' . $key => array()
                )
            ), array(
                'safe' => true,
                'upsert' => true
            ));
        }
        catch (MongoCursorException $e)
        {
            trigger_error("Remove failed " . $e->getMessage() . $sha1);
            return 'db_error';
        }
        //remove file
        rrmdir('files/' . file_name($project['name']) . '/' . file_name($project['version']));
        return 'filedeleted';
    }
}
function deconnect($conf = 'configurations')
{
    $conf = configurations();
    $dom  = $conf['sub-domaine'] . '.' . $conf['domaine'];
    session_unset();
    session_destroy();
    setcookie('cookie[user]', null, -1, '/', $dom);
    setcookie('cookie[pass]', null, -1, '/', $dom);
    return echo_front_page();
}
function get_parser()
{
    $conf = configurations();
    if (!$_GET)
    {
        return user_page_display($_SESSION['db_data']['user'], $_SESSION['db_data']['lvl'], 'listprojects');
    }
    if (isset($_GET['mod']))
    {
        if (is_array(myfilter($_GET['mod'], 'mod')))
        {
            trigger_error('potential attack using mod');
            return deconnect();
        }
        else
        {
            $mod = $_GET['mod'];
        }
    }
    else
    {
        $mod = null;
    }
    switch ($_GET['action'])
    {
        case 'adduser':
            if (admin(true))
            {
                if ($_POST['usr_email'] && $_POST['username'])
                {
                    return user_page_display($_SESSION['db_data']['user'], $_SESSION['db_data']['lvl'], 'adduser', add_user(myfilter($_POST['usr_email'], 'email'), myfilter($_POST['username'], 'user'), myfilter($_POST['lvl'], 'lvl')));
                }
                return user_page_display($_SESSION['db_data']['user'], $_SESSION['db_data']['lvl'], 'adduser');
            }
            break;
        case 'listusers':
            if (admin(true))
            {
                $list_users = list_users(array(
                    null
                ));
                return user_page_display($_SESSION['db_data']['user'], $_SESSION['db_data']['lvl'], 'listusers', $list_users);
            }
            break;
        case 'deco':
            return deconnect();
            break;
        case 'modpass':
            if ($_POST['oldpass'] && $_POST['password1'] && $_POST['password2'])
            {
                $pass = array(
                    myfilter($_POST['oldpass'], 'password'),
                    myfilter($_POST['password1'], 'password'),
                    myfilter($_POST['password2'], 'password')
                );
                if (is_string($pass[0]) && is_string($pass[1]) && is_string($pass[2]))
                {
                    $change = change_password($_SESSION['db_data']['_id'], $pass);
                    return user_page_display($_SESSION['db_data']['user'], $_SESSION['db_data']['lvl'], 'changepass', $change);
                }
            }
            return user_page_display($_SESSION['db_data']['user'], $_SESSION['db_data']['lvl'], 'changepass', null);
            break;
        case 'resetpass';
            if (isset($_GET['user_id']) && isset($_GET['resetcode']) && !is_array($_GET['user_id']) && !is_array($_GET['resetcode']))
            {
                return reset_password($_GET['user_id'], $_GET['resetcode']);
            }
            elseif (isset($_GET['user_id']) && !is_array($_GET['user_id']) && admin(true))
            {
                return user_page_display($_SESSION['db_data']['user'], $_SESSION['db_data']['lvl'], 'edit_user', reset_password($_GET['user_id']));
            }
            break;
        case 'edituser':
            if (isset($_GET['user_id']))
            {
                if (user(true) && $_GET['user_id'] == $_SESSION['db_data']['_id'])
                {
                    return user_page_display($_SESSION['db_data']['user'], $_SESSION['db_data']['lvl'], 'edit_user', change_user_data($_SESSION['db_data']));
                }
                if (admin(true) && !is_array($_GET['user_id']))
                {
                    return user_page_display($_SESSION['db_data']['user'], $_SESSION['db_data']['lvl'], 'edit_user', change_user_data(check_user(array(
                        '_id' => new MongoID(myfilter($_GET['user_id'], '_id'))
                    ))));
                }
            }
            break;
        case 'changemail':
            if (isset($_GET['user_id']) && isset($_GET['code']))
            {
                $db = check_user(array(
                    '_id' => new MongoID(myfilter($_GET['user_id'], '_id'))
                ));
                if ($db['mail_change_id'] == $_GET['code'])
                {
                    return change_email_user(array(
                        'email' => $db['new_mail'],
                        'new_mail' => null,
                        'mail_change_id' => null
                    ), myfilter($_GET['user_id'], '_id'), 'postmail');
                }
            }
            break;
        case 'deluser':
            if (admin(true) && !is_array($_GET['user_id']))
            {
                return delete_user(myfilter($_GET['user_id'], '_id'));
            }
            break;
        case 'addproject':
            if (admin(true))
            {
                return user_page_display($_SESSION['db_data']['user'], $_SESSION['db_data']['lvl'], 'add_project', addproject());
            }
            break;
        case 'project':
            if (isset($_GET['project_id']))
            {
                if (!is_array(myfilter($_GET['project_id'], '_id')))
                {
                    $_SESSION['currentprojet'] = myfilter($_GET['project_id'], '_id');
                    return user_page_display($_SESSION['db_data']['user'], $_SESSION['db_data']['lvl'], 'project', check_projects_mod($mod));
                }
            }
            break;
        case 'getfile':
            if (isset($_GET['file']) && isset($_GET['key']) && isset($_GET['id']) && isset($_GET['os']) && isset($_GET['arch']))
            {
                if (!is_array(myfilter($_GET['file'], 'sha1')) && !is_array(myfilter($_GET['key'], 'timestamp')) && !is_array(myfilter($_GET['id'], '_id')) && !is_array($_GET['os']) && !is_array($_GET['arch']))
                {
                    return down_file(myfilter($_GET['file'], 'sha1'), myfilter($_GET['key'], 'timestamp'), base64_decode(urldecode($_GET['os'])), base64_decode(urldecode($_GET['arch'])), myfilter($_GET['id'], '_id'));
                }
            }
            break;
        case 'addfile':
            if (admin(true) && isset($_GET['id']))
            {
                if (!is_array(myfilter($_GET['id'], '_id')))
                {
                    return user_page_display($_SESSION['db_data']['user'], $_SESSION['db_data']['lvl'], 'add_file', addfile(myfilter($_GET['id'], '_id')));
                }
            }
            break;
        case 'deletefile':
            if (admin(true) && isset($_GET['id']) && isset($_GET['key']))
            {
                if (!is_array(myfilter($_GET['id'], '_id')) && !is_array(myfilter($_GET['key'], 'timestamp')))
                {
                    return user_page_display($_SESSION['db_data']['user'], $_SESSION['db_data']['lvl'], 'project', delete_file(myfilter($_GET['id'], '_id'), myfilter($_GET['key'], 'timestamp')));
                }
            }
            break;
        case 'usersetting':
            if (isset($_GET['user_id']))
            {
                if (user(true) && $_GET['user_id'] == $_SESSION['db_data']['_id'])
                {
                    return user_page_display($_SESSION['db_data']['user'], $_SESSION['db_data']['lvl'], 'setting', change_user_setting($_SESSION['db_data']['_id']));
                }
            }
            break;
        case 'bug':
            if (isset($_GET['id']))
            {
                if (!is_array(myfilter($_GET['id'], '_id')))
                {
                    return user_page_display($_SESSION['db_data']['user'], $_SESSION['db_data']['lvl'], 'bug', check_bug($mod));
                }
            }
            break;
        case 'submitbug':
            if (isset($_GET['id']))
            {
                if (user(true) && in_array($_GET['id'], $_SESSION['db_data']['projects']))
                {
                    $_SESSION['idbug'] = $_GET['id'];
                    return user_page_display($_SESSION['db_data']['user'], $_SESSION['db_data']['lvl'], 'submitbug', add_bug($_POST, $_GET['id']));
                }
                if (admin(true) || vip(true))
                {
                    if (!is_array(myfilter($_GET['id'], '_id')))
                    {
                        $_SESSION['idbug'] = $_GET['id'];
                        return user_page_display($_SESSION['db_data']['user'], $_SESSION['db_data']['lvl'], 'submitbug', add_bug($_POST, $_GET['id']));
                    }
                }
            }
            break;
        case 'listprojects':
            return user_page_display($_SESSION['db_data']['user'], $_SESSION['db_data']['lvl'], 'listprojects', $mod);
            break;
        case 'editbug':
            if (strlen($_POST['status']) && isset($_GET['id']) && admin(true))
            {
                if (!is_array($_POST['status']) && !is_array(myfilter($_GET['id'], '_id')))
                {
                    if (in_array($_POST['status'], $conf['bugs']['Open']) || in_array($_POST['status'], $conf['bugs']['Closed']))
                    {
                        return user_page_display($_SESSION['db_data']['user'], $_SESSION['db_data']['lvl'], 'bug', edit_bug($_POST['status']));
                    }
                }
            }
            break;
        case 'resetpassmail':
            if (strlen($_POST['usr_email']))
            {
                return echo_front_page(reset_password_mail(myfilter($_POST['usr_email'], 'email')));
            }
            break;
        case 'editproject':
            if (isset($_GET['id']) && admin(true))
            {
                if (!is_array(myfilter($_GET['id'], '_id')))
                {
                    return user_page_display($_SESSION['db_data']['user'], $_SESSION['db_data']['lvl'], 'edit_project', edit_project($_POST));
                }
            }
            break;
    }
    return echo_front_page();
}
//fonction qui parse les variables appelés
function parse()
{
    if (isset($_SESSION['db_data']) || $_GET['action'] == 'resetpass' || $_GET['action'] == 'changemail' || $_GET['action'] == 'resetpassmail')
    {
        return get_parser();
    }
    if (isset($_POST['usr_email']))
    {
        return user_login(myfilter($_POST['usr_email'], 'user'), myfilter($_POST['password'], 'password'), myfilter($_POST['remember_me'], 'bool'));
    }
    if (isset($_COOKIE['cookie']['user']) && isset($_COOKIE['cookie']['pass']))
    {
        return cookie_login(myfilter($_COOKIE['cookie']['user'], '_id'), myfilter($_COOKIE['cookie']['pass'], 'password'));
    }
    if (isset($_GET['action']))
    {
        $_SESSION['get'] = $_GET;
    }
    return echo_front_page();
}
?>