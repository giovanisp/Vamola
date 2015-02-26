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
    <p class="hidden">v<?php echo VERSION;?></p>
    </body>
</html>

<?php } ?>
