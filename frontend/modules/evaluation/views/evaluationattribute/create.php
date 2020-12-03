<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\evaluation\Evaluationattribute */

$this->title = 'Create Evaluationattribute';
$this->params['breadcrumbs'][] = ['label' => 'Evaluationattributes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="evaluationattribute-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
