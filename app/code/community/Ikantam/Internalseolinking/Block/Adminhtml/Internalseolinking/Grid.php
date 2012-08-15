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
 * Internalseolinking grid
 *
 * @category   Ikantam
 * @package    Ikantam_Internalseolinking
 * @author     iKantam Team <support@ikantam.com>
 */
class Ikantam_Internalseolinking_Block_Adminhtml_Internalseolinking_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
    /**
     * Initialization
     */
    public function __construct()
    {
        parent::__construct();
        $this->setId('internalseolinking_grid');
        $this->setUseAjax(true);
        $this->setDefaultSort('id');
        $this->setDefaultDir('ASC');
        $this->setSaveParametersInSession(true);
    }

    /**
     * Retrieve collection class
     *
     * @return string
     */
    protected function _getCollectionClass()
    {
        return 'internalseolinking/internalseolinking_collection';
    }

    /**
     * Prepare and set collection of grid
     *
     * @return Ikantam_Internalseolinking_Block_Adminhtml_Internalseolinking_Grid
     */
    protected function _prepareCollection()
    {
        $collection = Mage::getResourceModel($this->_getCollectionClass());
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }
    
    /**
     * Prepare and add columns to grid
     *
     * @return Ikantam_Internalseolinking_Block_Adminhtml_Internalseolinking_Grid
     */
    protected function _prepareColumns()
    {
        $this->addColumn(
            'id', array(
                'header' => Mage::helper('internalseolinking')->__('ID'),
                'align'  => 'right',
                'width'  => '50px',
                'index'  => 'id')
        );
                
        $this->addColumn(
            'keywords', array(
                'header' => Mage::helper('internalseolinking')->__('Keywords'),
                'align'  => 'left',
                'index'  => 'keywords')
        );
                
        $this->addColumn(
            'url', array(
                'header' => Mage::helper('internalseolinking')->__('URL'),
                'align'  => 'left',
                'index'  => 'url')
        );
                
        $this->addColumn(
            'title', array(
                'header' => Mage::helper('internalseolinking')->__('Title'),
                'align'  => 'left',
                'index'  => 'title')
        );
                
        $this->addColumn(
            'is_enabled', array(
                'header'  => Mage::helper('internalseolinking')->__('Enabled'),
                'align'   => 'left',
                'width'   => '75px',
                'index'   => 'is_enabled',
                'type'    => 'options',
                'options' => array(0 => $this->__('No'), 1 => $this->__('Yes')))
        );

        return parent::_prepareColumns();
    }

    /**
     * Get url for row
     *
     * @param string $row
     * @return string
     */
    public function getRowUrl($row)
    {
        return $this->getUrl('*/*/edit', array('isl_id' => $row->getId()));
    }

}
