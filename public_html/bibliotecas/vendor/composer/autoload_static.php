<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInita81712b636c0c5804818e2a6bf14804f
{
    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'PHPMailer\\PHPMailer\\' => 20,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'PHPMailer\\PHPMailer\\' => 
        array (
            0 => __DIR__ . '/..' . '/phpmailer/phpmailer/src',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInita81712b636c0c5804818e2a6bf14804f::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInita81712b636c0c5804818e2a6bf14804f::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
