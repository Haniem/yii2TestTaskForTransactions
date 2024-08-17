<?php


use yii\grid\GridView;
use yii\grid\ActionColumn;
use app\models\Contact;
use app\models\Transaction;
use yii\helpers\Url;
use yii\helpers\Html;

/** @var yii\web\View $this */

$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div class="jumbotron text-center bg-transparent mt-5 mb-5">
        <h1 class="display-4">Сайт для просмотра заявок!</h1>

    </div>
    
    <br>
    <br>

    <div class="">
        
        <h1 class="display-4">Список пользователей!</h1>

        <?= GridView::widget([
            'dataProvider' => $contactDataProvider,
            'filterModel' => $contactSearchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                'id',
                'fullname',
                [
                    'attribute' => 'Ссылка',
                    'format' => 'raw', 
                    'value' => function($model) {
                        return Html::a('Просмотреть', ['site/curent-contact', 'id' => $model->id]);
                    }
                ]
            ],
        ]); ?>
    </div>

    <br>
    <br>
    <br>
    <br>

    <div class="">
        
        <h1 class="display-4">Список заявок!</h1>

        <?= GridView::widget([
            'dataProvider' => $transactionDataProvider,
            'filterModel' => $transactionSearchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                'id',
                'value',
                'contact_id',
                [
                    'attribute' => 'Ссылка',
                    'format' => 'raw', 
                    'value' => function($model) {
                        return Html::a('Просмотреть', ['site/curent-transaction', 'id' => $model->id]);
                    }
                ]
            ],
        ]); ?>
    </div>

</div>
