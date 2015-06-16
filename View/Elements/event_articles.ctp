<?php foreach($events as $event): ?>
    <?=$this->element('event_article', array('event' => $event));?>
<?php endforeach; ?>
