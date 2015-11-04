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
    private $status_values;
    private $status_colors_class;
    private $campaign_icons;
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

        $this->status_values = array(
            'active' => '1',
            'pending' => '2',
            'ended' => '3',
            'close' => '3',
            'rejected' => '4',
            'canceled' => '5'
        );

        $this->status_colors_class = array(
            'active' => 'uk-text-success',
            'pending' => 'uk-text-primary',
            'rejected' => 'uk-text-danger',
            'ended' => 'md-color-blue-900',
            'close' => 'md-color-blue-900',
            'canceled' => 'md-color-grey-500'
        );

        $this->campaign_icons = array(
            /*
            //old icons
            'banner' => 'picture_in_picture',
            'video' => 'ondemand_video',
            'mailing_list' => 'mail',
            'captcha' => 'spellcheck',
            'survey' => 'assignment'
            */

            'banner' => 'banner.svg',
            'banner_link' => 'banner_link.svg',
            'video' => 'video.svg',
            'mailing_list' => 'mailing.svg',
            'captcha' => 'captcha.svg',
            'survey' => 'encuesta.svg'
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

    /**
     * @param $status
     * @return string
     */
    public function getStatusColorClass($status){
        if(array_key_exists($status , $this->status_colors_class )){
            return $this->status_colors_class[$status];
        }
        return '';//not found
    }

    /**
     * @param $status
     * @return string
     */
    public function getStatusValue($status){
        if(array_key_exists($status , $this->status_values )){
            return $this->status_values[$status];
        }
        return '';//not found
    }

    /**
     * @param $interaction_name
     * @return string
     */
    public function getCampaignIcon($interaction_name){
        if(array_key_exists($interaction_name , $this->campaign_icons )){
            return $this->campaign_icons[$interaction_name];
        }
        return '';//not found
    }

}