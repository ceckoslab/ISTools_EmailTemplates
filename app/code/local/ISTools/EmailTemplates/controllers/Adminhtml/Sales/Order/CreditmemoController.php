<?php
require_once Mage::getModuleDir('controllers', 'Mage_Adminhtml') . DS . 'Sales' . DS . 'Order' . DS . 'CreditmemoController.php';

/**
 * Class ISTools_EmailTemplates_Adminhtml_Sales_Order_CreditmemoController
 *
 * REWRITE NOTE: add actions to handle email templates
 *
 * @category     ISTools
 * @package      ISTools_EmailTemplates
 * @author       Igor Solovyov <igorsolovyov@me.com>
 */
class ISTools_EmailTemplates_Adminhtml_Sales_Order_CreditmemoController extends Mage_Adminhtml_Sales_Order_CreditmemoController
{
    /**
     * View creditmemo_new email template
     *
     * @return ISTools_EmailTemplates_Adminhtml_Sales_Order_CreditmemoController
     */
    public function viewCreditmemoNewTemplateAction()
    {
        /** @var Mage_Sales_Model_Order_Creditmemo $creditmemo */
        $creditmemo = $this->_initCreditmemo();
        $this->_forward('viewTemplate', 'email_templates_sales', null, array(
            'entity'     => $creditmemo,
            'email_type' => 'new',
            'back_url'   => $this->_getBackUrl($creditmemo),
        ));
        return $this;
    }

    /**
     * View creditmemo_update email template
     *
     * @return ISTools_EmailTemplates_Adminhtml_Sales_Order_CreditmemoController
     */
    public function viewCreditmemoUpdateTemplateAction()
    {
        /** @var Mage_Sales_Model_Order_Creditmemo $creditmemo */
        $creditmemo = $this->_initCreditmemo();
        $this->_forward('viewTemplate', 'email_templates_sales', null, array(
            'entity'     => $creditmemo,
            'email_type' => 'update',
            'back_url'   => $this->_getBackUrl($creditmemo),
        ));
        return $this;
    }

    /**
     * Get back URL
     *
     * @param Mage_Sales_Model_Order_Creditmemo $creditmemo
     * @return string
     */
    protected function _getBackUrl(Mage_Sales_Model_Order_Creditmemo $creditmemo)
    {
        return $this->getUrl('*/sales_creditmemo/view', array(
            'creditmemo_id' => $creditmemo->getId(),
        ));
    }
}
