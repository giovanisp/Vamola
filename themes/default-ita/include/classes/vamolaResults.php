<?php
/**
 * Created by PhpStorm.
 * User: Tassi_P
 * Date: 29/01/14
 * Time: 11.50
 */

class vamolaResults {

    protected $aChecker;
    protected $has_errors = true;
    protected $has_warnings = true;
    protected $likely = false;

    public function __construct($aChecker)
    {
        $this->aChecker = $aChecker;

        // La validazione esiste
        if(isset($this->aChecker->aValidator))
        {
            // non contiene errori
            if (0 == $this->aChecker->num_of_errors)
            {
                $this->has_errors = false;
            }
            if ( 0 ==
                $this->aChecker->num_of_likely_problems_no_decision +
                $this->aChecker->num_of_likely_problems +
                $this->aChecker->num_of_potential_problems_no_decision +
                $this->aChecker->num_of_potential_problems
            )
            {
                $this->has_warnings = false;
            }
        }
    }

    public function getErrors()
    {
        return $this->has_errors;
    }

    public function getWarnings()
    {
        return $this->has_warnings;
    }

    public function debug($variable)
    {
        return '<pre style="max-width:1024px; margin:1em; padding:1em; background:#eee; border:1px solid red;">'. htmlentities(var_export($variable, true)) . '</pre>';
    }

} 
