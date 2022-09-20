<?php

use yii\helpers\StringHelper;


/* @var $this yii\web\View */
/* @var $generator yii\gii\generators\crud\Generator */

$modelClass = StringHelper::basename($generator->modelClass);
$urlParams = $generator->generateUrlParams();
$nameAttribute = $generator->getNameAttribute();
$actionParams = $generator->generateActionParams();

echo "<?php\n";

?>
return [
    [
        'class' => 'yii\grid\SerialColumn',
    ],
    <?php
    $count = 0;
    foreach ($generator->getColumnNames() as $name) {   
        if ($name=='id'||$name=='created_at'||$name=='updated_at' ||$name=='created_by'||$name=='updated_by'){
            echo "    // [\n";
            echo "        // 'class'=>'\yii\grid\DataColumn',\n";
            echo "        // 'attribute'=>'" . $name . "',\n";
            echo "    // ],\n";
        } else if (++$count < 6) {
            echo "    [\n";
            echo "        'class'=>'\yii\grid\DataColumn',\n";
            echo "        'attribute'=>'" . $name . "',\n";
            echo "    ],\n";
        } else {
            echo "    // [\n";
            echo "        // 'class'=>'\yii\grid\DataColumn',\n";
            echo "        // 'attribute'=>'" . $name . "',\n";
            echo "    // ],\n";
        }
    }
    ?>
    [
        'class' => 'yii\grid\ActionColumn',
    ],
];   