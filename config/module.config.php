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
				'bricks.index.index' => array(
					'type' => 'segment',
					'options' => array(						
						'route'    => '/{Bricks}',
						'defaults' => array(
							'controller' => 'BricksCms\Controller\IndexController',
							'action'     => 'index',
						),
					),					
				),				
			),
		),
		'BricksConfig' => array(
			'BricksCms' => array(
				'BricksCms' => array(
					'dependendModules' => array(
						'BricksFile',
						'BricksConfig',
						'BricksClassLoader',
						'BricksPlugin',
						'BricksAsset',
					),
				),
			),			
			'BricksAsset' => array(
				'BricksCms' => array(
					'autoPublish' => true,					
					'autoCompile' => true,
					'scssSupport' => true,
					'moduleAssetsPath' => dirname(__DIR__).'/public',
				),
				'jquery' => array(
					'autoPublish' => true,
					'moduleAssetsPath' => './vendor/components/jquery'
				),
				'jqueryui' => array(
					'autoPublish' => true,
					'moduleAssetsPath' => './vendor/components/jqueryui'
				),
				'bootstrap' => array(
					'autoPublish' => true,
					'moduleAssetsPath' => './vendor/components/bootstrap'
				),
				'modernizr' => array(
					'autoPublish' => true,
					'moduleAssetsPath' => './vendor/components/modernizr'
				),
				'font-awesome' => array(
					'autoPublish' => true,
					'moduleAssetsPath' => './vendor/components/font-awesome'
				),
			),
		),		
	);
?>