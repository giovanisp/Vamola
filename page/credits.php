<?php
define('AC_INCLUDE_PATH', '../include/');
include_once(AC_INCLUDE_PATH.'vitals.inc.php');
include_once(AC_INCLUDE_PATH.'header.inc.php');
?>

<h1 class="titolo_req">Credits</h1>

<div class=".div_centered_text">
    <div class="contenitore-loghi">
        <a  href="http://idrc.ocad.ca/" title="Inclusive Design Research Centre - OCAD University" ><img class="img_ocad" src="<?php echo 'themes/'. $_SESSION['prefs']['PREF_THEME'] ?>/images/IDI.png"  alt="Inclusive Design Research Centre - OCAD University" /></a>
        <a  href="http://www.unibo.it" title="Universit&agrave; di Bologna"><img class="img_logo" src="<?php echo 'themes/'. $_SESSION['prefs']['PREF_THEME'] ?>/images/logo_unibo_large.gif"  alt="Universit&agrave; di Bologna" /></a>
        <a  href="http://www.asphi.it" title="Fondazione Asphi Onlus" ><img class="img_logo" src="<?php echo 'themes/'. $_SESSION['prefs']['PREF_THEME'] ?>/images/logo_asphi.gif"  alt="Fondazione Asphi Onlus" /></a>
        <a  href="http://www.regione.emilia-romagna.it/" title="Regione Emilia-Romagna"><img class="img_logo" src="<?php echo 'themes/'. $_SESSION['prefs']['PREF_THEME'] ?>/images/logopictra_large.jpg" alt="Regione Emilia-Romagna" /></a>
        <a  href="http://www.regionedigitale.net/piano-telematico-2011-2013/che-cose-piter" title="Piano Telematico dell'Emilia Romagna"><img class="img_logo" src="<?php echo 'themes/'. $_SESSION['prefs']['PREF_THEME'] ?>/images/piter_large.gif"  alt="Piano Telematico dell'Emilia Romagna" /></a>
        <a  href="http://www.csipiemonte.it" title="CSI-Piemonte"><img class="img_csi" src="<?php echo 'themes/'. $_SESSION['prefs']['PREF_THEME'] ?>/images/csi_piemonte.jpeg"  alt="CSI-Piemonte" /></a>

        <h2 class="p_credits"><?php echo _AC('THANKS');?></h2>
        <p><span class="p_span_credits"> Matteo Battistelli, Filippo Borghesi, Matteo Casadei, Leo Cerreta, Jacopo Deyla, Andrea Di Pizio, Francesco Giargoni, Giovanni Grazia, Vincenzo Mania, Silvia Mirri, Michela Molinari, Roberto Montebelli, Ludovico Antonio Muratori, Ennio Paiella, Luca Rinero, Paola Salomoni, Simone Spagnoli, Pierluigi Tassi <?php echo _AC('and') ?> Marina Vritz. </span></p>
    </div>
</div>

<?php include(AC_INCLUDE_PATH.'footer.inc.php'); ?>
