<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitb9514298dee181a94dae12e15eb4339a
{
    public static $files = array (
        '0e6d7bf4a5811bfa5cf40c5ccd6fae6a' => __DIR__ . '/..' . '/symfony/polyfill-mbstring/bootstrap.php',
        'f61431ae35714ebe66a223a5c374b5e5' => __DIR__ . '/..' . '/soberwp/intervention/intervention.php',
    );

    public static $prefixLengthsPsr4 = array (
        'T' => 
        array (
            'Twig\\' => 5,
            'Timber\\' => 7,
        ),
        'S' => 
        array (
            'Symfony\\Polyfill\\Mbstring\\' => 26,
            'Sober\\Intervention\\Module\\' => 26,
            'Sober\\Intervention\\' => 19,
        ),
        'C' => 
        array (
            'Composer\\Installers\\' => 20,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Twig\\' => 
        array (
            0 => __DIR__ . '/..' . '/twig/twig/src',
        ),
        'Timber\\' => 
        array (
            0 => __DIR__ . '/..' . '/timber/timber/lib',
        ),
        'Symfony\\Polyfill\\Mbstring\\' => 
        array (
            0 => __DIR__ . '/..' . '/symfony/polyfill-mbstring',
        ),
        'Sober\\Intervention\\Module\\' => 
        array (
            0 => __DIR__ . '/..' . '/soberwp/intervention/src/modules',
        ),
        'Sober\\Intervention\\' => 
        array (
            0 => __DIR__ . '/..' . '/soberwp/intervention/src',
        ),
        'Composer\\Installers\\' => 
        array (
            0 => __DIR__ . '/..' . '/composer/installers/src/Composer/Installers',
        ),
    );

    public static $fallbackDirsPsr4 = array (
        0 => __DIR__ . '/..' . '/asm89/twig-cache-extension/lib',
    );

    public static $prefixesPsr0 = array (
        'T' => 
        array (
            'Twig_' => 
            array (
                0 => __DIR__ . '/..' . '/twig/twig/lib',
            ),
        ),
        'R' => 
        array (
            'Routes' => 
            array (
                0 => __DIR__ . '/..' . '/upstatement/routes',
            ),
        ),
    );

    public static $classMap = array (
        'AltoRouter' => __DIR__ . '/..' . '/altorouter/altorouter/AltoRouter.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitb9514298dee181a94dae12e15eb4339a::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitb9514298dee181a94dae12e15eb4339a::$prefixDirsPsr4;
            $loader->fallbackDirsPsr4 = ComposerStaticInitb9514298dee181a94dae12e15eb4339a::$fallbackDirsPsr4;
            $loader->prefixesPsr0 = ComposerStaticInitb9514298dee181a94dae12e15eb4339a::$prefixesPsr0;
            $loader->classMap = ComposerStaticInitb9514298dee181a94dae12e15eb4339a::$classMap;

        }, null, ClassLoader::class);
    }
}