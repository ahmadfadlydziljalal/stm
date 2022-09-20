<?php

/**/

/* @var $this View */
/* @var $withBreadcrumb bool */

/* @see \app\controllers\SiteController::actionAbout() */

use yii\bootstrap5\Html;
use yii\web\View;

if (!$this->title) {
    $this->title = 'Tentang Web';

}

if ($withBreadcrumb) {
    $this->params['breadcrumbs'][] = $this->title;
}

?>

<div class="site-about" style="max-width: 48rem">
    <div class="d-flex flex-column flex-nowrap" style="gap: .25rem">

        <h1>
            <?= Yii::$app->settings->get('site.icon') ?>
            <?php
                $text = Yii::$app->settings->get('site.name');
                echo Yii::$app->$text
            ?>
        </h1>

        <div class="d-flex flex-column text-justify" style="gap: 1.5rem">
            <p>
                <?= Yii::$app->settings->get('site.description')?>
            </p>
        </div>


        <div class="d-flex justify-content-between align-items-center py-2">
            <div class="d-flex flex-column">
                <span class="text-muted">Dibuat dan di maintenance oleh:</span>
                <span><?= Yii::$app->params['maintainer'] ?></span>
            </div>

            <div class="px-3">
                <?= Html::img(Yii::getAlias('@web') . '/images/undraw_feeling_proud_qne1.svg', [
                    'class' => 'img-fluid',
                    'style' => [
                        'transform' => 'scaleX(-1)',
                        'width' => '12rem',
                        'height' => 'auto'
                    ]
                ]) ?>
            </div>

        </div>
    </div>
</div>