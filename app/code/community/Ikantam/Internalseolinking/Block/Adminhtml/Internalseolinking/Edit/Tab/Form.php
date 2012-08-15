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
 * Internalseolinking edit form
 *
 * @category   Ikantam
 * @package    Ikantam_Internalseolinking
 * @author     iKantam Team <support@ikantam.com>
 */
class Ikantam_Internalseolinking_Block_Adminhtml_Internalseolinking_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{
    /*
     * Init form fieldset
     *
     * @return Ikantam_Internalseolinking_Block_Adminhtml_Internalseolinking_Edit_Tab_Form
    */
    protected function _prepareForm()
    {
        $form = new Varien_Data_Form();
        
        $this->setForm($form);
        
        $fieldset = $form->addFieldset(
            'internalseolinking_form', array(
                'legend' => Mage::helper('internalseolinking')->__('Record information'))
        );

        $fieldset->addField(
            'is_enabled', 'select', array(
                'label'  => Mage::helper('internalseolinking')->__('Enabled'),
                'name'   => 'is_enabled',
                'values' => array(0 => $this->__('No'), 1 => $this->__('Yes')))
        );

        $fieldset->addField(
            'keywords', 'textarea', array(
                'label'    => Mage::helper('internalseolinking')->__('Keywords'),
                'class'    => 'required-entry',
                'required' => true,
                'name'     => 'keywords')
        );

        $fieldset->addField(
            'url', 'text', array(
                'label'    => Mage::helper('internalseolinking')->__('URL'),
                'class'    => 'required-entry',
                'required' => true,
                'name'     => 'url')
        );
                
        $fieldset->addField(
            'title', 'text', array(
                'label' => Mage::helper('internalseolinking')->__('Title'),
                'name'  => 'title')
        );

        $fieldset->addField(
            'target_blank', 'select', array(
                'label'  => Mage::helper('internalseolinking')->__('Target'),
                'name'   => 'target_blank',
                'values' => array(0 => '_self', 1 => '_blank'))
        );

        $fieldset->addField(
            'is_bold', 'select', array(
                'label'  => Mage::helper('internalseolinking')->__('Make it Bold'),
                'name'   => 'is_bold',
                'values' => array(0 => $this->__('No'), 1 => $this->__('Yes')))
        );
        
        $fieldset->addField(
            'is_italic', 'select', array(
                'label'  => Mage::helper('internalseolinking')->__('Use Italics'),
                'name'   => 'is_italic',
                'values' => array(0 => $this->__('No'), 1 => $this->__('Yes')))
        );

        if (Mage::getSingleton('adminhtml/session')->getInternalseolinkingData()) {
            $form->setValues(Mage::getSingleton('adminhtml/session')->getInternalseolinkingData());
            Mage::getSingleton('adminhtml/session')->setInternalseolinkingData(null);
        } elseif (Mage::registry('current_internalseolink')) {
            $form->setValues(Mage::registry('current_internalseolink')->getData());
        }

        return parent::_prepareForm();
    }
    
}
