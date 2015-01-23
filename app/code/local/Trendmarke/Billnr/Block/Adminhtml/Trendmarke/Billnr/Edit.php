<?php
class Trendmarke_Billnr_Block_Adminhtml_Trendmarke_Billnr_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    public function __construct()
    {
        parent::__construct();

        $this->_blockGroup = 'billnr';
        $this->_mode = 'edit';
        $this->_controller = 'adminhtml_trendmarke_billnr';

        if( $this->getRequest()->getParam($this->_objectId) ) {
            $invoice = Mage::getModel('sales/order_invoice');
			$invoice->load($this->getRequest()->getParam($this->_objectId));
            Mage::register('frozen_term', $invoice);
        }
    }

    public function getHeaderText()
    {
	    return Mage::helper('billnr')
          ->__("Bearbeite %s",
               $this->htmlEscape(Mage::registry('frozen_term')->getIncrementId()));
    }
}
