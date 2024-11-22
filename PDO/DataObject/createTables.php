#!/usr/bin/env -S php -q
<?php
/**
 * Generation tools for PDO_DataObject
 *
 * For PHP versions  5 and 7
 * 
 * 
 * Copyright (c) 2023 Alan Knowles
 * 
 * This program is free software: you can redistribute it and/or modify  
 * it under the terms of the GNU Lesser General Public License as   
 * published by the Free Software Foundation, version 3.
 *
 * This program is distributed in the hope that it will be useful, but 
 * WITHOUT ANY WARRANTY; without even the implied warranty of 
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU 
 * Lesser General Lesser Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public License
 * along with this program. If not, see <http://www.gnu.org/licenses/>.
 *  
 * @category   Database
 * @package    PDO_DataObject
 * @author     Alan Knowles <alan@roojs.com>
 * @copyright  2016 Alan Knowles
 * @license    https://www.gnu.org/licenses/lgpl-3.0.en.html  LGPL 3
 * @version    1.0
 * @link       https://github.com/roojs/PDO_DataObject
 */

// include path needs to be set up correctly..?
// require_once 'PDO/DataObject/Generator.php';
// or use composer... 
// Make sure autoload.php is found
require_once '../vendor/autoload.php';

$do = new PDO_DataObject();

if (!ini_get('register_argc_argv')) {
    $do->raise(
        "\nERROR: You must turn register_argc_argv On in you php.ini file for this to work\n" .
        "eg.\n\nregister_argc_argv = On\n\n",
        "InvalidConfig"
    );
}

if (!@$_SERVER['argv'][1]) {
    $do->raise(
        "\nERROR: createTable.php usage:\n\n\PDO\DataObjects\createTable.php example.ini\n\n",
        "InvalidArgs"
    );
    exit;
}

$config = parse_ini_file($_SERVER['argv'][1], true);

foreach($config as $class=>$values) {
    switch($class) {
        case 'PDO_DataObject':
            PDO_DataObject::config($values);
            break;
        
        case 'PDO_DataObject_Generator':
            PDO_DataObject_Generator::config($values);
            break;
                
        default:
            // skip... just ingore stuff..
    }
}

set_time_limit(0);
echo "Generating files ...\n";
$generator = new PDO_DataObject_Generator();
$generator->start();
echo "Ready!\n";
