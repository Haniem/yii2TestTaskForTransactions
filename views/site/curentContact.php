<?php
use yii\helpers\Html;
use yii\grid\GridView;

$this->title = $contact->fullname;
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="contact-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <div>
        <p>ID: <?= Html::encode($contact->id) ?></p>
        <p>Полное имя: <?= Html::encode($contact->fullname) ?></p>
    </div>

    <div class="contact-transactions">
        <h2>Заявки пользователя</h2>

        <?= GridView::widget([
            'dataProvider' => new \yii\data\ArrayDataProvider([
                'allModels' => $contactTransactions,
                'pagination' => [
                    'pageSize' => 10,
                ],
            ]),
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                [  
                    'label' => 'id заявки',
                    'value' => 'id'
                ],
                [
                        'attribute' => 'contact.fullname',
                        'label' => 'Полное имя контакта',
                        'value' => function($model) {
                            return $model->contact ? $model->contact->fullname : 'N/A';
                        }
                    ],
                [
                    'label' => 'Заявка',
                    'value' => 'value'
                ],
                [
                    'attribute' => 'Ссылка',
                    'format' => 'raw', 
                    'value' => function($model) {
                        return Html::a('Просмотреть', ['site/curent-transaction', 'id' => $model->id]);
                    }
                ]
            ],
        ]) ?>
    </div>

</div>