<?php
class Trendmarke_Billnr_Block_Adminhtml_Trendmarke_Billnr_Edit_Form extends Mage_Adminhtml_Block_Widget_Form
{
	
	protected function _prepareLayout() {
	    $return = parent::_prepareLayout();
	    if (Mage::getSingleton('cms/wysiwyg_config')->isEnabled()) {
		    $this->getLayout()->getBlock('head')->setCanLoadTinyMce(true);
	    }
	    return $return;
	}
	
    protected function _prepareForm()
    {
        $form = new Varien_Data_Form(array(
            'id'        => 'edit_form',
            'action'    => $this->getUrl('*/*/save', array('id' => $this->getRequest()->getParam('id'))),
            'method'    => 'post'
        ));

        $fieldset = $form->addFieldset('edit_term', array('legend' => Mage::helper('billnr')->__('Neue Rechnungsnummer')));

        $fieldset->addField('increment_id', 'text', array(
            'name'      => 'increment_id',
            'title'     => Mage::helper('billnr')->__('Rechnungsnummer'),
            'label'     => Mage::helper('billnr')->__('Rechnungsnummer'),
            'maxlength' => '50',
            'required'  => true,
        ));

        $form->setUseContainer(true);
        $form->setValues(Mage::registry('frozen_term')->getData());
        $this->setForm($form);
        return parent::_prepareForm();
    }
}
