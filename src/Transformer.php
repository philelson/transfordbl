<?php

namespace philelson\Util;

/**
 * Class Transformer
 */
class Transformer
{
    CONST INDEX_SOURCE = 1;

    /**
     * Run the whole transformation process and echo the results
     *
     * @param array $argv
     * @throws \Exception
     */
    public function run(array $argv)
    {
        $fileName   = $this->getFilenameFromArray($argv);
        $source     = $this->getFileContent($fileName);
        $lines      = $this->getLines($source);
        $lines      = $this->formatLines($lines);
        echo $this->toString($lines);
    }

    /**
     * Returns the file name from the array at index 0
     *
     * @param array $argv
     * @return mixed
     * @throws \Exception
     */
    public function getFilenameFromArray(array $argv)
    {
        if (false === isset($argv[self::INDEX_SOURCE])) {
            throw new \Exception("First command line argument MUST be source file");
        }

        $fileName = $argv[self::INDEX_SOURCE];

        if(null == $fileName) {
            throw new \Exception("No file name found");
        }

        return $fileName;
    }

    /**
     * Get the content of the file
     *
     * @param string $fileName
     * @return string
     * @throws \Exception
     */
    public function getFileContent($fileName)
    {
        if (false === file_exists($fileName)) {
            throw new \Exception("Source file does not exist");
        }

        return file_get_contents($fileName);
    }

    /**
     * Get the lines from the string
     *
     * @param $source
     * @return array
     */
    public function getLines($source)
    {
        $processedLines = [];
        $lines          = explode(PHP_EOL, $source);

        foreach($lines as $line) {
            if (null != $line) {
                $processedLines[] = $line;
            }
        }

        return $processedLines;
    }

    /**
     * Format the lines
     *
     * @param $lines
     * @return array
     */
    public function formatLines($lines)
    {
        $formatted      = [];
        $end            = end($lines);

        foreach($lines as $line) {
            $formattedLine = "\t'".$line."'";

            if($line != $end) {
                $formattedLine .= ",";
            }

            $formatted[] = $formattedLine;

        }

        return $formatted;
    }

    /**
     * Make the lines into a string
     *
     * @param $lines
     * @return string
     */
    protected function toString($lines)
    {
        return implode(PHP_EOL, $lines);
    }
}

?>