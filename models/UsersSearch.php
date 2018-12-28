<?php
/**
 * Created by PhpStorm.
 * User: miriani
 * Date: 12/27/18
 * Time: 12:07 PM
 */

namespace app\models;


use yii\data\ActiveDataProvider;

class UsersSearch extends Users
{
    public function rules()
    {
        return [
            [['firstName', 'lastName'], 'safe']
        ];
    }

    public function Search($params)
    {
        $query = Users::find();

        $dataProvider = new ActiveDataProvider([
                'query' => $query,
                'pagination' => [
                    'pageSize' => 2
                ],
                'sort' => [
                    'attributes' => [
                        'firstName',
                        'lastName'
                    ],
                    'enableMultiSort' => true,
                    'defaultOrder' => [
                        'lastName' => SORT_DESC
                    ]
                ]
            ]);

        if (!($this->load($_GET)) && !$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere(['like', 'firstName', $this->firstName]);
        $query->andFilterWhere(['like', 'lastName', $this->lastName]);

        return $dataProvider;
    }
}