<?php
require_once Mage::getModuleDir('controllers', 'Mage_Adminhtml') . DS . 'Sales' . DS . 'Order' . DS . 'ShipmentController.php';

/**
 * Class ISTools_EmailTemplates_Adminhtml_Sales_Order_ShipmentController
 *
 * REWRITE NOTE: add actions to handle email templates
 *
 * @category     ISTools
 * @package      ISTools_EmailTemplates
 * @author       Igor Solovyov <igorsolovyov@me.com>
 */
class ISTools_EmailTemplates_Adminhtml_Sales_Order_ShipmentController extends Mage_Adminhtml_Sales_Order_ShipmentController
{
    /**
     * view shipment_new email template
     *
     * @return ISTools_EmailTemplates_Adminhtml_Sales_Order_ShipmentController
     */
    public function viewShipmentNewTemplateAction()
    {
        /** @var Mage_Sales_Model_Order_Shipment $shipment */
        $shipment = $this->_initShipment();
        $this->_forward('viewTemplate', 'email_templates_sales', null, array(
            'entity'     => $shipment,
            'email_type' => 'new',
            'back_url'   => $this->_getBackUrl($shipment),
        ));
        return $this;
    }

    /**
     * view shipment_update email template
     *
     * @return ISTools_EmailTemplates_Adminhtml_Sales_Order_ShipmentController
     */
    public function viewShipmentUpdateTemplateAction()
    {
        /** @var Mage_Sales_Model_Order_Shipment $shipment */
        $shipment = $this->_initShipment();
        $this->_forward('viewTemplate', 'email_templates_sales', null, array(
            'entity'     => $shipment,
            'email_type' => 'update',
            'back_url'   => $this->_getBackUrl($shipment),
        ));
        return $this;
    }

    /**
     * Get back URL
     *
     * @param Mage_Sales_Model_Order_Shipment $shipment
     * @return string
     */
    protected function _getBackUrl(Mage_Sales_Model_Order_Shipment $shipment)
    {
        return $this->getUrl('*/sales_shipment/view', array(
            'shipment_id' => $shipment->getId(),
        ));
    }
}
