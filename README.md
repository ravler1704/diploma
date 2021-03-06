Diploma (A.Raskatov)
=============================

Доделать:
Описание системы. Ссылка на Google-документ, в котором описано как устроена ваша система и нарисована UML-схема базы данных.

```
Инструкция по установке и первому запуску:
1. Импортировать дамп базы данных faq.sql в СУБД.
2. На web-сервере настроить директорию "web" как корневую.
3. В файле config/main.php ввести настройки для подключения к БД
```

В данном проекте реализована концепция MVC, разделяющая управляющую логику сайта и его визуальную часть.

В директории "configs" в файле "main.php" находятся настройки для подключения к БД.

В директории "controllers" (контроллеры) находятся классы, в которых находятся действия (функции), отвечающие за передачу внесенных пользователем изменений в Модель.

В директории "lib" находятся собственноручно созданные библиотеки:
- в файле Controller.php находится класс для "сборки" страниц сайта (соединения шаблона и представления);
- в файле View.php находится класс, с функцией, которая принемает полное имя файла с расширением и возвращает его содержимое или выводит его на экран;
- в файле App.php содержится класс с общими функциями для всего сайта, такими как подключение к БД, получение корневой директории.
В директории "lib/database" находится класс, содержащий функции, генерирующие SQL запросы к базе данных.

В директории "models" (модели) находятся классы, в которых находятся функции взаимодействия с БД для вывода данных на сайт, их обновления и удаления.

В директории "vendor" находятся сторонние библиотеки, автоматически скаченные менеджером зависимостей.

В директории "views" (представления) находятся файлы, в основном содержащие HTML код для вывода информации на страницы сайта. Для вывода данных из БД используется шаблонизатор TWIG.

Директория "web" должна быть настроена как корневая на web-сервере. Тем самым посетители сайта не смогут добраться до отдельных файлов представления, модели и контроллера, что обеспечит дополнительную их сохранность.
В директории "web" находится файл index.php, который является точкой входа на сайт. Данный файл Также там находятся CSS стили, Java скрипты.

По умолчанию index.php в папке "web" выводит содержимое главной страницы сайта.
При передаче в переменную "r" массива $_GET строки типа "site/login" происходит рендер (генерирование) конкретной страницы сайта.
В данном случае это страница входа на сайт, тоесть в общий шаблон сайта main.php подставляется представление login.php.
Если массив $_GET пустой, то переменной r этого массива по умолчанию присваивается путь 'site/index', иначе переменной r присваивается содержание массива $_GET.

faq.sql - дамп базы данных.



