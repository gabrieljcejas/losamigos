<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\assets\AppAsset;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\helpers\Html;
use yii\widgets\Breadcrumbs;

AppAsset::register($this);
?>
<?php $this->beginPage()?>
<!DOCTYPE html>
<html lang="<?=Yii::$app->language?>">
<head>
    <meta charset="<?=Yii::$app->charset?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?=Html::csrfMetaTags()?>
    <title><?=Html::encode($this->title)?></title>
    <?php $this->head()?>
</head>
<body>
<?php $this->beginBody()?>

<div class="wrap">
    <?php
NavBar::begin([
	'brandLabel' => 'Pollos a las brasas LOS AMIGOS',
	'brandUrl' => Yii::$app->homeUrl,
	'options' => [
		'class' => 'navbar-inverse navbar-fixed-top',
	],
]);
echo Nav::widget([
	'options' => ['class' => 'navbar-nav navbar-right'],
	'items' => [
		['label' => 'Inicio', 'url' => ['/site/index']],
		['label' => 'Turno', 'url' => ['/turno/index']],
		['label' => 'Ventas', 'url' => ['/ventas/index']],
		['label' => 'Egresos', 'url' => ['/egresos/index']],
		['label' => 'Clientes', 'url' => ['/clientes/index']],
		//['label' => 'Proveedores', 'url' => ['/proveedores/index']],
		['label' => 'Productos', 'url' => ['/productos/index']],
		['label' => 'Proveedores', 'url' => ['/proveedores/create']],
		['label' => 'Reportes', 'url' => ['#'],
			'items' => [
				['label' => 'Movimientos de Caja', 'url' => ['ventas/consulta-movimientos-caja']],
				['label' => 'Egresos', 'url' => ['ventas/consulta-egresos']],
				['label' => 'Ventas', 'url' => ['ventas/consulta-ventas']],
				//'<li class="divider"></li>',
				//['label' => 'Estado de Cuenta', 'url' => ['/proveedor/index']],
			],
		],

		//['label' => 'Promos', 'url' => ['/site/promos']],
		Yii::$app->user->isGuest ? (
			['label' => 'Login', 'url' => ['/site/login']]
		) : (
			'<li>'
			. Html::beginForm(['/site/logout'], 'post')
			. Html::submitButton(
				'Logout (' . Yii::$app->user->identity->username . ')',
				['class' => 'btn btn-link']
			)
			. Html::endForm()
			. '</li>'
		),
	],
]);
NavBar::end();
?>

    <div class="container">
        <?=Breadcrumbs::widget([
	'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
])?>
        <?=$content?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; My Company <?=date('Y')?></p>

        <p class="pull-right"><?=Yii::powered()?></p>
    </div>
</footer>

<?php $this->endBody()?>
</body>
</html>
<?php $this->endPage()?>
