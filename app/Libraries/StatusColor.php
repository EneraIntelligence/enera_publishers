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

    public function __construct(){
        $this->status_color = array(
            'active'=>'#7cb342!important',
            'pending'=>'#2d7091!important',
            'rejected'=>'#e53935!important',
            'ended'=>'#0d47a1!important',
            'close'=>'#0d47a1!important',
            'canceled'=>'#9e9e9e!important'
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

    public function selectColor($estado){
        if(array_key_exists($estado , $this->status_color )){
            $estado=array('color'=>$this->status_color[$estado]);
        }
        return $estado;
    }

    public function icon($estado){
        if(array_key_exists($estado , $this->status_icon )){
            $estado=array('icon'=>$this->status_icon[$estado]);
        }
        return $estado;
    }
    public function estados($estado){
        if(array_key_exists($estado , $this->status_icon )){
            $estado=array('icon'=>$this->status_icon[$estado],'color'=>$this->status_color[$estado]);
        }
        return $estado;
    }

}