<?php
return array (
    'Web' => array(
        'version'  => 'base',
        'template-path' =>  'src/Web/templates/',
        'Twig_extends' =>array(
            'html'      =>  'Web\Tags\Twig\WebHtmlExtension',
           'data'        =>  'Web\Tags\Twig\WebDataExtension',

        ),
        //'filter'=>array('front_filter'=>'src/library/FrontFilter'),
        'assets_path' => 'assets',
    ),
    'Mall' => array(
            'version'  => 'base',
            'template-path' =>  'src/Mall/Templates/',
            'Twig_extends' =>array(
                'html'      =>  'Mall\Tags\Twig\WebHtmlExtension',
                'data'        =>  'Mall\Tags\Twig\WebDataExtension',

            ),

            //'filter'=>array('front_filter'=>'src/library/FrontFilter'),
            'assets_path' => 'assets',
			'db' => array(
				'tablepre' => 't_', 
				'database' => 'talent',
			),
        ),
	'Talent' => array(
		
	),

);
?>