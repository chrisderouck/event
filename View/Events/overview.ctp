<?php if (count($running_events) > 0): ?>
    <h1><?=__('Events currently happening')?></h1>
    <?=$this->element('event_articles', array('events' => $running_events));?>
<?php endif; ?>

<?php if (count($future_events) > 0): ?>
    <h1><?=__('Future events')?></h1>
    <?=$this->element('event_articles', array('events' => $future_events));?>
<?php else: ?>
    <p><?=__('There are no more events planned in the future.')?></p>
<?php endif; ?>

<br>
<br>

<?php if(!isset($no_older_events)): ?>
    <?=$this->Html->link(__('Passed events'), array('controller' => 'events','action'=> 'old_events')); ?>
<?php endif;?>