--TEST--
Generator - INI file
--FILE--
<?php
require_once 'includes/init.php';
 
 

// test structure from introspection
 

 
// sqlite
PDO_DataObject::config(array(
        'PDO' => 'PDO', // we can do this for real...
        'tables' => array(
            'Customers' => 'EssentialSQL'
        )
        'databases' => array(
            'EssentialSQL' => 'sqlite:'.__DIR__.'/includes/EssentialSQL.db'
        ),
        'proxy' => true,
        'debug' => 0,
));

 

 


$gen = (new PDO_DataObject('EssentialSQL/Customers'))->generator();

PDO_DataObject_Generator::config(array(
         
           // 'build_views' => true,
            //'strip_schema' => true,
            'embed_schema' => true,
              
        
            //'generate_links' => true,
        
            //'var_keyword' => 'private',
                
            //'add_database_nickname' => true,
                
            // 'no_column_vars' => false,
                
                
            'setters' => true,
            'getters' => true,
            'add_defaults' => true,
            'link_methods'  =>true,
                
           // 'include_regex' =>  '/^Companies$/'
            //'exclude_regex' => false,
              
            


));

$gen->readTableList();
echo $gen->toIni();
echo $gen->toLinksIni(); 

echo $gen->toPhp('Companies');
 echo $gen->toPhp('address'); // a view..
 
?>
--EXPECT--