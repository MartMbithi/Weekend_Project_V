<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitb7533ab351e6c342c648fd186b20d680
{
    public static $prefixLengthsPsr4 = array (
        'A' => 
        array (
            'Ayeo\\Barcode\\' => 13,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Ayeo\\Barcode\\' => 
        array (
            0 => __DIR__ . '/..' . '/ayeo/gs1_barcode/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitb7533ab351e6c342c648fd186b20d680::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitb7533ab351e6c342c648fd186b20d680::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitb7533ab351e6c342c648fd186b20d680::$classMap;

        }, null, ClassLoader::class);
    }
}
