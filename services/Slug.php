<?php

class Slug
{
    protected static function translit($string)
    {
        $converter = array(
            'а' => 'a',   'б' => 'b',   'в' => 'v',
            'г' => 'g',   'д' => 'd',   'е' => 'e',
            'ё' => 'yo',   'ж' => 'zh',  'з' => 'z',
            'и' => 'i',   'й' => 'y',   'к' => 'k',
            'л' => 'l',   'м' => 'm',   'н' => 'n',
            'о' => 'o',   'п' => 'p',   'р' => 'r',
            'с' => 's',   'т' => 't',   'у' => 'u',
            'ф' => 'f',   'х' => 'kh',   'ц' => 'ts',
            'ч' => 'ch',  'ш' => 'sh',  'щ' => 'shch',
            'ь' => '',    'ы' => 'y',   'ъ' => '',
            'э' => 'e',   'ю' => 'yu',  'я' => 'ya',
        );
        return strtr($string, $converter);
    }

    public static function generate($str)
    {
        $str = mb_strtolower($str);
        return trim(preg_replace('~[^a-z0-9_+]+~u', '-', strtolower(static::translit($str))), "-");
    }
}