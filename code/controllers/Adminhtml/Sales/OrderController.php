<?php
require_once Mage::getModuleDir('controllers', 'Mage_Adminhtml') . DS . 'Sales' . DS . 'OrderController.php';

/**
 * Class ISTools_EmailTemplates_Adminhtml_Sales_OrderController
 *
 * REWRITE NOTE: add actions to handle email templates
 *
 * @category     ISTools
 * @package      ISTools_EmailTemplates
 * @author       Igor Solovyov <igorsolovyov@me.com>
 */
class ISTools_EmailTemplates_Adminhtml_Sales_OrderController extends Mage_Adminhtml_Sales_OrderController
{
    /**
     * View order_new email template
     *
     * @return ISTools_EmailTemplates_Adminhtml_Sales_OrderController
     */
    public function viewOrderNewTemplateAction()
    {
        /** @var Mage_Sales_Model_Order $order */
        $order = $this->_initOrder();
        $this->_forward('viewTemplate', 'email_templates_sales', null, array(
            'entity'     => $order,
            'email_type' => 'new',
            'back_url'   => $this->_getBackUrl($order),
        ));
        return $this;
    }

    /**
     * View order_update email template
     *
     * @return ISTools_EmailTemplates_Adminhtml_Sales_OrderController
     */
    public function viewOrderUpdateTemplateAction()
    {
        /** @var Mage_Sales_Model_Order $order */
        $order = $this->_initOrder();
        $this->_forward('viewTemplate', 'email_templates_sales', null, array(
            'entity'     => $order,
            'email_type' => 'update',
            'back_url'   => $this->_getBackUrl($order),
        ));
        return $this;
    }

    /**
     * Get back URL
     *
     * @param Mage_Sales_Model_Order $order
     * @return string
     */
    protected function _getBackUrl(Mage_Sales_Model_Order $order)
    {
        return $this->getUrl('*/sales_order/view', array(
            'order_id' => $order->getId(),
        ));
    }
}
