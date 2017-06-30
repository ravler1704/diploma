<?php

class View
{
    //Возвращает полное содержимое файла $fileName. Примает переменную $fileName - имя файла с расширением.      $return = false (по умолчанию)        static - разрешает обращение к методу без создания экземпляра класса
    public static function renderFile($fileName, $return = false)
    {
        //включает буферизацию вывода
        ob_start();
        //Подключаем файл $fileName
        require $fileName;
        //сохраняем в переменную $result содержимое буфера. ob_get_clean() - получает содержимое текущего буфера и затем удаляет текущий буфер.
        $result = ob_get_clean();
        //если $return = true, то возвращает $result(содержимое буфера)
        if ($return) {
            return $result;
        }
        //если передаем true, то содержимое $result будет просто выведено на экран
        echo $result;
    }

}