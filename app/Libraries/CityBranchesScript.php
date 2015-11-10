<?php

namespace Publishers\Libraries;
use SimpleXMLElement;
use Publishers\Branche;


class CityBranchesScript
{
    public static function saveCityBranches()
    {
        $mapsXml = "<?xml version='1.0' encoding='UTF-8'?>
<kml xmlns='http://www.opengis.net/kml/2.2'>
    <Document>
        <name>Untitled map</name>
        <description><![CDATA[]]></description>
        <Folder>
            <name>City express MX</name>
            <Placemark>
                <name>Hotel City Express Querétaro Oficial</name>
                <styleUrl>#icon-503-DB4436-nodesc</styleUrl>
                <ExtendedData>
                </ExtendedData>
                <Point>
                    <coordinates>-100.3880345,20.5772204,0.0</coordinates>
                </Point>
            </Placemark>
            <Placemark>
                <name>City Express Xalapa</name>
                <styleUrl>#icon-503-DB4436-nodesc</styleUrl>
                <ExtendedData>
                </ExtendedData>
                <Point>
                    <coordinates>-96.87717850000001,19.5152045,0.0</coordinates>
                </Point>
            </Placemark>
            <Placemark>
                <name>City Express Tampico</name>
                <styleUrl>#icon-503-DB4436-nodesc</styleUrl>
                <ExtendedData>
                </ExtendedData>
                <Point>
                    <coordinates>-97.87612360000003,22.2716388,0.0</coordinates>
                </Point>
            </Placemark>
            <Placemark>
                <name>Hotel City Express Monterrey Aeropuerto Oficial</name>
                <styleUrl>#icon-503-DB4436-nodesc</styleUrl>
                <ExtendedData>
                </ExtendedData>
                <Point>
                    <coordinates>-100.13435349999997,25.7852764,0.0</coordinates>
                </Point>
            </Placemark>
            <Placemark>
                <name>City Express Guadalajara</name>
                <styleUrl>#icon-503-DB4436-nodesc</styleUrl>
                <ExtendedData>
                </ExtendedData>
                <Point>
                    <coordinates>-103.39775199999997,20.65186,0.0</coordinates>
                </Point>
            </Placemark>
            <Placemark>
                <name>City Express Durango Oficial</name>
                <styleUrl>#icon-503-DB4436-nodesc</styleUrl>
                <ExtendedData>
                </ExtendedData>
                <Point>
                    <coordinates>-104.61771720000002,24.0534901,0.0</coordinates>
                </Point>
            </Placemark>
            <Placemark>
                <name>Hotel City Express Junior Ciudad Juárez Consulado</name>
                <styleUrl>#icon-503-DB4436-nodesc</styleUrl>
                <ExtendedData>
                </ExtendedData>
                <Point>
                    <coordinates>-106.40691019999997,31.6876674,0.0</coordinates>
                </Point>
            </Placemark>
            <Placemark>
                <name>City Express Nuevo Laredo</name>
                <styleUrl>#icon-503-DB4436-nodesc</styleUrl>
                <ExtendedData>
                </ExtendedData>
                <Point>
                    <coordinates>-99.51818259999999,27.4616462,0.0</coordinates>
                </Point>
            </Placemark>
            <Placemark>
                <name>City Express Saltillo Sur Oficial</name>
                <styleUrl>#icon-503-DB4436-nodesc</styleUrl>
                <ExtendedData>
                </ExtendedData>
                <Point>
                    <coordinates>-101.00728600000002,25.395348,0.0</coordinates>
                </Point>
            </Placemark>
            <Placemark>
                <name>Hotel City Express Plus Santa Fe Oficial</name>
                <styleUrl>#icon-503-DB4436-nodesc</styleUrl>
                <ExtendedData>
                </ExtendedData>
                <Point>
                    <coordinates>-99.278411,19.359133000000003,0.0</coordinates>
                </Point>
            </Placemark>
            <Placemark>
                <name>Hotel City Express Mexicali</name>
                <styleUrl>#icon-503-DB4436-nodesc</styleUrl>
                <ExtendedData>
                </ExtendedData>
                <Point>
                    <coordinates>-115.45090859999998,32.6407933,0.0</coordinates>
                </Point>
            </Placemark>
            <Placemark>
                <name>City Express Silao</name>
                <styleUrl>#icon-503-DB4436-nodesc</styleUrl>
                <ExtendedData>
                </ExtendedData>
                <Point>
                    <coordinates>-101.44509010000003,20.9555886,0.0</coordinates>
                </Point>
            </Placemark>
            <Placemark>
                <name>Hotel City Express Irapuato Oficial</name>
                <styleUrl>#icon-503-DB4436-nodesc</styleUrl>
                <ExtendedData>
                </ExtendedData>
                <Point>
                    <coordinates>-101.38075100000003,20.682983,0.0</coordinates>
                </Point>
            </Placemark>
            <Placemark>
                <name>City Express</name>
                <styleUrl>#icon-503-DB4436-nodesc</styleUrl>
                <ExtendedData>
                </ExtendedData>
                <Point>
                    <coordinates>-99.166881,19.426352,0.0</coordinates>
                </Point>
            </Placemark>
            <Placemark>
                <name>Hotel City Express Cancún Oficial</name>
                <styleUrl>#icon-503-DB4436-nodesc</styleUrl>
                <ExtendedData>
                </ExtendedData>
                <Point>
                    <coordinates>-86.8225832,21.1435141,0.0</coordinates>
                </Point>
            </Placemark>
            <Placemark>
                <name>Hotel City Express Tijuana Insurgentes Oficial</name>
                <styleUrl>#icon-503-DB4436-nodesc</styleUrl>
                <ExtendedData>
                </ExtendedData>
                <Point>
                    <coordinates>-116.93023119999997,32.494921,0.0</coordinates>
                </Point>
            </Placemark>
            <Placemark>
                <name>Hotel City Express Junior Tijuana Otay</name>
                <styleUrl>#icon-503-DB4436-nodesc</styleUrl>
                <ExtendedData>
                </ExtendedData>
                <Point>
                    <coordinates>-116.956704,32.530206,0.0</coordinates>
                </Point>
            </Placemark>
            <Placemark>
                <name>Hotel City Express Plus Guadalajara Palomar Oficial</name>
                <styleUrl>#icon-503-DB4436-nodesc</styleUrl>
                <ExtendedData>
                </ExtendedData>
                <Point>
                    <coordinates>-103.44470969999998,20.588717600000003,0.0</coordinates>
                </Point>
            </Placemark>
            <Placemark>
                <name>Hotel City Express Junior Guadalajara Periferico Sur</name>
                <styleUrl>#icon-503-DB4436-nodesc</styleUrl>
                <ExtendedData>
                </ExtendedData>
                <Point>
                    <coordinates>-103.34557210000003,20.5783887,0.0</coordinates>
                </Point>
            </Placemark>
            <Placemark>
                <name>Hotel City Express Central de Abastos Oficial</name>
                <styleUrl>#icon-503-DB4436-nodesc</styleUrl>
                <ExtendedData>
                </ExtendedData>
                <Point>
                    <coordinates>-99.099107,19.3685375,0.0</coordinates>
                </Point>
            </Placemark>
            <Placemark>
                <name>Hotel City Express Tepotzotlán Oficial</name>
                <styleUrl>#icon-503-DB4436-nodesc</styleUrl>
                <ExtendedData>
                </ExtendedData>
                <Point>
                    <coordinates>-99.20553439999998,19.7105487,0.0</coordinates>
                </Point>
            </Placemark>
            <Placemark>
                <name>City Express</name>
                <styleUrl>#icon-503-DB4436-nodesc</styleUrl>
                <ExtendedData>
                </ExtendedData>
                <Point>
                    <coordinates>-99.16734969999999,19.3655954,0.0</coordinates>
                </Point>
            </Placemark>
            <Placemark>
                <name>Hotel City Express Plus Insurgentes Sur Oficial</name>
                <styleUrl>#icon-503-DB4436-nodesc</styleUrl>
                <ExtendedData>
                </ExtendedData>
                <Point>
                    <coordinates>-99.18225200000002,19.364721,0.0</coordinates>
                </Point>
            </Placemark>
            <Placemark>
                <name>Hotel City Express Suites Anzures Oficial</name>
                <styleUrl>#icon-503-DB4436-nodesc</styleUrl>
                <ExtendedData>
                </ExtendedData>
                <Point>
                    <coordinates>-99.17871600000001,19.429292,0.0</coordinates>
                </Point>
            </Placemark>
            <Placemark>
                <name>Hotel City Express Buenavista Oficial</name>
                <styleUrl>#icon-503-DB4436-nodesc</styleUrl>
                <ExtendedData>
                </ExtendedData>
                <Point>
                    <coordinates>-99.1534249,19.4476805,0.0</coordinates>
                </Point>
            </Placemark>
            <Placemark>
                <name>Hotel City Express Plus Satelite Oficial</name>
                <styleUrl>#icon-503-DB4436-nodesc</styleUrl>
                <ExtendedData>
                </ExtendedData>
                <Point>
                    <coordinates>-99.23661299999998,19.510794,0.0</coordinates>
                </Point>
            </Placemark>
            <Placemark>
                <name>City Express Morelia</name>
                <styleUrl>#icon-503-DB4436-nodesc</styleUrl>
                <ExtendedData>
                </ExtendedData>
                <Point>
                    <coordinates>-101.19387670000003,19.7034264,0.0</coordinates>
                </Point>
            </Placemark>
            <Placemark>
                <name>Hotel City Express Salamanca Oficial</name>
                <styleUrl>#icon-503-DB4436-nodesc</styleUrl>
                <ExtendedData>
                </ExtendedData>
                <Point>
                    <coordinates>-101.21967000000001,20.584476,0.0</coordinates>
                </Point>
            </Placemark>
            <Placemark>
                <name>City Express</name>
                <styleUrl>#icon-503-DB4436-nodesc</styleUrl>
                <ExtendedData>
                </ExtendedData>
                <Point>
                    <coordinates>-101.63187879999998,21.09885139999999,0.0</coordinates>
                </Point>
            </Placemark>
            <Placemark>
                <name>Hotel City Express Tepatitlán Oficial</name>
                <styleUrl>#icon-503-DB4436-nodesc</styleUrl>
                <ExtendedData>
                </ExtendedData>
                <Point>
                    <coordinates>-102.7689269,20.7941648,0.0</coordinates>
                </Point>
            </Placemark>
            <Placemark>
                <name>Hotel City Express Irapuato Norte Oficial</name>
                <styleUrl>#icon-503-DB4436-nodesc</styleUrl>
                <ExtendedData>
                </ExtendedData>
                <Point>
                    <coordinates>-101.349241,20.71715,0.0</coordinates>
                </Point>
            </Placemark>
            <Placemark>
                <name>Hotel City Express Celaya Oficial</name>
                <styleUrl>#icon-503-DB4436-nodesc</styleUrl>
                <ExtendedData>
                </ExtendedData>
                <Point>
                    <coordinates>-100.83946100000003,20.5494777,0.0</coordinates>
                </Point>
            </Placemark>
            <Placemark>
                <name>Hotel City Express Querétaro Juríca Oficial</name>
                <styleUrl>#icon-503-DB4436-nodesc</styleUrl>
                <ExtendedData>
                </ExtendedData>
                <Point>
                    <coordinates>-100.431917,20.648785,0.0</coordinates>
                </Point>
            </Placemark>
            <Placemark>
                <name>City Express Junior Cancun</name>
                <styleUrl>#icon-503-DB4436-nodesc</styleUrl>
                <ExtendedData>
                </ExtendedData>
                <Point>
                    <coordinates>-86.8624307,21.1401618,0.0</coordinates>
                </Point>
            </Placemark>
            <Placemark>
                <name>Hotel City Express Playa del Carmen</name>
                <styleUrl>#icon-503-DB4436-nodesc</styleUrl>
                <ExtendedData>
                </ExtendedData>
                <Point>
                    <coordinates>-87.07558,20.666838,0.0</coordinates>
                </Point>
            </Placemark>
            <Placemark>
                <name>Hotel City Express Playa del Carmen Oficial</name>
                <styleUrl>#icon-503-DB4436-nodesc</styleUrl>
                <ExtendedData>
                </ExtendedData>
                <Point>
                    <coordinates>-87.089653,20.6203108,0.0</coordinates>
                </Point>
            </Placemark>
            <Placemark>
                <name>Hotel City Express Plus Monterrey Nuevo Sur Oficial</name>
                <styleUrl>#icon-503-DB4436-nodesc</styleUrl>
                <ExtendedData>
                </ExtendedData>
                <Point>
                    <coordinates>-100.274584,25.653246,0.0</coordinates>
                </Point>
            </Placemark>
            <Placemark>
                <name>City Express Monterrey Santa Catarina</name>
                <styleUrl>#icon-503-DB4436-nodesc</styleUrl>
                <ExtendedData>
                </ExtendedData>
                <Point>
                    <coordinates>-100.4959192,25.688540400000004,0.0</coordinates>
                </Point>
            </Placemark>
            <Placemark>
                <name>Hotel City Express Monterrey Norte</name>
                <styleUrl>#icon-503-DB4436-nodesc</styleUrl>
                <ExtendedData>
                </ExtendedData>
                <Point>
                    <coordinates>-100.23737719999997,25.8589466,0.0</coordinates>
                </Point>
            </Placemark>
            <Placemark>
                <name>Hotel City Express Saltillo Oficial</name>
                <styleUrl>#icon-503-DB4436-nodesc</styleUrl>
                <ExtendedData>
                </ExtendedData>
                <Point>
                    <coordinates>-100.98538100000002,25.444689400000005,0.0</coordinates>
                </Point>
            </Placemark>
            <Placemark>
                <name>Hotel City Express Mazatlán Oficial</name>
                <styleUrl>#icon-503-DB4436-nodesc</styleUrl>
                <ExtendedData>
                </ExtendedData>
                <Point>
                    <coordinates>-106.43883879999998,23.24636349999999,0.0</coordinates>
                </Point>
            </Placemark>
            <Placemark>
                <name>City Express Torreón</name>
                <styleUrl>#icon-503-DB4436-nodesc</styleUrl>
                <ExtendedData>
                </ExtendedData>
                <Point>
                    <coordinates>-103.40697269999998,25.5831339,0.0</coordinates>
                </Point>
            </Placemark>
            <Placemark>
                <name>Hotel City Express Zacatecas Oficial</name>
                <styleUrl>#icon-503-DB4436-nodesc</styleUrl>
                <ExtendedData>
                </ExtendedData>
                <Point>
                    <coordinates>-102.60628500000003,22.774855,0.0</coordinates>
                </Point>
            </Placemark>
            <Placemark>
                <name>Hotel City Express La Paz Oficial</name>
                <styleUrl>#icon-503-DB4436-nodesc</styleUrl>
                <ExtendedData>
                </ExtendedData>
                <Point>
                    <coordinates>-110.30227800000002,24.185685,0.0</coordinates>
                </Point>
            </Placemark>
            <Placemark>
                <name>Hotel City Express Suites Cabo San Lucas Oficial</name>
                <styleUrl>#icon-503-DB4436-nodesc</styleUrl>
                <ExtendedData>
                </ExtendedData>
                <Point>
                    <coordinates>-109.89518420000002,22.90188049999999,0.0</coordinates>
                </Point>
            </Placemark>
            <Placemark>
                <name>Hotel City Express Los Mochis Oficial</name>
                <styleUrl>#icon-503-DB4436-nodesc</styleUrl>
                <ExtendedData>
                </ExtendedData>
                <Point>
                    <coordinates>-109.005607,25.785613,0.0</coordinates>
                </Point>
            </Placemark>
            <Placemark>
                <name>Hotel City Express Ciudad Obregón Oficial</name>
                <styleUrl>#icon-503-DB4436-nodesc</styleUrl>
                <ExtendedData>
                </ExtendedData>
                <Point>
                    <coordinates>-109.93042600000001,27.512056000000005,0.0</coordinates>
                </Point>
            </Placemark>
            <Placemark>
                <name>Hotel City Express Culiacán Oficial</name>
                <styleUrl>#icon-503-DB4436-nodesc</styleUrl>
                <ExtendedData>
                </ExtendedData>
                <Point>
                    <coordinates>-107.43754899999999,24.792823,0.0</coordinates>
                </Point>
            </Placemark>
            <Placemark>
                <name>Hotel City Express Oaxaca</name>
                <styleUrl>#icon-503-DB4436-nodesc</styleUrl>
                <ExtendedData>
                </ExtendedData>
                <Point>
                    <coordinates>-96.72504600000002,17.072418,0.0</coordinates>
                </Point>
            </Placemark>
            <Placemark>
                <name>Hotel City Express Salina Cruz Oficial</name>
                <styleUrl>#icon-503-DB4436-nodesc</styleUrl>
                <ExtendedData>
                </ExtendedData>
                <Point>
                    <coordinates>-95.21429699999999,16.241078,0.0</coordinates>
                </Point>
            </Placemark>
            <Placemark>
                <name>Hotel City Express Paraíso Oficial</name>
                <styleUrl>#icon-503-DB4436-nodesc</styleUrl>
                <ExtendedData>
                </ExtendedData>
                <Point>
                    <coordinates>-93.1886154,18.4131736,0.0</coordinates>
                </Point>
            </Placemark>
            <Placemark>
                <name>Hotel City Express Minatitlán Oficial</name>
                <styleUrl>#icon-503-DB4436-nodesc</styleUrl>
                <ExtendedData>
                </ExtendedData>
                <Point>
                    <coordinates>-94.573509,17.991743,0.0</coordinates>
                </Point>
            </Placemark>
            <Placemark>
                <name>Hotel City Express Tehuacán Oficial</name>
                <styleUrl>#icon-503-DB4436-nodesc</styleUrl>
                <ExtendedData>
                </ExtendedData>
                <Point>
                    <coordinates>-97.41708169999998,18.46801839999999,0.0</coordinates>
                </Point>
            </Placemark>
            <Placemark>
                <name>Hotel City Express Veracruz Oficial</name>
                <styleUrl>#icon-503-DB4436-nodesc</styleUrl>
                <ExtendedData>
                </ExtendedData>
                <Point>
                    <coordinates>-96.10063259999998,19.160054,0.0</coordinates>
                </Point>
            </Placemark>
            <Placemark>
                <name>Hotel City Express Puebla Centro Oficial</name>
                <styleUrl>#icon-503-DB4436-nodesc</styleUrl>
                <ExtendedData>
                </ExtendedData>
                <Point>
                    <coordinates>-98.189051,19.046012,0.0</coordinates>
                </Point>
            </Placemark>
            <Placemark>
                <name>Hotel City Express Puebla Angelopolis Oficial</name>
                <styleUrl>#icon-503-DB4436-nodesc</styleUrl>
                <ExtendedData>
                </ExtendedData>
                <Point>
                    <coordinates>-98.22557319999999,19.0341835,0.0</coordinates>
                </Point>
            </Placemark>
            <Placemark>
                <name>Hotel City Express Suites Puebla FINSA Oficial</name>
                <styleUrl>#icon-503-DB4436-nodesc</styleUrl>
                <ExtendedData>
                </ExtendedData>
                <Point>
                    <coordinates>-98.23385200000001,19.098609,0.0</coordinates>
                </Point>
            </Placemark>
            <Placemark>
                <name>Hotel City Express Puebla FINSA Oficial</name>
                <styleUrl>#icon-503-DB4436-nodesc</styleUrl>
                <ExtendedData>
                </ExtendedData>
                <Point>
                    <coordinates>-98.24961989999997,19.111835,0.0</coordinates>
                </Point>
            </Placemark>
            <Placemark>
                <name>City Express</name>
                <styleUrl>#icon-503-DB4436-nodesc</styleUrl>
                <ExtendedData>
                </ExtendedData>
                <Point>
                    <coordinates>-98.13903449999998,19.4193306,0.0</coordinates>
                </Point>
            </Placemark>
            <Placemark>
                <name>Hotel City Express Toluca Oficial</name>
                <styleUrl>#icon-503-DB4436-nodesc</styleUrl>
                <ExtendedData>
                </ExtendedData>
                <Point>
                    <coordinates>-99.55647859999999,19.292179,0.0</coordinates>
                </Point>
            </Placemark>
            <Placemark>
                <name>City Express Tula Oficial</name>
                <styleUrl>#icon-503-DB4436-nodesc</styleUrl>
                <ExtendedData>
                </ExtendedData>
                <Point>
                    <coordinates>-99.25836099999998,20.041183,0.0</coordinates>
                </Point>
            </Placemark>
            <Placemark>
                <name>City Express</name>
                <styleUrl>#icon-503-DB4436-nodesc</styleUrl>
                <ExtendedData>
                </ExtendedData>
                <Point>
                    <coordinates>-99.56050700000003,19.306667,0.0</coordinates>
                </Point>
            </Placemark>
            <Placemark>
                <name>Hotel City Express Tijuana Río Oficial</name>
                <styleUrl>#icon-503-DB4436-nodesc</styleUrl>
                <ExtendedData>
                </ExtendedData>
                <Point>
                    <coordinates>-117.01444270000002,32.5244771,0.0</coordinates>
                </Point>
            </Placemark>
            <Placemark>
                <name>Hotel City Express Junior Mexicali Oficial</name>
                <styleUrl>#icon-503-DB4436-nodesc</styleUrl>
                <ExtendedData>
                </ExtendedData>
                <Point>
                    <coordinates>-115.41762299999999,32.62299460000001,0.0</coordinates>
                </Point>
            </Placemark>
            <Placemark>
                <name>Hotel City Express Nogales Oficial</name>
                <styleUrl>#icon-503-DB4436-nodesc</styleUrl>
                <ExtendedData>
                </ExtendedData>
                <Point>
                    <coordinates>-110.95043399999997,31.259795,0.0</coordinates>
                </Point>
            </Placemark>
            <Placemark>
                <name>Hotel City Express Hermosillo Oficial</name>
                <styleUrl>#icon-503-DB4436-nodesc</styleUrl>
                <ExtendedData>
                </ExtendedData>
                <Point>
                    <coordinates>-110.96199899999999,29.069148000000002,0.0</coordinates>
                </Point>
            </Placemark>
            <Placemark>
                <name>Hotel City Express Cananea Oficial</name>
                <styleUrl>#icon-503-DB4436-nodesc</styleUrl>
                <ExtendedData>
                </ExtendedData>
                <Point>
                    <coordinates>-110.25596999999999,30.996962000000003,0.0</coordinates>
                </Point>
            </Placemark>
            <Placemark>
                <name>City Express Cananea</name>
                <styleUrl>#icon-503-DB4436-nodesc</styleUrl>
                <ExtendedData>
                </ExtendedData>
                <Point>
                    <coordinates>-110.30116299999997,30.9824772,0.0</coordinates>
                </Point>
            </Placemark>
            <Placemark>
                <name>Hotel City Express Ciudad Juarez Oficial</name>
                <styleUrl>#icon-503-DB4436-nodesc</styleUrl>
                <ExtendedData>
                </ExtendedData>
                <Point>
                    <coordinates>-106.41079209999998,31.7300413,0.0</coordinates>
                </Point>
            </Placemark>
            <Placemark>
                <name>Hotel City Express Chihuahua Oficial</name>
                <styleUrl>#icon-503-DB4436-nodesc</styleUrl>
                <ExtendedData>
                </ExtendedData>
                <Point>
                    <coordinates>-106.12832500000002,28.6642006,0.0</coordinates>
                </Point>
            </Placemark>
            <Placemark>
                <name>Hotel City Express Junior Chihuahua</name>
                <styleUrl>#icon-503-DB4436-nodesc</styleUrl>
                <ExtendedData>
                </ExtendedData>
                <Point>
                    <coordinates>-106.13139409999997,28.710858900000005,0.0</coordinates>
                </Point>
            </Placemark>
            <Placemark>
                <name>City Express Reynosa</name>
                <styleUrl>#icon-503-DB4436-nodesc</styleUrl>
                <ExtendedData>
                </ExtendedData>
                <Point>
                    <coordinates>-98.30915499999999,26.0700927,0.0</coordinates>
                </Point>
            </Placemark>
            <Placemark>
                <name>Hotel City Express Reynosa</name>
                <styleUrl>#icon-503-DB4436-nodesc</styleUrl>
                <ExtendedData>
                </ExtendedData>
                <Point>
                    <coordinates>-98.36287820000001,26.0571932,0.0</coordinates>
                </Point>
            </Placemark>
            <Placemark>
                <name>Hotel City Express Matamoros</name>
                <styleUrl>#icon-503-DB4436-nodesc</styleUrl>
                <ExtendedData>
                </ExtendedData>
                <Point>
                    <coordinates>-97.51005299999997,25.833425,0.0</coordinates>
                </Point>
            </Placemark>
            <Placemark>
                <name>Hotel City Express Ciudad Victoria Oficial</name>
                <styleUrl>#icon-503-DB4436-nodesc</styleUrl>
                <ExtendedData>
                </ExtendedData>
                <Point>
                    <coordinates>-99.14286519999996,23.752056600000003,0.0</coordinates>
                </Point>
            </Placemark>
            <Placemark>
                <name>Hotel City Express San Luis Potosi Zona Industrial Oficial</name>
                <styleUrl>#icon-503-DB4436-nodesc</styleUrl>
                <ExtendedData>
                </ExtendedData>
                <Point>
                    <coordinates>-100.92728549999998,22.1300989,0.0</coordinates>
                </Point>
            </Placemark>
            <Placemark>
                <name>Hotel City Express Suites San Luis Potosí Oficial</name>
                <styleUrl>#icon-503-DB4436-nodesc</styleUrl>
                <ExtendedData>
                </ExtendedData>
                <Point>
                    <coordinates>-100.933287,22.13429,0.0</coordinates>
                </Point>
            </Placemark>
            <Placemark>
                <name>City Express San Luis Potosí Zona Universitaria</name>
                <styleUrl>#icon-503-DB4436-nodesc</styleUrl>
                <ExtendedData>
                </ExtendedData>
                <Point>
                    <coordinates>-101.01654450000001,22.1464112,0.0</coordinates>
                </Point>
            </Placemark>
            <Placemark>
                <name>Hotel City Express Aguascalientes Sur Oficial</name>
                <styleUrl>#icon-503-DB4436-nodesc</styleUrl>
                <ExtendedData>
                </ExtendedData>
                <Point>
                    <coordinates>-102.29115309999997,21.8416419,0.0</coordinates>
                </Point>
            </Placemark>
            <Placemark>
                <name>Hotel City Express EBC Reforma</name>
                <styleUrl>#icon-503-DB4436-nodesc</styleUrl>
                <ExtendedData>
                </ExtendedData>
                <Point>
                    <coordinates>-99.16208410000002,19.4279345,0.0</coordinates>
                </Point>
            </Placemark>
            <Placemark>
                <name>Hotel City Express Culiacan</name>
                <styleUrl>#icon-503-DB4436-nodesc</styleUrl>
                <ExtendedData>
                </ExtendedData>
                <Point>
                    <coordinates>-99.13667149999999,19.2860206,0.0</coordinates>
                </Point>
            </Placemark>
            <Placemark>
                <name>City express plus patio universidad</name>
                <styleUrl>#icon-503-DB4436-nodesc</styleUrl>
                <ExtendedData>
                </ExtendedData>
                <Point>
                    <coordinates>-99.18552790000001,19.3525774,0.0</coordinates>
                </Point>
            </Placemark>
            <Placemark>
                <name>Hotel City Express Tula</name>
                <styleUrl>#icon-503-DB4436-nodesc</styleUrl>
                <ExtendedData>
                </ExtendedData>
                <Point>
                    <coordinates>-99.22832,20.05456999999999,0.0</coordinates>
                </Point>
            </Placemark>
            <Placemark>
                <name>Hotel City Express Apizaco Oficial</name>
                <styleUrl>#icon-503-DB4436-nodesc</styleUrl>
                <ExtendedData>
                </ExtendedData>
                <Point>
                    <coordinates>-98.13670500000002,19.417559,0.0</coordinates>
                </Point>
            </Placemark>
            <Placemark>
                <name>Hotel City Express Junior Veracruz Aeropuerto Oficial</name>
                <styleUrl>#icon-503-DB4436-nodesc</styleUrl>
                <ExtendedData>
                </ExtendedData>
                <Point>
                    <coordinates>-96.201438,19.160289,0.0</coordinates>
                </Point>
            </Placemark>
            <Placemark>
                <name>City Express</name>
                <styleUrl>#icon-503-DB4436-nodesc</styleUrl>
                <ExtendedData>
                </ExtendedData>
                <Point>
                    <coordinates>-94.47280799999999,18.147277,0.0</coordinates>
                </Point>
            </Placemark>
            <Placemark>
                <name>City Express Villahermosa</name>
                <styleUrl>#icon-503-DB4436-nodesc</styleUrl>
                <ExtendedData>
                </ExtendedData>
                <Point>
                    <coordinates>-92.94825500000002,17.989036,0.0</coordinates>
                </Point>
            </Placemark>
            <Placemark>
                <name>City Express Junior</name>
                <styleUrl>#icon-503-DB4436-nodesc</styleUrl>
                <ExtendedData>
                </ExtendedData>
                <Point>
                    <coordinates>-93.06736009999997,16.741256,0.0</coordinates>
                </Point>
            </Placemark>
            <Placemark>
                <name>Hotel City Express Tuxtla Gutiérrez Oficial</name>
                <styleUrl>#icon-503-DB4436-nodesc</styleUrl>
                <ExtendedData>
                </ExtendedData>
                <Point>
                    <coordinates>-93.1437191,16.7483672,0.0</coordinates>
                </Point>
            </Placemark>
            <Placemark>
                <name>City Express</name>
                <styleUrl>#icon-503-DB4436-nodesc</styleUrl>
                <ExtendedData>
                </ExtendedData>
                <Point>
                    <coordinates>-91.832629,18.662279,0.0</coordinates>
                </Point>
            </Placemark>
            <Placemark>
                <name>Hotel City Express Junior Ciudad del Carmen</name>
                <styleUrl>#icon-503-DB4436-nodesc</styleUrl>
                <ExtendedData>
                </ExtendedData>
                <Point>
                    <coordinates>-91.81381799999997,18.649538,0.0</coordinates>
                </Point>
            </Placemark>
            <Placemark>
                <name>Hotel City Express Junior Ciudad del Carmen Isla de Tris Oficial</name>
                <styleUrl>#icon-503-DB4436-nodesc</styleUrl>
                <ExtendedData>
                </ExtendedData>
                <Point>
                    <coordinates>-91.79418099999998,18.65318,0.0</coordinates>
                </Point>
            </Placemark>
            <Placemark>
                <name>City Express</name>
                <styleUrl>#icon-503-DB4436-nodesc</styleUrl>
                <ExtendedData>
                </ExtendedData>
                <Point>
                    <coordinates>-89.62022000000002,21.020568,0.0</coordinates>
                </Point>
            </Placemark>
            <Placemark>
                <name>Hotel City Express Chetumal</name>
                <styleUrl>#icon-503-DB4436-nodesc</styleUrl>
                <ExtendedData>
                </ExtendedData>
                <Point>
                    <coordinates>-88.324612,18.521453,0.0</coordinates>
                </Point>
            </Placemark>
            <Placemark>
                <name>Hotel City Express</name>
                <styleUrl>#icon-503-DB4436-nodesc</styleUrl>
                <ExtendedData>
                </ExtendedData>
                <Point>
                    <coordinates>-90.533346,19.849325,0.0</coordinates>
                </Point>
            </Placemark>
            <Placemark>
                <name>Hotel City Express Campeche Oficial</name>
                <styleUrl>#icon-503-DB4436-nodesc</styleUrl>
                <ExtendedData>
                </ExtendedData>
                <Point>
                    <coordinates>-90.53383070000001,19.8492451,0.0</coordinates>
                </Point>
            </Placemark>
            <Placemark>
                <name>Hotel City Express Manzanillo Oficial</name>
                <styleUrl>#icon-503-DB4436-nodesc</styleUrl>
                <ExtendedData>
                </ExtendedData>
                <Point>
                    <coordinates>-104.32441979999999,19.0990869,0.0</coordinates>
                </Point>
            </Placemark>
            <Placemark>
                <name>Hotel City Express Lázaro Cárdenas Oficial</name>
                <styleUrl>#icon-503-DB4436-nodesc</styleUrl>
                <ExtendedData>
                </ExtendedData>
                <Point>
                    <coordinates>-102.206883,17.971872,0.0</coordinates>
                </Point>
            </Placemark>
        </Folder>
        <Style id='icon-503-DB4436-nodesc-normal'>
            <IconStyle>
            <color>ff3644DB</color>
                             <scale>1.1</scale>
                                         <Icon>
                                         <href>http://www.gstatic.com/mapspro/images/stock/503-wht-blank_maps.png</href>
                                                                                                                   </Icon>
                                                                                                                     <hotSpot x='16' y='31' xunits='pixels' yunits='insetPixels'>
            </hotSpot>
              </IconStyle>
                <LabelStyle>
                <scale>0.0</scale>
                            </LabelStyle>
                              <BalloonStyle>
                              <text><![CDATA[<h3>$[name]</h3>]]></text>
                                                                  </BalloonStyle>
        </Style>
        <Style id='icon-503-DB4436-nodesc-highlight'>
            <IconStyle>
            <color>ff3644DB</color>
                             <scale>1.1</scale>
                                         <Icon>
                                         <href>http://www.gstatic.com/mapspro/images/stock/503-wht-blank_maps.png</href>
                                                                                                                   </Icon>
                                                                                                                     <hotSpot x='16' y='31' xunits='pixels' yunits='insetPixels'>
            </hotSpot>
              </IconStyle>
                <LabelStyle>
                <scale>1.1</scale>
                            </LabelStyle>
                              <BalloonStyle>
                              <text><![CDATA[<h3>$[name]</h3>]]></text>
                                                                  </BalloonStyle>
        </Style>
        <StyleMap id='icon-503-DB4436-nodesc'>
            <Pair>
                <key>normal</key>
                <styleUrl>#icon-503-DB4436-nodesc-normal</styleUrl>
            </Pair>
            <Pair>
                <key>highlight</key>
                <styleUrl>#icon-503-DB4436-nodesc-highlight</styleUrl>
            </Pair>
        </StyleMap>
    </Document>
</kml>";

        $xml = new SimpleXMLElement($mapsXml);

        foreach ($xml->Document->Folder->Placemark as $element) {

            $branche = Branche::create(['network_id' => '56411939a826e259f029fd6a']);

            foreach($element as $key => $val) {



                if($key=="name")
                {
                    echo $val.": ";
                    $branche->name = (string)$val;
                }
                else if($key=="Point") {
                    foreach ($val as $ckey => $cval)
                    {
                        $coord = explode(",",$cval);
                        echo "lat: ".$coord[0]." lng: ".$coord[1]."<br>";

                        $branche->location = [$coord[1],$coord[0]];
                    }
                }
            }
            $branche->status = "active";
            $branche->portal = (object) array(
                "image" => "city_logo.png",
                "background" => "city_fondo.jpg",
                "message" => array(
                    "text" => "bienvenido",
                    "color" => "#ffffff")
            );
            $branche->save();
            //dd($branche);

        }
    }
}
