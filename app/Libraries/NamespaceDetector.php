<?php
/**
 * Created by PhpStorm.
 * User: pedroluna
 * Date: 1/19/16
 * Time: 6:06 PM
 */

namespace Publishers\Libraries;

class NamespaceDetector
{
    public function getAppNamespace()
    {
        return $this->getNamespaceForPath(app_path());
    }

    protected function getNamespaceForPath($searchForPath)
    {
        $composer = json_decode(file_get_contents(base_path() . '/composer.json'), true);
        foreach ((array)data_get($composer, 'autoload.psr-4') as $namespace => $path) {
            foreach ((array)$path as $pathChoice) {
                if (realpath($searchForPath) == realpath(base_path() . '/' . $pathChoice)) return str_replace('\\', '', $namespace);
            }
        }
        throw new \RuntimeException("Unable to detect application namespace.");
    }
}