<?php
/**
 * Created by PhpStorm.
 * User: ARodriguez
 * Date: 12/8/15
 * Time: 15:48
 */

namespace Publishers\Libraries;


class PreviewHelper
{

    private static $NAME_ROUTE = array(
        'profile::edit' => 'Editar Perfil',
        'profile::index' => 'Perfil',
        'budget::index' => 'Presupuestos',
        'campaigns::index' => 'Campañas',
    );

    public static function getNameRoute($route)
    {
        if(array_key_exists($route , self::$NAME_ROUTE))
        {
            return self::$NAME_ROUTE[$route];
        }
        return 'indefinida';
    }
}