<?php

/**
 * Class ISTools_EmailTemplates_Model_Core_Email_Template
 *
 * @category     ISTools
 * @package      ISTools_EmailTemplates
 * @author       Igor Solovyov <igorsolovyov@me.com>
 */
class ISTools_EmailTemplates_Model_Core_Email_Template extends Mage_Core_Model_Email_Template
{
    /**
     * Send mail to recipient
     *
     * REWRITE NOTE: skip email sending if there is a flag in registry
     * Put message body into the registry to make it available in the controller.
     *
     * @param   array|string       $email        E-mail(s)
     * @param   array|string|null  $name         receiver name(s)
     * @param   array              $variables    template variables
     * @return  boolean
     **/
    public function send($email, $name = null, array $variables = array())
    {
        $skipSending = Mage::registry(ISTools_EmailTemplates_Helper_Data::SKIP_EMAIL_SENDING);
        if ($skipSending) {
            $text = $this->getProcessedTemplate($variables);

            // put subject into the body tag
            $subjectHtml = Mage::app()->getLayout()->createBlock('core/template', null, array(
                'template' => 'is_tools/email_templates/additional.phtml',
                'subject'  => $this->getProcessedTemplateSubject($variables),
            ))->toHtml();
            $text = preg_replace('/<body[^>]*>/', "$0{$subjectHtml}", $text);

            Mage::register(ISTools_EmailTemplates_Helper_Data::EMAIL_BODY_REGISTRY_KEY, $text);
            return true;
        }
        return parent::send($email, $name, $variables);
    }
}
