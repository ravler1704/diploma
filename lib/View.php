<?php

class View
{
    public static function renderFile($fileName, $return = false)                       //Возвращает полное содержимое файла $fileName. Примает переменную $fileName - имя файла с расширением.      $return = false (по умолчанию)        static - разрешает обращение к методу без создания экземпляра класса
    {
        ob_start();                                                                     //включает буферизацию вывода
        require $fileName;                                                              //Подключаем файл $fileName
        $result = ob_get_clean();                                                       //сохраняем в переменную $result содержимое буфера. ob_get_clean() - получает содержимое текущего буфера и затем удаляет текущий буфер.
        if ($return) {                                                                  //если $return = true, то возвращает $result(содержимое буфера)
            return $result;
        }
        echo $result;                                                                   //если передаем true, то содержимое $result будет просто выведено на экран
    }

}