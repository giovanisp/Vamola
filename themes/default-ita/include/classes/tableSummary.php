<?php

require_once(AC_INCLUDE_PATH . 'classes/DAO/DAO.class.php');
require_once(AC_INCLUDE_PATH . 'classes/DAO/GuidelineGroupsDAO.class.php');
require_once(AC_INCLUDE_PATH . 'lib/Savant3.php');

class tableSummary
{

    protected $DAO; // new DAO
    protected $GuidelineGroupsDAO; // new GuidelineGroupsDAO
    protected $template; // new Savant
    protected $guideline_type = 'guideline';
    protected $guidelines_types = 'guidelines';
    protected $guideline_groups = array();
    protected $errors = array();
    protected $warnings = array();
    protected $output = array();

    public function __construct($guideline_id, $validation_error_report)
    {
        $this->DAO = new DAO;
        $this->GuidelineGroupsDAO = new GuidelineGroupsDAO;
        $this->template = new Savant3(array('template_path' => __DIR__ . '/../../checker'));

// Se le guideline sono Stanca/Allegato A, allora abbiamo: Requisiti
        if (in_array($guideline_id, array(3,10)))
        {
            $this->guideline_type = 'requirement';
            $this->guidelines_types = 'requirements';
        }

// Definisco i gruppi della linea guida
        foreach($this->GuidelineGroupsDAO->getNamedGroupsByGuidelineID($guideline_id) as $group_number => $group_data)
        {
            $this->_populateErrorsInGroupsFromValidation($group_data['group_id'], $validation_error_report);

            $this->guideline_groups[$group_data['group_id']] = array(
                'number' => $group_number,
//                'name' => substr($group_data['text'],0, strpos($group_data['text'],':')),
                'name' => $group_data['text'],
                'number_of_errors' => count($this->errors[$group_data['group_id']]),
                'number_of_warnings' => count($this->warnings[$group_data['group_id']]),
            );

//            var_dump(array(
//                'istanze ERRORS: ' => array_count_values($this->errors[$group_data['group_id']]),
//                'istanze WARNINGS' => array_count_values($this->warnings[$group_data['group_id']]),
//            ));
        }


// Definisco le variabili e le passo alla view;
        $this->output = array(
            'image_dir' => AC_BASE_HREF . 'themes/default-ita/images',
            'guideline_type' => _AC($this->guideline_type),
            'errors' => _AC('errors'),
            'human_checks' => _AC('human_checks'),
            'status' => _AC('status'),
            'warnings' => _AC('warnings'),
            'guideline_groups' => $this->guideline_groups,
        );
        $this->template->assign($this->output);
    }

    protected function _populateErrorsInGroupsFromValidation($group_id, $validation)
    {
        $sql = "SELECT gs.group_id, c.check_id, c.confidence FROM " . TABLE_PREFIX ."subgroup_checks sc
                INNER JOIN " . TABLE_PREFIX . "checks c ON sc.check_id = c.check_id
                INNER JOIN " . TABLE_PREFIX . "guideline_subgroups gs ON sc.subgroup_id = gs.subgroup_id
                WHERE c.open_to_public = 1 AND gs.group_id = %d AND c.check_id = %d";

        foreach($validation as $v)
        {
            $errors = $this->DAO->execute(sprintf($sql, $group_id, $v['check_id']));

            if (false <> $errors)
            {
                foreach($errors as $error)
                {
                    switch($error['confidence'])
                    {
                        case KNOWN: // Se è un errore
                            $this->errors[$error['group_id']][] = $error['check_id'];
                            break;
                        default: // Se è un warning
                            $this->warnings[$error['group_id']][] = $error['check_id'];
                    }
                }
            }
        }
    }

    public function display()
    {
        $this->template->display('summary_table.tmpl.php');
    }

} 
