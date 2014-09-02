<?php
return array (
    'Web' => array(
        'version'  => 'base',
        'template-path' =>  'src/Web/templates/',
        'Twig_extends' =>array(
            'html'      =>  'Web\Tags\Twig\WebHtmlExtension',
           'data'        =>  'Web\Tags\Twig\WebDataExtension',

        ),
        'route' => 'index/index/init',
        //'filter'=>array('front_filter'=>'src/library/FrontFilter'),
        'js_path' => '/portal/edu/statics/js/',
        'css_path' => '/portal/edu/statics/css/',
        'img_path' => '/portal/edu/statics/images/',
    )
);
?>