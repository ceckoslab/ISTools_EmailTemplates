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
     * Set flag that is used to skip sending of emails.
     * Enable hints for templates and blocks.
     *
     * @param Varien_Event_Observer $observer
     * @return ISTools_EmailTemplates_Model_Adminhtml_Observer
     */
    public function emailViewPreDispatchAdminhtml(Varien_Event_Observer $observer)
    {
        /** @var Mage_Adminhtml_Controller_Action $controller */
        $controller = $observer->getData('controller_action');

        Mage::register(ISTools_EmailTemplates_Helper_Data::SKIP_EMAIL_SENDING, true);

        $hints  = Mage::getStoreConfig('dev/is_tools/email_template_hints');
        if ($hints) {
            /** @var Mage_Core_Model_Config $config */
            $config = Mage::getConfig();

            $storeCodes = array_keys(Mage::app()->getStores(true, true));
            foreach ($storeCodes as $storeCode) {
                $config->setNode("stores/{$storeCode}/" . Mage_Core_Block_Template::XML_PATH_DEBUG_TEMPLATE_HINTS, $hints);
                $config->setNode("stores/{$storeCode}/" . Mage_Core_Block_Template::XML_PATH_DEBUG_TEMPLATE_HINTS_BLOCKS, $hints);
                $config->setNode("stores/{$storeCode}/" . Mage_Core_Helper_Data::XML_PATH_DEV_ALLOW_IPS, '');
            }
        }
        return $this;
    }
}
