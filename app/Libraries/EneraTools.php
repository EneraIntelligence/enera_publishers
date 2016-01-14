<?php
/**
 * Created by PhpStorm.
 * User: pedroluna
 * Date: 12/30/15
 * Time: 5:05 PM
 */

namespace Publishers\Libraries;

class EneraTools
{
    static function Getfloat($str)
    {
        if (strstr($str, ",")) {
            $str = str_replace(",", "", $str); // replace dots (thousand seps) with blancs
//            $str = str_replace(",", ".", $str); // replace ',' with '.'
        }

        if (preg_match("#([0-9\.]+)#", $str, $match)) { // search for number that may contain '.'
            return floatval($match[0]);
        } else {
            return floatval($str); // take some last chances with floatval
        }
    }

    /**
     * @param $cam
     * @return string
     */
    static function GetElementCamping($cam)
    {
        $elementos = '';
        switch ($cam->interaction['name']) {
            case 'banner':
                $elementos = '<div class="md-list-heading uk-width-large-1-2 azul"> Imagen chica :
                                    <a id="link" class=""
                                       data-uk-modal="{target:\'#modal_lightbox-1\'}">{!! isset($cam->content[\'images\'][\'small\'])?$cam->content[\'images\'][\'small\']:\'no hay imagen\' !!}</a>
                                    <div class="uk-modal" id="modal_lightbox-1">
                                        <div class="uk-modal-dialog uk-modal-dialog-lightbox">
                                            <button type="button"
                                                    class="uk-modal-close uk-close uk-close-alt"></button>
                                            <img src="{!! "https://s3-us-west-1.amazonaws.com/enera-publishers/items/". $cam->content[\'images\'][\'small\'] !!}"
                                                 alt=""/>
                                            <div class="uk-modal-caption">{!! $cam->content[\'images\'][\'small\'] !!}</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="md-list-content uk-width-large-1-2"
                                     style=" color: #1e88e5;float: right;">
                                    Imagen grande :
                                    <a id="link" class=""
                                       data-uk-modal="{target:\'#modal_lightbox-2\'}">
                                        {!! isset($cam->content[\'images\'][\'large\'])?$cam->content[\'images\'][\'large\']:\'no hay imagen\' !!}</a>
                                    <div class="uk-modal" id="modal_lightbox-2">
                                        <div class="uk-modal-dialog uk-modal-dialog-lightbox">
                                            <button type="button"
                                                    class="uk-modal-close uk-close uk-close-alt"></button>
                                            <img src="{!! "https://s3-us-west-1.amazonaws.com/enera-publishers/items/". $cam->content[\'images\'][\'large\'] !!}"
                                                 alt=""/>
                                            <div class="uk-modal-caption">Lorem</div>
                                        </div>
                                    </div>
                                    {{--<span class="uk-text-small uk-text-muted"><img class="uk-width-large-2-6" src="{!! URL::asset(\'images/\'.$content[\'imageng\']) !!}" alt=""></span>--}}
                                </div>
                                <h3 class="md-hr" style="margin-bottom: 10px;"></h3>
                                <div class="md-list-content uk-width-large-1-2"
                                     style=" color: #1e88e5;">
                                    Link a redireccionar :
                                    <a id="link" class=""
                                       href="http://{{ isset($cam->content[\'link\'])? str_replace("http://","",$cam->content[\'link\']):\'no definido\' }}"
                                       target="_blank">{!! isset($cam->content[\'link\'])? $cam->content[\'link\']:\'no hay una definida www.enera.com \' !!}</a>
                                </div>';
                break;
            case 'banner_link':

                $elementos = 'banner';
                break;
            case 'captcha':

                $elementos = 'banner';
                break;
            case 'mailing_list':

                $elementos = 'banner';
                break;
            case 'survey':

                $elementos = 'banner';
                break;
            case 'video':

                $elementos = 'banner';
                break;
            case 'like':

                $elementos = 'banner';
                break;
        }
        return $elementos;
    }
}