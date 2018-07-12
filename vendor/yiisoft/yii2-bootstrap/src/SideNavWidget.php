<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace yii\bootstrap;

use Yii;
use yii\base\InvalidConfigException;
use yii\bootstrap\BootstrapAsset;
use yii\bootstrap\Widget;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\helpers\Html;

class SideNavWidget extends Widget
{
    /**
     * @var array list of items in the nav widget. Each array element represents a single
     * menu item which can be either a string or an array with the following structure:
     *
     * - label: string, required, the nav item label.
     * - url: optional, the item's URL. Defaults to "#".
     * - visible: bool, optional, whether this menu item is visible. Defaults to true.
     * - linkOptions: array, optional, the HTML attributes of the item's link.
     * - options: array, optional, the HTML attributes of the item container (LI).
     * - active: bool, optional, whether the item should be on active state or not.
     * - items: array|string, optional, the configuration array for creating a [[Dropdown]] widget,
     *   or a string representing the dropdown menu. Note that Bootstrap does not support sub-dropdown menus.
     *
     * If a menu item is a string, it will be rendered directly without HTML encoding.
     */
    public $bars = [];
    public $items = [];
    /**
     * @var bool whether the nav items labels should be HTML-encoded.
     */
    public $encodeLabels = true;
    /**
     * @var string the route used to determine if a menu item is active or not.
     * If not set, it will use the route of the current request.
     * @see params
     * @see isItemActive
     */
    public $activeUrl;
    public $id = 'id0';
    public static $barCounter = 0;
    public static $itemCounter = 0;

    /**
     * Initializes the widget.
     */
    public function init()
    {
        parent::init();
        if (!isset($this->id)) {
            $this->id = 'id0';
        }
        if (isset($this->options['navs']['bars'])) {
            $this->bars = $this->options['navs']['bars'];
        }
        if (isset($this->options['navs']['items'])) {
            $this->items = $this->options['navs']['items'];
        }
    }

    /**
     * Renders the widget.
     */
    public function run()
    {
        echo Html::beginTag('ul', ['id' => "guide-navigation", 'class' => "list-group"]);
        foreach ($this->bars as $i => $bar) {
            $barView = $this->renderBars($bar, $this->items);
            //echo $barView;
        }
        echo Html::endTag('ul');
        BootstrapPluginAsset::register($this->getView());
    }

    /**
     * Renders nav bars.
     */
    public function renderBars($bar, $items, $collapsed = true)
    {
        if (!is_array($bar) or !is_array($items)) {
            return 'null';
        }
        if (!isset($bar['catalog_id'])) {
            throw new InvalidConfigException("The 'catalog_id' option is required.");
        }
        $barName = $bar['bar_id'];
        $navgationId = "guide-navigation-" . static::$barCounter++;
        echo Html::beginTag('li', ['class' => "list-group-item", 'visibility' => "hidden"]);
        echo Html::beginTag('button',
            [
                'class' => "btn collapsed",
                'data-toggle' => "collapse",
                'data-target' => "#" . $navgationId,
                //'data-parent' => "#guide-navigation",
                'aria-expanded' => "false"
            ]
        );
        echo Html::encode($barName);
        echo Html::endTag('button');
        echo Html::beginTag('div',
            [
                'id' => $navgationId,
                'class' => "collapse",
            ]
        );
        /*
        if (isset($item['active'])) {
            $active = ArrayHelper::remove($item, 'active', false);
        } else {
            $active = ($url == $this->activeUrl);
        } */
        // 添加子列表
        foreach ($items as $item) {
            $itemBar = $item['bar_id'];
            $itemView = $item['view'];
            if ($itemBar != $barName) {
                continue;
            }
            $itemName = $item['item_id'];
            //$url = $item['url']
            echo Html::tag('button',
                $itemName,
                [
                    'class' => 'btn btn-default list-group-item',
                    'value' => $itemView,
                    'onclick' => 'refresh_contents(this)',
                ]
            );
        }
        echo Html::endTag('div');
        echo Html::endTag('li');
        return;
    }

    /**
     * Renders collapsible toggle button.
     * @return string the rendering toggle button.
     */
    protected function renderToggleButton()
    {
        $bar = Html::tag('span', '', ['class' => 'icon-bar']);
        $screenReader = "<span class=\"sr-only\">{$this->screenReaderToggleText}</span>";

        return Html::button("{$screenReader}\n{$bar}\n{$bar}\n{$bar}", [
            'class' => 'navbar-toggle',
            'data-toggle' => 'collapse',
            'data-target' => "#{$this->containerOptions['id']}",
        ]);
    }
}
