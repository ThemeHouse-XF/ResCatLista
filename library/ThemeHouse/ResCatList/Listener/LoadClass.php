<?php

class ThemeHouse_ResCatList_Listener_LoadClass extends ThemeHouse_Listener_LoadClass
{

    protected function _getExtendedClasses()
    {
        return array(
            'ThemeHouse_ResCatList' => array(
                'controller' => array(
                    'XenResource_ControllerPublic_Resource'
                ), /* END 'controller' */
                'model' => array(
                    'XenResource_Model_Category'
                ), /* END 'model' */
            ), /* END 'ThemeHouse_ResCatList' */
        );
    } /* END _getExtendedClasses */

    public static function loadClassController($class, array &$extend)
    {
        $loadClassController = new ThemeHouse_ResCatList_Listener_LoadClass($class, $extend, 'controller');
        $extend = $loadClassController->run();
    } /* END loadClassController */

    public static function loadClassModel($class, array &$extend)
    {
        $loadClassModel = new ThemeHouse_ResCatList_Listener_LoadClass($class, $extend, 'model');
        $extend = $loadClassModel->run();
    } /* END loadClassModel */
}