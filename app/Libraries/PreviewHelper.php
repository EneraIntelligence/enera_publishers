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
        'campaigns::index' => 'Lista Campañas',
        'budget::invoices' => 'Invoice',
        'analytics::single' => 'Analitics',
        'campaigns::show' => 'Campaña',
        'campaigns::create' => 'Crear Campaña',
        'budget::deposits' => 'Depositos',
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