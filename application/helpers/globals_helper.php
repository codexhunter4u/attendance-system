<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Globals {

    //public static $table;

    public static function getRowId($whereColumn,$whereValue)
    {
        $CI = &get_instance();

        $query = $CI->db->query("SELECT * FROM $whereColumn
        WHERE user_email = ? ",array($whereValue));
        $result = $query->row();
        return $result->userid;
        
    }
    
}
