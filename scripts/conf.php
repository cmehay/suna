<?php
//quelques configurations
function configurations()
{
    return array(
        'title' => 'Some name',
        'lang' => set_language(),
        'style' => 'styles/style.css',
        'scripts' => array(
            'js/jquery-1.8.1.min.js',
            'js/awesome.js'
        ),
        'mailheader' => '[SSome header]',
        'domaine' => 'some-domaine.com',
        'sub-domaine' => 'www',
        'url' => 'https://',
        'cookie_salt' => '$5$rounds=2513$A3xbn9p2glIH1xTbYnctoVfIRY64lJLZ$', //à remplacer en cas de compromission de la base de donné
        'cookie_exp' => 90,
        'user_lenght' => '50',
        'password_lenght' => '50',
        'projectname_lenght' => '50',
        'version_lenght' => '20',
        'upload_dir' => 'upload',
        'lang_available' => array(
            'fr' => 'Français',
            'en' => 'English'
        ),
        'bugs' => array(
            //le premier est celui par défaut lors d'un rapport
            'Open' => array(
                'Unconfirmed',
                'Assigned'
            ),
            'Closed' => array(
                'Fixed',
                'WontFix',
                'Invalid'
            )
        ),
        'os' => array(
            'Windows',
            'Mac',
            'Linux',
            'Android'
        ),
        'arch' => array(
            'x84',
            'x64',
            'arm'
        ),
        //database
        'base' => 'some_base',
        'user' => 'users',
        'project' => 'projects',
        'bug' => 'bugs',
        'inc' => 'inc'
    );
}
function modsavailable()
{
    return array(
        'db_error',
        'reset_password',
        'notmail',
        'userexist',
        'passchanged',
        'log_error',
        'attack',
        'toolarge',
        'mail_changed',
        'mailvalid',
        'uservalid',
        'mailvaliduservalid',
        'mailused',
        'notsamepass',
        'wrongpass',
        'projectexist',
        'desctoolarge',
        'projectadded',
        'fileexist',
        'fieldmissing',
        'fileadded',
        'nofile',
        'filedeleted',
        'useradded',
        'dataupdated',
        'bugreported',
        'bugerror',
        'projectforbid',
        'bugforbid',
        'commentadded',
        'logged',
        'fieldcheck',
        'statuschanged',
        'error'
    );
}
?>