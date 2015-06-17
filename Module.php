<?php
/**
 * Bricks Framework & Bricks CMS
 * http://bricks-cms.org
 *
 * @link https://github.com/bricks81/BricksCms
 * @license http://www.gnu.org/licenses/ (GPLv3)
 */
namespace BricksCms;

class Module {
	
	/**
	 * @return array
	 */
	public function getConfig(){
		return include __DIR__ . '/config/module.config.php';
	}
	
	/**
	 * @return array
	 */
	public function getAutoloaderConfig() {
        return array(
        	'Zend\Loader\ClassMapAutoloader' => array(
        		__DIR__ . '/autoload_classmap.php',
        	),
        );
    }
}
