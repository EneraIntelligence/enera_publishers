<?php
/**
 * Created by PhpStorm.
 * User: usuario
 * Date: 28/10/15
 * Time: 4:47 PM
 */

namespace Publishers\Libraries;


class StatusColor
{
    private $status_color;
    private $status_icon;

    /**
     * StatusColor constructor.
     */
    public function __construct(){
        $this->status_color = array(
            'active'=>'#7cb342',
            'pending'=>'#2d7091',
            'rejected'=>'#e53935',
            'ended'=>'#0d47a1',
            'close'=>'#0d47a1',
            'canceled'=>'#9e9e9e'
        );
        $this->status_icon = array(
            'active'=>'&#xE8CE;',
            'pending'=>'&#xE85F;',
            'rejected'=>'&#xE002;',
            'ended'=>'&#xE857;',
            'close'=>'&#xE615;',
            'canceled'=>'&#xE002;',
        );
//        xE033 alarma fuera:ended =&#xE857 /pending xE85F  /ended xE88B
    }

    /**
     * @param $estado
     * @return array
     */
    public function getColor($estado){
        if(array_key_exists($estado , $this->status_color )){
            $estado=array('color'=>$this->status_color[$estado]);
        }
        return $estado;
    }

    /**
     * @param $estado
     * @return array
     */
    public function getIcon($estado){
        if(array_key_exists($estado , $this->status_icon )){
            $estado=array('icon'=>$this->status_icon[$estado]);
        }
        return $estado;
    }

    /**
     * @param $estado
     * @return array
     */
    public function getIconColor($estado){
        if(array_key_exists($estado , $this->status_icon )){
            $estado=array('icon'=>$this->status_icon[$estado],'color'=>$this->status_color[$estado]);
        }
        return $estado;
    }

}