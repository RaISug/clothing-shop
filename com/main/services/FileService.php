<?php

namespace service;

use exception\InternalServerErrorException;
use file\File;
use file\Files;

class FileService {

    public function uploadFilesInto(Files $files, $directory) {
        while ($files->hasMore()) {
            $file = $files->next();

            $this->uploadFileInto($file, $directory);
        }
    }

    public function uploadFileInto(File $file, $directory) {
        $result = move_uploaded_file($file->getTemporalName(), $directory . "/" . $file->getUniqueName());

        if ($result === FALSE) {
            throw new InternalServerErrorException("Failed to upload file");
        }
    }
    
    public function deleteFilesFrom($filenames, $directory) {
        foreach ($filenames as $filename) {
            $this->deleteFileFrom($filename, $directory);
        }
    }

    private function deleteFileFrom($filename, $directory) {
        if (strlen($filename) === 0) {
            return;
        }

        $result = unlink($directory . "/" . $filename);
        if ($result === FALSE) {
            throw new InternalServerErrorException("Failed to delete file: " . $filename);
        }
    }

}