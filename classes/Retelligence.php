<?php

final class Retelligence {
    private function __construct() {

    }


    /**
     * Loads configuration data from a file.
     *
     * @param string $name The name of the configuration file WITHOUT extension.
     * @return array The config data or (false) if name is invalid
     *               or (null) if no config file exists.
     */
    public static function conf($name) {
        $name = trim(strtolower($name));
        if (empty($name)) {
            return false;
        }

        $file = realpath('conf/' . $name . '.json');
        if (false === $file) {
            return null;
        }

        $reader = new \Zend\Config\Reader\Json();
        return $reader->fromFile($file);
    }

    /**
     * Creates and returns a new SPHERE.IO client.
     *
     * @return \Sphere\Core\Client The new client instance.
     */
    public static function sphereClient() {
        $context = \Sphere\Core\Model\Common\Context::of()->setLanguages(['en'])->setGraceful(true);

        $sphereCfg = self::conf('sphere');

        $config = new \Sphere\Core\Config();
        $config->fromArray($sphereCfg)->setContext($context);

        return new \Sphere\Core\Client($config);
    }
}
