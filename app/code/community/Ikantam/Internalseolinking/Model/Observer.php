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
 * Internalseolinking observer
 *
 * @category   Ikantam
 * @package    Ikantam_Internalseolinking
 * @author     iKantam Team <support@ikantam.com>
 */
class Ikantam_Internalseolinking_Model_Observer
{
    /**
     * Assign category and product attribute handlers
     *
     * @param  Varien_Event_Observer $observer
     * @return Ikantam_Internalseolinking_Model_Observer
     */
    public function assignHandlers($observer)
    {
        $catalogHelper = $observer->getEvent()->getHelper();
        $moduleHelper = Mage::helper('internalseolinking');
        
        if (!$moduleHelper->isEnabled()) {
            return $this;
        }

        if ($moduleHelper->shouldProcessCategory()) {
            $catalogHelper->addHandler('categoryAttribute', $moduleHelper);
        }
        
        if ($moduleHelper->shouldProcessProduct()) {
            $catalogHelper->addHandler('productAttribute', $moduleHelper);
        }

        return $this;
    }
}
