<?php

namespace file;

class Files {

    private $files;
    private $currentIndex;
    
    public function __construct($files) {
        $this->files = array();

        for ($i = 0 ; $i < count($files) ; $i++) {
            $this->files[] = new File($files[$i]);
        }

        $this->currentIndex = 0;
    }

    public function hasMore() {
        return $this->currentIndex < count($this->files);
    }

    public function next() {
        return $this->files[$this->currentIndex++];
    }

    public function getUniqueNames() {
        $uniqueNames = "";

        foreach ($this->files as $file) {
            $uniqueNames .= $file->getUniqueName() . ";";
        }

        return substr($uniqueNames, 0, strlen($uniqueNames) - 1);
    }

}