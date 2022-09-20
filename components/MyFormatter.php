<?php

namespace app\components;

use Yii;
use yii\i18n\Formatter;

class MyFormatter extends Formatter {
    public function asSpellout($value) {
        if (Yii::$app->language == "en-US") {
            $valueParent = parent::asSpellout($value);
            return ucwords($valueParent) . ' US Dollars';
        } else {
            return parent::asSpellout($value);
        }
    }
}