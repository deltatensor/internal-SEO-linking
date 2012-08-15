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
 * Adminhtml Internalseolinking controller
 *
 * @category   Ikantam
 * @package    Ikantam_Internalseolinking
 * @author     iKantam Magento Team <support@ikantam.com>
 */
class Ikantam_Internalseolinking_Adminhtml_InternalseolinkingController extends Mage_Adminhtml_Controller_Action
{
    /**
     * Additional initialization
     *
     */
    protected function _construct()
    {
        $this->setUsedModuleName('Ikantam_Internalseolinking');
    }
        
    /**
     * Init layout, menu and breadcrumb
     *
     * @return Ikantam_Internalseolinking_Adminhtml_InternalseolinkingController
     */
    protected function _initAction()
    {
        $this->loadLayout()
            ->_setActiveMenu('internalseolinking/internalseolinking')
            ->_addBreadcrumb($this->__('Internal SEO Linking'), $this->__('Internal SEO Linking'));
        return $this;
    }    
        
    /**
     * Initialize Internalseolinking model instance
     *
     * @return Ikantam_Internalseolinking_Model_Internalseolinking || false
     */
    protected function _initInternalSeoLink()
    {
        $model = Mage::getModel('internalseolinking/internalseolinking');
        $id    = $this->getRequest()->getParam('isl_id');
        
        if ($id) {
            $model->load($id);
            if (!$model->getId()) {
                return false;
            }
        }

        Mage::register('current_internalseolink', $model);
        return $model;
    }
    
        
    /**
     * Internal SEO Links grid
     *
     */    
    public function indexAction() 
    {
        $this->_title($this->__('Internal SEO Linking'));
        $this->_initAction()->renderLayout();
    }
        
    /**
     * Edit Internal SEO Link action
     *
     */
    public function editAction()
    {
        $this->_title($this->__('Internal SEO Linking'));
        
        $helper  = Mage::helper('internalseolinking');
        $session = Mage::getSingleton('adminhtml/session');

        if (!($model = $this->_initInternalSeoLink())) {
            $session->addError($helper->__('Wrong Internal SEO Link was specified'));
            return $this->_redirect('*/*/index', array('store' => $this->getRequest()->getParam('store')));
        }

        $data = $session->getInternalseolinkingData(true);
        if (!empty($data)) {
            $model->addData($data);
        }

        $this->_title($model->getId() ? 'Record #' . $model->getId() : $this->__('New Internal SEO Link'));
        $this->_initAction()->renderLayout();
    }

    /**
     * New Internal SEO Link action
     *
     */
    public function newAction()
    {
        $this->_forward('edit');
    }
  
    /**
     * Save Internal SEO Link action
     *
     */
    public function saveAction()
    {
        $data    = $this->getRequest()->getPost();
        $helper  = Mage::helper('internalseolinking');
        $session = Mage::getSingleton('adminhtml/session');
        
        if ($data) {
            try {
                if (!$model = $this->_initInternalSeoLink()) {
                    $session->addError($helper->__('Wrong Internal SEO Link was specified'));
                    return $this->_redirect('*/*/index');
                }

                $model->addData($data)->save();

                $session->addSuccess($helper->__('Internal SEO Link was successfully saved'));
                $session->setInternalseolinkingData(false);

                $continue = $this->getRequest()->getParam('back');
                
                if ($continue) {
                    return $this->_redirect('*/*/edit', array('isl_id' => $model->getId(), 'ret' => $continue));
                } else {
                    return $this->_redirect('*/*/' . $this->getRequest()->getParam('ret', 'index'));
                }
            } catch (Exception $e) {
                $session->addError($e->getMessage());
                $session->setInternalseolinkingData($data);
                
                return $this->_redirect('*/*/edit', array('isl_id' => $model->getId()));
            }
        }
        
        return $this->_redirect('*/*/index', array('_current' => true));
    }

    /**
     * Delete Internal SEO Link action
     *
     */
    public function deleteAction()
    {
        $model   = $this->_initInternalSeoLink();
        $helper  = Mage::helper('internalseolinking');
        $session = Mage::getSingleton('adminhtml/session');
        
        if ($model && $model->getId()) {
            try {
                $model->delete();
                $session->addSuccess($helper->__('The Internal SEO Link has been deleted'));
            } catch (Exception $e) {
                $session->addError($e->getMessage());
            }
        } else {
            $session->addError($helper->__('Unable to find an Internal SEO Link to delete'));
        }

        $this->getResponse()->setRedirect($this->getUrl('*/*/index'));
    }
    
}
