<?php
/**
 *  * Se le pagine sono diverse da /checker
 * Carico il default theme al fine di mantenere inalterate tutte le altre funzionalità di AChecker
 * */
if (0 === preg_match('#/(guideline|checker|page)#', $this->current_page)) {
    $this->theme = 'default';
    include_once(AC_INCLUDE_PATH . '../' . './themes/default/include/header.tmpl.php');
} else {

if (!defined('AC_INCLUDE_PATH')) { exit; }
$lang_charset = "UTF-8";

?><!DOCTYPE html>
<html lang="it">
<head>
	<title><?php echo SITE_NAME; ?> : <?php echo $this->page_title; ?></title>
	<meta http-equiv="Content-Type" content="text/html; charset=<?php echo $this->lang_charset; ?>" />
	<meta name="Generator" content="VaMoLà Validator, Validatore e Monitor per l'accessibilità. Regione Emilia-Romagna" />
	<meta name="keywords" content="validatore, validazione, applicazione, web, legge, accessibilità, linee, guida, WCAG2, STANCA, Allegato A, a11y, disabilità" />
	<meta name="description" content="VaMoLà Validator, il validatore e Monitor per l'accessibilità sviluppato per controllare che il contenuto dei siti web sia accessibile a tutti secondo la normativa vigente" />
	<base href="<?php echo $this->base_path; ?>" />
	<link rel="shortcut icon" href="<?php echo $this->base_path; ?>images/favicon.ico" type="image/x-icon" />
	<link rel="stylesheet" href="<?php echo $this->base_path.'themes/'.$this->theme; ?>/forms.css" type="text/css" />
    <link rel="stylesheet" href="<?php echo $this->base_path.'themes/'.$this->theme; ?>/css/jquery.ui.core.min.css" type="text/css" />
    <link rel="stylesheet" href="<?php echo $this->base_path.'themes/'.$this->theme; ?>/css/jquery.ui.tabs.min.css" type="text/css" />
    <link rel="stylesheet" href="<?php echo $this->base_path.'themes/'.$this->theme; ?>/css/jquery.ui.theme.min.css" type="text/css" />
    <link rel="stylesheet" href="<?php echo $this->base_path.'themes/'.$this->theme; ?>/styles.css" type="text/css" />
	<!--[if IE]>
	  <link rel="stylesheet" href="<?php echo $this->base_path.'themes/'.$this->theme; ?>/ie_styles.css" type="text/css" />
	<![endif]-->
    <script src="<?php echo $this->base_path; ?>jscripts/lib/jquery.js" type="text/javascript"></script>
	<script src="<?php echo $this->base_path; ?>jscripts/lib/jquery-URLEncode.js" type="text/javascript"></script>
	<script src="<?php echo $this->base_path; ?>jscripts/AChecker.js" type="text/javascript"></script>
    <script src="<?php echo $this->base_path.'themes/'.$this->theme; ?>/js/jquery.ui.core.min.js" type="text/javascript"></script>
    <script src="<?php echo $this->base_path.'themes/'.$this->theme; ?>/js/jquery.ui.widget.min.js" type="text/javascript"></script>
    <script src="<?php echo $this->base_path.'themes/'.$this->theme; ?>/js/jquery.ui.tabs.min.js" type="text/javascript"></script>
	<link rel="icon" type="image/x-icon" href="<?php echo $this->base_path.'themes/'.$this->theme; ?>/images/favicon.ico" />

    <?php echo $this->rtl_css; ?>
	<?php echo $this->custom_head; ?>
    <script type="text/javascript">
        $(function(){
            $('#tabvalidate').tabs({active: 1});
            $('#tabresults').tabs({active: 1});
        });
//        $("html, body").animate({ scrollTop: $('#tabresults').offset().top }, 1000);
    </script>
</head>

<body onload="<?php echo $this->onload; ?>">
<?php if (isset($this->show_jump_to_report)){ ?>
<a href="checker/index.php#output_div"><img src="images/clr.gif" height="1" width="1" alt="<?php echo _AC("jump_to_report"); ?>" /></a>
<?php } ?>
<div id="liquid-round"><div class="top"><span></span></div>
<div class="center-content" id="center-content">
		<div id="logo">
			<a href="<?php echo $this->base_path; ?>"><img src="<?php echo $this->base_path.'themes/'.$this->theme; ?>/images/logoheader.jpg"  alt="<?php echo SITE_NAME; ?>" /></a>
		</div>

	<!-- the sub navigation and guide -->
	<div id="sub-menu">
		<div id="sub-navigation">
		<?php if ($this->sub_menus): ?>
				<?php echo _AC('back_to');  ?>	        
			<?php $num_pages = count($this->sub_menus); ?>
			<?php for ($i=0; $i<$num_pages; $i++): ?>
				<?php if ($this->sub_menus[$i]['url'] == $this->current_page): ?>
					<strong><?php echo $this->sub_menus[$i]['title']; ?></strong>
				<?php else: ?>
					<a href="<?php echo $this->sub_menus[$i]['url']; ?>"><?php echo $this->sub_menus[$i]['title']; ?></a>
				<?php endif; ?>
				<?php if ($i < $num_pages-1): ?>
					|
				<?php endif; ?>
			<?php endfor; ?>
		<?php else: ?>
			&nbsp;
		<?php endif; ?>
		</div>
	</div>


<a id="content" title="<?php echo _AC("content_start"); ?>"></a>
<?php global $msg; $msg->printAll();?>

<?php } // endif not /checker path ?>
