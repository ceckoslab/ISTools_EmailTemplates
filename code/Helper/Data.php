<?php

/**
 * Class ISTools_EmailTemplates_Helper_Data
 *
 * @category     ISTools
 * @package      ISTools_EmailTemplates
 * @author       Igor Solovyov <igorsolovyov@me.com>
 */
class ISTools_EmailTemplates_Helper_Data extends Mage_Core_Helper_Abstract
{
    /**
     * Flag for skipping email sending.
     */
    const SKIP_EMAIL_SENDING      = 'skip_email_sending';

    /**
     * Registry key for email body.
     */
    const EMAIL_BODY_REGISTRY_KEY = 'email_body';

    /**
     * Add a button.
     * This method is used in the layout.
     *
     * @param string $type the type of the page
     * @param string $label button label
     * @param string $actionName controller action name
     *
     * @return array
     */
    public function addButton($type = null, $label = '', $actionName = '')
    {
        return array(
            'label'     => Mage::helper('adminhtml')->__($label),
            'onclick'   =>  'setLocation(\'' . $this->_getEmailPreviewUrl($type, $actionName) . '\')',
        );
    }

    /**
     * Return url for email preview.
     *
     * @param string $type the type of the page
     * @param string $actionName controller action name
     *
     * @return string
     */
    protected function _getEmailPreviewUrl($type, $actionName = '')
    {
        switch ($type) {
            case 'order_view':
                /** @var Mage_Adminhtml_Block_Sales_Order_View $block */
                $block = Mage::app()->getLayout()->getBlock('sales_order_edit');
                $url = $block->getUrl('*/sales_order/'.$actionName, array(
                    'order_id' => $block->getOrderId(),
                ));
                break;

            case 'invoice_view':
                /** @var Mage_Adminhtml_Block_Sales_Order_Invoice_View $block */
                $block = Mage::app()->getLayout()->getBlock('sales_invoice_view');
                $url = $block->getUrl('*/sales_order_invoice/'.$actionName, array(
                    'invoice_id' => $block->getInvoice()->getId(),
                ));
                break;

            case 'shipment_view':
                /** @var Mage_Adminhtml_Block_Sales_Order_Shipment_View $block */
                $block = Mage::app()->getLayout()->getBlock('sales_shipment_view');
                $url = $block->getUrl('*/sales_order_shipment/'.$actionName, array(
                    'shipment_id' => $block->getShipment()->getId(),
                ));
                break;

            case 'creditmemo_view':
                /** @var Mage_Adminhtml_Block_Sales_Order_Creditmemo_View $block */
                $block = Mage::app()->getLayout()->getBlock('sales_creditmemo_view');
                $url = $block->getUrl('*/sales_order_creditmemo/'.$actionName, array(
                    'creditmemo_id' => $block->getCreditmemo()->getId()
                ));
                break;

            default:
                $url = '';
                break;
        }
        return $url;
    }
}
