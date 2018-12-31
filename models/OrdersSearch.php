<?php
/**
 * Created by PhpStorm.
 * User: mirushaki
 * Date: 12/31/18
 * Time: 3:43 PM
 */

namespace app\models;


use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\db\conditions\OrCondition;

class OrdersSearch extends Orders
{
    public $user = Users::ALL;
    private $query;

    public function __construct($userId = null)
    {
        if($userId) {
            $this->user = Users::findOne(['id' => $userId]);
            $this->query = Orders::find()->andWhere(['user_id' => $userId]);
        }
        else
            $this->query = Orders::find();
        parent::__construct();
    }


    /*public function Scenarios()
    {
        return Model::scenarios();
    }*/


    public function rules()
    {
        $rules = [
            [['number', 'fullName'], 'safe']
        ];

/*
        if($this->user == Users::ALL)
            array_push($rules, [['user'], 'safe']);*/
        return $rules;
    }

    public function attributes()
    {
        if($this->user == Users::ALL)
            return array_merge(parent::attributes(), ['fullName']);
        else return parent::attributes();
    }

    public function search($params)
    {
        //var_dump($params); exit;
        if($this->user == Users::ALL)
            $this->query->joinWith(['user AS user']);

        $dataProvider = new ActiveDataProvider([
            'query' => $this->query,
            'pagination' => [
                'pageSize' => 5
            ],
            'sort' => [
                'attributes' => [
                    'id',
                    'number'
                ],
                'enableMultiSort' => false,
                'defaultOrder' => [
                    'id' => SORT_ASC
                ]
            ]
        ]);
/*
        $query->joinWith('Users AS user');*/
        if($this->user == Users::ALL)
        {
            $dataProvider->sort->attributes['fullName'] = [
                'asc' => ['user.firstName' => SORT_ASC],
                'desc' => ['user.firstName'=> SORT_DESC]
            ];
        }

        if(!($this->load($_GET) && $this->validate()))
        {
            return $dataProvider;
        }

        $this->query->andFilterWhere(['like', 'number', $this->getAttribute('number')]);

        if($this->user == Users::ALL) {/*
            $this->query->andFilterWhere(['like', 'user.firstName', $this->getAttribute('user.firstName')]);
            $this->query->andFilterWhere(['like', 'user.lastName', $this->getAttribute('user.lastName')]);*/


            $this->query->andWhere(new OrCondition([['like', 'user.firstName', $this->fullName],
                ['like', 'user.lastName', $this->fullName]
            ]));

            /*$this->query->andFilterWhere(['like', 'user.lastName', $this->getAttribute('user.lastName')]);*//*
            $this->query->andWhere(new OrCondition([['like', 'user.firstName', $this->getAttribute('user.firstName')],
                            ['like', 'user.lastName', $this->getAttribute('user.lastName')]]));*/
        }

        return $dataProvider;
    }
}