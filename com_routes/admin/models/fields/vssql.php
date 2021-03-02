<?php

defined('_JEXEC') or exit();

JFormHelper::loadFieldClass('sql');

class JFormFieldVSSQL extends JFormFieldSQL {

    /**
     * The form type field
     */
    public $type = 'VSSQL';

    /**
     * Overrides parent method
     */
    protected function getOptions() {

        //Get the ID
        $query_id = $this->form->getField((string) $this->element['query_id']);

        //Override query
        $this->query = str_replace('{query_id}', (string) $query_id->value, (string) $this->element['query']);

        return parent::getOptions();
    }

}