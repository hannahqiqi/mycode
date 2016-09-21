<html>
    <head>
        <title>document</title>
    </head>
    <body>
        <!--<h1>hello common</h1>-->
        <?php if(isset($this->blocks['block1'])):?>
            <?=$this->block['block1'];?>
        <?php else: ?>
            <h1>hello common</h1>
        <?php endif; ?>
        <?=$content;?>
    </body>
</html>