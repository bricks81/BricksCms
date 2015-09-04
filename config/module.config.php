<?php

	return array(
		'controllers' => array(
			'invokables' => array(
				'BricksCms\Controller\IndexController' => 'BricksCms\Controller\IndexController',
				'BricksAsset\Controller\AssetController' => 'BricksAsset\Controller\AssetController',
				'BricksAsset\Controller\MenuController' => 'BricksAsset\Controller\MenuController',
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
				'bricks.asset.index' => array(
					'type' => 'segment',
					'options' => array(
						'route'    => '/{Admin}/{Assets}',
						'defaults' => array(
							'controller' => 'BricksAsset\Controller\AssetController',
							'action'     => 'index',
						),
					),
				),
				'bricks.asset.publish' => array(
					'type' => 'segment',
					'options' => array(
						'route'    => '/{Admin}/{Assets/Write}',
						'defaults' => array(
							'controller' => 'BricksAsset\Controller\AssetController',
							'action'     => 'publish',
						),
					),
				),
				'bricks.asset.publish.do' => array(
					'type' => 'segment',
					'options' => array(
						'route'    => '/{Admin}/{Assets/Write/Execute}',
						'defaults' => array(
							'controller' => 'BricksAsset\Controller\AssetController',
							'action'     => 'publishDo',
						),
					),
				),
				'bricks.asset.publish.success' => array(
					'type' => 'segment',
					'options' => array(
						'route'    => '/{Admin}/{Assets/Write/Success}',
						'defaults' => array(
							'controller' => 'BricksAsset\Controller\AssetController',
							'action'     => 'publishSuccess',
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
			'BricksPlugin' => array(
				'BricksCms' => array(
					'extend' => array(
						'Bricks\Plugin\Module' => array(
							'BricksCms\Plugin\Test',							
						),						
					),
					'listeners' => array(
						'Bricks\Plugin\Module::__construct.pre' => array(
							'BricksCms\Plugin\Test::preConstruct' => -100000,
						),						
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