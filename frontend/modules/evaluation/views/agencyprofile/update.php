<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\evaluation\Agencyprofile */

$this->title = 'Update Agencyprofile: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Agencyprofiles', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->agency_profile_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="agencyprofile-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
