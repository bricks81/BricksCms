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

namespace BricksAsset\Form;

use Zend\Form\Form;
use Zend\Form\Element;
use Zend\Form\Fieldset;

class Assets extends Form {
	
	public function setupElements($loadedModules){		
		$modules = array();
		foreach($loadedModules AS $moduleName){
			$modules[$moduleName] = $moduleName;
		}

		// poedit translation
		function _($str){return $str;}
		
		$element = new Element\MultiCheckbox();
		$element->setName('modules');
		$element->setLabel('Select which modules will be affected');
		$element->setValueOptions($modules);
		$this->add($element);
		
		$element = new Element\MultiCheckbox();
		$element->setName('actions');
		$element->setLabel('Which action to take');
		$element->setValueOptions(array(
			'remove' => _('Remove assets'),
			'publish' => _('Publish assets'),
			'optimize' => _('Optimize assets'),
		));
		$this->add($element);
		
		$element = new Element\Radio();
		$element->setName('lessSupport');
		$element->setLabel('Less Publish Options');
		$element->setValueOptions(array(
			'default' => _('Use modules config'),
			'enable' => _('Force parsing less'),
			'disable' => _('Avoid parsing less'),
		));
		$element->setValue('default');
		$this->add($element);
		
		$element = new Element\Radio();
		$element->setName('scssSupport');
		$element->setLabel('Scss Publish Options');
		$element->setValueOptions(array(
			'default' => _('Use modules config'),
			'enable' => _('Force parsing scss'),
			'disable' => _('Avoid parsing scss'),
		));
		$element->setValue('default');
		$this->add($element);
		
		$element = new Element\Radio();
		$element->setName('minifyCssSupport');
		$element->setLabel('CSS Optimize Options');
		$element->setValueOptions(array(
			'default' => _('Use modules config'),
			'enable' => _('Force minifying CSS'),
			'disable' => _('Avoid minifying CSS'),
		));
		$element->setValue('default');
		$this->add($element);
		
		$element = new Element\Radio();
		$element->setName('minifyJsSupport');
		$element->setLabel('JS Optimize Options');
		$element->setValueOptions(array(
			'default' => _('Use modules config'),
			'enable' => _('Force minifying js'),
			'disable' => _('Avoid minifying js'),
		));
		$element->setValue('default');
		$this->add($element);
		
		$fieldset = new Fieldset('submit');
		$fieldset->setAttribute('class','submit');
		$element = new Element\Submit('submitData');
		$element->setValue(_('Submit now'));
		$fieldset->add($element);
		$this->add($fieldset);
	} 
	
}