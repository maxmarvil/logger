<?php
class Logger
{
    private $file_path; // full path
    private $mess = '';
    private $count = 0;

    function mess($mess = false) 
    {
        if (!empty($mess)) {
            $this->mess = (string) $mess;
        } 
        
        return $this;
    }

    public function __constaruct($path = '')
    {
        if (!empty($path)) {
            $this->setPath($_SERVER['DOCUMENT_ROOT'] . $path);
        } else {
            $this->setPath($_SERVER['DOCUMENT_ROOT'] . '/log.log');
        }
    }

    private function setPath($path)
    {
        if (!empty($path)) {
            $ar_path = explode('/', $path);
            $only_dir = array_slice($ar_path, 0, count($ar_path)-1);
            
            if (count($only_dir) > 1) {
                $part = implode('/', $only_dir);
                if (!is_dir($part)) {
                    mkdir($part);
                }
            }

            $this->file_path = $path;
        }
    }

    public function toFile($file = false)
    {
        $mess = $this->mess;
        
        if (empty($mess)) {
            $mess = debug_backtrace();
        }
        
        if ($file) {
            error_log($mess, 3, date($file));
        } else {
            error_log($mess, 3, date($this->file_path));
        }

        return $this;
    }

    public function print()
    {
        $mess = $this->mess;
        
        if (empty($mess)) {
            $mess = debug_backtrace();
        }

        echo '<pre>';
        print_r($mess);
        echo '</pre>';

        return $this;
    }

    public function updateCount()
    {
        $this->count++;
        
        return $this;
    }

    function dropCount()
    {
        $this->count = 0;
        return $this;
    }

    function showCount()
    {
        echo '<pre>' . $this->count . '</pre>';
        return $this;
    }
}