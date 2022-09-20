<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var app\models\ContactForm $model */

use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;
use yii\captcha\Captcha;

$this->title = 'Contact';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-contact d-flex flex-column gap-5 px-0 align-items-center">

    <?php if (Yii::$app->session->hasFlash('contactFormSubmitted')): ?>

        <div class="contact-form-submitted">

            <h1><?= Html::encode($this->title) ?></h1>
            
            <div class="alert alert-success">
                Thank you for contacting us. We will respond to you as soon as possible.
            </div>

            <p>
                Note that if you turn on the Yii debugger, you should be able
                to view the mail message on the mail panel of the debugger.
                <?php if (Yii::$app->mailer->useFileTransport): ?>
                    Because the application is in development mode, the email is not sent but saved as
                    a file under <code><?= Yii::getAlias(Yii::$app->mailer->fileTransportPath) ?></code>. Please configure the
                    <code>useFileTransport</code> property of the <code>mail</code>
                    application component to be false to enable email sending.
                <?php endif; ?>
            </p>

        </div>

    <?php else: ?>

        <div class="contact-section d-flex flex-row gap-5">

            <div class="contact-form">
                <p class="text-justify">
                    Jika Anda memiliki pertanyaan bisnis atau pertanyaan lain,
                    Silakan isi formulir berikut untuk menghubungi kami.
                    Terima kasih.
                </p>

                <?php $form = ActiveForm::begin([
                    'id' => 'contact-form',
                    'enableClientValidation' => true,
                    'layout' => ActiveForm::LAYOUT_FLOATING,
                ]); ?>

                <?= $form->field($model, 'name')->textInput(['autofocus' => true]) ?>
                <?= $form->field($model, 'email') ?>
                <?= $form->field($model, 'subject') ?>
                <?= $form->field($model, 'body')
                    ->textarea([
                        'rows' => 6,
                        'style' => [
                            'min-height' => '12rem'
                        ]
                    ]) ?>

                <div class="py-3 px-0">
                    <?= $form->field($model, 'verifyCode')->widget(Captcha::class, [
                        'template' => '
                    <div class="d-flex justify-content-between">
                        <div style="width: 80%">
                         {image}
                        </div>
                        {input}
                    </div>
                ',
                    ])->label(false) ?>
                </div>

                <div class="form-group d-flex justify-content-between">
                    <?= Html::a('Beranda', ['/'], ['class' => 'btn btn-outline-primary']) ?>
                    <?= Html::submitButton('Submit', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
                </div>

                <?php ActiveForm::end(); ?>
            </div>

            <?php if(!Yii::$app->user->isGuest) : ?>
                <div class="image align-self-center">
                    <?= Html::img(Yii::getAlias('@web') . '/images/undraw_newsletter_re_wrob.svg', [
                        'class' => 'img-fluid',
                        'style' => [
                            'transform' => 'scaleX(-1)'
                        ]
                    ]) ?>
                </div>
            <?php endif ?>

        </div>

    <?php endif; ?>

</div>