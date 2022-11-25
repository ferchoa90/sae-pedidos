<?php 
namespace backend\components;

class NewsView extends \yii\web\View {

 
    public function init() {
        parent::init();
        $this->viewPath = '@app/theme/hail812/yii2-adminlte3/src/views'; // or before init()
    }

}
?>