<?php
/**
 * Buddies Model
 *
 * PHP Version 5.5+
 *
 * @category Model
 * @package  Application
 * @author   XG Proyect Team
 * @license  http://www.xgproyect.org XG Proyect
 * @link     http://www.xgproyect.org
 * @version  3.1.0
 */

namespace application\models\game;

/**
 * Buddies Class
 *
 * @category Classes
 * @package  Application
 * @author   XG Proyect Team
 * @license  http://www.xgproyect.org XG Proyect
 * @link     http://www.xgproyect.org
 * @version  3.1.0
 */
class Buddies
{
    private $db = null;
    
    /**
     * __construct()
     */
    public function __construct($db)
    {        
        // use this to make queries
        $this->db   = $db;
    }

    /**
     * __destruct
     * 
     * @return void
     */
    public function __destruct()
    {
        $this->db->closeConnection();
    }
    
    /**
     * Add a new buddy
     * 
     * @param array $data Data to insert
     * 
     * @return mixed
     */
    public function addBuddy($data)
    {
        if (is_array($data)) {

            $fields = '';
            $values = '';
            
            foreach ($data as $key => $value) {

                $fields .=  $key . ', ';
                $values .=  '\'' . $value . '\', ';
            }
            
            if ($this->db->query(
                "INSERT INTO `" . BUDDY . "`(" . substr($fields, 0, -2) . ") VALUES(" . substr($values, 0, -2) . ")"
            )) {
                
                return $this->db->insertId();
            } else {
                
                return null;
            }
        }
        
        return null;
    }
    
    /**
     * Delete a buddy by the row ID
     * 
     * @param int $buddy_id Buddy ID
     * 
     * @return mixed
     */
    public function deleteBuddyById($buddy_id)
    {
        if ((int)$buddy_id > 0) {

            return $this->db->query(
                "DELETE * 
                    FROM `" . BUDDY . "` 
                    WHERE `buddy_id` = '" . $buddy_id . "'"
            );
        }
        
        return null;
    }
    
    /**
     * Delete a buddy by the row ID
     * 
     * @param int $sender_id   Who requested ID
     * @param int $receiver_id Who received the request ID
     * 
     * @return mixed
     */
    public function deleteBuddy($sender_id, $receiver_id)
    {
        if ((int)$sender_id > 0 && (int)$receiver_id > 0) {

            return $this->db->query(
                "DELETE * 
                    FROM `" . BUDDY . "` 
                    WHERE `buddy_sender` = '" . $sender_id . "' 
                        AND `buddy_receiver` = '" . $receiver_id . "'"
            );
        }
        
        return null;
    }
}

/* end of buddy.php */
