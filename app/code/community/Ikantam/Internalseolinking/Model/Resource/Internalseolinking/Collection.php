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
 * Internalseolinking collection
 *
 * @category   Ikantam
 * @package    Ikantam_Internalseolinking
 * @author     iKantam Team <support@ikantam.com>
 */
class Ikantam_Internalseolinking_Model_Resource_Internalseolinking_Collection extends Mage_Core_Model_Resource_Db_Collection_Abstract
{
    /**
     * Initialize resources
     *
     */
    public function _construct()
    {
        $this->_init('internalseolinking/internalseolinking');
    }

    /*
     * Prepare regex and replacement arrays
     *
     * @return list 
     */
    public function getReplaces()
    {
        $excludes = explode(",", Mage::helper('internalseolinking')->getExceptionList());

        $replaces = $urls = array();
        $this->addFilter('is_enabled', '1');
        foreach ($this as $row) {
            if (Mage::helper('core/url')->getCurrentUrl() == $row->getUrl()) {
                continue;//do not allow self-linking
            }
            
            if (in_array(Mage::helper('core/url')->getCurrentUrl(), $excludes)) {
                continue;//check exception list
            }
            
            $words = explode(',', $row->getKeywords());

            foreach ($words as $word) {
                $replaces[] = '/' . '\b(' . preg_quote($word, '/') . ')\b' . '/iu';
                $urls[]     = $this->getIslLink($row);
            }
        }

        return array($replaces, $urls);
    }

    /*
     * Get link element for current keyword 
     *
     * @param Ikantam_Internalseolinking_Model_Internalseolinking $row
     * @return string
    */
    protected function getIslLink($row)
    {
        $target = $row->getTargetBlank() ? '_blank' : '_self';

        if ($row->getTitle()) {
            $link = '<a target="'. $target . '" href="' . $row->getUrl() . '">';

            if ($row->getIsBold()) {
                $link .= '<b>';
            }

            if ($row->getIsItalic()) {
                $link .= '<i>';
            }

            $link .= $row->getTitle();

            if ($row->getIsItalic()) {
                $link .= '</i>';
            }

            if ($row->getIsBold()) {
                $link .= '</b>';
            }

            $link .= '</a>';
        } else {
           $link = '<a target="'. $target . '" href="' . $row->getUrl() . '">';

            if ($row->getIsBold()) {
                $link .= '<b>';
            }

            if ($row->getIsItalic()) {
                $link .= '<i>';
            }

            $link .= '$1';

            if ($row->getIsItalic()) {
                $link .= '</i>';
            }

            if ($row->getIsBold()) {
                $link .= '</b>';
            }

            $link .= '</a>';
        }

        return $link;
    }

}
