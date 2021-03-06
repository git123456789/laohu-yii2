<?php
/**
 * Created by PhpStorm.
 * User: HBW
 * Date: 2016/4/1
 * Time: 22:30
 * To change this template use File | Setting | File Templates.
 */

namespace app\modules\core\helpers;

use app\modules\core\extensions\HuExportMenu\HuExportMenu;
use app\modules\core\extensions\HuGridView;
use kartik\daterange\DateRangePicker;
use yii\helpers\Html;

/**
 * Class RenderHelper
 * Created by Dex
 * @package app\modules\core\helpers
 */
class RenderHelper
{
    /**
     * 表格用到的，筛选状态性别之类的下拉框
     *
     * @param string $name 格式为'ModelSearch[attributeName]'
     * @param string $value
     * @param array $list 形如[value1 => label1, value2 => label2]的数组
     * @return string
     */
    public static function dropDownFilter($name, $value, $list)
    {
        return Html::dropDownList($name, $value, ['' => '全部'] + $list, ['class' => 'form-control', 'style' => ['min-width' => '100px']]);
    }

    /**
     * 表格用到的，筛选日期范围
     *
     * @param $name
     * @param bool $dateOnly
     * @return string
     * @throws \Exception
     */
    public static function dateRangePicker($name, $dateOnly = true)
    {
        $setting = [
            'name' => $name,
            'convertFormat' => true,
            'readonly' => true,
            'pluginOptions' => [
                'separator' => ' - ',
            ],
        ];

        if ($dateOnly) {
            $setting['pluginOptions'] += [
                'format' => 'Y/m/d',
            ];
        } else {
            $setting['pluginOptions'] += [
                'format' => 'Y/m/d H:i',
                'timePicker' => true,
                'timePicker12Hour' => false,
                'timePickerIncrement' => 1,
            ];
        }

        return DateRangePicker::widget($setting);
    }

    /**
     * @param $dataProvider
     * @param $searchModel
     * @param $gridColumns
     * @param bool $hasExport
     * @return string
     * @throws \Exception
     */
    public static function gridView($dataProvider, $searchModel, $gridColumns, $hasExport = false)
    {
        $data = '';

        //ExportMenu
        if ($hasExport) {
            $data .= '<p>';
            $data .= HuExportMenu::widget([
                'dataProvider' => $dataProvider,
                'columns' => $gridColumns,
            ]);
            $data .= '</p>';
        }

        //GridView
        $data .= HuGridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => $gridColumns,
        ]);

        return $data;
    }
}