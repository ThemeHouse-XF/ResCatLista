<?php

class ThemeHouse_ResCatList_Install_Controller extends ThemeHouse_Install
{

    protected $_resourceManagerUrl = 'http://xenforo.com/community/resources/resource-categories-list-navigation.2947/';

    protected function _getPrerequisites()
    {
        return array(
            'XenResource' => '1000000'
        );
    } /* END _getPrerequisites */
}