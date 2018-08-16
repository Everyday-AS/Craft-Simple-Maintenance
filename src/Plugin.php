<?php

namespace everyday\simplemaintenance;

use everyday\simplemaintenance\models\Settings;
use craft\web\View;

class Plugin extends \craft\base\Plugin
{
    public $hasCpSettings = true;

    /**
     * @return string|void
     * @throws \Twig_Error_Loader
     * @throws \yii\base\Exception
     */
    public function init()
    {
        parent::init();

        // Custom initialization code goes here...
        $settings = $this->getSettings();

        // check if maintenance mode is enabled
        if($settings->maintenance === '1'
            && substr(\Craft::$app->request->getFullPath(), 0, strlen(\Craft::$app->getConfig()->general->cpTrigger)) !== \Craft::$app->getConfig()->general->cpTrigger){

            $html =\Craft::$app->getView()->renderTemplate($settings->view, [
                'settings' => $settings
            ]);

            die($html);
        }
    }

    /**
     * @return Settings
     */
    protected function createSettingsModel()
    {
        return new Settings();
    }

    /**
     * @return null|string
     * @throws \Twig_Error_Loader
     * @throws \yii\base\Exception
     */
    protected function settingsHtml()
    {
        $settings = $this->getSettings();
        $settings->validate();

        return \Craft::$app->getView()->renderTemplate('simple-maintenance/_settings', [
            'settings' => $settings
        ]);
    }
}