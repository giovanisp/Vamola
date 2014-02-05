<?php
define('AC_INCLUDE_PATH', '../include/');
include_once(AC_INCLUDE_PATH.'vitals.inc.php');
include_once(AC_INCLUDE_PATH.'header.inc.php');
?>

<h1 class="titolo_req">About</h1>

<div>
    <div class="about">
<p>Il Validatore VaMoL&agrave; ha come obiettivo supportare la validazione manuale tramite la verifica automatica di alcuni requisiti di accessibilità. Il validatore verifica la conformit&agrave; ai requisiti della Legge Italiana 4/2004 (“Disposizioni per favorire l'accesso dei soggetti disabili agli strumenti informatici”, anche nota come Legge Stanca) e/o alle linee guida WCAG (Web Content Accessibility Guidelines) 2.0 del W3C. </p>
<p>Il gennaio 2014 il Validatore &egrave; stato aggiornato all'ultima versione dei requisiti tecnici del DECRETO 20 marzo 2013, pubblicati in <a href="http://www.gazzettaufficiale.it/eli/id/2013/09/16/13A07492/sg">Gazzetta Ufficiale a settembre 2013</a>. </p>
<p>Questo validatore &egrave; un progetto open source ed &egrave; stato sviluppato a partire dal validatore AChecker. Il motore della validazione e l'interfaccia sono ancora in fase di test e potrebbe contenere errori, vi preghiamo di segnalarceli scrivendo a <a href="mailto:webmaster@regione.emilia-romagna.it">webmaster@regione.emilia-romagna.it</a>.
</p><p>Per contribuire al codice ed al suo miglioramento: <a href="https://github.com/RegioneER/Vamola">Vamol&agrave; su Github</a></p>
    </div>
</div>

<?php include(AC_INCLUDE_PATH.'footer.inc.php'); ?>
