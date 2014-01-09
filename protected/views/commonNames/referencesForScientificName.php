<h3>Vernacular-Name references for '<?php echo CHtml::encode($model_scientificNameCache->name); ?>'</h3>
<?php
foreach( $commonName_results as $commonName_result ) {
    // only display 100% matches for reference
    if( $commonName_result['score'] < 100 ) continue;
    ?>
    <p>
        <b><?php echo CHtml::encode($commonName_result['name']); ?></b>
        <?php
        if( !empty($commonName_result['language']) ) {
            ?>
            <i><?php echo CHtml::encode($commonName_result['language']); ?></i>
            <?php
        }
        ?>
        
        <ul>
            <?php
            foreach( $commonName_result['references'] as $commonName_reference ) {
                ?>
                <li><?php echo CHtml::encode($commonName_reference); ?></li>
                <?php
            }
            ?>
        </ul>
    </p>
    <?php
}
