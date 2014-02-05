<?php if (!defined('AC_INCLUDE_PATH')) { exit; }

if (0 === preg_match('#/(guideline|checker|page)#', $this->current_page)) {
    $this->theme = 'default';
    include_once(AC_INCLUDE_PATH . '../' . './themes/default/include/footer.tmpl.php');
} else {
?>
    <div class="center-content" id="footer">
        <ul>
            <li><a href="<?php echo $this->base_path?>page/about.php">About</a></li>
            <li><a href="<?php echo $this->base_path?>page/credits.php">Credits</a></li>
        </ul>
    </div>
    <div class="bottom"><span></span></div><!--  bottom for liquid-round theme -->
    </div> <!--  end center-content div -->
    <!--/div>  end liquid-round div -->

    <!-- Piwik Prod -->
    <script type="text/javascript">
        var pkBaseURL = ("https://statisticheweb.regione.emilia-romagna.it/analytics/");
        document.write(unescape("%3Cscript src='" + pkBaseURL + "piwik.js' type='text/javascript'%3E%3C/script%3E"));
    </script>
    <script type="text/javascript">
        var index1 = location.href.indexOf("applicazioni.regione.emilia-romagna.it");
        var index2 = location.href.indexOf("applicazionitest.regione.emilia-romagna.it");
        var index3 = location.href.indexOf("cm.regione.emilia-romagna.it");
        function pageLoaded()
        {
            try {
                var piwikTracker = Piwik.getTracker(pkBaseURL + "piwik.php", 56);
                piwikTracker.setDocumentTitle(document.domain + "/" + document.title);
                piwikTracker.trackPageView();
                piwikTracker.enableLinkTracking();
            } catch( err ) {}
        }
        if (index1==-1 && index2==-1 && index3==-1)
        {
            document.onload = pageLoaded();
        }
    </script>
    <noscript><p><img src="https://statisticheweb.regione.emilia-romagna.it/analytics/piwik.php?idsite=56" style="border:0" alt="" /></p></noscript>
    <!-- End Piwik Prod Tracking Code -->
    </body>
</html>

<?php } ?>
