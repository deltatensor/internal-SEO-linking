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
 * Internalseolinking page content block
 *
 * @category   Ikantam
 * @package    Ikantam_Internalseolinking
 * @author     iKantam Team <support@ikantam.com>
 */
class Ikantam_Internalseolinking_Model_Template_Filter extends Mage_Widget_Model_Template_Filter
{
    /**
     * Process CMS page content
     *
     * @param string $html
     * @return string
     */
    public function filter($html)
    {
        $html = parent::filter($html);
        
        $moduleHelper = Mage::helper('internalseolinking');

        if (!$moduleHelper->isEnabled()) {
            return $html;
        }
        
        if ($moduleHelper->getIsHomePage() && !$moduleHelper->shouldProcessHomepage()) {
            return $html;
        }
        
        if ($moduleHelper->getIsCmsPage() && !$moduleHelper->shouldProcessCmsPage()) {
            return $html;
        }

        if ($moduleHelper->getIsAwBlogPage() && !$moduleHelper->shouldProcessAwBlogPage()) {
            return $html;
        }

        $html = $moduleHelper->process($html);

        return $html;
    }
    
}
