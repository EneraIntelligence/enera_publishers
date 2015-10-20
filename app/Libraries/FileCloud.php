<?php
/**
 * Created by PhpStorm.
 * User: asdrubal
 * Date: 10/15/15
 * Time: 3:45 PM
 */

namespace Publishers\Libraries;
use League\Flysystem\Sftp\SftpAdapter;
use League\Flysystem\Filesystem;

class FileCloud
{
    protected $adapter;
    protected $filesysteam;

    public function __construct()
    {
        $this->adapter = new SftpAdapter([
            'host' => '192.241.236.240',
            'port' => 22,
            'username' => 'forge',
            'password' => '9X0I9k3EFgYIejMRT0T8',
            'privateKey' => '/Users/usuario/.ssh/id_rsa',
            'root' => '/home/forge/prueba',
            'timeout' => 10,
            'directoryPerm' => 0755
        ]);

        $this->filesystem = new Filesystem($adapter);
    }

    public function subir($filename,$uploadfile){
        $filesystem->put($filename, $uploadedfile );
    }



}