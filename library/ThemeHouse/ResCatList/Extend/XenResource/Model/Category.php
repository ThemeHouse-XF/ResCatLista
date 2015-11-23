<?php

/**
 *
 * @see XenResource_Model_Category
 */
class ThemeHouse_ResCatList_Extend_XenResource_Model_Category extends XFCP_ThemeHouse_ResCatList_Extend_XenResource_Model_Category
{

    public function groupCategoriesByParent(array $categories)
    {
        $grouped = parent::groupCategoriesByParent($categories);
        if (isset($GLOBALS['ThemeHouse_ResCatList_Extend_XenResource_ControllerPublic_Resource'])) {
            $categoryId = $GLOBALS['ThemeHouse_ResCatList_Extend_XenResource_ControllerPublic_Resource'];
            $selectedCategory = $categories[$categoryId];
        } else {
            return $grouped;
        }

        if (isset($selectedCategory)) {
            if (isset($categories[$selectedCategory['parent_category_id']])) {
                $parentCategory = $categories[$selectedCategory['parent_category_id']];
                $options = $this->_getResourceCategoryListOptions();
            }
            if (isset($parentCategory)) {
                if (isset($categories[$parentCategory['parent_category_id']])) {
                    $grandParentCategory = $categories[$parentCategory['parent_category_id']];
                }
                if (isset($grandParentCategory)) {
                    if (isset($categories[$grandParentCategory['parent_category_id']])) {
                        $greatGrandParentCategory = $categories[$grandParentCategory['parent_category_id']];
                    }
                }
            }
        }

        if (isset($parentCategory)) {
            if ($options['siblings']) {
                $siblingCategories = array_keys($grouped[$parentCategory['resource_category_id']]);
                if (($key = array_search($categoryId, $siblingCategories)) !== false) {
                    unset($siblingCategories[$key]);
                }
                if (!empty($siblingCategories)) {
                    foreach ($siblingCategories as $key) {
                        unset($grouped[$parentCategory['resource_category_id']][$key]);
                    }
                }
            }

            if (isset($grandParentCategory)) {
                if ($options['parentSiblings']) {
                    $parentSiblingCategories = array_keys($grouped[$grandParentCategory['resource_category_id']]);
                    if (($key = array_search($parentCategory['resource_category_id'], $parentSiblingCategories)) !==
                         false) {
                        unset($parentSiblingCategories[$key]);
                    }
                    if (!empty($parentSiblingCategories)) {
                        foreach ($parentSiblingCategories as $key) {
                            unset($grouped[$grandParentCategory['resource_category_id']][$key]);
                        }
                    }
                }

                if (isset($greatGrandParentCategory)) {
                    if ($options['grandParentSiblings']) {
                        $grandParentSiblingCategories = array_keys(
                            $grouped[$greatGrandParentCategory['resource_category_id']]);
                        if (($key = array_search($grandParentCategory['resource_category_id'],
                            $grandParentSiblingCategories)) !== false) {
                            unset($grandParentSiblingCategories[$key]);
                        }
                        if (!empty($grandParentSiblingCategories)) {
                            foreach ($grandParentSiblingCategories as $key) {
                                unset($grouped[$greatGrandParentCategory['resource_category_id']][$key]);
                            }
                        }
                    }
                }
            }
        }

        return $grouped;
    } /* END groupCategoriesByParent */

    /**
     * Fetches the options related to this add-on.
     */
    protected function _getResourceCategoryListOptions()
    {
        $options = XenForo_Application::getOptions();

        return array(
            'siblings' => $options->get('th_resCategoryList_hideSiblings'),
            'parentSiblings' => $options->get('th_resCategoryList_hideParentSiblings'),
            'grandParentSiblings' => $options->get('th_resCategoryList_hideGrandParentSiblings')
        );
    } /* END _getResourceCategoryListOptions */
}