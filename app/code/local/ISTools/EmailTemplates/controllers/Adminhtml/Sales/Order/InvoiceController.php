<?php
require_once Mage::getModuleDir('controllers', 'Mage_Adminhtml') . DS . 'Sales' . DS . 'Order' . DS . 'InvoiceController.php';

/**
 * Class ISTools_EmailTemplates_Adminhtml_Sales_Order_InvoiceController
 *
 * REWRITE NOTE: add actions to handle email templates
 *
 * @category     ISTools
 * @package      ISTools_EmailTemplates
 * @author       Igor Solovyov <igorsolovyov@me.com>
 */
class ISTools_EmailTemplates_Adminhtml_Sales_Order_InvoiceController extends Mage_Adminhtml_Sales_Order_InvoiceController
{
    /**
     * View invoice_new email template
     *
     * @return ISTools_EmailTemplates_Adminhtml_Sales_Order_InvoiceController
     */
    public function viewInvoiceNewTemplateAction()
    {
        /** @var Mage_Sales_Model_Order_Invoice $invoice */
        $invoice = $this->_initInvoice();
        $this->_forward('viewTemplate', 'email_templates_sales', null, array(
            'entity'     => $invoice,
            'email_type' => 'new',
            'back_url'   => $this->_getBackUrl($invoice),
        ));
        return $this;
    }

    /**
     * View invoice_update email template
     *
     * @return ISTools_EmailTemplates_Adminhtml_Sales_Order_InvoiceController
     */
    public function viewInvoiceUpdateTemplateAction()
    {
        /** @var Mage_Sales_Model_Order_Invoice $invoice */
        $invoice = $this->_initInvoice();
        $this->_forward('viewTemplate', 'email_templates_sales', null, array(
            'entity'     => $invoice,
            'email_type' => 'update',
            'back_url'   => $this->_getBackUrl($invoice),
        ));
        return $this;
    }

    /**
     * Get back URL
     *
     * @param Mage_Sales_Model_Order_Invoice $invoice
     * @return string
     */
    protected function _getBackUrl(Mage_Sales_Model_Order_Invoice $invoice)
    {
        return $this->getUrl('*/sales_invoice/view', array(
            'invoice_id' => $invoice->getId(),
        ));
    }
}
