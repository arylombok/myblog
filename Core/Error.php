<?php
namespace Core;

/**
* Error and Exception handler
*
*/
class Error
{
	/**
	* Error handler. convert all errors to exception by throwing an errorException.
	* @param int $level Error level
	* @param string $message Error message  
	* @param string $file Filename the error was raised in 
	* @param string $line Line Number in the file
	* @return void 
	*
	*/

	public static function errorHandler($level,$message,$file,$line)
	{
		if (error_reporting() !== 0){ //to keep the @ operator working
			throw new \ErrorException($message,0,$level,$file,$line);
		}
	}

	/**
	* Exception handler 
	*
	* @param Exception $exception The Exception
	* @return voids
	*/

	public static function exceptionHandler($exception)
	{
		// $exception="";
		if (\App\Config::SHOW_ERRORS){
			echo "<h1>Fatal Error</h1>";
			echo "<p>Uncaught exception: '".get_class($exception)."'</p>";
			echo "<p>Message:'".$exception->getMessage()."'</p>";
			echo "<p>Stack trace: <pre>".$exception->getTraceAsString()."</pre></p>";
			echo "Thrown in '".$exception->getFile()."' on Line".$exception->getLine()."</p>";
		}else {
			$log = dirname(__DIR__).'/Logs/'.date('Y-m-d').'.txt';
			ini_set('error_log', $log);

			$message = "Uncaught exception :'".get_class($exception)."'";
			$message .= "with message '".$exception->getMessage()."'";
			$message .= "\nStack trace : ".$exception->getTraceAsString();
			$message .= "\nThrown in '".$exception->getFile()."' on line".$exception->getLine();

			error_log($message);
			require "../App/Views/Error/error-404.php";
			// echo "<h1>An Error occured</h1>";
		}
	}
}