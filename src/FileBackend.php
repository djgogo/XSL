<?php
declare(strict_types = 1);

class FileBackend
{
    /**
     * @param string $filePath
     * @return string
     * @throws FileBackendException
     */
    public function load(string $filePath) : string
    {
        if (!file_exists($filePath)) {
            throw new FileBackendException('Could not load file' . $filePath);
        }

        $file = fopen($filePath, 'r');
        if ($file === false) {
            throw new FileBackendException('Datei "' . $filePath . '" konnte nicht geöffnet werden');
        }
        $content = stream_get_contents($file, filesize($filePath));

        $close = fclose($file);
        if ($close === false) {
            throw new FileBackendException('Datei "' . $filePath . '" konnte nicht geschlossen werden');
        }
        return $content;
    }

    /**
     * @param string $filePath
     * @param string $content
     * @throws FileBackendException
     */
    public function save(string $filePath, string $content)
    {
        $file = file_put_contents($filePath, $content);

        if ($file === false) {
            throw new FileBackendException('Datei "' . $filePath . '" konnte nicht gespeichert werden');
        }
    }
}
