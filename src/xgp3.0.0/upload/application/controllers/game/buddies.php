<?php
/**
 * Buddies Controller
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
 * Buddies Class
 *
 * @category Classes
 * @package  Application
 * @author   XG Proyect Team
 * @license  http://www.xgproyect.org XG Proyect
 * @link     http://www.xgproyect.org
 * @version  3.1.0
 */
class Buddies extends XGPCore
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
        parent::loadModel('game/buddies');
        
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
        $a      = (int)filter_input(INPUT_GET, 'a');
        $e      = (int)filter_input(INPUT_GET, 'e');
        
        // init
        $parse          = [];
        $parse['dpath'] = DPATH;
        
        
        // choose the right page
        if ($a === 1 or $e === 1) {
            
            parent::$page->display(
                parent::$page->get('buddies/buddies_requests_view')->parse(array_merge($parse, $this->langs))
            );  
        } else {

            parent::$page->display(
                parent::$page->get('buddies/buddies_main_view')->parse(array_merge($parse, $this->langs))
            );   
        }
    }
}

/* end of buddy.php */
