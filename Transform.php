<?php

class Transformer
{
    CONST INDEX_SOURCE = 1;

    public function run(array $argv)
    {
        $source = $this->getSourceContent($argv);
        $lines  = $this->getLines($source);
        $lines = $this->formatLines($lines);
        echo $this->toString($lines);
    }

    public function getSourceContent(array $argv)
    {
        if (false === isset($argv[self::INDEX_SOURCE])) {
            throw new \Exception("First command line argument MUST be source file");
        }

        $fileName = $argv[self::INDEX_SOURCE];

        if (false === file_exists($fileName)) {
            throw new \Exception("Source file does not exist");
        }

        return file_get_contents($fileName);
    }

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

    protected function toString($lines)
    {
        return implode(PHP_EOL, $lines);
    }
}

$t = new Transformer();
$t->run($argv);

?>