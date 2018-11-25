<?php

namespace file;

class File {

    private $file;
    private $uniqueName;

    public function __construct($file) {
        $this->file = $file;
    }

    public function getTemporalName() {
        return $this->file['tmp_name'];
    }

    private function getExtension() {
        return strtolower(pathinfo($this->getRealFileName(), PATHINFO_EXTENSION));
    }

    private function getRealFileName() {
        return $this->file['name'];
    }

    public function getUniqueName() {
        if ($this->uniqueName == null) {
            $this->uniqueName = strval(time()) . "." . $this->getExtension();
        }

        return $this->uniqueName;
    }

}