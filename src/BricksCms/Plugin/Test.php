<?php
/**
 * Bricks Framework & Bricks CMS
 * http://bricks-cms.org
 *
 * @link https://github.com/bricks81/BricksPlugin
 * @license http://www.gnu.org/licenses/ (GPLv3)
 */
namespace BricksCms\Plugin;

use Zend\EventManager\Event;
use Bricks\Plugin\Extender;
use Bricks\Plugin\Extender\VisitorInterface;

/**
 * This class will hold the autoloader with it's classmap
 * in front of the internal autoloading stack.
 */
class Test implements VisitorInterface {
	
	/**
	 * @var Extender
	 */
	protected $extender;
	
	/**
	 * @param Extender $extender
	 */
	public function __construct(Extender $extender=null){
		$this->setExtender($extender);
	}
	
	/**
	 * @param Extender $extender
	 */
	public function setExtender(Extender $extender=null){
		$this->extender = $extender;
	}
	
	/**
	 * @return \Bricks\Plugin\Extender
	 */
	public function getExtender(){
		return $this->extender;
	}
	
	/**
	 * (non-PHPdoc)
	 * @see \Bricks\Plugin\Extender\VisitorInterface::extend()
	 */
	public function extend(){
		$this->getExtender()->eventize('Bricks\Plugin','Module','__construct');
	}
	
	/**
	 * @param Event $event
	 */
	public function preConstruct(Event $event){				
		die($event->getParams());		
	}
	
}