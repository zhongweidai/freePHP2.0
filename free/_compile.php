<?php
/**
 * Created by PhpStorm.
 * User: dai
 * Date: 14-8-31
 * Time: 下午8:54
 */



function _free_compile()
{
    $cache_array = array(
        'Free\Libs',
        'Utility',
    );
    $classes = array();
    $content = '';
    foreach($cache_array as $v)
    {
        $cache_path = glob(FreeKernel::loader()->findFile($v) . DIRECTORY_SEPARATOR . '*.php');
        if(!empty($cache_path) && is_array($cache_path))
        {
            $content .= "\r\n" . 'namespace ' . $v . '{';
            foreach($cache_path as $path)
            {

                $class = $v . "\\". substr(pathinfo($path,PATHINFO_BASENAME),0,-4);

                $classes[$class] = $path;
                $content .= free_compile($path);

            }
            $content .= '}';
        }
    }
    $components = FreeKernel::container()->loadComponents();

    foreach($components as $c)
    {

        $content .= "\r\n" . 'namespace ' . substr($c,0,strrpos($c,"\\") ) . '{';
        $path = FreeKernel::loader()->findFile($c) . '.php';
        $classes[$c] = $path;
        $content .= free_compile($path);
        $content .= '}';
    }

    $configs = array();
    $cache_array = array('application','cache','component','database','system');
    foreach($cache_array as $v)
    {
        $path = FREE_PATH.'configs'.DIRECTORY_SEPARATOR.$v.'.php';
        if (file_exists($path)) {
            $configs[$v] = include $path;
        }
    }
    $content .= "\r\n" . 'namespace { FreeKernel::setConfig('  . var_export($configs, true) . ');}';
    return file_put_contents(FREE_PATH . 'caches/~runtime.php','<?php '.$content);

}
// 去除代码中的空白和注释
function free_strip_whitespace($content) {
    $stripStr = '';
    //分析php源码
    $tokens = token_get_all($content);

    $last_space = false;
    for ($i = 0, $j = count($tokens); $i < $j; $i++) {
        if (is_string($tokens[$i])) {
            $last_space = false;
            $stripStr .= $tokens[$i];
        } else {
            switch ($tokens[$i][0]) {
                //过滤各种PHP注释
                case T_COMMENT:
                case T_DOC_COMMENT:
                    break;
                //过滤空格
                case T_WHITESPACE:
                    if (!$last_space) {
                        $stripStr .= ' ';
                        $last_space = true;
                    }
                    break;
                case T_START_HEREDOC:
                    $stripStr .= "<<<FREE\n";
                    break;
                case T_END_HEREDOC:
                    $stripStr .= "FREE;\n";
                    for($k = $i+1; $k < $j; $k++) {
                        if(is_string($tokens[$k]) && $tokens[$k] == ';') {
                            $i = $k;
                            break;
                        } else if($tokens[$k][0] == T_CLOSE_TAG) {
                            break;
                        }
                    }
                    break;
                default:
                    $last_space = false;
                    $stripStr .= $tokens[$i][1];
            }
        }
    }
    return $stripStr;
}

// 循环创建目录
function free_mkdir($dir, $mode = 0777) {
    if (is_dir($dir) || @mkdir($dir, $mode))
    {
        return true;
    }
    if (!free_mkdir(dirname($dir), $mode))
    {
        return false;
    }
    return @mkdir($dir, $mode);
}

//[RUNTIME]
// 编译文件
function free_compile($filename) {
    $content = file_get_contents($filename);
    // 替换预编译指令
    $content = preg_replace('/\/\/\[RUNTIME\](.*?)\/\/\[\/RUNTIME\]/s', '', $content);

    $content = free_strip_whitespace($content);
    $content = preg_replace("/\<\?php\s+namespace\s+(.+);/U", '', $content);
    $content = trim($content);
    if ('?>' == substr($content, -2))
    {
        $content = substr($content, 0, -2);
    }
    return $content;
}