<?php

global $addslashes, $congrats_msg_for_likely, $congrats_msg_for_potential;

include_once(AC_INCLUDE_PATH.'classes/Utility.class.php');
include_once(AC_INCLUDE_PATH.'classes/DAO/UserLinksDAO.class.php');
include_once(__DIR__ . "/../include/classes/vamolaResults.php");

$vamola = new vamolaResults($this);

$user_link_url = '';

?>
<div class="center-content">
	<div class="center-input-form" id="tabresults">
        <a id="report" title="<?php echo _AC("report_start"); ?>"></a>
	    <h2><?php echo _AC("accessibility_review") . ' ('. _AC("guidelines"). ': '.$this->guidelines_text. ')'; ?></h2>

        <ul class="navigation">
            <li><a href="#AC_summary_report" accesskey="1" title="<?php echo _AC("summary_report"); ?> Alt+1"><?php echo _AC('summary_report'); ?></a></li>
            <li><a href="#AC_errors" accesskey="2" title="<?php echo _AC("known_problems"); ?> Alt+2"><?php echo _AC("known_problems"); ?>(<span id="AC_num_of_errors"><?php echo $this->num_of_errors; ?></span>)</a></li>
            <li><a href="#AC_warnings" accesskey="3" title="<?php echo _AC("potential_problems"); ?> Alt+3"><?php echo _AC("potential_problems"); ?> (<span id="AC_num_of_potential"><?php echo $this->num_of_potential_problems_no_decision; ?></span>)</a></li>
<?php
/**
 *          <li><a href="#AC_html_validation" accesskey="4" title="<?php echo _AC("html_validation_result"); ?> Alt+4"><?php echo _AC("html_validation_result"); ?> <?php if (isset($_POST["enable_html_validation"])) echo '(<span id="AC_num_of_html_errors">'.$this->num_of_html_errors."</span>)"; ?></a></li>
 *          <li><a href="#AC_css_validation" accesskey="5" title="<?php echo _AC("css_validation_result"); ?> Alt+5"><?php echo _AC("css_validation_result"); ?> <?php if (isset($this->cssValidator)) echo '(<span id="AC_num_of_css_errors">'.$this->num_of_css_errors."</span>)"; ?></a></li>
 * */
?>
        </ul>

        <div id="AC_summary_report">
            <?php
            // Class Summary Table di Vamolà
            require_once(__DIR__ . '/../include/classes/tableSummary.php');
            $summary = new tableSummary($this->a_rpt->gid, $this->aValidator->getValidationErrorRpt());
            $summary->display();
            ?>
        </div>

        <div id="AC_errors">
<?php if ($vamola->getErrors()) :  ?>
            <?php echo $this->a_rpt->getErrorRpt(); ?>
<?php else : ?>
            <span id="AC_congrats_msg_for_errors" class="congrats_msg">
                <img src="<?php echo AC_BASE_HREF; ?>images/feedback.gif" alt="<?php echo _AC("feedback") ?>" />
                <?php echo _AC("congrats_no_known");?>
            </span>
        
<?php endif; ?>
        </div>

        <div id="AC_warnings">
<?php if ($vamola->getWarnings()) : ?>
            <?php echo $this->a_rpt->getLikelyProblemRpt(); ?>
            <?php echo $this->a_rpt->getPotentialProblemRpt(); ?>
<?php else : ?>
            <span id="AC_congrats_msg_for_potential" class="congrats_msg">
                <?php echo $congrats_msg_for_potential;?>
            </span>
<?php endif;?>
        </div>
<?php
/**
        <div id="AC_html_validation">
<?php if(isset($this->htmlValidator)) : ?>
            <ol>
                <li class="msg_err"><?php echo _AC("html_validator_provided_by");?></li>
            </ol>
    <?php  if(0 <> $this->num_of_html_errors):?>
            <?php echo $this->htmlValidator->getValidationRpt();?>
    <?php else : ?>
            <span class="congrats_msg">
                <img src="<?php echo AC_BASE_HREF; ?>images/feedback.gif" alt="<?php echo _AC("feedback") ?>" />
                <?php echo _AC("congrats_html_validation");?>
            </span>
    <?php endif; ?>
<?php else : ?>
                <p><img src="<?php echo $this->base_path;?>/themes/<?php echo $this->theme;?>/images/warning.jpg" alt="Attenzione" /> Attenzione, occorre passare la validazione del codice HTML</p>
<?php endif; ?>
        </div>

        <div id="AC_css_validation">
<?php if($this->cssValidator) : ?>
            <ol>
                <li class="msg_err"><?php echo _AC("css_validator_provided_by");?></li>
            </ol>
    <?php if(0 <> $this->num_of_css_errors) :?>
            <?php echo $this->cssValidator->getValidationRpt();?>
    <?php else : ?>
            <span class="congrats_msg">
                <img src="<?php echo AC_BASE_HREF; ?>images/feedback.gif" alt="<?php echo _AC("feedback") ?>" />
                <?php echo _AC("congrats_css_validation");?>
            </span>
    <?php endif;?>

<?php else : ?>
            <p><img src="<?php echo $this->base_path;?>/themes/<?php echo $this->theme;?>/images/warning.jpg" alt="Attenzione" /> Attenzione, occorre passare la validazione del codice CSS</p>
<?php endif; // end if ccsValidator ?>
        </div>

if (isset($_POST['validate_file']) || isset($_POST['validate_paste'])) {
	// css validator is only available at validating url, not at validating a uploaded file or pasted html
	echo '<br /><span class="info_msg"><img src="'.AC_BASE_HREF.'images/info.png" width="15" height="15" alt="'._AC("info").'"/>  '._AC("css_validator_unavailable").'</span>';
} else if (isset($this->cssValidator)) {
	// validating url -> css validator option is turned ON
	echo '		<br />'. "\n";
	
	if ($this->cssValidator->containErrors())
		echo $this->cssValidator->getErrorMsg();
	else
	{
		if ($this->num_of_css_errors > 0)
			echo $this->cssValidator->getValidationRpt();
		else
			echo "<br /><span class='congrats_msg'><img src='".AC_BASE_HREF."images/feedback.gif' alt='"._AC("feedback")."' />  ".  _AC("congrats_css_validation") ."</span>";
	}
}

// Show source
if (isset($_POST['show_source']) && isset($this->aValidator)): ?>
        <div id="source" class="validator-output-form">
            <h3><?php echo _AC('source');?></h3>
            <p><?php echo _AC('source_note');?></p>

            <?php echo $this->a_rpt->getSourceRpt();?>
        </div>
<?php endif; // show source
 */ ?>

        <div class="center">Per una verifica completa occorre anche validare codice <a href="http://validator.w3.org/<?php echo ($_POST['uri']) ? 'check?uri='.$_POST['uri']:'';?>">HTML</a> e <a href="http://jigsaw.w3.org/css-validator/<?php echo ($_POST['uri']) ? 'check?uri='.$_POST['uri']:'';?>">CSS</a></div>
    </div>
</div>
