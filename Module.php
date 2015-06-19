<?php
/**
 * Bricks Framework & Bricks CMS
 * http://bricks-cms.org
 *
 * @link https://github.com/bricks81/BricksCms
 * @license http://www.gnu.org/licenses/ (GPLv3)
 */
namespace BricksCms;

use Zend\ModuleManager\ModuleManager;
use Zend\Mvc\MvcEvent;

class Module {
	
	/**
	 * @param ModuleManager $moduleManager
	 */
	public function init(ModuleManager $moduleManager){
		$config = $this->getConfig();
		foreach($config['BricksConfig']['BricksCms']['BricksCms']['dependendModules'] AS $moduleName){		
			$moduleManager->loadModule($moduleName);
		}		
	}
	
	/**
	 * @param MvcEvent $e
	 */
	public function onBootstrap(MvcEvent $e){
		$t = $e->getApplication()->getServiceManager()->get('MvcTranslator');
		$e->getApplication()->getServiceManager()->get('Router')->setTranslator($t);
		
		$e->getApplication()->getEventManager()->attach(MvcEvent::EVENT_RENDER,function(MvcEvent $e){
			$e->getApplication()->getServiceManager()->get('ViewHelperManager')->get('HeadLink')
				->appendStylesheet('bootstrap/css/bootstrap.min.css')
				->appendStylesheet('font-awesome/css/font-awesome.min.css')
				->appendStylesheet('BricksCms/css/default.css');
			$e->getApplication()->getServiceManager()->get('ViewHelperManager')->get('HeadScript')
				->appendFile('jquery/jquery.min.js')
				->appendFile('jqueryui/jquery-ui.min.js')
				->appendFile('modernizr/modernizr.js')
				->appendFile('bootstrap/js/bootstrap.min.js');
		});
	}
	
	/**
	 * @param MvcEvent $e
	 */
	public function handleError(MvcEvent $e){
		$param = $e->getParam('exception');
		if($param instanceof \Exception){
			throw $e->getParam('exception');
		}
	}
	
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
