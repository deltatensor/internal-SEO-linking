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
 * Internalseolinking data helper
 *
 * @category   Ikantam
 * @package    Ikantam_Internalseolinking
 * @author     iKantam Team <support@ikantam.com>
 */
class Ikantam_Internalseolinking_Helper_Data extends Mage_Core_Helper_Abstract
{
    /**
     * Prepare category attribute html output
     *
     * @param Mage_Catalog_Helper_Output $helper
     * @param string $attributeHtml
     * @param array $params
     * @return string
     */
    public function categoryAttribute($helper, $attributeHtml, $params)
    {
        if (isset($params['attribute']) && $params['attribute'] === 'description') {
            $attributeHtml = $this->process($attributeHtml);
        }

        return $attributeHtml;
    }
    
    /**
     * Prepare product attribute html output
     *
     * @param Mage_Catalog_Helper_Output $helper
     * @param string $attributeHtml
     * @param array $params
     * @return string
     */
    public function productAttribute($callObject, $attributeHtml, $params)
    {
        if (isset($params['attribute']) && $params['attribute'] === 'description') {
            $attributeHtml = $this->process($attributeHtml);
        }

        return $attributeHtml;
    }
    
    /*
     * Convert keywords into links
     * 
     * @param string $html
     * @return string
    */
    public function process($html)
    {
        $globalLimit = $limit = $this->getReplacementLimit();
        
        if ($globalLimit <= 0) {
            $globalLimit = $limit = -1;
        }
        $repCount = 0;

        $dom = new DOMDocument();
        $dom->loadHtml(mb_convert_encoding($html, 'HTML-ENTITIES', 'UTF-8'));
        $xpath = new DOMXPath($dom);
        $model = Mage::getModel('internalseolinking/internalseolinking');
        list($replaces, $urls) = $model->getCollection()->getReplaces();

        foreach ($xpath->query('//text()[not(ancestor::a)]') as $node) {
            if ($node->nodeType === 3) {
                if ($globalLimit > 0) {
                    $limit = $globalLimit - $repCount;
                    if ($limit < 0) {
                        $limit = 0;
                    }
                }
                //$replaced = preg_replace($replaces, $urls, htmlentities($node->wholeText), $limit, $count);
                $replaced = preg_replace($replaces, $urls, preg_replace('/[&]([^a])/', '&amp;$1', $node->wholeText), $limit, $count);
                $newNode  = $dom->createDocumentFragment();
                @$newNode->appendXML($replaced);
                $node->parentNode->replaceChild($newNode, $node);
                $repCount += $count;
            }
        }

        return $dom->saveHTML();
    }
    
    /**
     * Get current url
     *
     * @return true
     */
    public function getCurrentUrl()
    {
        return Mage::getUrl('*/*/*', array('_current'=>true, '_use_rewrite'=>true));
    }

    /**
     * Check if current url is url for home page
     *
     * @return true
     */
    public function getIsHomePage()
    {
        return Mage::getUrl('') == Mage::getUrl('*/*/*', array('_current'=>true, '_use_rewrite'=>true));
    }
    
    /**
     * Check if current page is CMS page
     *
     * @return boolean
     */
    public function getIsCmsPage()
    {
        return ((int) Mage::getBlockSingleton('cms/page')->getPage()->getData('page_id')) > 0;
    }
    
    /**
     * Check if current page is CMS page
     *
     * @return boolean
     */
    public function getIsAwBlogPage()
    {
        if (!Mage::getConfig()->getModuleConfig('AW_Blog')->is('active', 'true')) {
            return false;
        }

        $request = Mage::app()->getRequest();
        return ($request->getControllerModule() === 'AW_Blog' && $request->getModuleName() === 'blog');
    }
    
    /*
     * Get module settings
     *
     * @return boolean
    */
    public function isEnabled()
    {
        return (bool) Mage::getStoreConfig('internalseolinking/module_options/enabled');
    }
    
    /*
     * Get module settings
     *
     * @return boolean
    */
    public function shouldProcessHomepage()
    {
        return (bool) Mage::getStoreConfig('internalseolinking/process_options/home');
    }
    
    /*
     * Get module settings
     *
     * @return boolean
    */
    public function shouldProcessCmsPage()
    {
        return (bool) Mage::getStoreConfig('internalseolinking/process_options/cms');
    }
    
    /*
     * Get module settings
     *
     * @return boolean
    */
    public function shouldProcessCategory()
    {
        return (bool) Mage::getStoreConfig('internalseolinking/process_options/categories');
    }
    
    /*
     * Get module settings
     *
     * @return boolean
    */
    public function shouldProcessProduct()
    {
        return (bool) Mage::getStoreConfig('internalseolinking/process_options/products');
    }
    
    /*
     * Get module settings
     *
     * @return integer
    */
    public function getReplacementLimit()
    {
        return (int) Mage::getStoreConfig('internalseolinking/process_options/limit');
    }
    
    /*
     * Get module settings
     *
     * @return integer
    */
    public function shouldProcessAwBlogPage()
    {
        return (bool) Mage::getStoreConfig('internalseolinking/process_options/awblog');
    }

    /*
     * Get module settings
     *
     * @return integer
    */
    public function getExceptionList()
    {
        return Mage::getStoreConfig('internalseolinking/process_options/exceptions');
    }
    
}
