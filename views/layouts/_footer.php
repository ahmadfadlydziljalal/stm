<?php

use yii\bootstrap5\Html; ?>

<div class="row">
    <div class="col-md-6 text-center text-md-start">

        &copy; <?= Yii::$app->params['companyName'] ?>, <?= date('Y') ?>
    </div>
    <div class="col-md-6 text-center text-md-end">
        <?php
        echo Html::a(Yii::$app->params['myOwnCompany'], "https://rayakreasi.xyz/", [
            'class' => 'text-primary text-decoration-none'
        ]);
        ?>
        |
        <?= Html::a( (Yii::$app->params['theme'] === 'dark' ? '<i class="bi bi-sun"></i>' : '<i class="bi bi-moon"></i>'),
            ['/dark-light-toggle/index'],
            [
                'id' => 'dark-light-link',
            ]
        ) ?>

        <?php
        echo ' | ' . Yii::$app->params['appVersion'] . '-' . ucfirst(Yii::$app->params['env'])
        ?>
    </div>
</div>