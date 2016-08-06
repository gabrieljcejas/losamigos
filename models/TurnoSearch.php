<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Turno;

/**
 * TurnoSearch represents the model behind the search form about `app\models\Turno`.
 */
class TurnoSearch extends Turno
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['fecha', 'hora_inicio', 'hora_fin'], 'safe'],
            //[['cant_pollo', 'sobra_pollo'], 'number'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Turno::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'fecha' => $this->fecha,
            //'cant_pollo' => $this->cant_pollo,
            //'sobra_pollo' => $this->sobra_pollo,
        ]);

        $query->andFilterWhere(['like', 'hora_inicio', $this->hora_inicio])
            ->andFilterWhere(['like', 'hora_fin', $this->hora_fin]);

        $query->orderBy('id DESC');

        return $dataProvider;
    }
}
