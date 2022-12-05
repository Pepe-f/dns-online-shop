<?php
/**
 * @var $errorNumber \dns\ErrorHandler
 * @var $errorString \dns\ErrorHandler
 * @var $errorFile \dns\ErrorHandler
 * @var $errorLine \dns\ErrorHandler
 */
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Ошибка</title>
</head>
<body>

<h1>Произошла ошибка</h1>
<p><b>Код ошибки:</b> <?= $errorNumber ?></p>
<p><b>Текст ошибки:</b> <?= $errorString ?></p>
<p><b>Файл, в котором произошла ошибка:</b> <?= $errorFile ?></p>
<p><b>Строка, в которой произошла ошибка:</b> <?= $errorLine ?></p>

</body>
</html>
