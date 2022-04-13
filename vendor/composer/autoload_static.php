<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit469c83367d9e31e8f32859149b788d69
{
    public static $files = array (
        'a9ed0d27b5a698798a89181429f162c5' => __DIR__ . '/..' . '/khanamiryan/qrcode-detector-decoder/lib/Common/customFunctions.php',
    );

    public static $prefixLengthsPsr4 = array (
        'Z' => 
        array (
            'Zxing\\' => 6,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Zxing\\' => 
        array (
            0 => __DIR__ . '/..' . '/khanamiryan/qrcode-detector-decoder/lib',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit469c83367d9e31e8f32859149b788d69::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit469c83367d9e31e8f32859149b788d69::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit469c83367d9e31e8f32859149b788d69::$classMap;

        }, null, ClassLoader::class);
    }
}
