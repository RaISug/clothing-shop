<?php

namespace service;

use file\File;
use exception\InternalServerErrorException;
use file\Files;

class FileService {

    private $UPLOAD_DIRECTORY = "/home/raisug/_D/git/com.radoslav.web.shop/images";

    public function uploadFiles(Files $files) {
        while ($files->hasMore()) {
            $file = $files->next();

            $this->uploadFile($file);
        }
    }

    public function uploadFile(File $file) {
        $result = move_uploaded_file($file->getTemporalName(), $this->UPLOAD_DIRECTORY . "/" . $file->getUniqueName());

        if ($result === FALSE) {
            throw new InternalServerErrorException("Failed to upload file");
        }
    }
    
    public function deleteFiles($filenames) {
        foreach ($filenames as $filename) {
            $this->deleteFile($filename);
        }
    }

    public function deleteFile($filename) {
        if (strlen($filename) === 0) {
            return;
        }

        $result = unlink($this->UPLOAD_DIRECTORY . "/" . $filename);
        if ($result === FALSE) {
            throw new InternalServerErrorException("Failed to delete file: " . $filename);
        }
    }

}