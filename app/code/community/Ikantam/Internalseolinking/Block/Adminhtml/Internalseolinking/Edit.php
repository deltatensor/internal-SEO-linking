<?php
/**
 * iKantam
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
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
 * Internalseolinking edit block
 *
 * @category   Ikantam
 * @package    Ikantam_Internalseolinking
 * @author     iKantam Magento Team <support@ikantam.com>
 */
class Ikantam_Internalseolinking_Block_Adminhtml_Internalseolinking_Edit
    extends Mage_Adminhtml_Block_Widget_Form_Container
{
    /**
     * Init block, add and update buttons
     *
     * @return void
     */
    public function __construct()
    {
        $helper = Mage::helper('internalseolinking');
        
        $this->_objectId   = 'isl_id';
        $this->_controller = 'adminhtml_internalseolinking';
        
        parent::__construct();
        
        $this->_blockGroup = 'internalseolinking';
        
        $this->_updateButton('save', 'label', $helper->__('Save Record'));
        $this->_updateButton('delete', 'label', $helper->__('Delete Record'));

        $this->_addButton(
            'save_and_edit_button', array(
                'label'   => $helper->__('Save And Continue Edit'),
                'onclick' => 'saveAndContinueEdit(\'' . $this->_getSaveAndContinueUrl() . '\')',
                'class'   => 'save',
            ), 1
        );

        //TODO: do we need this?
        $this->_formScripts[] = 'function saveAndContinueEdit(){
                                     editForm.submit($("edit_form").action+"back/edit/");
                                 }';
    }

    /**
     * Retrieve Header text
     *
     * @return string
     */
    public function getHeaderText()
    {
        if (Mage::registry('current_internalseolink')->getId()) {
            return Mage::helper('internalseolinking')->__(
                'Edit Record #%s', $this->htmlEscape(
                    Mage::registry('current_internalseolink')->getId()
                )
            );
        } else {
            return Mage::helper('internalseolinking')->__('New Record');
        }
    }

    /**
     * Retrieve Delete URL
     *
     * @return string
     */
    public function getDeleteUrl()
    {
        return $this->getUrl(
            '*/*/delete', array(
                'isl_id' => $this->getRequest()->getParam($this->_objectId),
                'ret'    => $this->getRequest()->getParam('ret', 'index'))
        );
    }

    /**
     * Retrieve SaveAndContinue URL
     *
     * @return string
     */
    public function _getSaveAndContinueUrl()
    {
        return $this->getUrl(
            '*/*/save', array(
                '_current' => true,
                'ret'      => 'edit',
                'continue' => $this->getRequest()->getParam('ret', 'index'))
        );
    }

    /**
     * Retrieve Save URL
     *
     * @return string
     */
    public function getSaveUrl()
    {
        return $this->getUrl('*/*/save', array('_current'=>true));
    }

    /**
     * Get URL for back (reset) button
     *
     * @return string
     */
    public function getBackUrl()
    {
        return $this->getUrl('*/*/' . $this->getRequest()->getParam('ret', 'index'));
    }

}
