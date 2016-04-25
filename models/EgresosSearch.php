<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Egresos;

/**
 * EgresosSearch represents the model behind the search form about `app\models\Egresos`.
 */
class EgresosSearch extends Egresos
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'prod_id', 'otro', 'forma_pago', 'cantidad', 'precio', 'usuario_id'], 'integer'],
            [['fecha', 'obs'], 'safe'],
            [['total'], 'number'],
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
        $query = Egresos::find();

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
            'prod_id' => $this->prod_id,
            'otro' => $this->otro,
            'forma_pago' => $this->forma_pago,
            'cantidad' => $this->cantidad,
            'precio' => $this->precio,
            'total' => $this->total,
            'usuario_id' => $this->usuario_id,
        ]);

        $query->andFilterWhere(['like', 'obs', $this->obs]);

        $query->orderBy('id DESC');

        return $dataProvider;
    }
}