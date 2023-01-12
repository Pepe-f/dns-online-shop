# Дипломный проект

---

## Особенности

- Свой фреймворк
- Архитектура MVC

## Запуск проекта

1. Установка зависимостей - composer install
2. Изменение настроек подключения к базе данных в config/config_db.php, дамп БД dns-online-shop.sql
3. В папку public добавить ассеты AdminLTE в папку adminlte (структуру папок можно увидеть в .gitignore)
4. В созданную папку adminlte добавить файлы ckeditor и ckfinder в одноименные папки
5. В ckfinder/config.php изменить настройки:

```php
$config['authentication'] = function () {
    session_start();
    return (isset($\_SESSION['user']) && $\_SESSION['user']['role'] == 'admin');
};
```

```php
$config["backends"][] = [
	"name" => "default",
	"adapter" => "local",
	"baseUrl" => "/public/uploads/",
	//  'root'         => '', // Can be used to explicitly set the CKFinder user files directory.
	"chmodFiles" => 0777,
	"chmodFolders" => 0755,
	"filesystemEncoding" => "UTF-8"
];
```
