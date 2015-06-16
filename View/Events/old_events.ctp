<?php if (count($events) > 0): ?>
    <h1><?=__('Passed events from ') . $year?></h1>
    <?=$this->element('event_articles', array('events' => $events));?>
<?php else: ?>
    <p><?=__('There were no events in ')?> <?=$year?></p>
<?php endif; ?>

<?php if(!isset($no_older_events)): $older_year = $year - 1;?>
    <?=$this->Html->link(__('Events from ') . $older_year, array('controller' => 'events','action'=> 'old_events', $older_year)); ?>
<?php endif;?>

<?php if(!isset($no_newer_events)): $next_year = $year + 1;?>
<?=$this->Html->link(__('Events from ') . $next_year, array('controller' => 'events','action'=> 'old_events', $next_year)); ?>
<?php endif;?>

<?=$this->Html->link(__('Current Events'), array('controller' => 'events','action'=> 'overview')); ?>
