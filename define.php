<?php
/**
 * Created by PhpStorm.
 * User: PC
 * Date: 12-Jan-18
 * Time: 5:51 AM
 */
define('DS',DIRECTORY_SEPARATOR);
define('ROOT_PATH',dirname(__FILE__)); // specifies path root
define('LIBRATY_PATH', ROOT_PATH .DS.'libs'. DS); //
define('PUBLIC_PATH', ROOT_PATH .DS.'public'. DS);



define('TEMPLATE_PATH', 'template'. DS);
define('APPLICATION_PATH', 'default');
define('CONTROLLER_PATH', 'index');
define('ACTION_PATH', 'index');

define('APPLICATION_ROOT', 'application'. DS); // đinh nghĩa cho models
define('MODULE_ROOT',APPLICATION_ROOT. 'module'. DS); // đinh nghĩa cho models
define('MODULE_BLOCK',APPLICATION_ROOT. 'block'. DS); // đinh nghĩa cho models
define('PRIVATE_NAME','private'); // đinh nghĩa cho models


// đường dẫn ương đối
define('ROOT_URL',DS);
define('PATH_CSS'  ,ROOT_URL. APPLICATION_ROOT );
define('PUBLIC_URL', 'public'. DS);
define('SCRIPT', 'libs'. DS. 'scripts');
define('VIEW_URL',ROOT_URL. 'View' . DS);
define('TEMPLATE_URL',PUBLIC_URL. TEMPLATE_PATH);

define('PUBLIC_FILE', PUBLIC_URL. 'files'. DS);
define('FILE_IMG',  'files'. DS);
define('FILE_CATEGORY', 'category');
define('FILE_BOOK', 'book');
define('FILE_FUNCTION', 'function');
define('FOLDER_IMG', PUBLIC_URL. 'template'. DS. 'default/main'. DS. 'images');








// định nghĩa cho CSDL

define('DS_HOST','localhost');
define('DS_NAME','b33_21930263');
define('DS_PASS','123456');

define('DS_DATABASE','b33_21930263_bookstore');

define('DS_TABLE','group');
define('DS_TABLE_USER','user');
define('DS_CATEGORY','category');
define('DS_BOOK','book');
define('DS_CART','cart');

define('TIME_LOG',3600);

