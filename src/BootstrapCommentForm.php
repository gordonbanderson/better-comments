<?php
/**
 * Created by PhpStorm.
 * User: gordon
 * Date: 22/3/2561
 * Time: 12:37 น.
 */

namespace Suilven\BetterComments;


use SilverStripe\Comments\Controllers\CommentingController;
use SilverStripe\Comments\Forms\CommentForm;

class BootstrapCommentForm extends CommentForm
{
    /**
     * BootstrapCommentForm constructor.  Extend the standard CommentForm class and add extra functionality
     * @param $name
     * @param CommentingController $controller
     */
    public function __construct($name, CommentingController $controller)
    {
        parent::__construct($name, $controller);
        $this->convertToBootStrap();
    }

    /**
     * Add bootstrap classes to the form fields
     */
    private function convertToBootStrap()
    {
        $fields = $this->Fields();

        // the comments form is in a composite field.  Add form-control to allow fields full width, and mb-4 for padding
        foreach($fields as $field)
        {
            $clazz = get_class($field);

            if ("{$clazz}" == 'SilverStripe\Forms\CompositeField') {
                /** @var CompositeField $compositeFields */
                $compositeFields = $field;

                foreach($compositeFields->FieldList() as $commentField) {
                    error_log($commentField->getName());
                    $commentField->addExtraClass('form-control');
                    $commentField->addExtraClass('mb-4');
                }
            }
        }

        // make actions primary, here the submit button
        $actionFields = $this->Actions();
        foreach($actionFields as $actionField) {
            $actionField->addExtraClass('float-sm-right');
            $actionField->addExtraClass('btn');
            $actionField->addExtraClass('btn-primary');
        }
    }
}
