<?php

/**
 * Bricks Framework & Bricks CMS
 * http://bricks-cms.org
 *
 * The MIT License (MIT)
 * Copyright (c) 2015 bricks-cms.org
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 * 
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
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
				//->appendStylesheet('bootstrap/css/bootstrap.min.css')
				//->appendStylesheet('bootstrap/css/bootstrap-theme.min.css')
				->appendStylesheet('font-awesome/css/font-awesome.min.css')
				->appendStylesheet('BricksCms/sass/default.sass');				
				
			$e->getApplication()->getServiceManager()->get('ViewHelperManager')->get('HeadScript')
				->appendFile('jquery/jquery.min.js')
				->appendFile('jqueryui/jquery-ui.min.js')
				->appendFile('modernizr/modernizr.js')
				//->appendFile('bootstrap/js/bootstrap.min.js')
				->appendFile('BricksCms/js/default.js')
				->appendFile('BricksCms/js/navigation.js');
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
