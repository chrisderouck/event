<?php
$events = $this->requestAction(array('plugin'=>'event', 'controller'=>'events', 'action'=>'overview'));

if (count($events) > 0): ?>
    <div id="kalender">
        <h2><?=__d('event', 'Quick Calendar')?></h2>

        <?=$this->element('Event.event_articles', array('events' => $events));?>

        <?=$this->Html->link(__d('event', 'Full Calendar'), array('plugin'=>'event', 'controller'=>'events', 'action' => 'overview'), array('class' => 'button'))?>

        <div class="cleaner"></div>
    </div>
<?php endif; ?>