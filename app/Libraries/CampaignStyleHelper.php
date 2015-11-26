<?php

namespace Publishers\Libraries;


class CampaignStyleHelper
{
    private static $STATUS_COLOR = array(
        'active'=>'#7cb342',
        'pending'=>'#2d7091',
        'rejected'=>'#e53935',
        'ended'=>'#0d47a1',
        'close'=>'#0d47a1',
        'canceled'=>'#9e9e9e'
    );

    private static $STATUS_ICON = array(
        'active'=>'&#xE8CE;',
        'pending'=>'&#xE85F;',
        'rejected'=>'&#xE002;',
        'ended'=>'&#xE857;',
        'close'=>'&#xE615;',
        'canceled'=>'&#xE002;',
    );

    private static $STATUS_VALUE = array(
        'active' => '1',
        'pending' => '2',
        'ended' => '3',
        'close' => '3',
        'rejected' => '4',
        'canceled' => '5'
    );

    private static $STATUS_COLOR_CLASS  = array(
        'active' => 'uk-text-success',
        'pending' => 'uk-text-primary',
        'rejected' => 'uk-text-danger',
        'ended' => 'md-color-blue-900',
        'close' => 'md-color-blue-900',
        'canceled' => 'md-color-grey-500'
    );

    private static $CAMPAIGN_ICON = array(
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
        'survey' => 'survey.svg'
    );


    /**
     * @param $status
     * @return string
     */
    public static function getStatusColor($status)
    {
        if(array_key_exists($status , self::$STATUS_COLOR )){
            return self::$STATUS_COLOR[$status];
        }
        return '';
    }

    /**
     * @param $status
     * @return string
     */
    public static function getStatusIcon($status)
    {
        if(array_key_exists($status , self::$STATUS_ICON )){
            return self::$STATUS_ICON[$status];
        }
        return '';
    }

    /**
     * @param $status
     * @return string
     */
    public static function getStatusValue($status)
    {
        if(array_key_exists($status , self::$STATUS_VALUE )){
            return self::$STATUS_VALUE[$status];
        }
        return '';
    }


    /**
     * @param $status
     * @return string
     */
    public static function getStatusColorClass($status)
    {
        if(array_key_exists($status , self::$STATUS_COLOR_CLASS )){
            return self::$STATUS_COLOR_CLASS[$status];
        }
        return '';
    }

    /**
     * @param $campaignInteraction
     * @return string
     */
    public static function getCampaignIcon($campaignInteraction)
    {
        if(array_key_exists($campaignInteraction , self::$CAMPAIGN_ICON )){
            return self::$CAMPAIGN_ICON[$campaignInteraction];
        }
        return '';
    }


}