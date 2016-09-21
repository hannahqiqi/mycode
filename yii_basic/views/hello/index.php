<?php
    use yii\helpers\Html;
    use\yii\helpers\HtmlPurifier;
?>

<!--<h1>hello world!</h1>--><!--创建-->

<h1><?=Html::encode($view_hello_str);?></h1><!--key当作变量来使用-->
<h1><?=HtmlPurifier::process($view_hello_str);?></h1>
<!--<h1><?=$view_test_arr[0];?></h1>-->



