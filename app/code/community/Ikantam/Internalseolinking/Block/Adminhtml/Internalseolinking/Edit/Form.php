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
 * Internalseolinking edit form block
 *
 * @category   Ikantam
 * @package    Ikantam_Internalseolinking
 * @author     iKantam Team <support@ikantam.com>
 */
class Ikantam_Internalseolinking_Block_Adminhtml_Internalseolinking_Edit_Form extends Mage_Adminhtml_Block_Widget_Form
{
    /*
     * Init form
     *
    */
    protected function _prepareForm()
    {
        $form = new Varien_Data_Form(
            array(
                "id"     => "edit_form",
                "action" => $this->getUrl("*/*/save", array("isl_id" => $this->getRequest()->getParam("isl_id"))),
                "method" => "post")
        );
        
        $form->setUseContainer(true);
        $this->setForm($form);
        return parent::_prepareForm();
    }

}
