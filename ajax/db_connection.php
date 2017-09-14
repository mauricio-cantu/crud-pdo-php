<?php

define('HOST', 'localhost');
define('USER', 'root'); 
define('PASSWORD', 'root'); 
define('DATABASE', 'php_pdo'); 
define('CHARSET', 'utf8');

function DB()
{
    static $instance;
    
    if ($instance === null) {
        $opt = array(
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => FALSE,
        );

	    $dsn = 'mysql:host=' . HOST . ';dbname=' . DATABASE . ';charset=' . CHARSET;
		
		try
		{
			$instance = new PDO($dsn, USER, PASSWORD, $opt);
		}

		catch(PDOException $e)
		{
			echo $e->getMessage();
		}

    }
    
    return $instance;
}


?>
