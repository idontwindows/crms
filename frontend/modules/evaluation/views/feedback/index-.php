<?php

//Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl . 'css/overflow/main1.css');
//Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl . 'css/overflow/noscript.css');

$this->registerCssFile("css/overflow/main1.css", [
    //'depends' => [\yii\bootstrap\BootstrapAsset::className()],
    'media' => 'print',
], 'css-print-theme');

$this->registerCssFile("css/overflow/noscript.css", [
    //'depends' => [\yii\bootstrap\BootstrapAsset::className()],
    'media' => 'print',
], 'css-print-theme');
?>
<html>
	<head>
		<title>Overflow by HTML5 UP</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<!--link rel="stylesheet" href="css/overflow/main1.css" /-->
		<!--noscript><link rel="stylesheet" href="css/overflow/noscript.css" /></noscript-->
		
	</head>
	
	<body class="is-preload">
	    <section id="header">
            <header>
                <h1>Overflow</h1>
                <p>By HTML5 UP</p>
            </header>
            <footer>
                <a href="#banner" class="button style2 scrolly-middle">Proceed as anticipated</a>
            </footer>
        </section>
        
        <section id="banner">
            <header>
                <h2>This is Overflow</h2>
            </header>
            <p>A brand new site template designed by <a href="http://twitter.com/ajlkn">AJ</a> for <a href="http://html5up.net">HTML5 UP</a>.<br />
            It’s responsive, built on HTML5/CSS3, and entirely free<br />
            under the <a href="http://html5up.net/license">Creative Commons license</a>.</p>
            <footer>
                <a href="#first" class="button style2 scrolly">Act on this message</a>
            </footer>
        </section>

        <article id="first" class="container box style1 right">
            <a href="#" class="image fit"><img src="images/pic01.jpg" alt="" /></a>
            <div class="inner">
                <header>
                    <h2>Lorem ipsum<br />
                    dolor sit amet</h2>
                </header>
                <p>Tortor faucibus ullamcorper nec tempus purus sed penatibus. Lacinia pellentesque eleifend vitae est elit tristique velit tempus etiam.</p>
            </div>
        </article>
        
    </body>
</html>