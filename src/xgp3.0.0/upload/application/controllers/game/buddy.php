<?php
/**
 * Buddy Controller
 *
 * PHP Version 5.5+
 *
 * @category Controller
 * @package  Application
 * @author   XG Proyect Team
 * @license  http://www.xgproyect.org XG Proyect
 * @link     http://www.xgproyect.org
 * @version  3.1.0
 */

namespace application\controllers\game;

use application\core\XGPCore;
use application\libraries\FunctionsLib;

/**
 * Buddy Class
 *
 * @category Classes
 * @package  Application
 * @author   XG Proyect Team
 * @license  http://www.xgproyect.org XG Proyect
 * @link     http://www.xgproyect.org
 * @version  3.1.0
 */
class Buddy extends XGPCore
{
    const MODULE_ID = 20;

    private $langs;
    private $current_user;

    /**
     * __construct()
     */
    public function __construct()
    {
        parent::__construct();

        // check if session is active
        parent::$users->checkSession();

        // Check module access
        FunctionsLib::moduleMessage(FunctionsLib::isModuleAccesible(self::MODULE_ID));

        // load Model
        parent::loadModel('game/buddy');
        
        $this->langs        = parent::$lang;
        $this->current_user = parent::$users->getUserData();

        $this->buildPage();
    }
    
    /**
     * Builds the page
     *
     * @return void
     */
    private function buildPage()
    {
        // filter stuff
        $a  = (int)filter_input(INPUT_GET, 'a');
        $e  = (int)filter_input(INPUT_GET, 'e');
        
        // choose the right page
        if ($a === 1 or $e === 1) {
            
            parent::$page->display(
                parent::$page->get('buddy/buddy_requests_view')->parse()
            );  
        } else {

            parent::$page->display(
                parent::$page->get('buddy/buddy_main_view')->parse()
            );   
        }
    }
}

/* end of buddy.php */
