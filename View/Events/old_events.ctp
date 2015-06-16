<?php if (count($events) > 0): ?>
    <h1>Gepasseerde evenementen in <?=$year?></h1>
    <?=$this->element('event_articles', array('events' => $events));?>
<?php else: ?>
    <p>Er zijn geen evenemenen gepasseerd in <?=$year?></p>
<?php endif; ?>

<?php if(!isset($no_older_events)): $older_year = $year - 1;?>
    <?=$this->Html->link("Evenementen uit $older_year", array('controller' => 'events','action'=> 'old_events', $older_year)); ?>
<?php endif;?>

<?php if(!isset($no_newer_events)): $next_year = $year + 1;?>
<?=$this->Html->link("Evenementen uit $next_year", array('controller' => 'events','action'=> 'old_events', $next_year)); ?>
<?php endif;?>

<?=$this->Html->link('Huidige evenementen', array('controller' => 'events','action'=> 'overview')); ?>
