<?php
namespace Virge;

use Virge\Core\Config;

/**
 * 
 * @author Michael Kramer
 */
class IO {
    
    /**
     * Get the storage path
     * @param type $path
     * @return type
     */
    public static function storage($path = '') {
        return Config::get('base_path') . 'storage/' . $path;
    }
    
    /**
     * Get the storage path
     * @param type $path
     * @return type
     */
    public static function cache($path = '') {
        return self::storage() . 'cache/' . $path;
    }
    
    /**
     * Get the public path
     * @param type $path
     * @return type
     */
    public static function publicPath($path = '') {
        return Config::get('base_path') . 'public/' . $path;
    }
    
    /**
     * Get the public cache path
     * @param type $path
     * @return type
     */
    public static function publicCache($path = '', $rel = false) {
        
        $prefix = $rel ? '' : self::publicPath();

        return $prefix . 'cache/' . $path;
    }
    
    /**
     * Make the directory, and make sure it is writable
     * @param type $path
     */
    public static function makeDir($path, $permissions = 0755) {
        if(!is_dir($path)){
            return mkdir($path, $permissions, true);
        }
        
        return true;
    }
    
    /**
     * Check if the path is writeable, if it isn't, make it writeable
     * @param string $path
     * @return boolean
     */
    public static function checkWriteable($path, $permissions = 0755) {
        if(!is_dir($path)){
            return self::makeDir($path, $permissions);
        }
        
        if(!is_writable($path) && !@chmod($path, $permissions)){
            return false;
        }
        
        return true;
    }
    
    /**
     * Create a filename
     * @param string $name
     * @return string
     */
    public static function createFilename($name) {
        $name = preg_replace('/[^a-z0-9\.\_\-]+/', '', strtolower($name));
        $name = substr(md5(time()), 0, 5) . $name;
        
        return $name;
    }
}