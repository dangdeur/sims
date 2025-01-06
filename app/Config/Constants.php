<?php
defined( 'SEKOLAH' ) || define( 'SEKOLAH', 'SMKN 2 Pandeglang' );
//defined( 'KODESEKOLAH' ) || define( 'KODESEKOLAH', '02' );
defined( 'JARGON' ) || define( 'JARGON', 'SMK Pusat Keunggulan' );
defined( 'WEB' ) || define( 'WEB', 'www.smkn2pandeglang.sch.id' );
defined( 'SITUS' ) || define( 'SITUS', 'SIMS SMKN 2 Pandeglang' );
defined( 'HARI_PBM' ) || define( 'HARI_PBM', [ 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat' ] );
defined( 'JAM_PBM' ) || define( 'JAM_PBM', [
    '10'=>'08:00-08:45', '11'=>'08:45-09:30', '12'=>'09:45-10:30', '13'=>'10:30-11:15', '14'=>'11:15-12:00', '15'=>'12:30-13:10', '16'=>'13:10-13:50', '17'=>'13:50-14:30', '18'=>'14:30-15:10', '19'=>'15:10-15:50',
    //'20'=>'07:15-08:00', '21'=>'08:00-08:45', '22'=>'08:45-09:30', '23'=>'09:45-10:30', '24'=>'10:30-11:15', '25'=>'11:15-12:00', '26'=>'12:30-13:15', '27'=>'13:15-14:00', '28'=>'14:00-14:45', '29'=>'14:45-15:30',
    '20'=>'08:00-08:45', '21'=>'08:45-09:30', '22'=>'09:45-10:30', '23'=>'10:30-11:15', '24'=>'11:15-12:00', '25'=>'12:30-13:10', '26'=>'13:10-13:50', '27'=>'13:50-14:30', '28'=>'14:30-15:10', '29'=>'15:10-15:50',
    '30'=>'07:15-08:00', '31'=>'08:00-08:45', '32'=>'08:45-09:30', '33'=>'09:45-10:30', '34'=>'10:30-11:15', '35'=>'11:15-12:00', '36'=>'12:30-13:15', '37'=>'13:15-14:00', '38'=>'14:00-14:45', '39'=>'14:45-15:30',
    '40'=>'07:15-08:00', '41'=>'08:00-08:45', '42'=>'08:45-09:30', '43'=>'09:45-10:30', '44'=>'10:30-11:15', '45'=>'11:15-12:00', '46'=>'12:30-13:15', '47'=>'13:15-14:00', '48'=>'14:00-14:45', '49'=>'14:45-15:30',
    '50'=>'08:00-08:45', '51'=>'08:45-09:30', '52'=>'09:45-10:30', '53'=>'10:30-11:15', '54'=>'13:00-13:40', '55'=>'13:40-14:20', '56'=>'14:20-15:00', '57'=>'15:00-15:40'
] );

defined( 'TAPEL' ) || define( 'TAPEL', '2024/2025' );
defined( 'SEMESTER' ) || define( 'SEMESTER', 'GENAP' );
defined( 'PEJABAT' ) || define( 'PEJABAT', [
    'kepsek'=>['nama'=>'Drs. Ade Firdaus, M. Pd.','nip'=>'196606061992121003'],
    'wakakur'=>['nama'=>'Retno Utami K, S. TP., M. Si.','nip'=>'197011201997032007'],
]);
defined( 'JP' ) || define( 'JP', [
    '1'=>[ '1'=>'08:00-08:45', '2'=>'08:45-09:30', '3'=>'09:45-10:30', '4'=>'10:30-11:15', '5'=>'11:15-12:00', '6'=>'12:30-13:10', '7'=>'13:10-13:50', '8'=>'13:50-14:30', '9'=>'14:30-15:10', '10'=>'15:10-15:50' ],
    //'2'=>[ '1'=>'07:15-08:00', '2'=>'08:00-08:45', '3'=>'08:45-09:30', '4'=>'09:45-10:30', '5'=>'10:30-11:15', '6'=>'11:15-12:00', '7'=>'12:30-13:15', '8'=>'13:15-14:00', '9'=>'14:00-14:45', '10'=>'14:45-15:30' ],
    '2'=>[ '1'=>'08:00-08:45', '2'=>'08:45-09:30', '3'=>'09:45-10:30', '4'=>'10:30-11:15', '5'=>'11:15-12:00', '6'=>'12:30-13:10', '7'=>'13:10-13:50', '8'=>'13:50-14:30', '9'=>'14:30-15:10', '10'=>'15:10-15:50' ],
    '3'=>[ '1'=>'07:15-08:00', '2'=>'08:00-08:45', '3'=>'08:45-09:30', '4'=>'09:45-10:30', '5'=>'10:30-11:15', '6'=>'11:15-12:00', '7'=>'12:30-13:15', '8'=>'13:15-14:00', '9'=>'14:00-14:45', '10'=>'14:45-15:30' ],
    '4'=>[ '1'=>'07:15-08:00', '2'=>'08:00-08:45', '3'=>'08:45-09:30', '4'=>'09:45-10:30', '5'=>'10:30-11:15', '6'=>'11:15-12:00', '7'=>'12:30-13:15', '8'=>'13:15-14:00', '9'=>'14:00-14:45', '10'=>'14:45-15:30' ],
    '5'=>[ '1'=>'08:00-08:45', '2'=>'08:45-09:30', '3'=>'09:45-10:30', '4'=>'10:30-11:15', '5'=>'13:00-13:40', '6'=>'13:40-14:20', '7'=>'14:20-15:00', '8'=>'15:00-15:40' ],
    '6'=>[ 'Sabtu-Tidak ada PBM' ],
    '7'=>[ 'Minggu-Tidak ada PBM' ]
] );

defined( 'JABATAN' ) || define( 'JABATAN', ['Wakil'=>'Wakil Kepala','Kurikulum'=>'Staf Kurikulum','BP/BK'=>'BP/BK','Bendahara'=>'Bendahara',
'Kajur'=>'Ketua KK','HKI'=>'Staf HKI','Pembina'=>'Pembina Ekskul','Piket'=>'Piket'

]);

defined( 'LOKASI' ) || define( 'LOKASI', ['Ruang Kelas','Laboratorium','Lapangan Basket', 'Aula Bukit', 'Mesjid','Saung Batik']);
defined( 'TANGGAL' ) || define( 'TANGGAL', [
'01'=>'01','02'=>'02','03'=>'03','04'=>'04','05'=>'05','06'=>'06','07'=>'07','08'=>'08','09'=>'09',
                      '10'=>'10','11'=>'11','12'=>'12','13'=>'13','14'=>'14','15'=>'15','16'=>'16','17'=>'17','18'=>'18','19'=>'19',
                      '20'=>'20','21'=>'21','22'=>'22','23'=>'23','24'=>'24','25'=>'25','26'=>'26','27'=>'27','28'=>'28','29'=>'29',
                      '30'=>'30','31'=>'31'
]);

defined( 'BULAN' ) || define( 'BULAN', ['01'=>'Januari','02'=>'Februari','03'=>'Maret','04'=>'April','05'=>'Mei','06'=>'Juni','07'=>'Juli',
                            '08'=>'Agustus','09'=>'September','10'=>'Oktober','11'=>'November','12'=>'Desember'] );

//Program keahlian
defined( 'PROGRAM_KEAHLIAN' ) || define( 'PROGRAM_KEAHLIAN', [ '---', 'Agribisnis Tanaman (AT)', 'Agribisnis Pengolahan Hasil Pertanian (APHP)', 'Teknik Otomotif-Kendaraan Ringan (TKRO)', 'Teknik Otomotif-Bisnis Sepeda Motor (TBSM)', 'Teknik Ketenagalistrikan (TKL)',
'Desain Komunikasi Visual (DKV)', 'Teknik Komputer Dan Jaringan (TJKT)', 'Analisis Pengujian Laboratorium (APL)' ] );



//
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
defined( 'APP_NAMESPACE' ) || define( 'APP_NAMESPACE', 'App' );

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
define('EVENT_PRIORITY_HIGH', 10 );
