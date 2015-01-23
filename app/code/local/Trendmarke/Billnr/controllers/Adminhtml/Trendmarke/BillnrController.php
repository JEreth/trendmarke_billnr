<?php
class Trendmarke_Billnr_Adminhtml_Trendmarke_BillnrController extends Mage_Adminhtml_Controller_Action
{
    protected function _initAction()
	{
		$this->loadLayout();
		$this->_setActiveMenu('sales/billnr');
		$this->_addBreadcrumb(Mage::helper('adminhtml')->__('Catalog'), Mage::helper('billnr')->__('Rechnungsnummmer ändern'));
		return $this;
	}
	
	
	public function indexAction()
    {
		$this->_initAction();
		$this->renderLayout();
    }
    
	/*
    public function newAction() // Create new element
    {
        $this->loadLayout()
        ->_addContent($this->getLayout()
           ->createBlock('billnr/admin_new'))
        ->renderLayout();
    } 
	*/    

    public function postAction() // Save element
    {
        if ($data = $this->getRequest()->getPost()) {
            $term = Mage::getModel('billnr/term')->setData($data);
            try {
                $term->save();
                Mage::getSingleton('adminhtml/session')
                     ->addSuccess(Mage::helper('billnr')
                     ->__('Item was successfully saved'));
                $this->getResponse()->setRedirect($this->getUrl('*/*/'));
                return;
            } catch (Exception $e){
                die($e->getMessage());
                Mage::getSingleton('adminhtml/session')
                  ->addError($e->getMessage());
            }
        }
        $this->getResponse()->setRedirect($this->getUrl('*/*/'));
        return;
    }
    
    public function deleteAction()
{
    $termId = $this->getRequest()->getParam('id', false);

    try {
        Mage::getModel('billnr/term')->setId($termId)->delete();
        Mage::getSingleton('adminhtml/session')
           ->addSuccess(Mage::helper('billnr')
              ->__('Element successfully deleted'));
        $this->getResponse()->setRedirect($this->getUrl('*/*/'));

        return;
    } catch (Exception $e){
        Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
    }

    $this->_redirectReferer();
}

public function editAction()
{
    $this->loadLayout();
    $this->_addContent($this->getLayout()
       ->createBlock('billnr/admin_edit'));
    $this->renderLayout();
}

public function saveAction()
{
    $id = $this->getRequest()->getParam('id', false);
    if ($data = $this->getRequest()->getPost()) {
       	$invoice = Mage::getModel('sales/order_invoice');
		$invoice->load((int) $id);
        $invoice->addData($data);
        try {
            $invoice->save();
			
			if (! $invoice->getId())
				{
					Mage::throwException(Mage::helper('lieferant')->__('Fehler beim Speichern!'));
				}

            Mage::getSingleton('adminhtml/session')
               ->addSuccess(Mage::helper('billnr')
               ->__('Erfolgreich geändert'));
            $this->getResponse()->setRedirect($this->getUrl('*/*/'));
            return;
        } catch (Exception $e){
            Mage::getSingleton('adminhtml/session')
            ->addError($e->getMessage());
        }
    }
    $this->_redirectReferer();
}

    
    
}
