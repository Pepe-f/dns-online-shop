<?php

namespace dns;

class ErrorHandler
{
	public function __construct()
	{
		if (DEBUG) {
			error_reporting(-1);
		} else {
			error_reporting(0);
		}
		set_exception_handler([$this, 'exceptionHandler']);
		set_error_handler([$this, 'errorHandler']);
		ob_start();
		register_shutdown_function([$this, 'fatalErrorHandler']);
	}

	public function errorHandler(
		$errorNumber,
		$errorString,
		$errorFile,
		$errorLine
	) {
		$this->logError($errorString, $errorFile, $errorLine);
		$this->displayError($errorNumber, $errorString, $errorFile, $errorLine);
	}

	public function fatalErrorHandler()
	{
		$error = error_get_last();
		if (
			!empty($error) &&
			$error['type'] & (E_ERROR | E_PARSE | E_COMPILE_ERROR | E_CORE_ERROR)
		) {
			$this->logError($error['message'], $error['file'], $error['line']);
			ob_end_clean();
			$this->displayError(
				$error['type'],
				$error['message'],
				$error['file'],
				$error['line']
			);
		} else {
			ob_end_flush();
		}
	}

	public function exceptionHandler(\Throwable $e)
	{
		$this->logError($e->getMessage(), $e->getFile(), $e->getLine());
		$this->displayError(
			'Исключение',
			$e->getMessage(),
			$e->getFile(),
			$e->getLine(),
			$e->getCode()
		);
	}

	protected function logError($message = '', $file = '', $line = '')
	{
		file_put_contents(
			LOGS . '/errors.log',
			'[' .
				date('Y-m-d H:i:s') .
				"] Текст ошибки: {$message} | Файл: {$file} | Строка: {$line}\n=================\n",
			FILE_APPEND
		);
	}

	protected function displayError(
		$errorNumber,
		$errorString,
		$errorFile,
		$errorLine,
		$response = 500
	) {
		if ($response == 0) {
			$response = 404;
		}
		http_response_code($response);
		if ($response == 404 && !DEBUG) {
			require WWW . '/errors/404.php';
			die();
		}
		if (DEBUG) {
			require WWW . '/errors/development.php';
		} else {
			require WWW . '/errors/production.php';
		}
		die();
	}
}
