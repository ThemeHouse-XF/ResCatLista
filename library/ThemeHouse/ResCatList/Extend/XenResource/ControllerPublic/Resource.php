<?php

/**
 *
 * @see XenResource_ControllerPublic_Resource
 */
class ThemeHouse_ResCatList_Extend_XenResource_ControllerPublic_Resource extends XFCP_ThemeHouse_ResCatList_Extend_XenResource_ControllerPublic_Resource
{

    public function actionCategory()
    {
        $GLOBALS['ThemeHouse_ResCatList_Extend_XenResource_ControllerPublic_Resource'] = $this->_input->filterSingle(
            'resource_category_id', XenForo_Input::UINT);
        return parent::actionCategory();
    } /* END actionCategory */
}