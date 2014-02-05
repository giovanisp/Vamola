<?php

global $onload, $_custom_head;

if (isset($_POST["validate_file"])){
	$init_tab = "AC_by_upload";
} else if (isset($_POST["validate_paste"])){
	$init_tab = "AC_by_paste";
} else {
	$init_tab = "AC_by_uri";
}

if ($_POST["rpt_format"] == REPORT_FORMAT_GUIDELINE) {
	$rpt_format = "by_guideline";
} else if ($_POST["rpt_format"] == REPORT_FORMAT_LINE) {
	$rpt_format = "by_line";
}

$onload="AChecker.input.initialize('".$init_tab."', '".$rpt_format."');";
$_custom_head .= '	<script language="javascript" type="text/javascript">'."\n".
                 '	//<!--'."\n";

ob_start();
require_once(AC_INCLUDE_PATH.'../checker/js/checker_js.php');
$_custom_head .= ob_get_contents();
ob_end_clean();

$_custom_head .= '	//-->'."\n".
                 '	</script>'."\n".
                 '	<script src="'.AC_BASE_HREF.'checker/js/checker.js" type="text/javascript"></script>'."\n";

include(AC_INCLUDE_PATH.'header.inc.php');

if (isset($this->error)) echo $this->error;

/** return the string of a div html to display all the available guidelines
 * 2 formats: checkbox or radio button in front of the guideline
 * @param: $guideline_rows - array of available guidelines
 *         $num_of_guidelines_per_row
 *         $format: "checkbox" or "radio"
 */ 
function get_guideline_div($guideline_rows, $num_of_guidelines_per_row, $format = "checkbox") {
	$output = '				<div id="guideline_in_'.$format .'"';
	if ($format == "checkbox") $output .= ' style="display:none"';
	$output .= '>'."\n";
	$output .= '				<ul class="thirds">'."\n";
	
	$count_guidelines_in_current_row = 0;
	
	if (is_array($guideline_rows))
	{
		foreach ($guideline_rows as $id => $row)
		{
			if ($count_guidelines_in_current_row == 0 || $count_guidelines_in_current_row == $num_of_guidelines_per_row)
			{
				$count_guidelines_in_current_row = 0;
				$output .= "					";
			}

			$output .= '						<li >';
			$output .= '							<input type="';
			
			if ($format == "checkbox") $output .= "checkbox";
			else $output .= "radio";
			
			$output .= '" name="'.$format.'_gid[]" id="'.$format.'_gid_'.$row["guideline_id"].'" value="'. $row["guideline_id"].'"';
			
			// the name of the array for the selected guidelines in the post value are different.
			// "radio_gids" at guideline view and "checkbox_gids" at line view. 
			$gid_name = $format."_gid";
			foreach($_POST[$gid_name] as $gid) {
				if ($gid == $row["guideline_id"]) $output .= ' checked="checked"';
			} 
			$output .= ' />'."\n";
			
			$output .= '							<label for="'.$format.'_gid_'. $row["guideline_id"].'">'. htmlspecialchars($row["title"]).'</label>'."\n";
			$output .= "						</li>\n";
			$count_guidelines_in_current_row++;
		
			if ($count_guidelines_in_current_row == $num_of_guidelines_per_row)
				$output .= "					";
		
		}
	}
	$output .= "				</ul>\n";
	$output .= "			</div>\n";
	
	return $output;
}

/**
 * Debugging closure, since php 5.3 :)
 *
 * @param $string "What needs to be debugged"
 * @return string "Output formatted string, human readable"
 */
$debug = function($string) {
        $debug_output = '<pre style="top:0; right:0; border: 1px solid red; background: #ccc; padding: .5em; margin: .5em; position: absolute;">' . var_export($string, true) . '</pre>' . "\n";
        return sprintf($debug_output, string);
    };
?>


<div class="center-input-form">
<form name="input_form" enctype="multipart/form-data" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>#tabresults" >

	
	<div id="tabvalidate" class="topnavlistcontainer">
		<ul>
			<li><a href="#AC_by_uri" role="button"  title="<?php echo _AC("check_by_uri"); ?> Alt+1" id="AC_menu_by_uri" onclick="return AChecker.input.onClickTab('AC_by_uri');" <?php if (!isset($_POST["validate_paste"]) && !isset($_POST["validate_file"])) echo 'class="active"'; ?>><?php echo(_AC('check_by_uri'))?></a></li>
			<li><a  href="#AC_by_upload" role="button"   title="<?php echo _AC("check_by_upload"); ?> Alt+2" id="AC_menu_by_upload" onclick="return AChecker.input.onClickTab('AC_by_upload');" <?php if (isset($_POST["validate_file"])) echo 'class="active"'; ?>><?php echo(_AC('check_by_upload'))?></a></li>
			<li><a  href="#AC_by_paste" role="button" title="<?php echo _AC("check_by_paste"); ?> Alt+3" id="AC_menu_by_paste" onclick="return AChecker.input.onClickTab('AC_by_paste');" <?php if (isset($_POST["validate_paste"])) echo 'class="active"'; ?>><?php echo(_AC('check_by_paste'))?></a></li>
			</ul>
	
	<!--div class="left-column" -->
	<fieldset class="group_form">
	<legend class="group_form hidden"><?php echo _AC("input"); ?></legend>
        <!--label class="hidden" for="once">Codice univoco</label-->
        <input type="hidden" id="once" name="once" value="<?php echo $this->once;?>">

		<div id="AC_by_uri"  >
			
				<label for="checkuri"><?php echo _AC('URL'); ?>:</label>
				<input type="text" name="uri" id="checkuri" value="<?php if (isset($_POST['uri'])) echo $_POST['uri']; else echo $this->default_uri_value; ?>"   />
				<div class="validation_submit_div">
					<div class="spinner_div">
						<img class="spinner_img" id="AC_spinner_by_uri" style="display:none" src="<?php echo AC_BASE_HREF.'themes/'.$_SESSION['prefs']['PREF_THEME']; ?>/images/spinner.gif" alt="<?php echo _AC("in_progress"); ?>" />
						&nbsp;
					</div>
					<input class="validation_button" type="submit" name="validate_uri" id="validate_uri" value="<?php echo _AC("check_it"); ?>" onclick="return AChecker.input.validateURI();" />
				</div>
		
		</div>
		
		<div id="AC_by_upload" >
            <!--label class="hidden" for="max_file_size">Dimensioni massime del file</label-->
            <input type="hidden" name="MAX_FILE_SIZE" id="max_file_size" value="52428800" />
            <label for="checkfile"><?php echo _AC('file'); ?>:</label>
            <input type="file" id="checkfile" name="uploadfile"  />
            <div class="validation_submit_div">
                <div class="spinner_div">
                    <img class="spinner_img" id="AC_spinner_by_upload" style="display:none" src="<?php echo AC_BASE_HREF.'themes/'.$_SESSION['prefs']['PREF_THEME']; ?>/images/spinner.gif" alt="<?php echo _AC("in_progress"); ?>" />
                    &nbsp;
                </div>
                <input class="validation_button" type="submit" name="validate_file" id="validate_file" value="<?php echo _AC("check_it"); ?>" onclick="return AChecker.input.validateUpload();"  />
            </div>
		</div>
		
		<div id="AC_by_paste" >
			<label for="checkpaste"><?php echo _AC('enter'); ?>:</label>
			<div style="text-align:center;">
				<textarea rows="5" cols="75" name="pastehtml" id="checkpaste"><?php if (isset($_POST['pastehtml'])) echo htmlspecialchars($_POST['pastehtml']); ?></textarea>
				<div class="validation_submit_div">
					<div class="spinner_div">
						<img class="spinner_img" id="AC_spinner_by_paste" style="display:none" src="<?php echo AC_BASE_HREF.'themes/'.$_SESSION['prefs']['PREF_THEME']; ?>/images/spinner.gif" alt="<?php echo _AC("in_progress"); ?>" />
						&nbsp;
					</div>
					<input class="validation_button" type="submit" name="validate_paste" id="validate_paste" value="<?php echo _AC("check_it"); ?>" onclick="return AChecker.input.validatePaste();" />
				</div>
			</div>
		</div>

<div id="div_opzioni">
<?php
/*
	<h3><?php echo _AC("options"); ?></h3>
<!--/div>	
		<div class="div-close" id="button2-aria-requisite">
			<p class="button">
					<a href="javascript:AChecker.toggleDiv('div_options', 'toggle_image');" id="button2"  role="button" aria-controls="general-option"><?php echo _AC("options"); ?></a>
			</p-->


		<ul class="thirds">
		<li ><input type="checkbox" name="enable_html_validation" id="enable_html_validation" value="1" <?php if (isset($_POST["enable_html_validation"])) echo 'checked="checked"'; ?> />
				<label for='enable_html_validation'><?php echo _AC("enable_html_validator"); ?></label>
			</li>
			<li >

				<input type="checkbox" name="enable_css_validation" id="enable_css_validation" value="1" <?php if (isset($_POST["enable_css_validation"])) echo 'checked="checked"'; ?> />
				<label for='enable_css_validation'><?php echo _AC("enable_css_validation"); ?></label>
</li>
<li >
				
				
				<input type="checkbox" name="show_source" id="show_source" value="1" <?php if (isset($_POST["show_source"])) echo 'checked="checked"'; ?> />
				<label for='show_source'><?php echo _AC("show_source"); ?></label>
				</li>
			</ul>
*/?>
			
<h3><?php echo _AC("guidelins_to_check"); ?></h3>
<!-- <ul class="thirds">

<?php
$count_guidelines_in_current_row = 0;

if (is_array($this->rows))
{
	foreach ($this->rows as $id => $row)
	{
		if ($count_guidelines_in_current_row == 0 || $count_guidelines_in_current_row == $this->num_of_guidelines_per_row)
		{
			$count_guidelines_in_current_row = 0;
			echo "			";
		}
?>
				<li >
					<input type="checkbox" name="gid[]" id='gid_<?php echo $row["guideline_id"]; ?>' value='<?php echo $row["guideline_id"]; ?>' <?php 
					if (isset($_POST["gid"]) && is_array($_POST["gid"])) {	
						foreach($_POST["gid"] as $gid) {
							if (intval($gid) == $row["guideline_id"]) echo 'checked="checked"';
						}
					} 
					?> />
					<label for='gid_<?php echo $row["guideline_id"]; ?>'><?php echo htmlspecialchars($row["title"]); ?></label>
				</li>
<?php
		$count_guidelines_in_current_row++;
	
		if ($count_guidelines_in_current_row == $this->num_of_guidelines_per_row)
			echo "			";
	
	}
}
?>

			

			
</ul> -->
<?php 
echo get_guideline_div($this->rows, $this->num_of_guidelines_per_row, "radio");  // used at "view by guideline"
echo get_guideline_div($this->rows, $this->num_of_guidelines_per_row, "checkbox");  // used at "view by line"
?>

            <input type="hidden" name="rpt_format" value="<?php echo REPORT_FORMAT_GUIDELINE; ?>" />
		    <div class="clear"></div>
		    </div>
	    </fieldset>
	</div>
</form>

</div>
</div>
