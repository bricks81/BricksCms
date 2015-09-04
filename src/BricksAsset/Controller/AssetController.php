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

namespace BricksAsset\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Form\Form;
use Zend\Form\Element;
use Zend\Form\Fieldset;
use BricksAsset\Form\Assets;
use Zend\Mvc\MvcEvent;

class AssetController extends AbstractActionController {
	
	public function indexAction(){
		$this->redirect()->toRoute('bricks.asset.publish');		
	}
	
	public function publishAction(){
		$form = $this->getPublishForm();
		$form->setAttribute('action',$this->Url()->fromRoute('bricks.asset.publish.do'));
		$as = $this->getServiceLocator()->get('BricksAsset');
		$loadedModules = $as->getLoadedModules();
		$form->setupElements($loadedModules);
		return array('publishForm'=>$form);
	}
	
	public function publishDoAction(){
		$modules = array();
		if($this->getRequest()->getPost('modules')){
			foreach($this->getRequest()->getPost('modules') AS $module){
				$modules[] = $module;
			}
		}
		$remove = false;
		$publish = false;
		$optimize = false;
		if($this->getRequest()->getPost('actions')){
			if(in_array('remove',$this->getRequest()->getPost('actions'))){
				$remove = true;
			}
			if(in_array('publish',$this->getRequest()->getPost('actions'))){
				$publish = true;
			}
			if(in_array('optimize',$this->getRequest()->getPost('actions'))){
				$optimize = true;
			}
		}			

		$lessSupport = $this->getRequest()->getPost('lessSupport')?:'default';
		$scssSupport = $this->getRequest()->getPost('scssSupport')?:'default';
		$minifyCssSupport = $this->getRequest()->getPost('minifyCssSupport')?:'default';
		$minifyJsSupport = $this->getRequest()->getPost('minifyJsSupport')?:'default';
		
		$as = $this->getServiceLocator()->get('BricksAsset');
		foreach($modules AS $moduleName){
			$module = $as->getModule($moduleName);
			$origLessSupport = $module->getLessSupport();
			$origScssSupport = $module->getScssSupport();
			$origMinifyCssSupport = $module->getMinifyCssSupport();
			$origMinifyJsSupport = $module->getMinifyJsSupport();
			if('default'!=$lessSupport){				
				$module->setLessSupport('enable'==$lessSupport?:false);
			}
			if('default'!=$scssSupport){				
				$module->setScssSupport('enable'==$scssSupport?:false);
			}
			if('default'!=$minifyCssSupport){
				$module->setMinifyCssSupport('enable'==$minifyCssSupport?:false);
			}
			if('default'!=$minifyJsSupport){
				$module->setMinifyJsSupport('enable'==$minifyJsSupport?:false);
			}
			if($remove){
				$module->remove();
			}
			if($publish){
				$module->publish();
			}
			if($optimize){
				$module->optimize();
			}
			$module->setLessSupport($origLessSupport);
			$module->setScssSupport($origScssSupport);
			$module->setMinifyCssSupport($origMinifyCssSupport);
			$module->setMinifyJsSupport($origMinifyJsSupport);
		}
		
		$this->redirect()->toRoute('bricks.asset.publish.success');		
	}
	
	public function publishSuccessAction(){		
	}
	
	public function getPublishForm(){
		return new Assets();
	}
	
} 