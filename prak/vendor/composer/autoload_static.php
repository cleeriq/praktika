<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit8bb04ed77c494ad66af7fc04e6535b23
{
    public static $prefixLengthsPsr4 = array (
        'V' => 
        array (
            'Ven\\App\\' => 8,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Ven\\App\\' => 
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
            $loader->prefixLengthsPsr4 = ComposerStaticInit8bb04ed77c494ad66af7fc04e6535b23::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit8bb04ed77c494ad66af7fc04e6535b23::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit8bb04ed77c494ad66af7fc04e6535b23::$classMap;

        }, null, ClassLoader::class);
    }
}