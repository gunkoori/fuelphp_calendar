<!DOCTYPE html>
<html lang='ja'>
<head>
    <meta charset='utf-8'>
    <title>calendar</title>
    <?php echo Asset::css('style.css');?>
    <?php echo Asset::js('jquery-2.1.1.min.js');?>
    <?php echo Asset::js('script.js');?>
    
</head>
<body>

    <div="header">
        <!-- header.phpファイルを読み込む-->
        <?php echo $header; ?>
    </div>
    <div id="content">
        <!-- 各アクションの内容を読み込む-->
        <?php echo $content; ?>
    </div>
    <div id="footer">
        <!-- footer.phpファイルを読み込む-->
        <?php echo $footer; ?>
    </div>


</body>
</html>
