<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit8371b0a2f76bc8877e1935f486e966d2
{
    public static $prefixLengthsPsr4 = array (
        'N' => 
        array (
            'Nuevopaquete\\Autorizador\\' => 25,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Nuevopaquete\\Autorizador\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit8371b0a2f76bc8877e1935f486e966d2::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit8371b0a2f76bc8877e1935f486e966d2::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit8371b0a2f76bc8877e1935f486e966d2::$classMap;

        }, null, ClassLoader::class);
    }
}
