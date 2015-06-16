<?php if (count($running_events) > 0): ?>
    <h1>Evenementen die bezig zijn</h1>
    <?=$this->element('event_articles', array('events' => $running_events));?>
<?php endif; ?>

<?php if (count($future_events) > 0): ?>
    <h1>Evenementen in de toekomst</h1>
    <?=$this->element('event_articles', array('events' => $future_events));?>
<?php else: ?>
    <p>Er zijn geen evenemenen meer gepland in de toekomst.</p>
<?php endif; ?>

<br>
<br>

<?php if(!isset($no_older_events)): ?>
    <?=$this->Html->link('Gepasseerde evenementen', array('controller' => 'events','action'=> 'old_events')); ?>
<?php endif;?>