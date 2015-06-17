<?php
	return array(
		'controllers' => array(
			'invokables' => array(
				'BricksCms\Controller\IndexController' => 'BricksCms\Controller\IndexController',				
			),
		),
		'view_manager' => array(	
			'template_map' => array(
				'layout/layout'			=> __DIR__.'/../view/layout/layout.phtml',
				'error/404'				=> __DIR__.'/../view/error/404.phtml',
				'error/index'			=> __DIR__.'/../view/error/index.phtml',
			),
			'template_path_stack' => array(
				__DIR__ . '/../view',
			),
		),
		'translator' => array(
			'translation_file_patterns' => array(
				array(
					'type' => 'phparray',
					'base_dir' => __DIR__.'/../language',
					'pattern' => '%1$s/%1$s.php',
				),
				array(
					'type' => 'gettext',
					'base_dir' => __DIR__.'/../language',
					'pattern' => '%1$s.mo',
				)
			),
		),
		'router' => array(
			'router_class' => 'Zend\Mvc\Router\Http\TranslatorAwareTreeRouteStack',
			'routes' => array(
				'index' => array(
					'type' => 'literal',
					'options' => array(						
						'route'    => '/bricks',
						'defaults' => array(
							'controller' => 'BricksCms\Controller\IndexController',
							'action'     => 'index',
						),
					),					
				),				
			),
		),		
	);
?>