<?php

/**
 * Class ISTools_EmailTemplates_Model_Adminhtml_Observer
 *
 * @category     ISTools
 * @package      ISTools_EmailTemplates
 * @author       Igor Solovyov <igorsolovyov@me.com>
 */
class ISTools_EmailTemplates_Model_Adminhtml_Observer
{
    /**
     * Set flag that is used to skip sending of emails
     *
     * @param Varien_Event_Observer $observer
     * @return ISTools_EmailTemplates_Model_Adminhtml_Observer
     */
    public function controllerActionPreDispatchAdminhtml(Varien_Event_Observer $observer)
    {
        /** @var Mage_Adminhtml_Controller_Action $controller */
        $controller = $observer->getData('controller_action');

        if ($controller->getRequest()->getControllerModule() == 'ISTools_EmailTemplates_Adminhtml') {
            Mage::register(ISTools_EmailTemplates_Helper_Data::SKIP_EMAIL_SENDING, true);
        }

        return $this;
    }

    /**
     * Remove flag for skipping email sending
     *
     * @param Varien_Event_Observer $observer
     * @return ISTools_EmailTemplates_Model_Adminhtml_Observer
     */
    public function controllerActionPostDispatchAdminhtml(Varien_Event_Observer $observer)
    {
        Mage::unregister(ISTools_EmailTemplates_Helper_Data::SKIP_EMAIL_SENDING);
        return $this;
    }
}
