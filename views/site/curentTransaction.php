<?php
use yii\helpers\Html;
use yii\grid\GridView;

$this->title = $transaction->value;
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="transaction-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <div>
        <p>ID: <?= Html::encode($transaction->id) ?></p>
        <p>Заявка: <?= Html::encode($transaction->value) ?></p>
    </div>

    <div class="contact-transactions">
        <h2>Пользователь оставивший заявку</h2>

        <?= GridView::widget([
            'dataProvider' => new \yii\data\ArrayDataProvider([
                'allModels' => $transactionContact,
                'pagination' => [
                    'pageSize' => 10,
                ],
            ]),
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                [
                    'label' => 'id контакта',
                    'value' => function($model) {
                        return $model->id;  // Отображаем ID контакта
                    }
                ],
                [
                    'label' => 'Полное имя контакта',
                    'value' => function($model) {
                        return $model->fullname;
                    }
                ],
                [
                    'attribute' => 'Ссылка',
                    'format' => 'raw',  
                    'value' => function($model) {
                        return Html::a('Просмотреть', ['site/curent-contact', 'id' => $model->id]);
                    }
                ]
            ],
        ]) ?>
    </div>

</div>