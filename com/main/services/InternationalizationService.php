<?php

namespace service;

use exception\InternalServerErrorException;

class InternationalizationService {

    private $fileName;
    
    public function __construct($language) {
        $this->fileName = "i18n_" . $language . ".ini";
    }

    public function get($key) {
        $properties = $this->loadProperties();

        return $properties[$key];
    }

    public function loadProperties() {
        if (file_exists(__DIR__ . "/" . $this->fileName) === FALSE) {
            $this->fileName = "i18n.ini";
        }

        $result = parse_ini_file(__DIR__ . "/" . $this->fileName);

        if ($result === FALSE) {
            $result = parse_ini_file(__DIR__ . "/i18n.ini");
            if ($result === FALSE) {
                throw new InternalServerErrorException("Failed to load internatilization file.");
            }
        }

        return $result;
    }

    public function store($bundle) {
        $file = fopen(__DIR__ . "/" . $this->fileName, "w");
        if ($file === FALSE) {
            throw new InternalServerErrorException("Failed to open the bundle file.");
        }

        fwrite($file, $bundle);
        
        fclose($file);
    }

    public function delete() {
        if (file_exists($this->fileName)) {
            unlink($this->fileName);
        }
    }

}