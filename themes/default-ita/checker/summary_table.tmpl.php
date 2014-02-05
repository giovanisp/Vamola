<!-- WAI ARIA Table -->
<table class="tableSummary">
    <!-- tableSummary header -->
    <tr>
        <th id="thType" rowspan="2"><?php echo $this->eprint($this->guideline_type); ?></th>
        <th id="thErrors" colspan="2"><?php echo $this->eprint($this->errors); ?></th>
        <th id="thHuman" colspan="2"><?php echo $this->eprint($this->human_checks); ?></th>
    </tr>
    <tr>
        <th id="thErrorsStatus" class='subTh'><?php echo $this->eprint($this->status); ?></th>
        <th id="thErrorsErr" class='subTh'><?php echo $this->eprint($this->errors); ?></th>
        <th id="thHumanStatus"  class='subTh'><?php echo $this->eprint($this->status); ?></th>
        <th id="thHumanErr" class='subTh'><?php echo $this->eprint($this->warnings); ?></th>
    </tr>
    <!-- end tableSummary header -->

<?php foreach ($this->guideline_groups as $k => $v):?>
    <!-- row con errori e avvisi -->
    <tr>
        <th id="row-<?php echo $k;?>" class="normal" headers="thType"><?php echo $this->eprint($v['name']) ?></th>
        <td  headers="thErrors thErrorsStatus row-<?php echo $k;?>" class='tdCentered'>
<?php if(0 <> $v['number_of_errors']): ?>
            <img alt="Errori Presenti" src="<?php echo $this->image_dir;?>/error_small.jpg" />
<?php else: ?>
    <img alt="Nessun Errore" src="<?php echo $this->image_dir;?>/ok.jpg" />
<?php endif;?>
        </td>
        <td  headers="thErrors thErrorsErr row-<?php echo $k;?>" class='tdCentered'>
            <?php echo $this->eprint($v['number_of_errors']);?>
        </td>
        <td  headers="thHuman thHumanStatus row-<?php echo $k;?>" class='tdCentered'>
<?php if(0 <> $v['number_of_warnings']): ?>
            <img alt="Avvisi Presenti" src="<?php echo $this->image_dir;?>/warning_small.jpg" />
<?php else: ?>
            <img alt="Nessun Avviso" src="<?php echo $this->image_dir;?>/ok.jpg" />
<?php endif;?>
        </td>
        <td  headers="thHuman thHumanErr row-<?php echo $k;?>" class='tdCentered'>
            <?php echo $this->eprint($v['number_of_warnings']);?>
        </td>
    </tr>
    <!-- end row con errori e avvisi -->
<?php endforeach;?>
</table>
<!-- END OF WAI ARIA Table -->
