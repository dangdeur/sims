<?php
//defined('JAM_PBM') || define('PENDAFTARAN','TUTUP');
//pekerjaan
defined('HARI_PBM') || define('HARI_PBM',['Senin','Selasa','Rabu','Kamis','Jumat']);
defined('JAM_PBM') || define('JAM_PBM',[
    '10'=>'08:00-08:45','11'=>'08:45-09:30','12'=>'09:45-10:30','13'=>'10:30-11:15','14'=>'11:15-12:00','15'=>'12:30-13:15','16'=>'13:15-14:00','17'=>'14:00-14:45','18'=>'14:45-15:30','19'=>'14:45-15:30',
    '20'=>'07:15-08:00','21'=>'08:00-08:45','22'=>'08:45-09:30','23'=>'09:45-10:30','24'=>'10:30-11:15','25'=>'11:15-12:00','26'=>'12:30-13:15','27'=>'13:15-14:00','28'=>'14:00-14:45','29'=>'14:45-15:30',
    '30'=>'07:15-08:00','31'=>'08:00-08:45','32'=>'08:45-09:30','33'=>'09:45-10:30','34'=>'10:30-11:15','35'=>'11:15-12:00','36'=>'12:30-13:15','37'=>'13:15-14:00','38'=>'14:00-14:45','39'=>'14:45-15:30',
    '40'=>'07:15-08:00','41'=>'08:00-08:45','42'=>'08:45-09:30','43'=>'09:45-10:30','44'=>'10:30-11:15','45'=>'11:15-12:00','46'=>'12:30-13:15','47'=>'13:15-14:00','48'=>'14:00-14:45','49'=>'14:45-15:30',
    '50'=>'07:15-08:00','51'=>'08:00-08:45','52'=>'08:45-09:30','53'=>'09:45-10:30','54'=>'10:30-11:15','55'=>'11:15-12:00','56'=>'12:30-13:15','57'=>'13:15-14:00'
    ]);
/*
 | --------------------------------------------------------------------
 | App Namespace
 | --------------------------------------------------------------------
 |
 | This defines the default Namespace that is used throughout
 | CodeIgniter to refer to the Application directory. Change
 | this constant to change the namespace that all application
 | classes should use.
 |
 | NOTE: changing this will require manually modifying the
 | existing namespaces of App\* namespaced-classes.
 */
defined('APP_NAMESPACE') || define('APP_NAMESPACE', 'App');

/*
 | --------------------------------------------------------------------------
 | Composer Path
 | --------------------------------------------------------------------------
 |
 | The path that Composer's autoload file is expected to live. By default,
 | the vendor folder is in the Root directory, but you can customize that here.
 */
defined('COMPOSER_PATH') || define('COMPOSER_PATH', ROOTPATH . 'vendor/autoload.php');

/*
 |--------------------------------------------------------------------------
 | Timing Constants
 |--------------------------------------------------------------------------
 |
 | Provide simple ways to work with the myriad of PHP functions that
 | require information to be in seconds.
 */
defined('SECOND') || define('SECOND', 1);
defined('MINUTE') || define('MINUTE', 60);
defined('HOUR')   || define('HOUR', 3600);
defined('DAY')    || define('DAY', 86400);
defined('WEEK')   || define('WEEK', 604800);
defined('MONTH')  || define('MONTH', 2_592_000);
defined('YEAR')   || define('YEAR', 31_536_000);
defined('DECADE') || define('DECADE', 315_360_000);

/*
 | --------------------------------------------------------------------------
 | Exit Status Codes
 | --------------------------------------------------------------------------
 |
 | Used to indicate the conditions under which the script is exit()ing.
 | While there is no universal standard for error codes, there are some
 | broad conventions.  Three such conventions are mentioned below, for
 | those who wish to make use of them.  The CodeIgniter defaults were
 | chosen for the least overlap with these conventions, while still
 | leaving room for others to be defined in future versions and user
 | applications.
 |
 | The three main conventions used for determining exit status codes
 | are as follows:
 |
 |    Standard C/C++ Library (stdlibc):
 |       http://www.gnu.org/software/libc/manual/html_node/Exit-Status.html
 |       (This link also contains other GNU-specific conventions)
 |    BSD sysexits.h:
 |       http://www.gsp.com/cgi-bin/man.cgi?section=3&topic=sysexits
 |    Bash scripting:
 |       http://tldp.org/LDP/abs/html/exitcodes.html
 |
 */
defined('EXIT_SUCCESS')        || define('EXIT_SUCCESS', 0);        // no errors
defined('EXIT_ERROR')          || define('EXIT_ERROR', 1);          // generic error
defined('EXIT_CONFIG')         || define('EXIT_CONFIG', 3);         // configuration error
defined('EXIT_UNKNOWN_FILE')   || define('EXIT_UNKNOWN_FILE', 4);   // file not found
defined('EXIT_UNKNOWN_CLASS')  || define('EXIT_UNKNOWN_CLASS', 5);  // unknown class
defined('EXIT_UNKNOWN_METHOD') || define('EXIT_UNKNOWN_METHOD', 6); // unknown class member
defined('EXIT_USER_INPUT')     || define('EXIT_USER_INPUT', 7);     // invalid user input
defined('EXIT_DATABASE')       || define('EXIT_DATABASE', 8);       // database error
defined('EXIT__AUTO_MIN')      || define('EXIT__AUTO_MIN', 9);      // lowest automatically-assigned error code
defined('EXIT__AUTO_MAX')      || define('EXIT__AUTO_MAX', 125);    // highest automatically-assigned error code

/**
 * @deprecated Use \CodeIgniter\Events\Events::PRIORITY_LOW instead.
 */
define('EVENT_PRIORITY_LOW', 200);

/**
 * @deprecated Use \CodeIgniter\Events\Events::PRIORITY_NORMAL instead.
 */
define('EVENT_PRIORITY_NORMAL', 100);

/**
 * @deprecated Use \CodeIgniter\Events\Events::PRIORITY_HIGH instead.
 */
define('EVENT_PRIORITY_HIGH', 10);
