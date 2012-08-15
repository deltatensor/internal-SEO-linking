<?php
/**
 * Internal SEO Linking
 *
 * LICENSE: this source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 *
 * @category    Ikantam
 * @package     Ikantam_Internalseolinking
 * @copyright   Copyright (c) 2012 iKantam LLC (http://www.ikantam.com)
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

/**
 * Internalseolinking tabs block
 *
 * @category   Ikantam
 * @package    Ikantam_Internalseolinking
 * @author     iKantam Team <support@ikantam.com>
 */
class Ikantam_Internalseolinking_Block_Adminhtml_Internalseolinking_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{
    /*
     * Init block
     *
    */
    public function __construct()
    {
        parent::__construct();
        $this->setId('isl_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle(Mage::helper('internalseolinking')->__('Internal SEO Linking'));
    }
    
    /*
     * Add tabs
     *
     * @return Ikantam_Internalseolinking_Block_Adminhtml_Internalseolinking_Edit_Tabs
    */
    protected function _beforeToHtml()
    {
        $this->addTab(
            'form_section', array(
                'label'   => Mage::helper('internalseolinking')->__('Record Information'),
                'title'   => Mage::helper('internalseolinking')->__('Record Information'),
                'content' => $this->getLayout()->createBlock('internalseolinking/adminhtml_internalseolinking_edit_tab_form')->toHtml())
        );

        return parent::_beforeToHtml();
    }

}
