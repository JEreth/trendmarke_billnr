<?php
class Trendmarke_Billnr_Block_Adminhtml_Trendmarke_Billnr extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    public function __construct()
    {
		
        $this->_blockGroup = 'billnr';
        $this->_controller = 'adminhtml_trendmarke_billnr';
      	$this->_headerText = Mage::helper('billnr')->__('Rechnungsnummern');	
    	parent::__construct();
	}
	
	/*protected function _prepareLayout()
   {
       $this->setChild( 'grid',
           $this->getLayout()->createBlock( $this->_blockGroup.'/' . $this->_controller . '_grid',
           $this->_controller . '.grid')->setSaveParametersInSession(true) );
       return parent::_prepareLayout();
   }*/

}

