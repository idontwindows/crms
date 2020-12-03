<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\evaluation\Agencyprofile */

$this->title = 'Create Agencyprofile';
$this->params['breadcrumbs'][] = ['label' => 'Agencyprofiles', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="agencyprofile-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
