<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit7d05f99863578ecb8ad93cc0a6972467
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

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit7d05f99863578ecb8ad93cc0a6972467::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit7d05f99863578ecb8ad93cc0a6972467::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit7d05f99863578ecb8ad93cc0a6972467::$classMap;

        }, null, ClassLoader::class);
    }
}
