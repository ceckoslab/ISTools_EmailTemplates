<?php
/**
 * Class ISTools_EmailTemplates_Adminhtml_Email_Templates_SalesController
 *
 * @category     ISTools
 * @package      ISTools_EmailTemplates
 * @author       Igor Solovyov <igorsolovyov@me.com>
 */
class ISTools_EmailTemplates_Adminhtml_Email_Templates_SalesController extends Mage_Adminhtml_Controller_Action
{
    /**
     * Try to send an email and retrieve body of a message from the registry
     *
     * @return ISTools_EmailTemplates_Adminhtml_Email_Templates_SalesController
     */
    public function viewTemplateAction()
    {
        /** @var Mage_Core_Controller_Request_Http $request */
        $request = $this->getRequest();

        /**
         * $entity could be an instance of one of the following classes:
         * Mage_Sales_Model_Order
         * Mage_Sales_Model_Order_Invoice
         * Mage_Sales_Model_Order_Shipment
         * Mage_Sales_Model_Order_Creditmemo
         */
        $entity = $request->getParam('entity');

        /**
         * @var string $emailType Contains a type of the email to be shown, could be either new or update
         */
        $emailType = $request->getParam('email_type');
        $backUrl   = $request->getParam('back_url');

        if ($entity) {
            // Try to send an email. After this we have message body in the registry.
            switch ($emailType) {
                case 'new':
                    $action = ($entity instanceof Mage_Sales_Model_Order) ? 'sendNewOrderEmail' : 'sendEmail';
                    $entity->$action(true);
                    break;

                case 'update':
                    $action = ($entity instanceof Mage_Sales_Model_Order) ? 'sendOrderUpdateEmail' : 'sendUpdateEmail';
                    $entity->$action(true);
                    break;
            }

            // We don't need layout for this, so just put the body in response
            $body = Mage::registry(ISTools_EmailTemplates_Helper_Data::EMAIL_BODY_REGISTRY_KEY);
            if ($body) {
                return $this->getResponse()->setBody($body);
            } else {
                $this->_getSession()->addError($this->__('Failed to load the email template.'));
                return $this->_redirectUrl($backUrl);
            }
        }

        return $this->_redirectReferer();
    }
}
