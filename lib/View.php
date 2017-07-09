<?php
namespace lib;

class View
{
    //Возвращает полное содержимое файла $fileName. Примает переменную $fileName - имя файла с расширением.      $return = false (по умолчанию)        static - разрешает обращение к методу без создания экземпляра класса
    public static function renderFile($fileName, array $data = [],  $return = false)
    {
        extract($data);
        //Включает буферизацию вывода
        ob_start();
        //Подключаем файл $fileName
        require $fileName;
        //Сохраняем в переменную $result содержимое буфера. ob_get_clean() - получает содержимое текущего буфера и затем удаляет текущий буфер.
        $result = ob_get_clean();
        //Если $return = true, то возвращает $result(содержимое буфера)
        if ($return) {
            return $result;
        }
        //Если передаем true, то содержимое $result будет просто выведено на экран
        echo $result;
    }

}