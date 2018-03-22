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
    public function __construct($name, CommentingController $controller)
    {
        parent::__construct($name, $controller);
        error_log('*** BCF ****');
        $this->convertToBootStrap();
    }

    private function convertToBootStrap()
    {
        error_log('OVERRIDE FORM METHOD');
        $fields = $this->Fields();        /**
         */
        foreach($fields as $field)
        {
            error_log('FIELD!');
            error_log(get_class($field));
            $clazz = get_class($field);

            if ("{$clazz}" == 'SilverStripe\Forms\CompositeField') {
                error_log('COMPOSITE');
                /** @var CompositeField $compositeFields */
                $compositeFields = $field;

                foreach($compositeFields->FieldList() as $commentField) {
                    error_log($commentField->getName());
                    $commentField->addExtraClass('form-control');
                    $commentField->addExtraClass('mb-4');
                }
            }
        }

        $actionFields = $this->Actions();
        foreach($actionFields as $actionField) {
            error_log('ACTION: ' . $actionField->getName());
            $actionField->addExtraClass('float-sm-right');
            $actionField->addExtraClass('btn');
            $actionField->addExtraClass('btn-primary');
        }
    }
}
