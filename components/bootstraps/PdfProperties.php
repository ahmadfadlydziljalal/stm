<?php

namespace app\components\bootstraps;

use Yii;
use yii\base\Component;

class PdfProperties extends Component
{

    public function init()
    {

        parent::init();

        $header = !Yii::$app->settings->get('site.name') ?
            Yii::$app->name :
            Yii::$app->settings->get('site.name');

        $footer = empty(Yii::$app->settings->get('site.companyClient')) ?
            Yii::$app->params['companyName'] :
            Yii::$app->settings->get('site.companyClient');

        $pdf = Yii::$app->pdf;
        $pdf->methods['SetHeader'] = $header . '| |' . Yii::$app->formatter->asDatetime(date("Y-m-d H:i"));
        $pdf->methods['SetFooter'] = $footer . '| |' . '{PAGENO} dari {nb}';

    }

}