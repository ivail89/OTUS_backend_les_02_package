<?php


class OTUS_backend_lesson_2
{
  /**
   * Функция проверки корректности расстановки скобок в строке
   * @param string $str
   * @return bool
   * @throws InvalidArgumentException - содержит отличные символы “(“, “)”, “ ” (пробел), “\n” (перенос строки), “\t” (символ табуляции), “\r” (перенос каретки)
   */
  public static function analyzeStr(string $str) : bool
  {
    if (preg_match('/^([()\s\n\r\t]+)$/', $str) == false) { // preg_match может вернуть как 0 так и false ловим оба случая
      throw new InvalidArgumentException('String has illegal symbols');
    }

    $stack = new SplStack();
    $len = strlen($str);

    for ($i = 0; $i < $len; $i++) {
      if ($str[$i] === '(') {
        $stack->push('(');
      } elseif ($str[$i] === ')') {
        if ($stack->count() === 0) {
          return false; // закрывающая скобка предшествует открытой дальше проверять нет смысла
        } else {
          $stack->pop(); // есть пара открытая-закрытая скобка
        }
      }
      // так как в условии не сказано как обрабатывать спецсимволы просто пропускаем их
    }

    return $stack->isEmpty() ? true : false; // если остались открытые и не закрытые скобки
  }
}