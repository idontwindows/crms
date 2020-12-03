<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\evaluation\Feedback */

$this->title = 'New Feedback';
$this->params['breadcrumbs'][] = ['label' => 'Feedbacks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="feedback-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('__form', [
        'model' => $model,
        'modelComment' => $modelComment,
        //'modelCustomer' => $modelCustomer,
        'modelDeliveryrating' => $modelDeliveryrating,
        'modelImportancerating' => $modelImportancerating,
        'modelOtherattribute' => $modelOtherattribute,
        'modelPromotion' => $modelPromotion,
        'evaluationAttributes' => $evaluationAttributes,
        'ratingScale' => $ratingScale,
        'ratingPromotion' => $ratingPromotion,
        'modelCustomerExperience' => $modelCustomerExperience,
    ]) ?>

</div>
